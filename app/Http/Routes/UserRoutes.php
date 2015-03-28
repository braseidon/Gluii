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

/**
 * News Feeds
 */
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::group(['prefix' => 'feed'], function () {
    # Families
    Route::get('families', ['as' => 'feed/families', 'uses' => 'HomeController@getIndex']);
    # Areas
    Route::get('areas', ['as' => 'feed/areas', 'uses' => 'HomeController@getIndex']);
    # Influencers
    Route::get('influencers', ['as' => 'feed/influencers', 'uses' => 'HomeController@getIndex']);
});

/**
 * User Timeline/Photos/Videos/Calendar
 *
 * @namespace User
 */
Route::group(['prefix' => 'u/{username}', 'namespace' => 'User'], function () {
    # View Timeline
    Route::get('/', ['as' => 'user/view', 'uses' => 'UserProfileController@getViewTimeline']);
    # Photos Index
    Route::get('photos', ['as' => 'user/photos', 'uses' => 'UserProfileController@getViewPhotos']);
    # Videos Index
    Route::get('videos', ['as' => 'user/videos', 'uses' => 'UserProfileController@getViewVideos']);
    # Calendar
    Route::get('calendar', ['as' => 'user/calendar', 'uses' => 'UserProfileController@getViewCalendar']);
});

/**
 * Friendship Actions
 */
