<?php
/**
 * Application Routes for Settings Module
 */

 Route::namespace('Modules\Settings\Http\Controllers')->middleware('access:admin.settings')->prefix('admin')->name('admin.')->group(function(){
    Route::get('settings', 'SettingsController@setting')->name('settings.index');
    Route::post('settings', 'SettingsController@updateSetting')->name('settings.update');
 });

 Route::namespace('Modules\Settings\Http\Controllers')->prefix('admin/settings')->name('admin.settings.')->group(function() {
    
    Route::get('profile', 'SettingsController@profile')->name('profile.index');
    Route::post('profile', 'SettingsController@updateProfile')->name('profile.update');
    Route::post('profile-pass', 'SettingsController@updatePassword')->name('profile.password.update');
});