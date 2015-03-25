<?php namespace App\Gluii\Status\Traits;

use App\Models\Status;

trait StatusLikeableTrait
{

    /**
     * Relationship to User by Likes
     *
     * @return Collection
     */
    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'status_likes', 'status_id', 'user_id')
            ->withPivot('status_id', 'user_id');
    }

    // Idk
    // public function likescount()
    // {
    // 	return $this->with(['likes' => function($q)
    // 	{
    // 		$q->select( [\DB::raw("count(*) as like_count"), "user_id"] )
    // 			->groupBy("user_id");
    // 	}]);
    // }

    /**
     * Determine if current user follows another user.
     *
     * @param User $otherUser
     * @return bool
     */
    public function isLikedBy(\App\Models\User $user)
    {
        $userStatusList = $this->likes->lists('id');

        return in_array($user->id, $userStatusList);
    }
}
