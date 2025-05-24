<?php


use Illuminate\Support\Facades\Route;


Route::as('frontend.recurring-donations.')->prefix('recurring-donations')->group( function () {

     Route::middleware(['auth'])->group( function () {
          Route::get('project/{project_slug?}/{time_period?}/{price?}','RecurringDonationController@index')->name('index');
          Route::delete('/{id}','RecurringDonationController@delete')->name('delete');
          Route::post('project/{project_slug?}/{time_period?}/{price?}','RecurringDonationController@donait')->name('donait');
     });

     Route::get('payment/success', 'RecurringDonationController@success')->name('payment.success');

     Route::get('payment/failed', 'RecurringDonationController@failed')->name('payment.failed');
});
