<?php namespace App\Models;

use App\Models\Activity;
use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\Status\Traits\StatusLikeableTrait;
use App\Gluii\Support\Traits\PublishesActivity;
use Auth;
use Gluii\Presenters\StatusPresenter;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    use PresentableTrait, PublishesActivity, StatusLikeableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * Fillable fields for a new status.
     *
     * @var array
     */
    protected $fillable = ['profile_user_id', 'author_id', 'body'];

    // protected $with = ['profileuser', 'author'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * A status belongs to a User's profile
     *
     * @return User
     */
    public function profileuser()
    {
        return $this->belongsTo('App\Models\User', 'profile_user_id');
    }

    /**
     * A status belongs to the User author
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    /**
     * Statuses have many Comments
     *
     * @return Collection
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'status_id');
    }

    /**
     * Relationship with Users through Subscriptions
     *
     * @return Collection
     */
    public function subscribers()
    {
        return $this->belongsToMany('App\Models\User', 'status_subscribers', 'status_id', 'user_id')
            ->wherePivot('notifications', '=', 1)
            ->withPivot('user_id', 'status_id', 'notifications');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
<<<<<<< HEAD:app/Status.php
     * Query scope for all friend updates?
     *
     * @param  Builder  $query
     * @param  integer  $limit
     * @return Builder
     */
    public function scopeAllFriendUpdates($query, $limit = 20)
=======
     * Loads all relationships for displaying the status
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeLoadRelationships($query)
>>>>>>> updates:app/Models/Status.php
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
