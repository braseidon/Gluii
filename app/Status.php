<?php namespace App;

use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\Status\Traits\StatusLikeableTrait;
use Gluii\Presenters\StatusPresenter;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    use PresentableTrait, StatusLikeableTrait;

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
        return $this->belongsTo('App\User', 'profile_user_id');
    }

    /**
     * A status belongs to the User author
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * Statuses have many Comments
     *
     * @return Collection
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'status_id');
    }

    /**
     * Relationship with Users through Subscriptions
     *
     * @return Collection
     */
    public function subscribers()
    {
        return $this->belongsToMany('App\User', 'status_subscribers', 'status_id', 'user_id')
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

    public function scopeAllFriendUpdates($query, $limit = 20)
    {
        return $query->with([
            'profileuser',
            'author',
            'likes' => function ($q) {
                $q->select('users.id', 'first_name', 'last_name')
                    ->withPivot('user_id');
            },
            'comments' => function ($q) {
                $q->orderBy('id', 'ASC');
            },
            'comments.author',
            'comments.likes' => function ($q) {
                $q->select('users.id', 'first_name', 'last_name')
                    ->withPivot('user_id');
            },
        ]);
    }
}
