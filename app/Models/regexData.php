<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regexData extends Model
{
    protected $fillable = [
        'name',
        'regex',
    ];
    protected $table = 'regexData';
}
