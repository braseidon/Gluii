<?php namespace App\Gluii\Comment\Traits;

use App\Models\Comment;

trait CommentLikeableTrait
{

    /**
     * Relationship to User by Likes
     *
     * @return Collection
     */
    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'comment_likes', 'comment_id', 'user_id')
            ->withPivot('comment_id', 'user_id');
    }

    /**
     * Determine if current user follows another user.
     *
     * @param User $otherUser
     * @return bool
     */
    public function isLikedBy(\App\Models\User $user)
    {
        $userCommentList = $this->likes->lists('id');

        return in_array($user->id, $userCommentList);
    }
}
