<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captains', function (Blueprint $table) {
            $table->id();
            $table->string('captain_code')->unique();
            $table->string('full_name')->nullable();
            $table->enum('gender',['Male','Female'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('city')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('avatar');
            $table->text('remember_token')->nullable();
            $table->text('device_token')->nullable();
            $table->text('device_id')->nullable();
            $table->text('device_type')->nullable();
            $table->integer('register_step')->default(0);
            $table->float('rate')->nullable();
            $table->boolean('available')->default(false)->nullable();
            $table->boolean('suspend')->default(false);
            $table->string('lang')->default('ar');
            $table->string('national_id_front');
            $table->string('national_id_back');
            $table->date('national_expiry_date')->nullable();
            $table->string('driving_license_front');
            $table->string('driving_license_back');
            $table->date('license_expiry_date')->nullable();
            $table->boolean('is_dark_mode')->default(false);
            $table->integer('status')->default(0);
            $table->boolean('is_active')->default(false);
            $table->boolean('in_trip')->default(0)->comment('0 available , 1 in trip');
            $table->integer('active_by')->default(0);
            $table->timestamp('active_date')->nullable();
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
        Schema::dropIfExists('captains');
    }
}
