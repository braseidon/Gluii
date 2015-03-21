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
 * Settings
 */
Route::group(['prefix' => 'account/settings', 'namespace' => 'Account\\Settings'], function () {
    // Settings
    Route::get('/', ['as' => 'account/settings', 'uses' => 'SettingsController@getSettings']);
    // Notifications
    Route::get('notifications', ['as' => 'account/settings/notifications', 'uses' => 'SettingsController@getNotifications']);
});

/**
 * Security
 */
Route::group(['prefix' => 'account/security', 'namespace' => 'Account\\Security'], function () {
    // Security Dashboard
    Route::get('/', ['as' => 'account/security', 'uses' => 'SecurityController@getSecurityDashboard']);
    // Update Email
    Route::get('update-email', ['as' => 'account/security/update-email', 'uses' => 'SecurityController@getUpdateEmail']);
    Route::post('update-email', 'SecurityController@postUpdateEmail');
    // Update Password
    Route::get('update-password', ['as' => 'account/security/update-password', 'uses' => 'SecurityController@getUpdatePassword']);
    Route::post('update-password', 'SecurityController@postUpdatePassword');
    // Active Sessions
    Route::group(['prefix' => 'sessions'], function () {
        // Sessions
        Route::get('/', ['as' => 'account/security/sessions', 'uses' => 'SecurityController@getActiveSessions']);
        // Flush
        Route::get('flush', ['as' => 'account/security/sessions/flush', 'uses' => 'SecurityController@getFlushSession']);
        // Flush Code
        Route::get('flush-code/{code}', ['as' => 'account/security/sessions/flush-code', 'uses' => 'SecurityController@getFlushCode']);
        // Flush All
        Route::get('flush-all', ['as' => 'account/security/sessions/flush-all', 'uses' => 'SecurityController@getFlushAllSessions']);
    });
});
