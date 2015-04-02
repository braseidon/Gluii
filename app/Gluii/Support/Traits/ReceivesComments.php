<?php namespace App\Gluii\Support\Traits;

use App\Models\Comment;
use Auth;

trait ReceivesComments
{

    /**
     * Relationship to User by Comments
     *
     * @return Collection
     */
    public function comments()
    {
        return $this->morphMany('\App\Models\Comment', 'commentable');
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
    public function scopeWhereCommented($query, $userId = null)
    {
        if (is_null($userId)) {
            $userId = $this->loggedInUserId();
        }

        return $query->whereHas('likes', function ($q) use ($userId) {
            $q->where('user_id', '=', $userId);
        });
    }

    /**
     * Add a Comment to an Activity
     *
     * @param string  $body
     * @param integer $userId
     */
    public function addComment($body, $userId = null)
    {
        if (is_null($userId)) {
            $userId = Auth::getUser()->id;
        }

        $comment            = new Comment();
        $comment->body      = $body;
        $comment->user_id   = $userId;

        $this->comments()->save($comment);
    }
}
