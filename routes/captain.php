<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Captains'], function () {

    ##############################
    ###### Authentication ########
    ##############################
    Route::group(['namespace' => 'Auth'], function () {
        //POST send-code

        //POST check-code

        //POST register
        
        Route::group(['middleware' => ['auth:captain', 'scope:allow-captain']], function () {

            //POST register-vehicle

            //POST register-bank-account
        });
    });
});
