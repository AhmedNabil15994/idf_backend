<?php

use Vsch\TranslationManager\Translator;


Route::group(['prefix' => '/' , 'middleware' => ['charities.auth']], function() {

  Route::get('/' , 'CharityController@index')->name('charities.home');

  Route::group(['prefix' => 'translations'], function () {
      Translator::routes();
  });

});
