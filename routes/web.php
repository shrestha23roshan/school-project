<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * Front Routes
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Backend Routes
 */
Route::get('/school-project-login', function(){
    return view('auth.login');
});

/**
 * Authentication Routes
 */
Route::group(['namespace' => 'Auth'], function(){
    Route::get('school-project-login', ['as' => 'login','uses' => 'LoginController@login']);
    Route::post('school-project-login', ['as' => 'auth.login', 'uses' => 'LoginController@authenticate']);
    Route::get('forgot/password', ['as' => 'auth.change.password', 'uses' => 'LoginController@getChangePassword']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Auth'], function(){
    Route::post('logout', ['as' => 'auth.logout', 'uses' => 'LoginController@logout']);
    // Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'LoginController@onSuccess']);
});