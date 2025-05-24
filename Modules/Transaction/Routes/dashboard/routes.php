<?php

Route::group(['prefix' => 'transactions'], function () {

  	Route::get('/' ,'TransactionController@index')
  	->name('dashboard.transactions.index');

  	Route::get('datatable'	,'TransactionController@datatable')
  	->name('dashboard.transactions.datatable');

});
