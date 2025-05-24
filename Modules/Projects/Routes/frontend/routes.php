<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::post('projects/filter','ProjectController@index')->name('projects.filter');
    Route::resource('projects','ProjectController')->only('index','show')->names('projects');
});