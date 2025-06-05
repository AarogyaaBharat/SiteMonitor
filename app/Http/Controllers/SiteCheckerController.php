<?php

namespace App\Http\Controllers;

use App\Models\domains;
use App\Models\regexData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use Psr\Http\Message\ResponseInterface;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class SiteCheckerController extends Controller
{
    protected $seoReport = [];
    protected $errorPages = [];
    protected $visitedUrls = [];
    protected $timeoutUrls = [];
    protected $retryQueue = [];
    protected $guzzle;
    protected $baseDomain;
    protected $domainName;
    protected $userAgent = 'Mozilla/5.0 (compatible; LaravelSiteChecker/1.0)';

    public function __construct()
    {
        $this->guzzle = new Client([
            'timeout' => 20,
            'connect_timeout' => 20,
            'headers' => [
                'User-Agent' => $this->userAgent,
                'Accept' => 'text/html,application/xhtml+xml',
                'Accept-Encoding' => 'gzip',
            ],
            'allow_redirects' => [
                'max' => 10,
                'strict' => true,
                'referer' => true,
                'track_redirects' => true
            ],
            'verify' => false,
            'http_errors' => false
        ]);
    }

    public function generate(Request $request)
    {
        set_time_limit(7200);
        $siteUrl = $request->query('site');
        $depth = (int)$request->query('depth', 5);

        if (!$this->validateUrl($siteUrl)) {
            return response()->json(['error' => 'Invalid or missing "site" parameter'], 400);
        }

        domains::create(['url' => $siteUrl]);
        $parsed = parse_url($siteUrl);
        $this->baseDomain = $parsed['scheme'] . '://' . $parsed['host'];
        $this->domainName = $parsed['host'];

        try {
            $sitemapUrls = $this->fetchSitemapUrls();
            if (!empty($sitemapUrls)) {
                $this->processUrls($sitemapUrls, $depth);
            }

            $this->crawlUrl($siteUrl, $depth);
            $sitemapPath = $this->generateSitemap();

            $allurl = array_keys($this->visitedUrls);
//             foreach ($this->visitedUrls as $url => $visited) {
//     try {
//         $response = $this->guzzle->head($url, ['timeout' => 30]);
//         $statusCode = $response->getStatusCode();

//         if (in_array($statusCode, [404, 500])) {
//             $this->errorPages[] = [
//                 'url' => $url,
//                 'status' => $statusCode,
//                 'referencedFrom' => $this->baseDomain,
//                 'error' => 'Page returned error status'
//             ];
//             if ($this->visitedUrls[$url] === true) {
//                 unset($this->visitedUrls[$url]);
//             }
//         }
//     } catch (RequestException $e) {
//         $this->errorPages[] = [
//             'url' => $url,
//             'status' => $e->getCode(),
//             'referencedFrom' => $this->baseDomain,
//             'error' => $e->getMessage()
//         ];
//         // Optional: Remove from visited if timeout or other cURL error
//         unset($this->visitedUrls[$url]);
//     }
// }
            
            return response()->json([
                'status' => 'success',
                'saved_to' => storage_path('app/' . $sitemapPath),
                'url_count' => count($this->visitedUrls),
                'seo_issues' => $this->seoReport,
                'error_pages' => $this->errorPages,
                'visited_urls' => array_keys($this->visitedUrls)
            ]);

        } catch (\Exception $e) {
            Log::error('Site check failed: ' . $e->getMessage());
            return response()->json(['error' => 'Crawling failed: ' . $e->getMessage()], 500);
        }
    }

    private function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) && in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https']);
    }

    private function fetchSitemapUrls()
    {
        $sitemapUrls = [];
        $sitemapLocations = [
            $this->baseDomain . '/sitemap.xml',
            $this->baseDomain . '/sitemap_index.xml'
        ];

        foreach ($sitemapLocations as $sitemapUrl) {
            try {
                $response = $this->guzzle->get($sitemapUrl);
                if ($response->getStatusCode() === 200) {
                    $xml = new \SimpleXMLElement((string)$response->getBody());
                    foreach ($xml->url ?? [] as $url) {
                        $loc = (string)$url->loc;
                        if ($this->validateUrl($loc)) $sitemapUrls[] = $loc;
                    }
                    foreach ($xml->sitemap ?? [] as $sitemap) {
                        $loc = (string)$sitemap->loc;
                        if ($this->validateUrl($loc)) $sitemapUrls[] = $loc;
                    }
                }
            } catch (\Exception $e) {
                Log::notice("Sitemap fetch failed for $sitemapUrl: " . $e->getMessage());
            }
        }

        return array_unique($sitemapUrls);
    }

    private function processUrls(array $urls, $maxDepth)
    {
        $filteredUrls = array_filter($urls, function($url) {
            $normalized = $this->normalizeUrl($url);
            return !isset($this->visitedUrls[$normalized]) && $this->validateUrl($normalized);
        });

        if (empty($filteredUrls)) {
            return;
        }

        $client = new Client([
            'timeout' => 7,
            'connect_timeout' => 3,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (compatible; SiteChecker/1.0)',
                'Accept' => 'text/html,application/xhtml+xml',
            ],
            'verify' => false,
            'allow_redirects' => [
                'max' => 5,
                'strict' => true,
                'referer' => true,
            ]
        ]);

        $requests = function ($urls) {
            foreach ($urls as $url) {
                $normalized = $this->normalizeUrl($url);
                $this->visitedUrls[$normalized] = true;
                yield new GuzzleRequest('GET', $normalized);
            }
        };

        $pool = new Pool($client, $requests($filteredUrls), [
            'concurrency' => 3,
            'fulfilled' => function (ResponseInterface $response, $index) use ($filteredUrls, $maxDepth) {
                if (!isset($filteredUrls[$index])) {
                    return;
                }

                $url = $filteredUrls[$index];
                $effectiveUrl = (string)$response->getHeaderLine('X-GUZZLE-EFFECTIVE-URL');
                $finalUrl = $effectiveUrl ?: $url;
                $statusCode = $response->getStatusCode();

                $this->visitedUrls[$this->normalizeUrl($finalUrl)] = true;

                if ($statusCode === 200) {
                    try {
                        $html = (string)$response->getBody();
                        $this->processPageContent($finalUrl, $html, $maxDepth);
                    } catch (\Exception $e) {
                        Log::error("Error processing $finalUrl: " . $e->getMessage());
                    }
                }
            },
            'rejected' => function ($reason, $index) use ($filteredUrls) {
                if (!isset($filteredUrls[$index])) {
                    return;
                }
                $url = $filteredUrls[$index];
                $this->handleFailedRequest($reason, $url);
            },
        ]);

        $pool->promise()->wait();
    }

    private function handleFailedRequest($reason, $url)
    {
        $statusCode = 0;
        $errorMessage = $reason->getMessage();

        if ($reason instanceof RequestException && $reason->hasResponse()) {
            $statusCode = $reason->getResponse()->getStatusCode();
            $errorMessage = $reason->getResponse()->getReasonPhrase();
        }

        if (strpos($errorMessage, 'cURL error 28') !== false) {
            Log::warning("Timeout occurred for URL: $url");
            $this->timeoutUrls[$url] = [
                'error' => 'Timeout',
                'retries' => ($this->timeoutUrls[$url]['retries'] ?? 0) + 1
            ];
            
            if (($this->timeoutUrls[$url]['retries'] ?? 0) < 3) {
                $this->retryQueue[] = $url;
            }
            return;
        }

        if (in_array($statusCode, [404, 500])) {
            $this->errorPages[$url] = [
                'status' => $statusCode,
                'error' => $errorMessage
            ];
        } else {
            Log::warning("Request failed for $url: " . $errorMessage);
        }
    }

    private function processPageContent($url, $html, $maxDepth)
    {
        $crawler = new DomCrawler($html, $url);
        $this->checkSeo($url, $crawler);

        if ($maxDepth > 0) {
            $links = $this->extractLinks($crawler);
            $this->processUrls($links, $maxDepth - 1);
        }
    }

    private function crawlUrl($url, $maxDepth, $html = null)
    {
        $url = $this->normalizeUrl($url);
        if (isset($this->visitedUrls[$url]) || !$this->validateUrl($url)) return;

        $this->visitedUrls[$url] = true;
        Log::info("Crawling: $url");

        try {
            if ($html === null) {
                $response = $this->guzzle->get($url);
                $html = (string)$response->getBody();
                $statusCode = $response->getStatusCode();
                
                if (in_array($statusCode, [404, 500])) {
                    $this->errorPages[$url] = [
                        'status' => $statusCode,
                        'error' => 'Page returned error status'
                    ];
                    return;
                }
            }

            $crawler = new DomCrawler($html, $url);
            $this->checkSeo($url, $crawler);

            if ($maxDepth > 0) {
                $links = $this->extractLinks($crawler);
                $this->processUrls($links, $maxDepth - 1);
            }
        } catch (\Exception $e) {
            Log::error("Error crawling $url: " . $e->getMessage());
        }
    }

    private function normalizeUrl($url)
    {
        $url = strtok($url, '#');
        $url = strtok($url, '?');
        
        if (strpos($url, 'http') !== 0) {
            if (strpos($url, '//') === 0) {
                $url = parse_url($this->baseDomain, PHP_URL_SCHEME) . ':' . $url;
            } elseif (strpos($url, '/') === 0) {
                $url = rtrim($this->baseDomain, '/') . $url;
            } else {
                $url = rtrim($this->baseDomain, '/') . '/' . ltrim($url, '/');
            }
        }
        
        return rtrim($url, '/');
    }

    private function extractLinks($content, $baseUrl = null)
    {
        if ($content instanceof DomCrawler) {
            return $this->extractLinksFromCrawler($content);
        }
        
        if (is_string($content)) {
            try {
                $crawler = new DomCrawler($content, $baseUrl);
                return $this->extractLinksFromCrawler($crawler);
            } catch (\Exception $e) {
                Log::error("Failed to create DomCrawler: " . $e->getMessage());
                return [];
            }
        }
        
        return [];
    }

    private function extractLinksFromCrawler(DomCrawler $crawler)
    {
        $links = [];
        try {
            $crawler->filter('a')->each(function (DomCrawler $node) use (&$links) {
                $href = $node->attr('href');
                if ($href) {
                    $normalized = $this->normalizeUrl($href);
                    if ($this->isInternalUrl($normalized)) {
                        $links[] = $normalized;
                    }
                }
            });
        } catch (\Exception $e) {
            Log::error('Link extraction failed: ' . $e->getMessage());
        }
        return array_unique($links);
    }

    private function isInternalUrl($url)
    {
        return strpos($url, $this->baseDomain) === 0;
    }

    private function checkSeo($url, DomCrawler $crawler)
    {
        $issues = [];
        try {
            $title = $crawler->filter('title')->first();
            if ($title->count() === 0) {
                $issues[] = 'Missing title tag';
            } else {
                $titleText = trim($title->text());
                if (strlen($titleText) < 10 || strlen($titleText) > 60) {
                    $issues[] = 'Title length not optimal (10-60 chars recommended)';
                }
            }

            $metaDesc = $crawler->filter('meta[name="description"]')->first();
            if ($metaDesc->count() === 0) {
                $issues[] = 'Missing meta description';
            } else {
                $desc = trim($metaDesc->attr('content'));
                if (empty($desc)) {
                    $issues[] = 'Empty meta description';
                } elseif (strlen($desc) < 70 || strlen($desc) > 160) {
                    $issues[] = 'Meta description length not optimal (70-160 chars recommended)';
                }
            }

            $h1Count = $crawler->filter('h1')->count();
            if ($h1Count === 0) {
                $issues[] = 'Missing H1 tag';
            } elseif ($h1Count > 1) {
                $issues[] = 'Multiple H1 tags found';
            }

            if (!empty($issues)) {
                $this->seoReport[$url] = $issues;
            }
        } catch (\Exception $e) {
            Log::error("SEO check failed for $url: " . $e->getMessage());
        }
    }

    private function generateSitemap()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');
        
        foreach (array_keys($this->visitedUrls) as $url) {
            if (empty($url)) continue;
            
            $entry = $xml->addChild('url');
            $entry->addChild('loc', htmlspecialchars($url));
            $entry->addChild('lastmod', date('Y-m-d'));
            $entry->addChild('changefreq', 'weekly');
            $entry->addChild('priority', '0.8');
        }

        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->formatOutput = true;

        $fileName = $this->domainName . '-sitemap.xml';
        $filePath = public_path('sitemaps/' . $fileName);

        if (!file_exists(public_path('sitemaps'))) {
            mkdir(public_path('sitemaps'), 0755, true);
        }

        $dom->save($filePath);
        return url('sitemaps/' . $fileName);
    }

    public function checkUrlsFromExcel(Request $request)
    {
        set_time_limit(7200);
        ini_set('memory_limit', '512M');
        $file = $request->file('excel_file');

        if (!$file || !$file->isValid()) {
            return response()->json(['error' => 'Invalid or missing file'], 400);
        }

        $path = $file->getRealPath();
        $data = Excel::toArray([], $path);

        if (empty($data) || !isset($data[0])) {
            return response()->json(['error' => 'No data found in the Excel file'], 400);
        }

        $urls = $data[0];
        $results = [
            'working' => [],
            'errors' => []
        ];

        foreach ($urls as $row) {
            $url = $row[0] ?? null;

            if ($url && $this->validateUrl($url)) {
                try {
                    $response = $this->guzzle->head($url, ['timeout' => 30]);
                    Log::info("Checking URL: $url");
                    $statusCode = $response->getStatusCode();

                    if ($statusCode === 200) {
                        $results['working'][] = [
                            'url' => $url,
                            'status' => $statusCode
                        ];
                    } else {
                        $results['errors'][] = [
                            'url' => $url,
                            'status' => $statusCode,
                            'error' => 'Non-200 status code'
                        ];
                    }
                } catch (RequestException $e) {
                    $results['errors'][] = [
                        'url' => $url,
                        'error' => $e->getMessage()
                    ];
                }
            } else {
                $results['errors'][] = [
                    'url' => $url,
                    'error' => 'Invalid URL'
                ];
            }
        }

        return response()->json($results);
    }

    public function checkUrlsRegx(Request $request)
    {
        set_time_limit(7200);
        ini_set('memory_limit', '512M');
        $siteUrl = $request->url;
        $regex = $request->regex;
        $depth = (int)$request->depth;

        if (!$this->validateUrl($siteUrl)) {
            return response()->json(['error' => 'Invalid URL'], 400);
        }

        if (empty($regex)) {
            return response()->json(['error' => 'Regex pattern is required'], 400);
        }

        regexData::create(['name' => $siteUrl, 'regex' => $regex]);

        try {
            $parsed = parse_url($siteUrl);
            $this->baseDomain = $parsed['scheme'] . '://' . $parsed['host'];
            $this->domainName = $parsed['host'];

            $results = [
                'total_matches' => 0,
                'pages_with_matches' => 0,
                'pages_checked' => 0,
                'matches' => []
            ];

            $this->crawlForRegex($siteUrl, $regex, $depth, $results);

            return response()->json([
                'status' => 'success',
                'results' => $results
            ]);

        } catch (\Exception $e) {
            Log::error("Regex check failed for $siteUrl: " . $e->getMessage());
            return response()->json(['error' => 'Regex check failed: ' . $e->getMessage()], 500);
        }
    }

    private function crawlForRegex($url, $regex, $maxDepth, &$results, $currentDepth = 0)
    {
        if ($currentDepth > $maxDepth || isset($this->visitedUrls[$url])) {
            return;
        }

        $this->visitedUrls[$url] = true;
        $results['pages_checked']++;

        try {
            $response = $this->guzzle->get($url);
            $html = (string)$response->getBody();

            if (@preg_match($regex, '') === false) {
                $regex = '/' . str_replace('/', '\/', $regex) . '/';
            }
            preg_match_all($regex, $html, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                $results['pages_with_matches']++;
                $results['total_matches'] += count($matches);
                
                $results['matches'][$url] = [
                    'url' => $url,
                    'match_count' => count($matches),
                    'matches' => array_map(function($match) {
                        return $match[0];
                    }, $matches)
                ];
            }

            if ($currentDepth < $maxDepth) {
                $crawler = new DomCrawler($html, $url);
                $links = $this->extractLinks($crawler);
                
                foreach ($links as $link) {
                    $this->crawlForRegex($link, $regex, $maxDepth, $results, $currentDepth + 1);
                }
            }

        } catch (\Exception $e) {
            Log::error("Failed to check $url: " . $e->getMessage());
            $results['errors'][$url] = $e->getMessage();
        }
    }
 public function checkExcelUrlsWithRegex(Request $request)
{
    // $request->validate([
    //     'pattern' => 'required|string',
    //     'excel_file' => 'required|file|mimes:xlsx,xls,csv',
    //     'url_column' => 'sometimes|string|default:url',
    //     'concurrency' => 'sometimes|integer|min:1|max:20|default:5'
    // ]);

    set_time_limit(3600);
    ini_set('memory_limit', '512M');

    try {
        // Store the regex pattern
        RegexData::create([
            'name' => 'Excel URL Check',
            'regex' => $request->pattern
        ]);

        // Process Excel file
        $data = Excel::toArray([], $request->file('excel_file')->getRealPath());
        
        if (empty($data)) {
            return response()->json(['error' => 'Excel file is empty'], 400);
        }

        $headers = array_shift($data[0]);
        $urlColumn = array_search('URL', $headers);
        
        if ($urlColumn === false) {
            return response()->json(['error' => 'URL column not found'], 400);
        }

        $urls = array_column($data[0], $urlColumn);
        $urls = array_filter($urls, [$this, 'validateUrl']);
        $urls = array_unique($urls);

        if (empty($urls)) {
            return response()->json(['error' => 'No valid URLs found'], 400);
        }

        // Prepare regex
        $regex = $this->prepareRegex($request->pattern);
        $results = $this->processUrlsWithRegex($urls, $regex, $request->concurrency);

        // Format matches for frontend
        $formattedMatches = [];
        foreach ($results['matches'] as $url => $match) {
            $formattedMatches[$url] = [
                'match_count' => $match['match_count'],
                'matches' => $match['sample_matches'] // Already limited to 3 samples
            ];
        }

        // Prepare the response in the format expected by your frontend
        return response()->json([
            'status' => 'success',
            'results' => [
                'pages_with_matches' => count($results['matches']),
                'total_matches' => array_sum(array_column($results['matches'], 'match_count')),
                'matches' => $formattedMatches,
                'errors' => $results['errors'],
                'stats' => [
                    'total_urls' => count($urls),
                    'matched_urls' => count($results['matches']),
                    'match_percentage' => round(count($results['matches']) / max(1, count($urls)) * 100, 2)
                ]
            ],
            'pattern' => $request->pattern,
            'website_url' => $request->website_url ?? null // Optional if you want to track source URL
        ]);

    } catch (Exception $e) {
        Log::error("Excel URL regex check failed: " . $e->getMessage());
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => config('app.debug') ? $e->getTraceAsString() : null
        ], 500);
    }
}

