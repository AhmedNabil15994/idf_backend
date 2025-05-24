<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'p'], function () {

    Route::get('{slug}' ,'PageController@show')
        ->name('front.pages.show');

});
