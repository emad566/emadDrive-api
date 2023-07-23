<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'Passengers'], function () {

    ##############################
    ###### Authentication ########
    ##############################
    Route::group(['namespace' => 'Auth'], function () {
        // POST send-code

        // POST check-code

        // POST register
    });
});
