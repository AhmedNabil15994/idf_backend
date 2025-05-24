<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function () {

  	Route::get('/' ,'OrderController@index')
  	->name('charities.orders.index');

  	Route::get('datatable'	,'OrderController@datatable')
  	->name('charities.orders.datatable');

  	Route::get('{id}','OrderController@show')
  	->name('charities.orders.show');

});
