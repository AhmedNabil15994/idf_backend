<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'charters'], function () {

  	Route::get('/' ,'CharterController@index')
  	->name('dashboard.charters.index');
//    ->middleware(['permission:show_Statistics']);

  	Route::get('datatable'	,'CharterController@datatable')
  	->name('dashboard.charters.datatable');
//  	->middleware(['permission:show_Statistics']);

  	Route::get('create'		,'CharterController@create')
  	->name('dashboard.charters.create');
//    ->middleware(['permission:add_Statistics']);

  	Route::post('/'			,'CharterController@store')
  	->name('dashboard.charters.store');
//    ->middleware(['permission:add_Statistics']);

  	Route::get('{id}/edit'	,'CharterController@edit')
  	->name('dashboard.charters.edit');
//    ->middleware(['permission:edit_Statistics']);

  	Route::put('{id}'		,'CharterController@update')
  	->name('dashboard.charters.update');
//    ->middleware(['permission:edit_Statistics']);

  	Route::delete('{id}'	,'CharterController@destroy')
  	->name('dashboard.charters.destroy');
//    ->middleware(['permission:delete_Statistics']);

  	Route::get('deletes'	,'CharterController@deletes')
  	->name('dashboard.charters.deletes');
//    ->middleware(['permission:delete_Statistics']);

  	Route::get('{id}','CharterController@show')
  	->name('dashboard.charters.show');
//    ->middleware(['permission:show_Statistics']);

});
