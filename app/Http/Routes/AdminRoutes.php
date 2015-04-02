<?php

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
