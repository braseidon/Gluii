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
Route::group(['namespace' => 'Auth'], function()
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
	# Reset Password
	Route::get('reset-password/{token}', ['as' => 'auth/reset-password', 'uses' => 'PasswordController@getResetPassword']);
});

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
|
*/
Route::group(['prefix' => 'user', 'namespace' => 'User'], function()
{
	# View Profile
	Route::get('{id}/view', ['as' => 'user/view', 'uses' => 'UserController@getViewUserProfile']);

	# Friends
	Route::group(['prefix' => 'friends'], function()
	{
		# Friend Requests
		Route::group(['prefix' => 'requests'], function()
		{
			# Send Request
			Route::post('addnew', ['as' => 'user/request/add', 'uses' => 'FriendRequestController@postSendFriendRequest']);
			# Accept Request
			Route::get('accept', ['as' => 'user/request/accept', 'uses' => 'FriendRequestController@getAcceptFriendRequest']);
			# Deny Request
			Route::get('deny', ['as' => 'user/request/deny', 'uses' => 'FriendRequestController@getDenyFriendRequest']);
			# Cancel/Delete Request
			Route::get('cancel', ['as' => 'user/request/cancel', 'uses' => 'FriendRequestController@getRemoveFriend']);
		});
	});
});

/*
|--------------------------------------------------------------------------
| Statuses
|--------------------------------------------------------------------------
|
|
*/
Route::group(['prefix' => 'statuses', 'namespace' => 'User'], function()
{
	# View Single
	Route::post('{id}/view', ['as' => 'status/view', 'uses' => 'StatusController@getViewStatus']);
	# Post Status
	Route::post('post-new', ['as' => 'status/new', 'uses' => 'StatusController@postNewStatus']);
	# Like Status
	Route::post('like', ['as' => 'status/like', 'uses' => 'StatusController@postLikeStatus']);
	# Unlike Status
	Route::post('unlike', ['as' => 'status/unlike', 'uses' => 'StatusController@postUnlikeStatus']);
	# Delete Status
	Route::post('delete', ['as' => 'status/delete', 'uses' => 'StatusController@postDeleteStatus']);

	# Comments
	Route::group(['prefix' => 'comments'], function()
	{
		# Post Comment
		Route::post('post-new', ['as' => 'status/comment/new', 'uses' => 'StatusController@postNewComment']);
		# Like Comment
		Route::post('like', ['as' => 'status/comment/like', 'uses' => 'StatusController@postLikeComment']);
		# Unlike Comment
		Route::post('unlike', ['as' => 'status/comment/unlike', 'uses' => 'StatusController@postUnlikeComment']);
		# Delete Comment
		Route::post('delete', ['as' => 'status/comment/delete', 'uses' => 'StatusController@postDeleteComment']);
	});
});

/*
|--------------------------------------------------------------------------
| Explore
|--------------------------------------------------------------------------
|
|
*/
Route::group(['prefix' => 'explore'], function()
{
	Route::get('/', ['as' => 'explore', 'uses' => 'ExploreController@getIndex']);
});

/*
|--------------------------------------------------------------------------
| Festivals
|--------------------------------------------------------------------------
|
|
*/
Route::group(['prefix' => 'festivals'], function()
{
	Route::get('/', ['as' => 'festivals', 'uses' => 'FestivalsController@getIndex']);
});

/*
|--------------------------------------------------------------------------
| Images
|--------------------------------------------------------------------------
|
|
*/
Route::group(['prefix' => 'img'], function()
{
	# Cover Images
	Route::get('/cover/{path}', ['as' => 'image/cover', 'uses' => 'ImageController@getCoverPhoto']);
});

/*
|--------------------------------------------------------------------------
| Random Tests
|--------------------------------------------------------------------------
|
|
*/

# Testing Event
Route::get('test-event', ['as' => 'test-event', 'uses' => 'WelcomeController@getTestEvent']);
# Testing Email
Route::get('test-email', ['as' => 'test-email', 'uses' => 'HomeController@getTestEmail']);