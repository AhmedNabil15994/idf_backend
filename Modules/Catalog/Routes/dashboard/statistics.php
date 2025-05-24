<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'Statistics'], function () {

  	Route::get('/' ,'StatisticsController@index')
  	->name('dashboard.statistics.index');
//    ->middleware(['permission:show_Statistics']);

  	Route::get('datatable'	,'StatisticsController@datatable')
  	->name('dashboard.statistics.datatable');
//  	->middleware(['permission:show_Statistics']);

  	Route::get('create'		,'StatisticsController@create')
  	->name('dashboard.statistics.create');
//    ->middleware(['permission:add_Statistics']);

  	Route::post('/'			,'StatisticsController@store')
  	->name('dashboard.statistics.store');
//    ->middleware(['permission:add_Statistics']);

  	Route::get('{id}/edit'	,'StatisticsController@edit')
  	->name('dashboard.statistics.edit');
//    ->middleware(['permission:edit_Statistics']);

  	Route::put('{id}'		,'StatisticsController@update')
  	->name('dashboard.statistics.update');
//    ->middleware(['permission:edit_Statistics']);

  	Route::delete('{id}'	,'StatisticsController@destroy')
  	->name('dashboard.statistics.destroy');
//    ->middleware(['permission:delete_Statistics']);

  	Route::get('deletes'	,'StatisticsController@deletes')
  	->name('dashboard.statistics.deletes');
//    ->middleware(['permission:delete_Statistics']);

  	Route::get('{id}','StatisticsController@show')
  	->name('dashboard.statistics.show');
//    ->middleware(['permission:show_Statistics']);

});
