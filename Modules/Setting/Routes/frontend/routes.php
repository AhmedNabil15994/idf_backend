<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'p'], function () {

Route::get('{slug}' ,'PageController@page')
    ->name('front.pages.show');
});