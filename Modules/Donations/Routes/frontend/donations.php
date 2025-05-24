<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group( function () {

    Route::post('donation/direct/donate/{project?}','DonationController@directDonation')->name('donation.direct.donate');
    Route::get('donation/success', 'DonationController@success')
        ->name('donation.success');

    Route::get('donation/failed', 'DonationController@failed')
        ->name('donation.failed');
//    Route::resource('donation','DonateResourceController')->only('index','show','store')->names('donate-resources');
});