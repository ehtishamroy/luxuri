<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'hero_image', 'hero_video',
        'country', 'meta_title', 'meta_description', 'og_image',
        'sort_order', 'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function villas()
    {
        return $this->hasMany(Villa::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
