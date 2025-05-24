<?php

Route::group(['prefix' => 'pages'], function () {

  	Route::get('/' ,'PageController@index')
  	->name('dashboard.pages.index');

  	Route::get('datatable'	,'PageController@datatable')
  	->name('dashboard.pages.datatable');

  	Route::get('create'		,'PageController@create')
  	->name('dashboard.pages.create');

  	Route::post('/'			,'PageController@store')
  	->name('dashboard.pages.store');

  	Route::get('{id}/edit'	,'PageController@edit')
  	->name('dashboard.pages.edit');

  	Route::put('{id}'		,'PageController@update')
  	->name('dashboard.pages.update');

  	Route::delete('{id}'	,'PageController@destroy')
  	->name('dashboard.pages.destroy');

  	Route::get('deletes'	,'PageController@deletes')
  	->name('dashboard.pages.deletes');

  	Route::get('{id}','PageController@show')
  	->name('dashboard.pages.show');

});
