<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagTypes extends Model
{
    // no timestamps
    public $timestamps = false;

    // mass assignment
    protected $guarded = ['id'];
}
