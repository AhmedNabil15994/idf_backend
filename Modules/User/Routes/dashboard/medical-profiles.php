<?php

Route::group(['prefix' => 'medical_profiles'], function () {

  	Route::get('/' ,'MedicalProfileController@index')
  	->name('dashboard.medical_profiles.index');

  	Route::get('datatable'	,'MedicalProfileController@datatable')
  	->name('dashboard.medical_profiles.datatable');

  	Route::get('create'		,'MedicalProfileController@create')
  	->name('dashboard.medical_profiles.create');

  	Route::post('/'			,'MedicalProfileController@store')
  	->name('dashboard.medical_profiles.store');

  	Route::get('{id}/edit'	,'MedicalProfileController@edit')
  	->name('dashboard.medical_profiles.edit');

  	Route::put('{id}'		,'MedicalProfileController@update')
  	->name('dashboard.medical_profiles.update');

  	Route::delete('{id}'	,'MedicalProfileController@destroy')
  	->name('dashboard.medical_profiles.destroy');

  	Route::get('deletes'	,'MedicalProfileController@deletes')
  	->name('dashboard.medical_profiles.deletes');

  	Route::get('{id}','MedicalProfileController@show')
  	->name('dashboard.medical_profiles.show');

});
