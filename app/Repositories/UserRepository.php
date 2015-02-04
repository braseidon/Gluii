<?php namespace App\Repositories;

use App\User;

class UserRepository extends AbstractRepository {

	/**
	 * Instantiate the Object
	 *
	 * @param User $model
	 */
	public function __construct(User $model)
	{
		parent::__construct($model);
	}

	/*
	|--------------------------------------------------------------------------
	| Queries
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Get User's profile for viewing
	 *
	 * @param  integer $userId
	 * @return User
	 */
	public function getProfile($userId)
	{
		// if(! $user = User::find($userId)->getStatuses())
		// 	return false;

		return $user = User::whereId($userId)
			->with([
				'friends',
				'statuses' => function($q)
				{
					$q->orderBy('id', 'DESC')
						->addSelect('profile_user_id', 'author_id', 'body', 'created_at');
				},
				'statuses.profileuser',
				'statuses.author',
				'statuses.comments',
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