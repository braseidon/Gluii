<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

# Index
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
|
*/

# Authentication
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function()
{
	# Log In
	Route::get('login', ['as' => 'auth/login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', 'AuthController@postLogin');
	# Log Out
	Route::get('logout', ['as' => 'auth/logout', 'uses' => 'AuthController@getLogout']);
	# Register
	Route::get('register', ['as' => 'auth/register', 'uses' => 'AuthController@getRegister']);
	Route::post('register', 'AuthController@postRegister');
	# Forgot Password
	Route::get('forgot-password', ['as' => 'auth/forgot-password', 'uses' => 'PasswordController@getEmail']);
	Route::post('forgot-password', 'PasswordController@postEmail');
});

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
|
*/

# Users - RESTful
// Route::resource('user', 'UserController');

/*
|--------------------------------------------------------------------------
| Explore
|--------------------------------------------------------------------------
|
|
*/

# Explore
Route::get('explore', ['as' => 'explore', 'uses' => 'ExploreController@getIndex']);

/*
|--------------------------------------------------------------------------
| Festivals
|--------------------------------------------------------------------------
|
|
*/

# Festivals
Route::get('festivals', ['as' => 'festivals', 'uses' => 'FestivalsController@getIndex']);

/*
|--------------------------------------------------------------------------
| Random Tests
|--------------------------------------------------------------------------
|
|
*/

# Testing Event
Route::get('test-event', ['as' => 'test-event', 'uses' => 'WelcomeController@getTestEvent']);