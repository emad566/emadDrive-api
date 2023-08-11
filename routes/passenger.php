<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'Passengers'], function () {

    ##############################
    ###### Authentication ########
    ##############################
    Route::group(['namespace' => 'Auth'], function () {
        // POST send-code
        Route::POST('send-code', 'AuthController@sendCode');

        // POST check-code
        Route::POST('check-code', 'AuthController@check');

        // POST register
        Route::POST('register-passenger', 'AuthController@registerPassenger');
    });
});
