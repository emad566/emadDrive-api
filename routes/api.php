<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'General'], function () {
    Route::GET('constants', 'ConstantController@index')->name('constants');
    Route::GET('test', 'GeneralController@test');
});

