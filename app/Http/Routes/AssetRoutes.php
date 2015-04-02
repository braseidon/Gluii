<?php

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
