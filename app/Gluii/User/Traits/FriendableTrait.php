<?php namespace App\Gluii\User\Traits;

use App\User;

trait FriendableTrait {

	/**
	 * Friendship cache
	 *
	 * @var array
	 */
	protected $cacheFriendships = [];

	/*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Relationship with Friends
	 *
	 * @return Collection
	 */
	public function friends()
	{
		// Fresh
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			->withPivot('accepted', 'user_id', 'friend_id')
			->wherePivot('accepted', '=', 1)
			->withTimestamps();

		// Original
		// return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
		// 	->withPivot('accepted')//, 'user_id', 'friend_id'
		// 	->withTimestamps();

		// Hack-ish
		// return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
		// 	->withPivot('accepted', 'user_id', 'friend_id')
		// 	->wherePivot('accepted', '=', 1)
		// 	->where(function($q)
		// 	{
		// 		$q->where('friend_id', '=', $this->id)
		// 			->orWhere('user_id', '=', $this->id)
		// 	})
		// 	->join('users as users2', 'users2.id', '=', 'users_friends.friend_id')  // join users table to..
		// 	->withTimestamps();
	}

	/**
	 * Pending Friend Requests (sent)
	 *
	 * @return Collection
	 */
	public function friendsto()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			->withPivot('accepted', 'user_id', 'friend_id')
			// ->wherePivot('accepted', '=', 0) // to filter only accepted
			->withTimestamps();
	}

	/**
	 * Pending Friend Requests (received)
	 *
	 * @return Collection
	 */
	public function friendsfrom()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'friend_id', 'user_id')
			->withPivot('accepted', 'user_id', 'friend_id')
			// ->wherePivot('accepted', '=', 0) // to filter only pending
			->withTimestamps();
	}

	/*
	|--------------------------------------------------------------------------
	| Friend Requests
	|--------------------------------------------------------------------------
	|
	|
	*/

	/*
	|--------------------------------------------------------------------------
	| Queries
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Determines if the current User is friends with the specified User ID
	 *
	 * @param  integer  $friendId
	 * @return boolean
	 */
	public function friendshipWith($friendId)
	{
		if(! $friendship = $this->getFriendship($friendId))
			return false;

		$friendship = $friendship->first()->pivot->toArray();

		if($friendship['accepted'])
			return true;

		if($this->id == $friendship['user_id'] && $friendship['accepted'] == false)
			return 'sent';

		if($this->id == $friendship['friend_id'] && $friendship['accepted'] == false)
			return 'pending';
	}

	/**
	 * Returns the two Users' friendship
	 *
	 * @param  integer $friendId
	 * @return mixed
	 */
	public function getFriendship($friendId)
	{
		$userOtherFriends = $this->friendsfrom()->get();
		$userFriends = $this->friends->merge($userOtherFriends);

		$friendship = $userFriends->filter(function($collection) use ($friendId)
		{
			if(! isset($collection->pivot))
				return false;

			if($collection->pivot->user_id == $friendId && $collection->pivot->friend_id == $this->id)
				return true;

			if($collection->pivot->user_id == $this->id && $collection->pivot->friend_id == $friendId)
				return true;

			return false;
		});

		if(! $friendship or $friendship->isEmpty())
			return false;

		return $friendship;
	}

	/*
	|--------------------------------------------------------------------------
	| Repository Shit
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Eager load friends with friend_count and such
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function scopeLoadFriendsByStatus($query, $accepted = true)
	{
		// return $query->??
	}

	/**
	 * Eager load friends with friend_count and such
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function getAllFriends($accepted = true)
	{
		return static::with('friends')
			->wherePivot('accepted', $accepted);
	}
}