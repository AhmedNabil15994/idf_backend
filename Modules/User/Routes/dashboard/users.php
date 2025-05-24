<?php

Route::group(['prefix' => 'users'], function () {

  	Route::get('/' ,'UserController@index')
  	->name('dashboard.users.index');

  	Route::get('datatable'	,'UserController@datatable')
  	->name('dashboard.users.datatable');

  	Route::get('create'		,'UserController@create')
  	->name('dashboard.users.create');

  	Route::post('/'			,'UserController@store')
  	->name('dashboard.users.store');

  	Route::get('{id}/edit'	,'UserController@edit')
  	->name('dashboard.users.edit');

  	Route::put('{id}'		,'UserController@update')
  	->name('dashboard.users.update');

  	Route::delete('{id}'	,'UserController@destroy')
  	->name('dashboard.users.destroy');

  	Route::get('deletes'	,'UserController@deletes')
  	->name('dashboard.users.deletes');

  	Route::get('{id}','UserController@show')
  	->name('dashboard.users.show');

});
