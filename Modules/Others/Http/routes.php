<?php

Route::namespace('Modules\Others\Http\Controllers')->middleware('access:admin.other')->prefix('admin')->name('admin.')->group(function(){
    Route::prefix('other')->name('other.')->group(function(){

        Route::resource('subscribers', 'SubscribersController');
        Route::resource('feedback', 'FeedbackController');
    });
});





