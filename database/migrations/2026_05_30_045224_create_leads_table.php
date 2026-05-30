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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('villa'); // villa or yacht
            $table->foreignId('villa_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('yacht_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->integer('guests')->nullable();
            $table->text('message')->nullable();
            $table->string('referral_source')->nullable();
            $table->boolean('marketing_consent')->default(false);
            $table->string('status')->default('new'); // new, contacted, converted, closed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
