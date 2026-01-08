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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('ashon')->nullable();
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('nid')->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('fother')->nullable();
            $table->string('mother')->nullable();
            $table->string('occupation')->nullable();
            $table->text('address')->nullable();
            $table->string('zila')->nullable();
            $table->string('upazila')->nullable();
            $table->string('city_corporation')->nullable();
            $table->string('word')->nullable();
            $table->string('area')->nullable();
            $table->string('area_number')->nullable();
            $table->timestamps();

            // Indexes for efficient filtering and searching
            // Single column indexes
            $table->index('name'); // For name searches
            $table->index('dob'); // For date filtering
            $table->index('gender'); // For gender filtering
            $table->index('nid'); // Already unique, but explicit index for lookups
            $table->index('zila'); // For location filtering
            $table->index('upazila'); // For location filtering
            $table->index('city_corporation'); // For location filtering
            $table->index('word'); // For location filtering
            $table->index('area'); // For area filtering
            $table->index('occupation'); // For occupation filtering

            // Composite indexes for common filter combinations
            $table->index(['zila', 'upazila']); // Common location filter
            $table->index(['zila', 'upazila', 'city_corporation']); // Full location filter
            $table->index(['gender', 'zila']); // Gender and location filter
            $table->index(['name', 'nid']); // Name and NID search
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

