<?php
namespace App\Http\Controllers\Api\V1\Captains;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Captains'], function () {

    ##############################
    ###### Authentication ########
    ##############################
    Route::group(['namespace' => 'Auth'], function () {
        //POST send-code
        Route::POST('send-code', 'AuthController@sendCode');

        // POST check-code
        Route::POST('check-code', 'AuthController@check');

        // POST register
        Route::POST('register-captain', 'AuthController@registerCaptain');

        Route::group(['middleware' => ['auth:captain', 'scope:allow-captain']], function () {
            //POST register-vehicle
            Route::POST('register-vehicle', 'AuthController@registerVehicle');

            //POST register-bank-account
            Route::POST('register-bank-account', 'AuthController@registerBankAccount');
        });
    });
});
