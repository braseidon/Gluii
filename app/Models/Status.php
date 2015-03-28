<?php namespace App\Models;

use App\Models\Activity;
use App\Gluii\Presenters\Setup\PresentableTrait;
use App\Gluii\Support\Traits\ReceivesComments;
use App\Gluii\Support\Traits\ReceivesLikes;
use App\Gluii\Support\Traits\PublishesActivity;
use Auth;
use Gluii\Presenters\StatusPresenter;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    use PresentableTrait, PublishesActivity, ReceivesComments, ReceivesLikes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['profile_user_id', 'user_id', 'body'];

    // protected $with = ['profileuser', 'user'];

    /**
     * Helper column used for likes/comments
     *
     * @var string
     */
    public $shortName = 'status';

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
     * Loads all relationships for displaying the status
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeLoadActivityRelationships($query)
    {
        return $query->with([
                'profileuser' => function ($q) {
                    $q->selectForFeed();
                },
                'user' => function ($q) {
                    $q->selectForFeed();
                },
                'likes',
                'comments' => function ($q) {
                    $q->orderBy('id', 'ASC');
                },
                'comments.user' => function ($q) {
                    $q->selectForFeed();
                },
                'comments.likes',
            ]);
    }
}
