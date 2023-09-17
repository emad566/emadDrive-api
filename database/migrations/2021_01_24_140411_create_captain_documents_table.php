<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captain_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain_id');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->string('name')->nullable();
            $table->string('file');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('captain_documents');
    }
}