private function processUrlsWithRegex($urls, $regex, $concurrency = 5)
{
    $results = [
        'matches' => [],
        'errors' => []
    ];

    $requests = function ($urls) {
        foreach ($urls as $url) {
            yield new GuzzleRequest('GET', $url);
        }
    };

    $pool = new Pool($this->guzzle, $requests($urls), [
        'concurrency' => $concurrency,
        'fulfilled' => function ($response, $index) use ($urls, $regex, &$results) {
            $url = $urls[$index];
            try {
                $content = (string)$response->getBody();
                if (preg_match_all($regex, $content, $matches, PREG_SET_ORDER)) {
                    $results['matches'][$url] = [
                        'match_count' => count($matches),
                        'sample_matches' => array_slice(array_map(function($m) {
                            // Escape HTML for safety before sending to frontend
                            return htmlspecialchars(mb_substr($m[0], 0, 200), ENT_QUOTES, 'UTF-8');
                        }, $matches), 0, 3) // Limit to 3 sample matches
                    ];
                }
            } catch (Exception $e) {
                $results['errors'][$url] = $e->getMessage();
            }
        },
        'rejected' => function ($reason, $index) use ($urls, &$results) {
            $url = $urls[$index] ?? 'unknown';
            $results['errors'][$url] = $reason->getMessage();
        },
    ]);

    $pool->promise()->wait();
    return $results;
}

    /**
     * Validate and prepare regex pattern
     */
    private function prepareRegex($pattern)
    {
        if (@preg_match($pattern, '') === false) {
            // Try to auto-correct by adding delimiters if missing
            if (!preg_match('/^\/.*\/[imsxADSUXJu]*$/', $pattern)) {
                $pattern = '/' . str_replace('/', '\/', $pattern) . '/';
            }
            
            if (@preg_match($pattern, '') === false) {
                throw new Exception("Invalid regex pattern: " . preg_last_error_msg());
            }
        }
        return $pattern;
    }

    /**
     * Validate URL format
     */
    // private function validateUrl($url)
    // {
    //     return filter_var($url, FILTER_VALIDATE_URL) && 
    //            in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https']);
    // }
}