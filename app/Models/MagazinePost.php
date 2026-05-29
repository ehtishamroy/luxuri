<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagazinePost extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image',
        'category', 'author', 'published_at', 'active',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'active'       => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('active', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}
