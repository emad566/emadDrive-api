<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captain_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->unsignedBigInteger('captain_id');
            $table->string('iban_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('captain_bank_accounts');
    }
}
