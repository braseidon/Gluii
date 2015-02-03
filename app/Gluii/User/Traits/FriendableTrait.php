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
	public function allfriends()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			->withPivot('accepted')
			->withTimestamps();
	}

	/**
	 * Relationship with Friends (one way)
	 *
	 * @return Collection
	 */
	public function friendsto()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			// ->wherePivot('accepted', '=', 1) // to filter only accepted
			->withPivot('accepted')
			->withTimestamps();
	}

	/**
	 * Relationship with Friends (one way) reversed
	 *
	 * @return Collection
	 */
	public function friendsfrom()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'friend_id', 'user_id')
			// ->wherePivot('accepted', '=', 1) // to filter only accepted
			->withPivot('accepted')
			->withTimestamps();
	}

	// **

	// accessor allowing you call $user->friends
	public function getFriendsAttribute()
	{
		if (! array_key_exists('friends', $this->relations)) $this->loadFriends();

		return $this->getRelation('friends');
	}

	/**
	 * Set & load a custom 'friends' relationship
	 *
	 * @return void
	 */
	protected function loadFriends()
	{
		if (! array_key_exists('friends', $this->relations))
		{
			$friends = $this->mergeFriends();

			$this->setRelation('friends', $friends);
		}
	}

	/**
	 * Merge the two belongsToMany queries
	 *
	 * @return Builder
	 */
	protected function mergeFriends()
	{
		return $this->friendsto->merge($this->friendsfrom);
	}

	/*
	|--------------------------------------------------------------------------
	| Friend Requests
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Send a friend request
	 *
	 * @param integer $userId
	 * @return void
	 */
	public function addFriend($userId)
	{
		$this->friendsto()->attach($userId);

		// return static::find($userId)->friends()->attach($this->id);
	}

	/**
	 * Cancel a friend request
	 *
	 * @param  integer $userId
	 * @return void
	 */
	public function removeFriend($userId)
	{
		$this->friendsto()
			->detach($userId);

		$this->friendsfrom()
			->detach($userId);
	}

	/**
	 * Accepts a friend request
	 *
	 * @param  integer $userId
	 * @return Builder
	 */
	public function acceptRequest($userId)
	{
		return $this->friendsfrom()->updateExistingPivot($userId, ['accepted' => true]);

		// static::find($userId)->friends()->updateExistingPivot($this->id, ['accepted' => true]);
	}

	/**
	 * Deny a friend request
	 *
	 * @param  integer $userId
	 * @return void
	 */
	public function denyRequest($userId)
	{
		return static::find($userId)->friendsto()->detach($this->id);
	}

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
	public function isFriendsWith($friendId)
	{
		// Check cache
		if(isset($this->cacheFriendships[$friendId]))
			return $this->cacheFriendships[$friendId];

		// Query the DB for the relationship
		$friendship = static::with([
				'friendsto' => function($q) use ($friendId)
				{
					$q->where('friend_id', '=', $friendId);
						// ->where('user_id', '=', $this->id);
				},
				'friendsfrom' => function($q) use ($friendId)
				{
					$q->where('user_id', '=', $friendId);
						// ->where('friend_id', '=', $this->id);
				}
			])
			->first();

		$merged = $friendship->friends->first();

		if(! $merged)
			return false;

		// Accepted friend request
		if($merged->pivot->accepted == true)
		{
			$this->cacheFriendships[$friendId] = 'accepted';

			return 'accepted';
		}

		// Sent friend request
		if($merged->pivot->user_id == $this->id)
		{
			$this->cacheFriendships[$friendId] = 'sent';

			return 'sent';
		}

		// Pending received friend request
		$this->cacheFriendships[$friendId] = 'pending';

		return 'pending';
	}

	/**
	 * Eager load friends with friend_count and such
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function scopeGetAllFriends($query)
	{
		return $query->with(['friendsto', 'friendsfrom']);
	}

	/**
	 * Eager load friends with friend_count and such
	 *
	 * @param  Builder $query
	 * @return Builder
	 */
	public function scopeLoadFriendsByStatus($query, $accepted = true)
	{
		return $query->with([
				'friendsto' => function($q) use ($accepted)
				{
					$q->where('accepted', $accepted);
				},
				'friendsfrom' => function($q) use ($accepted)
				{
					$q->where('accepted', $accepted);
				}
			]);
	}
}