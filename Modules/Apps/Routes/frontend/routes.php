<?php
use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group(function () {

    Route::get('/', 'FrontendController@index')->name('home');
    Route::resource('contact-us', 'ContactUsController')->only('index', 'store')->names('contact-us');
});