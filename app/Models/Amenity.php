<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = ['name', 'slug', 'icon'];

    protected $casts = [
        'icon' => 'string',
    ];

    public function villas()
    {
        return $this->belongsToMany(Villa::class, 'amenity_villa')
            ->withPivot('order')
            ->withTimestamps();
    }
}
