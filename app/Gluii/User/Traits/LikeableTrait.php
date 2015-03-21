<?php namespace App\Gluii\User\Traits;

use App\User;

trait LikeableTrait
{

    /**
     * Relationship to Status by Likes
     *
     * @return Collection
     */
    public function likedstatuses()
    {
        return $this->belongsToMany('App\Status', 'status_likes', 'user_id', 'status_id')
            ->withPivot('user_id', 'status_id');
    }

    /**
     * Relationship to Comment by Likes
     *
     * @return Collection
     */
    public function likedcomments()
    {
        return $this->belongsToMany('App\Comment', 'comment_likes', 'user_id', 'comment_id')
            ->withPivot('user_id', 'comment_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Attaching & Detaching
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Like a Status as a User
     *
     * @param $statusId
     * @return mixed
     */
    public function likeStatus($statusId)
    {
        return $this->statusesliked()->attach($statusId);
    }
    /**
     * Unlike a Status as a User
     *
     * @param $statusId
     * @return mixed
     */
    public function unlikeStatus($statusId)
    {
        return $this->statusesliked()->detach($statusId);
    }
}
