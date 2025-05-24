<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'volunteers'], function () {

    Route::get('/', 'VolunteerController@index')
        ->name('charities.volunteers.index');

    Route::get('datatable', 'VolunteerController@datatable')
        ->name('charities.volunteers.datatable');

    Route::get('{id}', 'VolunteerController@show')
        ->name('charities.volunteers.show');

});
