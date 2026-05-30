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
        Schema::table('yachts', function (Blueprint $table) {
            $table->decimal('price_per_hour', 10, 2)->nullable()->after('price_per_day');
            $table->decimal('charter_4h_price', 10, 2)->nullable()->after('price_per_hour');
            $table->decimal('charter_6h_price', 10, 2)->nullable()->after('charter_4h_price');
            $table->decimal('charter_8h_price', 10, 2)->nullable()->after('charter_6h_price');
            $table->text('includes')->nullable()->after('description');
            $table->boolean('crew_included')->default(false)->after('includes');
            $table->boolean('catering_available')->default(false)->after('crew_included');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yachts', function (Blueprint $table) {
            $table->dropColumn([
                'price_per_hour', 'charter_4h_price', 'charter_6h_price', 'charter_8h_price',
                'includes', 'crew_included', 'catering_available',
            ]);
        });
    }
};
