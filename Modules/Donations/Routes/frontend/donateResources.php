<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::resource('donate-resources','DonateResourceController')->only('index','show','store')->names('donate-resources');
});