<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'donors'], function () {

  	Route::get('/' ,'DonorController@index')
  	->name('dashboard.donors.index');

  	Route::get('datatable'	,'DonorController@datatable')
  	->name('dashboard.donors.datatable');

  	Route::get('create'		,'DonorController@create')
  	->name('dashboard.donors.create');

  	Route::post('/'			,'DonorController@store')
  	->name('dashboard.donors.store');

  	Route::get('{id}/edit'	,'DonorController@edit')
  	->name('dashboard.donors.edit');

  	Route::put('{id}'		,'DonorController@update')
  	->name('dashboard.donors.update');

  	Route::delete('{id}'	,'DonorController@destroy')
  	->name('dashboard.donors.destroy');

  	Route::get('deletes'	,'DonorController@deletes')
  	->name('dashboard.donors.deletes');

  	Route::get('{id}','DonorController@show')
  	->name('dashboard.donors.show');

});
