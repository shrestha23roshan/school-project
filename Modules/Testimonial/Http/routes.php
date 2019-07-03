<?php

Route::namespace('Modules\Testimonial\Http\Controllers')->middleware('access:admin.testimonial')->prefix('admin')->name('admin.')->group(function(){

    Route::resource('testimonial', 'TestimonialController');
});

