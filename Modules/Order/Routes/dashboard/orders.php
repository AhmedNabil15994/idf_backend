<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function () {

  	Route::get('/' ,'OrderController@index')
  	->name('dashboard.orders.index');

  	Route::get('datatable'	,'OrderController@datatable')
  	->name('dashboard.orders.datatable');

    Route::get('exports/{pdf}' , 'OrderController@export')->name('dashboard.orders.export');

  	Route::get('assign-volunteer/{volunteer}'	,'OrderController@assignVolunteer')
  	->name('dashboard.orders.assign.volunteer');

  	Route::get('create'		,'OrderController@create')
  	->name('dashboard.orders.create');

  	Route::post('/'			,'OrderController@store')
  	->name('dashboard.orders.store');

  	Route::get('{id}/edit'	,'OrderController@edit')
  	->name('dashboard.orders.edit');

  	Route::put('{id}'		,'OrderController@update')
  	->name('dashboard.orders.update');

  	Route::delete('{id}'	,'OrderController@destroy')
  	->name('dashboard.orders.destroy');

  	Route::get('deletes'	,'OrderController@deletes')
  	->name('dashboard.orders.deletes');

  	Route::get('{id}','OrderController@show')
  	->name('dashboard.orders.show');

});
