<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->string('passenger_code')->unique();
            $table->string('full_name');
            $table->enum('gender',['male','female'])->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('shake_phone')->default(false);
            $table->text('remember_token')->nullable();
            $table->text('device_token')->nullable();
            $table->float('rate')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('suspend')->default(false);
            $table->string('lang')->default('ar');
            $table->boolean('is_dark_mode')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
