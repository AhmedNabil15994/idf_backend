<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'cities'], function () {

  	Route::get('/' ,'CityController@index')
  	->name('dashboard.cities.index');

  	Route::get('datatable'	,'CityController@datatable')
  	->name('dashboard.cities.datatable');

  	Route::get('create'		,'CityController@create')
  	->name('dashboard.cities.create');

  	Route::post('/'			,'CityController@store')
  	->name('dashboard.cities.store');

  	Route::get('{id}/edit'	,'CityController@edit')
  	->name('dashboard.cities.edit');

  	Route::put('{id}'		,'CityController@update')
  	->name('dashboard.cities.update');

  	Route::delete('{id}'	,'CityController@destroy')
  	->name('dashboard.cities.destroy');

  	Route::get('deletes'	,'CityController@deletes')
  	->name('dashboard.cities.deletes');

  	Route::get('{id}','CityController@show')
  	->name('dashboard.cities.show');

    Route::get('get-regions/{id}','CityController@getRegions')
        ->name('dashboard.cities.get-regions');

});
