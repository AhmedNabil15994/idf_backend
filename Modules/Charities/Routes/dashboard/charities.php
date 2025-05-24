<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'charities'], function () {

    Route::get('/', 'CharityController@index')
        ->name('dashboard.charities.index');

    Route::get('datatable', 'CharityController@datatable')
        ->name('dashboard.charities.datatable');

    Route::get('create', 'CharityController@create')
        ->name('dashboard.charities.create');

    Route::post('/', 'CharityController@store')
        ->name('dashboard.charities.store');

    Route::get('{id}/edit', 'CharityController@edit')
        ->name('dashboard.charities.edit');

    Route::put('{id}', 'CharityController@update')
        ->name('dashboard.charities.update');

    Route::delete('{id}', 'CharityController@destroy')
        ->name('dashboard.charities.destroy');

    Route::get('deletes', 'CharityController@deletes')
        ->name('dashboard.charities.deletes');

    Route::get('{id}', 'CharityController@show')
        ->name('dashboard.charities.show');

});
