<?php

// Route::group(['middleware' => 'web', 'prefix' => 'contentmanagement', 'namespace' => 'Modules\ContentManagement\Http\Controllers'], function()
// {
//     Route::get('/', 'ContentManagementController@index');
// });

 /** Backend Routes */
 Route::namespace('Modules\ContentManagement\Http\Controllers')->middleware('access:admin.content-management')->prefix('admin')->name('admin.')->group(function(){
    Route::middleware('access:admin.content-management.notice')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('notice', 'NoticeController');
    });

    Route::middleware('access:admin.content-management.banner')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('banner', 'BannerController');
    });
    Route::middleware('access:admin.content-management.message')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('message', 'MessageController');
    });
    Route::middleware('access:admin.content-management.aboutus')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('aboutus', 'AboutUsController');
    });
    Route::middleware('access:admin.content-management.download')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('download', 'DownloadController');
    });
    Route::middleware('access:admin.content-management.faculty')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('faculty', 'FacultyController');
    });
    Route::middleware('access:admin.content-management.page')->prefix('content-management')->name('content-management.')->group(function(){
        Route::resource('page', 'PageController');
    });
 });