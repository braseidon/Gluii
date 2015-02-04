<?php namespace App\Repositories;

use App\User;

class AbstractRepository {

	/*
	|--------------------------------------------------------------------------
	| Repo Stuff
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Persist a Model
	 *
	 * @param Model $user
	 * @return mixed
	 */
	public function save($model)
	{
		$model->save();
	}

	public function getUserById($id)
	{
		return User::find($id);
	}

	/**
	 * Get User's profile for viewing
	 *
	 * @param  integer $userId
	 * @return User
	 */
	public function loadUserProfile(User $user)
	{
		return $user->with([
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
	| Caching
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Check a section key
	 *
	 * @param  string $section
	 * @param  string $key
	 * @return bool
	 */
	public function cacheHas($section, $key)
	{
		return isset($this->cache[$section][$key]);
	}

	/**
	 * Return a section key
	 *
	 * @param  string $section
	 * @param  string $key
	 * @return mixed
	 */
	public function cacheGet($section, $key)
	{
		return $this->cache[$section][$key];
	}

	/**
	 * Set a section key
	 *
	 * @param  string $section
	 * @param  string $key
	 * @param  mixed  $value
	 * @return mixed
	 */
	public function cacheSet($section, $key, $value)
	{
		return $this->cache[$section][$key] = $value;
	}

}