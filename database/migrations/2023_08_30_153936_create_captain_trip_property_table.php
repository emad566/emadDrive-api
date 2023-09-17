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
        Schema::create('captain_trip_property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain_id');
            $table->unsignedBigInteger('property_id');
            $table->foreign('captain_id')->references('id')->on('captains')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captain_trip_property');
    }
};
