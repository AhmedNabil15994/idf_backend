<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'donations'], function () {

  	Route::get('/' ,'DonationController@index')
  	->name('dashboard.donations.index');
    Route::get('donations/exports/{pdf}' , 'DonationController@export')->name('dashboard.donations.export');

  	Route::get('datatable'	,'DonationController@datatable')
  	->name('dashboard.donations.datatable');
  	Route::delete('{id}'	,'DonationController@destroy')
  	->name('dashboard.donations.destroy');
  	Route::get('deletes'	,'DonationController@deletes')
  	->name('dashboard.donations.deletes');
  	Route::get('{id}','DonationController@show')
  	->name('dashboard.donations.show');
});
