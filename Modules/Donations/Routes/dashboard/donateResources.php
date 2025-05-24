<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'donate-resources'], function () {

  	Route::get('/' ,'DonateResourceController@index')
  	->name('dashboard.donate_resources.index');

  	Route::get('datatable'	,'DonateResourceController@datatable')
  	->name('dashboard.donate_resources.datatable');

  	Route::put('{id}'		,'DonateResourceController@update')
  	->name('dashboard.donate_resources.update');

  	Route::delete('{id}'	,'DonateResourceController@destroy')
  	->name('dashboard.donate_resources.destroy');

  	Route::get('deletes'	,'DonateResourceController@deletes')
  	->name('dashboard.donate_resources.deletes');

  	Route::get('{id}','DonateResourceController@show')
  	->name('dashboard.donate_resources.show');

});
