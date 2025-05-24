<?php

use Vsch\TranslationManager\Translator;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/'], function() {

  Route::get('/' , 'DashboardController@index')->name('dashboard.home');

  Route::group(['prefix' => 'translations'], function () {
      Translator::routes();
  });


});
