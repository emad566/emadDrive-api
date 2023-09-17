<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captain_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain_id');
            $table->float('balance')->default(0);
            $table->double('balance_transfer')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('captain_id')->references('id')->on('captains')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('captain_wallets');
    }
}
