<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('login')->nullable();
            $table->timestamp('logout')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('platform')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'email_verified_at' => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
