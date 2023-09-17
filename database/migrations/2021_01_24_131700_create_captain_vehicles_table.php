<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('captain_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain_id');
            $table->string('registration_plate')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('carmodel_id')->nullable();
            $table->string('model_date')->nullable();
            $table->bigInteger('color_id')->nullable();
            $table->string('vehicle_front')->nullable();
            $table->string('vehicle_back')->nullable();
            $table->string('vehicle_left')->nullable();
            $table->string('vehicle_right')->nullable();
            $table->string('vehicle_front_seat')->nullable();
            $table->string('vehicle_back_seat')->nullable();
            $table->string('vehicle_license_front')->nullable();
            $table->string('vehicle_license_back')->nullable();
            $table->string('vehicle_license_expire_date')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(false);
            $table->boolean('status_image')->default(false);
            $table->timestamps();

            $table->foreign('captain_id')->references('id')->on('captains')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('captain_vehicles');
    }
}
