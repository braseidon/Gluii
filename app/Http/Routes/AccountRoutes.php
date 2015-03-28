<?php

/**
 * Authentication
 *
 * @namespace Auth
 */
Route::group(['namespace' => 'Auth'], function () {
    # Log In
    Route::get('login', ['as' => 'auth/login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', 'AuthController@postLogin');
    # Log Out
    Route::get('logout', ['as' => 'auth/logout', 'uses' => 'AuthController@getLogout']);

    # Forgot Password
    Route::get('forgot-password', ['as' => 'auth/forgot-password', 'uses' => 'PasswordController@getForgotPassword']);
    Route::post('forgot-password', 'PasswordController@postForgotPassword');
    # Reset Password
    Route::get('reset-password/{id}/{code}', ['as' => 'auth/reset-password', 'uses' => 'PasswordController@getResetPassword']);
    Route::post('reset-password/{id}/{code}', 'PasswordController@postResetPassword');

    # Register
    Route::get('register', ['as' => 'auth/register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', 'AuthController@postRegister');
    # Activate Account
    Route::get('activate/{id}/{code}', [ 'as' => 'auth/activate', 'uses' => 'ActivationsController@activate' ])->where('id', '\d+');
});

/*
|--------------------------------------------------------------------------
| Account Settings / Security
|--------------------------------------------------------------------------
|
|
*/

/**
 * Settings
 */
Route::group(['prefix' => 'account/settings', 'namespace' => 'Account\\Settings'], function () {
    // Settings
    Route::get('/', ['as' => 'account/settings', 'uses' => 'SettingsController@getSettings']);
    Route::post('/', 'SettingsController@postUpdateSettings');
    // Notifications
    Route::get('notifications', ['as' => 'account/settings/notifications', 'uses' => 'SettingsController@getNotifications']);
});

/**
 * Security
 */
Route::group(['prefix' => 'account/security', 'middleware' => 'auth', 'namespace' => 'Account\\Security'], function () {
    // Security Dashboard
    Route::get('/', ['as' => 'account/security', 'uses' => 'SecurityController@getSecurityDashboard']);
    // Update Email
    Route::get('update-email', ['as' => 'account/security/update-email', 'uses' => 'SecurityController@getUpdateEmail']);
    Route::post('update-email', 'SecurityController@postUpdateEmail');
    // Update Email - Confirm
    Route::get('confirm-email/{code}', ['as' => 'account/security/update-email/confirm', 'uses' => 'SecurityController@getConfirmNewEmail']);
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
