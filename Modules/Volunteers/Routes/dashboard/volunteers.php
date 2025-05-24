<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'volunteers'], function () {

    Route::get('/', 'VolunteerController@index')
        ->name('dashboard.volunteers.index');

    Route::get('datatable', 'VolunteerController@datatable')
        ->name('dashboard.volunteers.datatable');

    Route::get('create', 'VolunteerController@create')
        ->name('dashboard.volunteers.create');

    Route::post('/', 'VolunteerController@store')
        ->name('dashboard.volunteers.store');

    Route::get('{id}/edit', 'VolunteerController@edit')
        ->name('dashboard.volunteers.edit');

    Route::put('{id}', 'VolunteerController@update')
        ->name('dashboard.volunteers.update');

    Route::delete('{id}', 'VolunteerController@destroy')
        ->name('dashboard.volunteers.destroy');

    Route::get('deletes', 'VolunteerController@deletes')
        ->name('dashboard.volunteers.deletes');

    Route::get('{id}', 'VolunteerController@show')
        ->name('dashboard.volunteers.show');

});
