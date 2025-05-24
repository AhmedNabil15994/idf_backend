<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'families'], function () {

    Route::get('/', 'FamilyController@index')
        ->name('dashboard.families.index');

    Route::get('datatable', 'FamilyController@datatable')
        ->name('dashboard.families.datatable');

    Route::get('create', 'FamilyController@create')
        ->name('dashboard.families.create');

    Route::post('/', 'FamilyController@store')
        ->name('dashboard.families.store');

    Route::get('{id}/edit', 'FamilyController@edit')
        ->name('dashboard.families.edit');

    Route::put('{id}', 'FamilyController@update')
        ->name('dashboard.families.update');

    Route::delete('{id}', 'FamilyController@destroy')
        ->name('dashboard.families.destroy');

    Route::get('deletes', 'FamilyController@deletes')
        ->name('dashboard.families.deletes');

    Route::delete('/delete/{family}/attachments/{media}', 'FamilyController@deleteAttachment')
        ->name('families.attachment.delete');

    Route::get('/sort-attachments/{id}', 'FamilyController@sortAttachment')
        ->name('families.attachment.sort');

    Route::get('{id}', 'FamilyController@show')
        ->name('dashboard.families.show');

});
