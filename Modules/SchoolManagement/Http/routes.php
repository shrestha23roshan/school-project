<?php

Route::namespace('Modules\SchoolManagement\Http\Controllers')->middleware('access:admin.school-management')->prefix('admin')->name('admin.')->group(function(){

    Route::prefix('school-management')->name('school-management.')->group(function(){

        Route::resource('alumni', 'AlumniController', ['only' => ['index', 'show', 'destroy']]);

        //Result

        Route::resource('result', 'ResultController', ['except' => ['show']]);
		Route::get('result/delete_all', 'ResultController@deleteAll')->name('result.deleteall');
		Route::get('result/publish', 'ResultController@publishResult')->name('result.publish');
        Route::get('result/unpublish', 'ResultController@unpublishResult')->name('result.unpublish');
        Route::get('result/import', 'ResultController@getImport')->name('result.import.index');
		Route::post('result/import', 'ResultController@postImport')->name('result.import.store');
    });
});

