<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSpeedMetric extends Model
{
    protected $fillable = [
        'url',
        'strategy',
        'fcp',
        'lcp',
        'cls',
        'tbt',
        'si',
        'score',
        'screenshot',
        'best_practices_score',
        'accessibility_score',
        'seo_score',
    ];

    protected $casts = [
        'fcp' => 'decimal:2',
        'lcp' => 'decimal:2',
        'cls' => 'decimal:4',
        'tbt' => 'decimal:2',
        'si' => 'decimal:2',
        'score' => 'decimal:2',
        'best_practices_score' => 'decimal:2',
        'accessibility_score' => 'decimal:2',
        'seo_score' => 'decimal:2',
    ];
}
