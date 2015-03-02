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

// Route::group(['prefix' => 'img', 'namespace' => 'Assets'], function () {
// 	# Profile Images
// 	Route::get('/profile/{path}', ['as' => 'image/cover', 'uses' => 'ImageController@getCoverPhoto']);
// 	# Photos
// 	Route::get('/photo/{path}', ['as' => 'image/cover', 'uses' => 'ImageController@getCoverPhoto']);
// });

/**
 * Image Cache
 */
Route::get('img/{size}/{path}', ['as' => 'asset/img', 'uses' => 'AssetController@getUserPhoto'])->where('path', '.+');