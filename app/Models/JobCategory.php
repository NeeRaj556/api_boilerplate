<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = [
        'name',
        'rank',
        'status',
    ];

    protected $casts = [
        'rank' => 'integer',
        'status' => 'integer',
    ];
}
