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
        Schema::create('trip_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('pricing')->nullable();
            $table->year('year')->nullable();
            $table->date('departure');
            $table->date('return');
            $table->string('notes', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_dates');
    }
};
