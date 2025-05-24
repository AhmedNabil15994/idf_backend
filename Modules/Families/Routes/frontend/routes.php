<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::resource('families','FamilyController')->only('index','store')->names('families');
});