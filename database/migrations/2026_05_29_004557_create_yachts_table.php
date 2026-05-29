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
        Schema::create('yachts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('make')->nullable();
            $table->string('style')->nullable();
            $table->unsignedSmallInteger('length_ft')->nullable();
            $table->unsignedTinyInteger('cabins')->nullable();
            $table->unsignedTinyInteger('max_guests')->nullable();
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->json('images')->nullable();
            $table->json('tags')->nullable();
            $table->string('location')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('external_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yachts');
    }
};
