<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'donor.guest'], function () {
    Route::group(['prefix' => 'reset'], function () {

        // Show Forget Password Form
        Route::get('{token}', 'ResetPasswordController@resetPassword')
            ->name('frontend.password.reset')
            ->middleware('guest');

        // Send Forget Password Via Mail
        Route::post('/', 'ResetPasswordController@updatePassword')
            ->name('frontend.password.update');

    });
    Route::group(['prefix' => 'password'], function () {


        // Show Forget Password Form
        Route::get('forget', 'ForgotPasswordController@forgetPassword')
            ->name('frontend.password.request')
            ->middleware('guest');

        // Send Forget Password Via Mail
        Route::post('forget', 'ForgotPasswordController@sendForgetPassword')
            ->name('frontend.password.email');

    });

    Route::get('login', 'LoginController@showLogin')
        ->name('frontend.auth.login');
    Route::post('/login', 'LoginController@postLogin')
        ->name('frontend.auth.login');

    Route::post('/register', 'RegisterController@postRegister')
        ->name('frontend.auth.register');

});

Route::group(['middleware' => 'donor.auth'], function () {

    Route::any('logout', 'LoginController@logout')
        ->name('frontend.auth.logout');
});