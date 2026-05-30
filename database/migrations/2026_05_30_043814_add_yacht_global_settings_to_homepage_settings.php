<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->string('global_yacht_contact_phone')->nullable();
            $table->string('global_yacht_contact_email')->nullable();
            $table->text('global_yacht_policies_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_settings', function (Blueprint $table) {
            $table->dropColumn(['global_yacht_contact_phone', 'global_yacht_contact_email', 'global_yacht_policies_text']);
        });
    }
};
