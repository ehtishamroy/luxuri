<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable()->after('phone');
            $table->string('email')->nullable()->after('mobile_phone');
            $table->string('copyright_text')->nullable()->after('email');
            $table->string('instagram_url')->nullable()->after('copyright_text');
            $table->string('facebook_url')->nullable()->after('instagram_url');
            $table->string('tiktok_url')->nullable()->after('facebook_url');
            $table->string('pinterest_url')->nullable()->after('tiktok_url');
            $table->string('google_maps_url')->nullable()->after('pinterest_url');
            $table->string('linkedin_url')->nullable()->after('google_maps_url');
            $table->string('threads_url')->nullable()->after('linkedin_url');
        });
    }

    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'mobile_phone', 'email', 'copyright_text',
                'instagram_url', 'facebook_url', 'tiktok_url',
                'pinterest_url', 'google_maps_url', 'linkedin_url', 'threads_url',
            ]);
        });
    }
};
