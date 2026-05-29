<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $fillable = [
        'destination_id', 'title', 'slug', 'description', 'price_per_night',
        'bedrooms', 'bathrooms', 'max_guests', 'images', 'amenities', 'tags',
        'location', 'address', 'latitude', 'longitude', 'featured', 'active',
        'meta_title', 'meta_description', 'external_id',
    ];

    protected $casts = [
        'images'    => 'array',
        'amenities' => 'array',
        'tags'      => 'array',
        'featured'  => 'boolean',
        'active'    => 'boolean',
        'price_per_night' => 'decimal:2',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

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
