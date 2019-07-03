<?php
 Route::namespace('Modules\Seo\Http\Controllers')->middleware('access:admin.seo')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('seo', 'SeoController');
  
 });



