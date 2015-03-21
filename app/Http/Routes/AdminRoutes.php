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
 * Admin Section
 *
 * @namespace Admin
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'auth.admin'], function () {

    /*
    |-------------------------------------------------------------------------------------------------
    | Users
    |-------------------------------------------------------------------------------------------------
    |
    |
    */
    Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
        # Index
        Route::get('/', ['as' => 'admin/users', 'uses' => 'UsersController@getIndex']);
        # Create
        Route::get('create', [ 'as' => 'admin/users/create', 'uses' => 'UsersController@getCreateUser' ]);
        Route::post('create', 'UsersController@postCreateUser');
        # Edit
        Route::get('{id}', [ 'as' => 'admin/users/edit', 'uses' => 'UsersController@getEditUser' ]);
        Route::post('{id}', 'UsersController@postEditUser');
        # Delete
        Route::delete('{id}', [ 'as' => 'admin/users/delete', 'uses' => 'UsersController@delete' ]);
        # Deactivate
        Route::get('{id}/deactivate', [ 'as' => 'admin/users/deactivate', 'uses' => 'ActivationsController@deactivate']);
        Route::get('{id}/reactivate', [ 'as' => 'admin/users/reactivate', 'uses' => 'ActivationsController@reactivate']);
    });

});
