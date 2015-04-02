<?php

/**
 * Explore Gluii
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
Route::get('php-tester', ['as' => 'php-tester', 'uses' => 'PHPTesterController@getPhpTester']);
# Testing Email
Route::get('test-email', ['as' => 'test-email', 'uses' => 'HomeController@getTestEmail']);
