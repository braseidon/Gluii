<?php namespace App\Repositories;

use App\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

	/*
	|--------------------------------------------------------------------------
	| Queries
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Retrieve all users from the database
	 *
	 * @return Collection
	 */
	public function getAllUsers()
	{
		return User::all();
	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  integer  $identifier
	 * @return Model|null
	 */
	public function getUserById($id)
	{
		return User::find($id);
	}

	/**
	 * Create or update a user based on its unique identifier
	 *
	 * @param  integer|null $id
	 * @return Model
	 */
	public function createOrUpdate($id = null)
	{
		return User::updateOrCreate(
			[
				'id' => $id
			],
			[
				'id' => $id
			]
		);
	}

	/**
	 * Get User's profile for viewing
	 *
	 * @param  integer $userId
	 * @return User
	 */
	public function loadUserProfile($userId)
	{
		$user = User::whereId($userId);

		return $user->with([
				'friends',
				'statuses' => function($q)
				{
					$q->orderBy('created_at', 'DESC')
						->addSelect('profile_user_id', 'author_id', 'body', 'created_at')
						->limit(10);
				},
				'statuses.profileuser',
				'statuses.author',
				'statuses.comments',
				'statuses.comments.author',
			])
			->first();
	}

	/*
	|--------------------------------------------------------------------------
	| Get Friend Requests
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Get a User's pending received friend requets
	 *
	 * @return Collection
	 */
	public function requestsPending()
	{
		return User::friendsfrom()
			->where('users_friends.accepted', '=', 0)
			// ->select('users.id', 'users_friends.id', 'users_friends.user_id', 'users_friends.friend_id', 'users_friends.accepted')
			->get();
	}

	/**
	 * Get a User's pending sent friend requets
	 *
	 * @return Collection
	 */
	public function requestsSent()
	{
		return User::friends()
			->where('users_friends.accepted', '=', 0)
			->get();
	}

	/*
	|--------------------------------------------------------------------------
	| Friend Request Actions
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
	public function addFriend($userId, User $user)
	{
		return $user->friendsto()->attach($userId, ['accepted' => false]);
	}

	/**
	 * Cancel a friend request
	 *
	 * @param  integer $userId
	 * @return void
	 */
	public function removeFriend($userId, User $user)
	{
		$user->friendsto()->detach($userId);
		$friend = User::find($userId);
		$friend->friends()->detach($userId);
	}

	/**
	 * Accepts a friend request
	 *
	 * @param  integer $userId
	 * @return Builder
	 */
	public function acceptRequest($userId, User $user)
	{
		$user->friendsfrom()->updateExistingPivot($userId, ['accepted' => true]);
		$friend = User::find($userId);
		$friend->friends()->attach($user->id, ['accepted' => true]);
	}

	/**
	 * Deny a friend request
	 *
	 * @param  integer $userId
	 * @return void
	 */
	public function denyRequest($userId, User $user)
	{
		$friend = User::find($userId);
		$friend->friendsto()->detach($user->id);
	}


}