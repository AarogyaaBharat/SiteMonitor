<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Exception;

class BacklinkCheckController extends Controller
{
       public function check(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'domain' => 'nullable|string',
            'max_results' => 'nullable|integer|min:1|max:100',
        ]);

        $targetUrl = $request->input('url');
        $sourceDomain = $request->input('domain');
        $maxResults = $request->input('max_results', 20);

        $backlinks = $this->getBacklinks($targetUrl, $sourceDomain, $maxResults);

        return response()->json([
            'success' => true,
            'target_url' => $targetUrl,
            'backlinks_count' => count($backlinks),
            'backlinks' => $backlinks,
        ]);
    }

    protected function getBacklinks(string $targetUrl, ?string $sourceDomain, int $maxResults): array
    {
        $query = "link:{$targetUrl}";
        if ($sourceDomain) {
            $query = "site:{$sourceDomain} {$query}";
        }

        $backlinks = [];
        $searchEngines = [
            'google' => "https://www.google.com/search?q=" . $query. "&num=100",
            'bing' => "https://www.bing.com/search?q=" . $query. "&count=50",
        ];
        return $searchEngines;

        foreach ($searchEngines as $engine => $url) {
            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ])->get($url);

                if ($response->successful()) {
                    $backlinks = array_merge(
                        $backlinks,
                        $this->parseResults($engine, $response->body())
                    );
                    
                    if (count($backlinks) >= $maxResults) {
                        return array_slice($backlinks, 0, $maxResults);
                    }
                }
            } catch (\Exception $e) {
                continue;
            }
            
            sleep(rand(2, 5)); // Delay between requests
        }

        return array_slice(array_unique($backlinks), 0, $maxResults);
    }

    protected function parseResults(string $engine, string $html): array
    {
        $links = [];
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        if ($engine === 'google') {
            $results = $xpath->query("//div[contains(@class, 'g')]//a[contains(@href, 'http')]");
            foreach ($results as $result) {
                $url = $result->getAttribute('href');
                if (!Str::contains($url, 'google.com')) {
                    $links[] = $url;
                }
            }
        } elseif ($engine === 'bing') {
            $results = $xpath->query("//li[contains(@class, 'b_algo')]//a[contains(@href, 'http')]");
            foreach ($results as $result) {
                $url = $result->getAttribute('href');
                if (!Str::contains($url, 'bing.com')) {
                    $links[] = $url;
                }
            }
        }

        return $links;
    }
}