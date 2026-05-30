<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $fillable = [
        'logo', 'contact_image',
        'phone', 'mobile_phone', 'email', 'copyright_text',
        'instagram_url', 'facebook_url', 'tiktok_url', 'pinterest_url',
        'google_maps_url', 'linkedin_url', 'threads_url',
        'global_policies_text', 'global_contact_phone', 'global_contact_email', 'global_processing_fee_text',
        'global_yacht_policies_text', 'global_yacht_contact_phone', 'global_yacht_contact_email',
    ];
}
