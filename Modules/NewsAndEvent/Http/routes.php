<?php

/** Backend Routes */
Route::namespace('Modules\NewsAndEvent\Http\Controllers')->middleware('access:admin.newsandevent')->prefix('admin')->name('admin.')->group(function(){
        Route::resource('newsandevent', 'NewsAndEventController');
});
