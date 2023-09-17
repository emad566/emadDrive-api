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
        Schema::create('vehicle_classes', function (Blueprint $table) {
            $table->id();
            $table->string('ar_name');
            $table->string('en_name');
            $table->string('ar_description');
            $table->string('en_description');
            $table->string('icon');
            $table->string('class');
            $table->float('base_fare');
            $table->float('distance');
            $table->float('wait');
            $table->float('cost_small_destination')->default(0);
            $table->float('cancel_value');
            $table->float('outside_town');
            $table->double('add_value')->default(3);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_classes');
    }
};