Route::group(['prefix' => 'friends', 'middleware' => 'auth', 'namespace' => 'User'], function () {

    # Friend Requests
    Route::group(['prefix' => 'requests'], function () {
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

/**
 * Statuses - View/Like/Comment
 *
 * @namespace User
 */
Route::group(['prefix' => 'status', 'namespace' => 'User'], function () {
    # View Single
    Route::get('{id}/view', ['as' => 'status/view', 'uses' => 'StatusController@getViewStatus']);

    # Like Status
    Route::post('like', ['as' => 'status/like', 'uses' => 'StatusController@postLikeStatus']);
    # Unlike Status
    Route::post('unlike', ['as' => 'status/unlike', 'uses' => 'StatusController@postUnlikeStatus']);

    # Comments
    Route::group(['prefix' => 'comments'], function () {
        # Post Comment
        Route::post('post-new', ['as' => 'status/comment/new', 'uses' => 'StatusController@postNewComment']);
        # Delete Comment
        Route::post('delete', ['as' => 'status/comment/delete', 'uses' => 'StatusController@postDeleteComment']);

        # Like Comment
        Route::post('like', ['as' => 'status/comment/like', 'uses' => 'StatusController@postLikeComment']);
        # Unlike Comment
        Route::post('unlike', ['as' => 'status/comment/unlike', 'uses' => 'StatusController@postUnlikeComment']);
    });
});

/**
 * Statuses - Management
 *
 * @namespace User
 */
Route::group(['prefix' => 'statuses', 'namespace' => 'User'], function () {
    # Post Status
    Route::post('post-new', ['as' => 'status/new', 'uses' => 'StatusController@postNewStatus']);
    # Delete Status
    Route::post('delete', ['as' => 'status/delete', 'uses' => 'StatusController@postDeleteStatus']);
});

/**
 * Notifications
 *
 * @namespace User
 */
Route::group(['prefix' => 'notifications', 'middleware' => 'auth', 'namespace' => 'User'], function () {
    # Friend Requests
    Route::get('friend-requests', ['as' => 'notifications/friend-requests', 'uses' => 'NotificationController@getFriendRequests']);
    # Messages
    Route::get('messages', ['as' => 'notifications/messages', 'uses' => 'NotificationController@getMessages']);
    # Notifications
    Route::get('notifications', ['as' => 'notifications/notifications', 'uses' => 'NotificationController@getNotifications']);
});

/**
 * Photos - View/Like/Comment
 *
 * @namespace Photos
 */
Route::group(['prefix' => 'photo', 'namespace' => 'Photos'], function () {
    # View Photo
    Route::get('{id}/view', ['as' => 'photo/view', 'uses' => 'PhotoController@getViewPhoto']);

    # Like Photo
    Route::post('like', ['as' => 'photo/like', 'uses' => 'PhotoController@postLikePhoto']);
    # Unlike Photo
    Route::post('unlike', ['as' => 'photo/unlike', 'uses' => 'PhotoController@postUnlikePhoto']);


});

/**
 * Photos - Management
 *
 * @namespace Photos
 */
Route::group(['prefix' => 'photos', 'middleware' => 'auth', 'namespace' => 'Photos'], function () {
    # Photo Manager
    Route::get('photos', ['as' => 'user/manage/photos', 'uses' => 'PhotoUploadController@getIndex']);
    # Upload Pictures
    Route::get('upload', ['as' => 'user/manage/photos/upload', 'uses' => 'PhotoUploadController@getUploadPhoto']);
    Route::post('upload', 'PhotoUploadController@postUploadPhoto');
    # Crop Photo
    Route::get('{id}/crop', ['as' => 'user/manage/photos/crop', 'uses' => 'PhotoUploadController@getPhotoCropper']);
    Route::post('{id}/crop-process', ['as' => 'user/manage/photos/crop-process', 'uses' => 'PhotoUploadController@postPhotoCropperProcess']);
});

/*
|--------------------------------------------------------------------------
| Activity Actions
|--------------------------------------------------------------------------
|
|
*/
Route::group(['prefix' => 'activity/{activityType}', 'namespace' => 'Activities'], function () {
    # Like Activity
    Route::post('like', ['as' => 'activity/like', 'uses' => 'ActivityActionController@postLikeActivity']);
    # Unlike Activity
    Route::post('unlike', ['as' => 'activity/unlike', 'uses' => 'ActivityActionController@postUnlikeActivity']);

    # Comments
    Route::group(['prefix' => 'comments'], function () {
        # Post Comment
        Route::post('post-new', ['as' => 'activity/comment/new', 'uses' => 'ActivityActionController@postNewComment']);
        # Delete Comment
        Route::post('delete', ['as' => 'activity/comment/delete', 'uses' => 'ActivityActionController@postDeleteComment']);

        # Like Comment
        Route::post('like', ['as' => 'activity/comment/like', 'uses' => 'ActivityActionController@postLikeComment']);
        # Unlike Comment
        Route::post('unlike', ['as' => 'activity/comment/unlike', 'uses' => 'ActivityActionController@postUnlikeComment']);
    });
});

/*
|--------------------------------------------------------------------------
| Influencers / Families / Calendar /+ Explore
|--------------------------------------------------------------------------
|
|
*/

/**
 * Explore
 *
 * @namespace Explore
 */
Route::group(['namespace' => 'Explore', 'prefix' => 'explore'], function () {
    # Feed
    Route::get('/', ['as' => 'explore', 'uses' => 'ExploreController@getIndex']);
});

/**
 * Festivals
 *
 * @namespace Festivals
 */
Route::group(['namespace' => 'Festivals', 'prefix' => 'festivals'], function () {
    # Feed
    Route::get('/', ['as' => 'festivals', 'uses' => 'FestivalsController@getIndex']);
});

/**
 * Families
 *
 * @namespace Families
 */
Route::group(['namespace' => 'Families', 'prefix' => 'families'], function () {
    # Feed
    Route::get('/', ['as' => 'families', 'uses' => 'FamiliesController@getIndex']);
    # View Family
    Route::get('{slug}', ['as' => 'families/view', 'uses' => 'FamiliesController@getIndex']);
});

/**
 * Influencers
 *
 * @namespace Influencers
 */
Route::group(['namespace' => 'Influencers', 'prefix' => 'influencers'], function () {
    # Feed
    Route::get('/', ['as' => 'influencers', 'uses' => 'InfluencersController@getIndex']);
    # View Family
    Route::get('{slug}', ['as' => 'influencers/view', 'uses' => 'InfluencersController@getIndex']);
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
