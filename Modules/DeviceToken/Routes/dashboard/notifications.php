<?php

Route::group(['prefix' => 'notifications'], function () {

  	Route::get('/' ,'DeviceTokenController@index')
  	->name('dashboard.notifications.index');

  	Route::post('/'			,'DeviceTokenController@send')
  	->name('dashboard.notifications.send');

});
