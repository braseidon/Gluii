<?php namespace App\Models;

class PhotoActivity extends Photo
{

    /**
     * Always autoload the specified related models
     *
     * @var array
     */
    protected $with = ['user', 'album'];

    /**
     * Make sure the correct presenter is loaded
     *
     * @var string
     */
    protected $presenter = 'App\\Gluii\\Presenters\\PhotoPresenter';

    /**
     * Manually set the morph class
     *
     * @var string
     */
    // public $morphClass = 'App\Models\Photo';
}
