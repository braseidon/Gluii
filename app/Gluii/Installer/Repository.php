<?php namespace App\Gluii\Installer;
/**
 * Part of the Sentinel Kickstart application.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Sentinel Kickstart
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

class Repository {

	/**
	 * The user configuration data.
	 *
	 * @var array
	 */
	protected $userData = [
		'email'            => null,
		'password'         => null,
		'password_confirm' => null,
	];

	/**
	 * The user validation rules.
	 *
	 * @var array
	 */
	protected $userRules = [
		'email'            => 'required|email',
		'password'         => 'required|min:6',
		'password_confirm' => 'required|same:password',
	];

	/**
	 * The selected database driver.
	 *
	 * @var string
	 */
	protected $databaseDriver;

	/**
	 * The database configuration data.
	 *
	 * @var array
	 */
	protected $databaseData = [

		'sqlite' => [
			'database' => null,
			'prefix'   => null,
		],

		'mysql' => [
			'host'      => 'localhost',
			'database'  => null,
			'username'  => null,
			'password'  => null,
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => null,
		],

		'pgsql' => [
			'host'     => 'localhost',
			'database' => null,
			'username' => null,
			'password' => null,
			'charset'  => 'utf8',
			'prefix'   => null,
			'schema'   => 'public',
		],

		'sqlsrv' => [
			'host'     => 'localhost',
			'database' => null,
			'username' => null,
			'password' => null,
			'prefix'   => null,
		],

	];

	/**
	 * The database validation rules.
	 *
	 * @var array
	 */
	protected $databaseRules = [

		'sqlite' => [
			'database' => 'required',
		],

		'mysql' => [
			'host'      => 'required',
			'database'  => 'required',
			'username'  => 'required',
			'charset'   => 'required',
			'collation' => 'required',
		],

		'pgsql' => [
			'host'     => 'required',
			'database' => 'required',
			'username' => 'required',
		],

		'sqlsrv' => [
			'host'     => 'required',
			'database' => 'required',
			'username' => 'required',
		],

	];

	/**
	 * Returns the user configuration data.
	 *
	 * @return array
	 */
	public function getUserData()
	{
		return $this->userData;
	}

	/**
	 * Sets the user configuration data.
	 *
	 * @param  array  $data
	 * @return $this
	 */
	public function setUserData(array $data = [])
	{
		$this->userData = array_merge($this->userData, $data);

		return $this;
	}

	/**
	 * Returns the user rules.
	 *
	 * @return array
	 */
	public function getUserRules()
	{
		return $this->userRules;
	}

	/**
	 * Returns the database driver.
	 *
	 * @return string
	 */
	public function getDatabaseDriver()
	{
		return $this->databaseDriver;
	}

	/**
	 * Sets the selected database driver.
	 *
	 * @param  string  $driver
	 * @return void
	 * @throws \RuntimeException
	 */
	public function setDatabaseDriver($driver)
	{
		if ( ! isset($this->databaseData[$driver]))
		{
			throw new \RuntimeException("Database configuration does not exist for driver [{$driver}].");
		}

		$this->databaseDriver = $driver;
	}

	/**
	 * Returns the database configuration data.
	 *
	 * @param  string  $driver
	 * @return array
	 */
	public function getDatabaseData($driver = null)
	{
		if ( ! $driver) return $this->databaseData;

		return array_get($this->databaseData, $driver, []);
	}

	/**
	 * Sets the database configuration data.
	 *
	 * @param  string  $driver
	 * @param  array  $data
	 * @return $this
	 */
	public function setDatabaseData($driver, array $data = [])
	{
		$this->setDatabaseDriver($driver);

		$this->databaseData[$driver] = array_merge(
			$this->databaseData[$driver], $data
		);

		return $this;
	}

	/**
	 * Returns the given database driver rules.
	 *
	 * @param  string  $driver
	 * @return array
	 */
	public function getDatabaseRules($driver = null)
	{
		if ( ! $driver) return $this->databaseRules;

		return array_get($this->databaseRules, $driver, []);
	}

}
