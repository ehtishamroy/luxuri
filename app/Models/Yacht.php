<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yacht extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'make', 'style', 'length_ft',
        'cabins', 'max_guests', 'price_per_day', 'images', 'tags',
        'location', 'featured', 'active', 'meta_title', 'meta_description', 'external_id',
    ];

    protected $casts = [
        'images'       => 'array',
        'tags'         => 'array',
        'featured'     => 'boolean',
        'active'       => 'boolean',
        'price_per_day' => 'decimal:2',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFirstImageAttribute(): ?string
    {
        return is_array($this->images) && count($this->images) > 0
            ? $this->images[0]
            : null;
    }
}
