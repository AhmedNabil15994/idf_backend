<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'families'], function () {

    Route::get('/', 'FamilyController@index')
        ->name('charities.families.index');

    Route::get('datatable', 'FamilyController@datatable')
        ->name('charities.families.datatable');

    Route::get('{id}', 'FamilyController@show')
        ->name('charities.families.show');

});
