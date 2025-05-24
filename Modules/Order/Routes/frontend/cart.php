<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::post('cart/add/{project}','CartController@addToCart')->name('cart.add');
    Route::post('cart/remove/{project}','CartController@removeItem')->name('cart.remove.item');
    Route::post('cart/checkout','CartController@checkout')->name('cart.checkout');
    Route::resource('cart','CartController')->only('index')->names('cart');
});