<?php namespace App\Repositories;

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