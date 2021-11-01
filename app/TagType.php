<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    // no timestamps
    public $timestamps = false;

    // mass assignment
    protected $guarded = ['id'];
}
