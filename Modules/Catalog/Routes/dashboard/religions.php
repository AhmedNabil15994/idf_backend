<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'religions'], function () {

  	Route::get('/' ,'ReligionController@index')
  	->name('dashboard.religions.index');

  	Route::get('datatable'	,'ReligionController@datatable')
  	->name('dashboard.religions.datatable');

  	Route::get('create'		,'ReligionController@create')
  	->name('dashboard.religions.create');

  	Route::post('/'			,'ReligionController@store')
  	->name('dashboard.religions.store');

  	Route::get('{id}/edit'	,'ReligionController@edit')
  	->name('dashboard.religions.edit');

  	Route::put('{id}'		,'ReligionController@update')
  	->name('dashboard.religions.update');

  	Route::delete('{id}'	,'ReligionController@destroy')
  	->name('dashboard.religions.destroy');

  	Route::get('deletes'	,'ReligionController@deletes')
  	->name('dashboard.religions.deletes');

  	Route::get('{id}','ReligionController@show')
  	->name('dashboard.religions.show');

});
