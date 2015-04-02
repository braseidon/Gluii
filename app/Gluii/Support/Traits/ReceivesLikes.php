<?php namespace App\Gluii\Support\Traits;

use App\Models\Like;
use App\Models\LikeCounter;
use Auth;
use Exception;

trait ReceivesLikes
{

    /**
     * Collection of the likes on this record
     *
     * @return Model
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likable');
    }

    /**
     * Counter is a record that stores the total likes for the morphed record
     *
     * @return Model
     */
    public function likeCounter()
    {
        return $this->morphOne('App\Models\LikeCounter', 'likable');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Fetch only records that currently logged in user has liked/followed
     *
     * @param  Builder $query
     * @param  integer $userId
     * @return Builder
     */
    public function scopeWhereLiked($query, $userId = null)
    {
        if (is_null($userId)) {
            $userId = $this->loggedInUserId();
        }

        return $query->whereHas('likes', function ($q) use ($userId) {
            $q->where('user_id', '=', $userId);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Populate the $model->likes attribute
     *
     * @return void
     */
    public function getLikeCountAttribute()
    {
        return $this->likeCounter ? $this->likeCounter->count : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Add a like for this record by the given user.
     *
     * @param  integer $userId
     * @return void
     */
    public function like($userId = null)
    {
        if (is_null($userId)) {
            $userId = $this->loggedInUserId();
        }

        if ($userId) {
            $like = $this->likes()->where('user_id', '=', $userId)->first();

            if ($like) {
                return;
            }

            $like = new Like();
            $like->user_id = $userId;

            $this->likes()->save($like);
        }

        $this->incrementLikeCount();
    }
    /**
     * Remove a like from this record for the given user.
     *
     * @param  integer $userId
     * @return void
     */
    public function unlike($userId = null)
    {
        if (is_null($userId)) {
            $userId = $this->loggedInUserId();
        }

        if ($userId) {
            $like = $this->likes()->where('user_id', '=', $userId)->first();

            if (! $like) {
                return;
            }

            $like->delete();
        }

        $this->decrementLikeCount();
    }

    /**
     * Private. Increment the total like count stored in the counter
     *
     * @return void
     */
    private function incrementLikeCount()
    {
        $counter = $this->likeCounter()->first();

        if ($counter) {
            $counter->count++;
            $counter->save();
        } else {
            $counter = new LikeCounter;
            $counter->count = 1;
            $this->likeCounter()->save($counter);
        }
    }

    /**
     * Private. Decrement the total like count stored in the counter
     *
     * @return void
     */
    private function decrementLikeCount()
    {
        $counter = $this->likeCounter()->first();

        if ($counter) {
            $counter->count--;
            if ($counter->count) {
                $counter->save();
            } else {
                $counter->delete();
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Has the currently logged in user already "liked" the current object
     *
     * @param string $userId
     * @return boolean
     */
    public function liked($userId = null)
    {
        if (is_null($userId)) {
            $userId = $this->loggedInUserId();
        }

        return (bool) $this->likes()->where('user_id', '=', $userId)->count();
    }

    /**
     * Fetch the primary ID of the currently logged in user
     *
     * @return integer
     */
    public function loggedInUserId()
    {
        if (\App::environment()=='testing') {
            return 1;
        }

        return Auth::getUser()->id;
    }
}
