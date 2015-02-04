<?php namespace App\Repositories;

class AbstractRepository {

	/**
	 * The Model being wrapped
	 *
	 * @var Model
	 */
	protected $model;

	/**
	 * Repository cache
	 *
	 * @var array $cache
	 */
	protected $cache = [];

	/**
	 * Instantiate the Object
	 *
	 * @param Model $model
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

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