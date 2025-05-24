<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'partners'], function () {

  	Route::get('/' ,'PartnerController@index')
  	->name('dashboard.partners.index');

  	Route::get('datatable'	,'PartnerController@datatable')
  	->name('dashboard.partners.datatable');

  	Route::get('create'		,'PartnerController@create')
  	->name('dashboard.partners.create');

  	Route::post('/'			,'PartnerController@store')
  	->name('dashboard.partners.store');

  	Route::get('{id}/edit'	,'PartnerController@edit')
  	->name('dashboard.partners.edit');

  	Route::put('{id}'		,'PartnerController@update')
  	->name('dashboard.partners.update');

  	Route::delete('{id}'	,'PartnerController@destroy')
  	->name('dashboard.partners.destroy');

  	Route::get('deletes'	,'PartnerController@deletes')
  	->name('dashboard.partners.deletes');

  	Route::get('{id}','PartnerController@show')
  	->name('dashboard.partners.show');

});
