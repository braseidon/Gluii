<?php namespace App\Gluii\User\Traits;

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
		// Original
		// return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
		// 	->withPivot('accepted')//, 'user_id', 'friend_id'
		// 	->withTimestamps();

		// Hack-ish
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			->join('users as users2', 'users2.id', '=', 'users_friends.friend_id')  // join users table to..
			->wherePivot('accepted', '=', 1) // to filter only accepted
			->withPivot('accepted', 'user_id', 'friend_id')
			->orWherePivot('friend_id', '=', $this->id)
			->withTimestamps();
	}

	/**
	 * Pending Friend Requests (sent)
	 *
	 * @return Collection
	 */
	public function friendsto()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			->wherePivot('accepted', '=', 0) // to filter only accepted
			->withPivot('accepted', 'user_id', 'friend_id')
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
			->wherePivot('accepted', '=', 0) // to filter only pending
			->withPivot('accepted', 'user_id', 'friend_id')
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
	 * @param  User     $user
	 * @return boolean
	 */
	public function friendshipWith($friendId, User $user)
	{
		if(! $friendship = $this->getFriendship($friendId, $user))
			return false;


		// dd($friendship);
		$friendship = $friendship->first()->toArray();

		if(! is_array($friendship))
			return false;

		if($user->id == $friendship['user_id'] && $friendship['accepted'] == false)
			return 'sent';

		if($user->id == $friendship['friend_id'] && $friendship['accepted'] == false)
			return 'pending';
	}

	/**
	 * Returns the two Users' friendship
	 *
	 * @param  integer $friendId
	 * @param  User   $user
	 * @return mixed
	 */
	public function getFriendship($friendId, User $user)
	{
		// Check cache
		// if(UserRepository::cacheHas('friendships', $user->id))
		// 	return UserRepository::cacheGet('friendships', $user->id);

		$friendship = $user->friends()
			// ->wherePivot('user_id', '=', $user->id)
			->orWherePivot('friend_id', '=', $friendId)
			->select('users.id', 'users_friends.user_id', 'users_friends.friend_id', 'users_friends.accepted')
			->get();

		$friendship = $friendship->filter(function($collection) use ($friendId, $user)
		{
			// dd($collection->pivot->user_id);
			if(! isset($collection->pivot))
				return false;

			if(($collection->pivot->user_id == $friendId && $collection->pivot->friend_id == $user->id) or ($collection->pivot->user_id == $user->id && $collection->pivot->friend_id == $friendId))
				return true;

			return false;
		});

		if(! $friendship or $friendship->isEmpty())
			return false;

		// Set the cache
		// UserRepository::cacheSet('friendships', $user->id, $friendship);

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