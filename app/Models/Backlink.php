<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backlink extends Model
{
    protected $fillable = [
        'target_url',
        'source_url',
        'anchor_text',
        'source_domain_authority',
        'source_page_authority',
        'dofollow',
        'first_seen_at',
        'last_seen_at',
    ];

    protected $casts = [
        'first_seen_at' => 'datetime',
        'last_seen_at' => 'datetime',
    ];
}
