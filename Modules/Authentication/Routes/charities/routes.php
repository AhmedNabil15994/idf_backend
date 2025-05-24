<?php

Route::group(['prefix' => 'login'], function () {

    if (env('LOGIN')):

        // Show Login Form
        Route::get('/', 'LoginController@showLogin')
        ->name('charities.login')
        ->middleware('guest');

        // Submit Login
        Route::post('/', 'LoginController@postLogin')
        ->name('charities.login');

    endif;

});


Route::group(['prefix' => 'logout','middleware' => 'charities.auth'], function () {

    // Logout
    Route::any('/', 'LoginController@logout')
    ->name('charities.logout');

});
