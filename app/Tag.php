<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // no timestamps
    public $timestamps = false;

    // convert type
    protected $casts = [
        'blocked' => 'boolean',
    ];

    // mass assignment
    protected $guarded = ['id'];
}
