<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'baskets'], function () {

  	Route::get('/' ,'BasketController@index')
  	->name('dashboard.baskets.index');

  	Route::get('datatable'	,'BasketController@datatable')
  	->name('dashboard.baskets.datatable');

  	Route::get('create'		,'BasketController@create')
  	->name('dashboard.baskets.create');

  	Route::post('/'			,'BasketController@store')
  	->name('dashboard.baskets.store');

  	Route::get('{id}/edit'	,'BasketController@edit')
  	->name('dashboard.baskets.edit');

  	Route::put('{id}'		,'BasketController@update')
  	->name('dashboard.baskets.update');

  	Route::delete('{id}'	,'BasketController@destroy')
  	->name('dashboard.baskets.destroy');

  	Route::get('deletes'	,'BasketController@deletes')
  	->name('dashboard.baskets.deletes');

  	Route::get('{id}','BasketController@show')
  	->name('dashboard.baskets.show');

    Route::get('get-max-number/{id}','BasketController@getMaxNumber')
        ->name('dashboard.baskets.get-max-number');

});
