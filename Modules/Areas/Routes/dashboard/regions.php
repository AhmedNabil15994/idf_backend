<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'regions'], function () {

  	Route::get('/' ,'RegionController@index')
  	->name('dashboard.regions.index');

  	Route::get('datatable'	,'RegionController@datatable')
  	->name('dashboard.regions.datatable');

  	Route::get('create'		,'RegionController@create')
  	->name('dashboard.regions.create');

  	Route::post('/'			,'RegionController@store')
  	->name('dashboard.regions.store');

  	Route::get('{id}/edit'	,'RegionController@edit')
  	->name('dashboard.regions.edit');

  	Route::put('{id}'		,'RegionController@update')
  	->name('dashboard.regions.update');

  	Route::delete('{id}'	,'RegionController@destroy')
  	->name('dashboard.regions.destroy');

  	Route::get('deletes'	,'RegionController@deletes')
  	->name('dashboard.regions.deletes');

  	Route::get('{id}','RegionController@show')
  	->name('dashboard.regions.show');

});
