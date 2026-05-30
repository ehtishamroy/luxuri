<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'marketing_consent',
    ];

    protected $casts = [
        'marketing_consent' => 'boolean',
    ];
}
