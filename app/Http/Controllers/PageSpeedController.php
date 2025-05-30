<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\PageSpeedMetric;
use Illuminate\Support\Facades\Log;

class PageSpeedController extends Controller
{
    protected $client;
    protected $psiApiKey;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 10,
            'verify' => false
        ]);
        $this->psiApiKey = 'AIzaSyC_lpShOkpaHPmzmLFPBW8FwwssQ4DSCB0';
    }

    public function trackMetrics(Request $request)
    {
        set_time_limit(7200);
        // ini_set('memory_limit', '512M');
        $request->validate([
            'url' => 'required|url',
            'strategy' => 'in:mobile,desktop'
        ]);

        $url = $request->input('url');
        $strategy = $request->input('strategy', 'mobile');

        try {
            $metrics = $this->getAllPageSpeedMetrics($url, $strategy);
            // return $metrics;
            $pageSpeed = PageSpeedMetric::create([
                'url' => $url,
                'strategy' => $strategy,
                'fcp' => $metrics['performance']['fcp'],
                'lcp' => $metrics['performance']['lcp'],
                'cls' => $metrics['performance']['cls'],
                'tbt' => $metrics['performance']['tbt'],
                'si' => $metrics['performance']['si'],
                'score' => $metrics['performance']['score'],
                'best_practices_score' => $metrics['best_practices_score'],
                'accessibility_score' => $metrics['accessibility_score'],
                'seo_score' => $metrics['seo_score'],
                'screenshot' => $metrics['screenshot'] ?? null
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $pageSpeed
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function getAllPageSpeedMetrics($url, $strategy)
    {
        return [
            'performance' => $metrics = $this->getPerformanceMetrics($url, $strategy),
            'best_practices_score' => $this->getCategoryScore($url, $strategy, 'best-practices'),
            'accessibility_score' => $this->getCategoryScore($url, $strategy, 'accessibility'),
            'seo_score' => $this->getCategoryScore($url, $strategy, 'seo'),
            'screenshot' => $metrics['screenshot'] ?? null
        ];
    }

    private function getPerformanceMetrics($url, $strategy)
    {
        try {
            $response = $this->client->get("https://www.googleapis.com/pagespeedonline/v5/runPagespeed", [
                'query' => [
                    'url' => $url,
                    'key' => $this->psiApiKey,
                    'strategy' => $strategy,
                    'category' => 'performance'
                ],
                'timeout' => 60
            ]);

            $data = json_decode($response->getBody(), true);

            if (!isset($data['lighthouseResult'])) {
                throw new \Exception("Invalid API response format");
            }

            return [
                'fcp' => $this->extractMetric($data, 'first-contentful-paint'),
                'lcp' => $this->extractMetric($data, 'largest-contentful-paint'),
                'cls' => $this->extractMetric($data, 'cumulative-layout-shift'),
                'tbt' => $this->extractMetric($data, 'total-blocking-time'),
                'si' => $this->extractMetric($data, 'speed-index'),
                'score' => $data['lighthouseResult']['categories']['performance']['score'] * 100,
                'screenshot' => $data['lighthouseResult']['audits']['final-screenshot']['details']['data'] ?? null
            ];

        } catch (\Exception $e) {
            Log::error("Performance metrics failed for {$url}: " . $e->getMessage());
            return [
                'fcp' => 0,
                'lcp' => 0,
                'cls' => 0,
                'tbt' => 0,
                'si' => 0,
                'score' => 0,
                'screenshot' => null
            ];
        }
    }

    private function getCategoryScore($url, $strategy, $category)
    {
        try {
            $response = $this->client->get("https://www.googleapis.com/pagespeedonline/v5/runPagespeed", [
                'query' => [
                    'url' => $url,
                    'key' => $this->psiApiKey,
                    'strategy' => $strategy,
                    'category' => $category
                ],
                'timeout' => 30
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['lighthouseResult']['categories'][$category]['score'] * 100 ?? 0;
        } catch (\Exception $e) {
            Log::error("{$category} score failed for {$url}: " . $e->getMessage());
            return 0;
        }
    }

    private function extractMetric($data, $metricName)
    {
        return $data['lighthouseResult']['audits'][$metricName]['numericValue'] ?? 0;
    }

    public function getCumulativeChanges(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'days' => 'integer|min:1|max:365'
        ]);

        $url = $request->input('url');
        $days = $request->input('days', 7);
        $strategy = $request->input('strategy', 'mobile');

        $metrics = PageSpeedMetric::where('url', $url)
            ->where('strategy', $strategy)
            ->where('created_at', '>=', now()->subDays($days))
            ->orderBy('created_at')
            ->get();

        if ($metrics->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data available for this URL'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'url' => $url,
                'strategy' => $strategy,
                'time_period' => $days . ' days',
                'metrics' => $metrics,
                'summary' => $this->calculateSummary($metrics)
            ]
        ]);
    }

    private function calculateSummary($metrics)
    {
        return [
            'fcp' => [
                'current' => $metrics->last()->fcp,
                'change' => $this->calculateChange($metrics->pluck('fcp')),
                'unit' => 'ms'
            ],
            'lcp' => [
                'current' => $metrics->last()->lcp,
                'change' => $this->calculateChange($metrics->pluck('lcp')),
                'unit' => 'ms'
            ],
            'cls' => [
                'current' => $metrics->last()->cls,
                'change' => $this->calculateChange($metrics->pluck('cls')),
                'unit' => ''
            ],
            'score' => [
                'current' => $metrics->last()->score,
                'change' => $this->calculateChange($metrics->pluck('score')),
                'unit' => '%'
            ],
            'best_practices_score' => [
                'current' => $metrics->last()->best_practices_score,
                'change' => $this->calculateChange($metrics->pluck('best_practices_score')),
                'unit' => '%'
            ],
            'accessibility_score' => [
                'current' => $metrics->last()->accessibility_score,
                'change' => $this->calculateChange($metrics->pluck('accessibility_score')),
                'unit' => '%'
            ],
            'seo_score' => [
                'current' => $metrics->last()->seo_score,
                'change' => $this->calculateChange($metrics->pluck('seo_score')),
                'unit' => '%'
            ]
        ];
    }

    private function calculateChange($values)
    {
        if ($values->count() < 2) return 0;
        $first = $values->first();
        $last = $values->last();
        if ($first == 0) return 0;
        return round((($last - $first) / $first) * 100, 2);
    }

    public function compareUrls(Request $request)
    {
        $request->validate([
            'url1' => 'required|url',
            'url2' => 'required|url',
            'strategy' => 'in:mobile,desktop'
        ]);

        try {
            $url1Metrics = $this->getAllPageSpeedMetrics($request->url1, $request->strategy);
            $url2Metrics = $this->getAllPageSpeedMetrics($request->url2, $request->strategy);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'url1' => [
                        'url' => $request->url1,
                        'metrics' => $url1Metrics
                    ],
                    'url2' => [
                        'url' => $request->url2,
                        'metrics' => $url2Metrics
                    ],
                    'comparison' => $this->compareMetrics($url1Metrics, $url2Metrics)
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function compareMetrics($metrics1, $metrics2)
    {
        return [
            'fcp' => $this->compareValues($metrics1['performance']['fcp'], $metrics2['performance']['fcp'], 'ms'),
            'lcp' => $this->compareValues($metrics1['performance']['lcp'], $metrics2['performance']['lcp'], 'ms'),
            'cls' => $this->compareValues($metrics1['performance']['cls'], $metrics2['performance']['cls'], ''),
            'score' => $this->compareValues($metrics1['performance']['score'], $metrics2['performance']['score'], '%'),
            'best_practices_score' => $this->compareValues($metrics1['best_practices_score'], $metrics2['best_practices_score'], '%'),
            'accessibility_score' => $this->compareValues($metrics1['accessibility_score'], $metrics2['accessibility_score'], '%'),
            'seo_score' => $this->compareValues($metrics1['seo_score'], $metrics2['seo_score'], '%')
        ];
    }

    private function compareValues($value1, $value2, $unit)
    {
        $difference = $value1 - $value2;
        $percentage = $value2 > 0 ? round(($difference / $value2) * 100, 2) : 0;
        
        return [
            'difference' => $difference,
            'percentage' => $percentage,
            'unit' => $unit,
            'better' => ($unit === '%') ? ($difference > 0) : ($difference < 0)
        ];
    }
}