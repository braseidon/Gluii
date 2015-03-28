<?php namespace App\Models;

class StatusActivity extends Status
{

    /**
     * Always autoload the specified related models
     *
     * @var array
     */
    protected $with = ['profileuser', 'user', 'likes', 'comments', 'comments.author', 'comments.likes'];

    /**
     * Make sure the correct presenter is loaded
     *
     * @var string
     */
    protected $presenter = 'App\\Gluii\\Presenters\\StatusPresenter';

    /**
     * Manually set the morph class
     *
     * @var string
     */
    // public $morphClass = 'App\Models\Status';

    /**
     * Loads all relationships for displaying the status
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeLoadRelationships($query)
    {
        return $query->with([
                'profileuser' => function ($q) {
                    $q->selectForFeed();
                },
                'author' => function ($q) {
                    $q->selectForFeed();
                },
                'likes' => function ($q) {
                    $q->addSelect('users.id', 'first_name', 'last_name')
                        ->withPivot('user_id');
                },
                'comments' => function ($q) {
                    $q->orderBy('id', 'ASC');
                },
                'comments.author' => function ($q) {
                    $q->selectForFeed();
                },
                'comments.likes' => function ($q) {
                    $q->addSelect('users.id', 'first_name', 'last_name')
                        ->withPivot('user_id');
                },
            ]);
    }
}
