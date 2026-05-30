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
        Schema::table('villas', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('images');
            $table->json('fees')->nullable()->after('featured_image');
            $table->decimal('security_deposit_amount', 10, 2)->nullable()->after('fees');
            $table->text('policies_text')->nullable()->after('security_deposit_amount');
            $table->string('contact_phone')->nullable()->after('policies_text');
            $table->string('contact_email')->nullable()->after('contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('villas', function (Blueprint $table) {
            $table->dropColumn([
                'featured_image',
                'fees',
                'security_deposit_amount',
                'policies_text',
                'contact_phone',
                'contact_email',
            ]);
        });
    }
};
