<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageMedia extends Model
{
    protected $table = 'homepage_media';

    protected $fillable = [
        'key',
        'label',
        'type',
        'file_path',
        'poster_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'type' => 'string',
    ];
}
