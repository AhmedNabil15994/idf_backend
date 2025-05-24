<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::resource('volunteers','VolunteerController')->only('store')->names('volunteers');
});