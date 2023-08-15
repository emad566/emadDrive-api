<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'Passengers'], function () {

    /* =========================== Auth =========================== */
    Route::group(['namespace' => 'Auth'], function () {
        Route::POST('send-code', 'AuthController@sendCode');
        Route::POST('check-code', 'AuthController@check');
        Route::POST('register-passenger', 'AuthController@registerPassenger');
    });
    /* =========================== \Auth =========================== */

    /* =========================== Home =========================== */
    Route::group(['middleware' => ['auth:passenger', 'scope:allow-passenger']], function () {
        Route::GET('details', 'HomeController@details');
    });
    /* =========================== \Home =========================== */
});
