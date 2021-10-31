<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    public const DELETED_AT = 'deleted_at';

    // convert type
    protected $casts = [
        Post::CREATED_AT => 'datetime:D, d m Y H:i:s e',
        Post::UPDATED_AT => 'datetime:D, d m Y H:i:s e',
        Post::DELETED_AT => 'datetime:D, d m Y H:i:s e'
    ];

    // hidden attributes
    protected $hidden = [Post::DELETED_AT];

    // mass assignment
    protected $guarded = ['id'];
}
