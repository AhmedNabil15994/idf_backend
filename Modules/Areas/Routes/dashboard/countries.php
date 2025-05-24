<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'countries'], function () {

  	Route::get('/' ,'CountryController@index')
  	->name('dashboard.countries.index');

  	Route::get('datatable'	,'CountryController@datatable')
  	->name('dashboard.countries.datatable');

  	Route::get('create'		,'CountryController@create')
  	->name('dashboard.countries.create');

  	Route::post('/'			,'CountryController@store')
  	->name('dashboard.countries.store');

  	Route::get('{id}/edit'	,'CountryController@edit')
  	->name('dashboard.countries.edit');

  	Route::put('{id}'		,'CountryController@update')
  	->name('dashboard.countries.update');

  	Route::delete('{id}'	,'CountryController@destroy')
  	->name('dashboard.countries.destroy');

  	Route::get('deletes'	,'CountryController@deletes')
  	->name('dashboard.countries.deletes');

  	Route::get('{id}','CountryController@show')
  	->name('dashboard.countries.show');

});
