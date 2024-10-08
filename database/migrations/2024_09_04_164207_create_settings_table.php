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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_logo')->nullable()->constrained(table: 'media')->nullOnDelete();
            $table->string('site_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('international_phone')->nullable();
            $table->text('address')->nullable();
            $table->string('fax')->nullable();
            $table->string('availability')->nullable();
            $table->text('indication')->nullable();
            $table->string('join_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};