<?php


Route::namespace('Modules\Media\Http\Controllers')->middleware('access:admin.media')->prefix('admin')->name('admin.')->group(function(){
    Route::prefix('media')->name('media.')->group(function(){
        Route::resource('album', 'AlbumController');
    });
    Route::prefix('media')->name('media.')->group(function(){
        Route::get('album/{id}/photo', 'AlbumPhotoController@index')->name('album.photo.index');
        Route::get('album/{id}/photo/create', 'AlbumPhotoController@create')->name('album.photo.create');
        Route::post('album/{id}/photo/store', 'AlbumPhotoController@store')->name('album.photo.store');
      
        Route::delete('album/photo/{id}', 'AlbumPhotoController@destroy');
    });
});
