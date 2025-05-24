<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::resource('charity','CharityController')->only('store')->names('charity');
});