<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'type', 'villa_id', 'yacht_id', 'name', 'phone', 'email',
        'check_in', 'check_out', 'guests', 'message', 'referral_source',
        'marketing_consent', 'status', 'admin_notes',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'marketing_consent' => 'boolean',
        'guests' => 'integer',
    ];

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }

    public function yacht()
    {
        return $this->belongsTo(Yacht::class);
    }
}
