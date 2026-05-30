<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Villa extends Model
{
    protected $fillable = [
        'destination_id', 'title', 'slug', 'description', 'price_per_night', 'price_per_hour',
        'bedrooms', 'bathrooms', 'max_guests', 'images', 'amenities', 'tags',
        'location', 'address', 'latitude', 'longitude', 'featured', 'active',
        'meta_title', 'meta_description', 'external_id',
        'featured_image', 'fees', 'security_deposit_amount',
        'policies_text', 'contact_phone', 'contact_email',
    ];

    protected $casts = [
        'images'    => 'array',
        'amenities' => 'array',
        'tags'      => 'array',
        'featured'  => 'boolean',
        'active'    => 'boolean',
        'price_per_night' => 'decimal:2',
        'price_per_hour' => 'decimal:2',
        'fees'    => 'array',
        'security_deposit_amount' => 'decimal:2',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function amenitiesList()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_villa')
            ->withPivot('order')
            ->orderByPivot('order')
            ->withTimestamps();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getHeroImageAttribute(): ?string
    {
        $path = $this->getAttributes()['featured_image'] ?? null;
        if ($path) {
            return Storage::disk('public')->url($path);
        }
        return $this->first_image;
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
