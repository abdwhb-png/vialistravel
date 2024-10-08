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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->text('intro');
            $table->text('permalink')->nullable();
            $table->string('duration')->nullable();
            $table->string('pricing')->nullable();
            $table->integer('travelers_limit')->nullable();
            $table->string('countries')->nullable();
            $table->boolean('can_be_private')->default(1);
            $table->foreignId('pic')->nullable()->constrained(table: 'media')->nullOnDelete();
            $table->foreignId('hero')->nullable()->constrained(table: 'media')->nullOnDelete();
            $table->string('type')->default('classic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
