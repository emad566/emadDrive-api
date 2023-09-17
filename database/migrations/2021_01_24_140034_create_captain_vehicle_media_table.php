<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainVehicleMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captain_vehicle_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain_vehicle_id');
            $table->string('name')->nullable();
            $table->text('image');
            $table->timestamps();

            $table->foreign('captain_vehicle_id')->references('id')->on('captain_vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('captain_vehicle_media');
    }
}
