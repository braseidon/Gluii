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



# Authentication
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
	# Log In
	Route::get('login', ['as' => 'auth/login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['uses' => 'AuthController@postLogin']);
	# Log Out
	Route::get('logout', ['as' => 'auth/lgout', 'uses' => 'AuthController@getLogout']);
	# Register
	Route::get('register', ['as' => 'auth/register', 'uses' => 'AuthController@getRegister']);
	Route::post('register', ['uses' => 'AuthController@postRegister']);
});