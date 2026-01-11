<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
  use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'published_at',
        'author_name',
        'author_position',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'published_at' => 'datetime',
    ];
}
