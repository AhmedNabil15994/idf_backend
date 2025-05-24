<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'projects'], function () {

    Route::get('/', 'ProjectController@index')
        ->name('dashboard.projects.index');

    Route::get('datatable', 'ProjectController@datatable')
        ->name('dashboard.projects.datatable');

    Route::get('create', 'ProjectController@create')
        ->name('dashboard.projects.create');

    Route::post('/', 'ProjectController@store')
        ->name('dashboard.projects.store');

    Route::get('{id}/edit', 'ProjectController@edit')
        ->name('dashboard.projects.edit');

    Route::put('{id}', 'ProjectController@update')
        ->name('dashboard.projects.update');

    Route::delete('{id}', 'ProjectController@destroy')
        ->name('dashboard.projects.destroy');

    Route::get('deletes', 'ProjectController@deletes')
        ->name('dashboard.projects.deletes');

    Route::get('{id}', 'ProjectController@show')
        ->name('dashboard.projects.show');

});
