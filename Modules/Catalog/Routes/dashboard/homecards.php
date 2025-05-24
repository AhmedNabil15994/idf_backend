<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'home-cards'], function () {

    Route::get('/', 'HomeCardController@index')
        ->name('dashboard.home-cards.index');

    Route::get('datatable', 'HomeCardController@datatable')
        ->name('dashboard.home-cards.datatable');

    Route::get('create', 'HomeCardController@create')
        ->name('dashboard.home-cards.create');

    Route::post('/', 'HomeCardController@store')
        ->name('dashboard.home-cards.store');

    Route::get('{id}/edit', 'HomeCardController@edit')
        ->name('dashboard.home-cards.edit');

    Route::put('{id}', 'HomeCardController@update')
        ->name('dashboard.home-cards.update');

    Route::delete('{id}', 'HomeCardController@destroy')
        ->name('dashboard.home-cards.destroy');

    Route::get('deletes', 'HomeCardController@deletes')
        ->name('dashboard.home-cards.deletes');

    Route::get('{id}', 'HomeCardController@show')
        ->name('dashboard.home-cards.show');

});
