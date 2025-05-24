<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'item-types'], function () {

  	Route::get('/' ,'ItemTypeController@index')
  	->name('dashboard.item_types.index');

  	Route::get('datatable'	,'ItemTypeController@datatable')
  	->name('dashboard.item_types.datatable');

  	Route::get('create'		,'ItemTypeController@create')
  	->name('dashboard.item_types.create');

  	Route::post('/'			,'ItemTypeController@store')
  	->name('dashboard.item_types.store');

  	Route::get('{id}/edit'	,'ItemTypeController@edit')
  	->name('dashboard.item_types.edit');

  	Route::put('{id}'		,'ItemTypeController@update')
  	->name('dashboard.item_types.update');

  	Route::delete('{id}'	,'ItemTypeController@destroy')
  	->name('dashboard.item_types.destroy');

  	Route::get('deletes'	,'ItemTypeController@deletes')
  	->name('dashboard.item_types.deletes');

  	Route::get('{id}','ItemTypeController@show')
  	->name('dashboard.item_types.show');

});
