<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'governorates'], function () {

  	Route::get('/' ,'GovernorateController@index')
  	->name('dashboard.governorates.index');

  	Route::get('datatable'	,'GovernorateController@datatable')
  	->name('dashboard.governorates.datatable');

  	Route::get('create'		,'GovernorateController@create')
  	->name('dashboard.governorates.create');

  	Route::post('/'			,'GovernorateController@store')
  	->name('dashboard.governorates.store');

  	Route::get('{id}/edit'	,'GovernorateController@edit')
  	->name('dashboard.governorates.edit');

  	Route::put('{id}'		,'GovernorateController@update')
  	->name('dashboard.governorates.update');

  	Route::delete('{id}'	,'GovernorateController@destroy')
  	->name('dashboard.governorates.destroy');

  	Route::get('deletes'	,'GovernorateController@deletes')
  	->name('dashboard.governorates.deletes');

  	Route::get('{id}','GovernorateController@show')
  	->name('dashboard.governorates.show');

  	Route::get('get-governorates/{id}','GovernorateController@getCities')
  	->name('dashboard.governorates.get-cities');

});
