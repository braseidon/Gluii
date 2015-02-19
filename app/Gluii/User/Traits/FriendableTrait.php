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
			// ->wherePivot('accepted', 0) // to filter only accepted
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
			// ->wherePivot('accepted', 0) // to filter only pending
			->withTimestamps();
	}

	public function friendcount()
	{
		return $this->belongsToMany(static::class, 'users_friends', 'user_id', 'friend_id')
			->withPivot('accepted', 'user_id', 'friend_id')
			->wherePivot('accepted', '=', 1)
			->select( [\DB::raw("count(`users_friends`.`id`) as friend_count"), "user_id"] )
						->groupBy("user_id");
	}

	/**
	 * Set & load a custom 'friends' relationship
	 *
	 * @return void
	 */
	public function loadFriends()
	{
		if(! array_key_exists('friends', $this->relations))
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
		// Check cache
		if(isset($this->cacheFriendships[$friendId]))
			return $this->cacheFriendships[$friendId];

		$this->cacheFriendships[$friendId] = $this->getFriendship($friendId);

		return $this->cacheFriendships[$friendId];
	}

	/**
	 * Returns the two Users' friendship
	 *
	 * @param  integer $friendId
	 * @return mixed
	 */
	public function getFriendship($friendId)
	{
		// Get merged friendship
		$friendship = $this->queryFriendship($friendId);

		if(! $friendship or $friendship->isEmpty())
			return false;

		if(! $friendship = $friendship->first()->pivot)
			return false;

		// If friendship is approved
		if($friendship->accepted !== 0)
			return true;

		// If $this sent Request
		if($this->id == $friendship->friend_id)
			return 'sent';

		// If $this receiving Request
		if($this->id == $friendship->user_id)
			return 'pending';

		return 'error';
	}

	/**
	 * Query that finds the relationship between two Users
	 *
	 * @param  integer $friendId
	 * @return Collection|null
	 */
	public function queryFriendship($friendId)
	{
		$friendsto = $this->friendsto()
			->wherePivot('friend_id', '=', $friendId)
			->get();

		$friendsfrom = $this->friendsfrom()
			->wherePivot('user_id', '=', $friendId)
			->get();

		return $friendsto->merge($friendsfrom);
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
	public function getAllFriends($accepted = true)
	{
		return static::with('friends')
			->wherePivot('accepted', $accepted);
	}
}