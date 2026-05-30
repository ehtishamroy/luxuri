<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Yacht extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'includes', 'make', 'style', 'length_ft',
        'cabins', 'max_guests', 'price_per_day', 'price_per_hour',
        'charter_4h_price', 'charter_6h_price', 'charter_8h_price',
        'images', 'tags', 'location', 'featured', 'active',
        'crew_included', 'catering_available',
        'meta_title', 'meta_description', 'external_id',
    ];

    protected $casts = [
        'images'    => 'array',
        'tags'      => 'array',
        'featured'  => 'boolean',
        'active'    => 'boolean',
        'crew_included' => 'boolean',
        'catering_available' => 'boolean',
        'price_per_day' => 'decimal:2',
        'price_per_hour' => 'decimal:2',
        'charter_4h_price' => 'decimal:2',
        'charter_6h_price' => 'decimal:2',
        'charter_8h_price' => 'decimal:2',
        'length_ft' => 'decimal:2',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFirstImageAttribute(): ?string
    {
        if (!is_array($this->images) || count($this->images) === 0) {
            return null;
        }
        return Storage::disk('public')->url($this->images[0]);
    }

    public function getImageUrlsAttribute(): array
    {
        if (!is_array($this->images)) {
            return [];
        }
        return array_map(
            fn ($path) => Storage::disk('public')->url($path),
            $this->images
        );
    }
}
