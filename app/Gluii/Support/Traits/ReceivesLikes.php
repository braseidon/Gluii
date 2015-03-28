<?php namespace App\Gluii\Support\Traits;

trait ReceivesLikes
{

    /**
     * Relationship to User by Likes
     *
     * @return Collection
     */
    public function likes()
    {
        return $this->belongsToMany('App\Models\User')
            ->withPivot();
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
        $idList = $this->likes->lists('id');

        return in_array($user->id, $idList);
    }
}
