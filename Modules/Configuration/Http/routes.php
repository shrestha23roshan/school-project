<?php

// Route::group(['middleware' => 'web', 'prefix' => 'configuration', 'namespace' => 'Modules\Configuration\Http\Controllers'], function()
// {
//     Route::get('/', 'ConfigurationController@index');
// });
Route::namespace('Modules\Configuration\Http\Controllers')->middleware('access:admin.privilege')->prefix('admin/privilege')->name('admin.privilege.')->group(function(){
    Route::resource('role', 'RoleController');
    Route::resource('module', 'ModuleController', ['except'=>['create', 'edit']]);
    Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);

    Route::put('module/sort/order', ['as'=>'module.sortorder', 'uses'=>'ModuleController@sortOrder']);
    Route::put('module/change/status/{module}', ['as'=>'module.change.status', 'uses'=>'ModuleController@changeStatus']);
    Route::put('user/change/status/{user}', ['as' => 'user.change.status', 'uses' => 'UserController@changeStatus']);
 });