<?php
namespace App\Http\Controllers\Api\V1\Captains;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Captains'], function () {

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
