<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'prices'], function () {

  	Route::get('/' ,'PriceController@index')
  	->name('dashboard.prices.index');

  	Route::get('datatable'	,'PriceController@datatable')
  	->name('dashboard.prices.datatable');

  	Route::get('create'		,'PriceController@create')
  	->name('dashboard.prices.create');

  	Route::post('/'			,'PriceController@store')
  	->name('dashboard.prices.store');

  	Route::get('{id}/edit'	,'PriceController@edit')
  	->name('dashboard.prices.edit');

  	Route::put('{id}'		,'PriceController@update')
  	->name('dashboard.prices.update');

  	Route::delete('{id}'	,'PriceController@destroy')
  	->name('dashboard.prices.destroy');

  	Route::get('deletes'	,'PriceController@deletes')
  	->name('dashboard.prices.deletes');

  	Route::get('{id}','PriceController@show')
  	->name('dashboard.prices.show');
});