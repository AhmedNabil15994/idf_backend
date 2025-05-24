<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'nationalities'], function () {

  	Route::get('/' ,'NationalityController@index')
  	->name('dashboard.nationalities.index');

  	Route::get('datatable'	,'NationalityController@datatable')
  	->name('dashboard.nationalities.datatable');

  	Route::get('create'		,'NationalityController@create')
  	->name('dashboard.nationalities.create');

  	Route::post('/'			,'NationalityController@store')
  	->name('dashboard.nationalities.store');

  	Route::get('{id}/edit'	,'NationalityController@edit')
  	->name('dashboard.nationalities.edit');

  	Route::put('{id}'		,'NationalityController@update')
  	->name('dashboard.nationalities.update');

  	Route::delete('{id}'	,'NationalityController@destroy')
  	->name('dashboard.nationalities.destroy');

  	Route::get('deletes'	,'NationalityController@deletes')
  	->name('dashboard.nationalities.deletes');

  	Route::get('{id}','NationalityController@show')
  	->name('dashboard.nationalities.show');

});
