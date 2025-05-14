<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\UploadedFile;

class SiteCheckerController extends Controller
{
    protected $seoReport = [];
    protected $errorPages = []; // Now only stores 404 and 500 errors
    protected $visitedUrls = [];
    protected $guzzle;
    protected $baseDomain;
    protected $domainName;
    protected $userAgent = 'Mozilla/5.0 (compatible; LaravelSiteChecker/1.0)';

    public function __construct()
    {
        $this->guzzle = new Client([
            'timeout' => 600,
            'connect_timeout' => 600,
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
            'http_errors' => false // Important for proper error handling
        ]);
    }

    public function generate(Request $request)
    {
         set_time_limit(7200);
        ini_set('memory_limit', '512M');
        $siteUrl = $request->query('site');
        $depth = (int)$request->query('depth', 5);

        if (!$this->validateUrl($siteUrl)) {
            return response()->json(['error' => 'Invalid or missing "site" parameter'], 400);
        }

        $parsed = parse_url($siteUrl);
        $this->baseDomain = $parsed['scheme'] . '://' . $parsed['host'];
        $this->domainName = $parsed['host'];

        try {
            // Skip robots.txt check if you want to crawl anyway
            $sitemapUrls = $this->fetchSitemapUrls();
            if (!empty($sitemapUrls)) {
                $this->processUrls($sitemapUrls, $depth);
            }

            $this->crawlUrl($siteUrl, $depth);
 $sitemapPath = $this->generateSitemap();

           $allurl= array_keys($this->visitedUrls);
            foreach ($this->visitedUrls as $url => $visited) {
                $response = $this->guzzle->head($url, ['timeout' => 30]);
                $statusCode = $response->getStatusCode();
                if (in_array($statusCode, [404, 500])) {
                    $this->errorPages[] = [
                        'url' => $url,
                        'status' => $statusCode,
                        'referencedFrom' => $this->baseDomain,
                        'error' => 'Page returned error status'
                    ];
                    if($this->visitedUrls[$url] === true) {
                        unset($this->visitedUrls[$url]); // Remove from visited URLs if it's an error page
                    }
                }
            }
            
            return response()->json([
                'status' => 'success',
                'saved_to' => storage_path('app/' . $sitemapPath),
                'url_count' => count($this->visitedUrls),
                'seo_issues' => $this->seoReport,
                'error_pages' => $this->errorPages, // Now only contains 404/500 errors
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

    $requests = function ($urls) {
        foreach ($urls as $url) {
            $normalized = $this->normalizeUrl($url);
            $this->visitedUrls[$normalized] = true; // Mark as visited immediately
            yield new GuzzleRequest('GET', $normalized);
        }
    };

    $pool = new Pool($this->guzzle, $requests($filteredUrls), [
        'concurrency' => 5,
        'fulfilled' => function (ResponseInterface $response, $index) use ($filteredUrls, $maxDepth) {
            $url = $filteredUrls[$index];
            $effectiveUrl = (string)$response->getHeaderLine('X-GUZZLE-EFFECTIVE-URL');
            $finalUrl = $effectiveUrl ?: $url;
            $statusCode = $response->getStatusCode();

            // Update visited URLs with final URL after redirects
            $this->visitedUrls[$this->normalizeUrl($finalUrl)] = true;

            // Only track 404 and 500 errors
            // if (in_array($statusCode, [404, 500])) {
            //     $this->errorPages[$finalUrl] = [
            //         'status' => $statusCode,
            //         'error' => 'Page returned error status',
            //         'redirected_from' => $url 
            //     ];
            //     return; // Don't process error pages further
            // }

            // Only process successful responses
            if ($statusCode === 200) {
                $this->crawlUrl($finalUrl, $maxDepth, (string)$response->getBody());
            }
        },
        'rejected' => function ($reason, $index) use ($filteredUrls) {
            $url = $filteredUrls[$index];
            $statusCode = 0;
            $errorMessage = $reason->getMessage();

            if ($reason instanceof RequestException && $reason->hasResponse()) {
                $statusCode = $reason->getResponse()->getStatusCode();
                $errorMessage = $reason->getResponse()->getReasonPhrase();
            }

            if (in_array($statusCode, [404, 500])) {
                $this->errorPages[$url] = [
                    'status' => $statusCode,
                    'error' => $errorMessage
                ];
            } else {
                Log::warning("Request failed for $url: " . $errorMessage);
            }
        },
    ]);

    $pool->promise()->wait();
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
                
                // Track 404/500 errors from direct requests
                if (in_array($statusCode, [404, 500])) {
                    $this->errorPages[$url] = [
                        'status' => $statusCode,
                        'error' => 'Page returned error status'
                    ];
                    return; // Don't process further if error
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

    private function extractLinks(DomCrawler $crawler)
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
            // Title check
            $title = $crawler->filter('title')->first();
            if ($title->count() === 0) {
                $issues[] = 'Missing title tag';
            } else {
                $titleText = trim($title->text());
                if (strlen($titleText) < 10 || strlen($titleText) > 60) {
                    $issues[] = 'Title length not optimal (10-60 chars recommended)';
                }
            }

            // Meta description
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

            // H1 check
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

    // Convert SimpleXMLElement to DOMDocument for pretty formatting
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;

    $fileName = $this->domainName . '-sitemap.xml';
    $filePath = public_path('sitemaps/' . $fileName);

    // Ensure the sitemaps directory exists
    if (!file_exists(public_path('sitemaps'))) {
        mkdir(public_path('sitemaps'), 0755, true);
    }

    // Save the formatted XML
    $dom->save($filePath);

    // Return the public accessible URL
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

    $urls = $data[0]; // Assuming URLs are in the first sheet
    $results = [
        'working' => [],
        'errors' => []
    ];

    foreach ($urls as $row) {
        $url = $row[0] ?? null; // Assuming URL is in the first column

        if ($url && $this->validateUrl($url)) {
            try {
                $response = $this->guzzle->head($url, ['timeout' => 30]);
                $statusCode = $response->getStatusCode();

                if ($statusCode === 200) {
                    $results['working'][] = [
                        'url' => $url,
                        'status' => $statusCode,
                        'error' => 'Non-200 status code'
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
}