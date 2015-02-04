<?php namespace App\Repositories;

interface UserRepositoryInterface {

	/**
	 * Retrieve all users from the database
	 *
	 * @return Collection
	 */
	public function getAllUsers();

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  integer  $identifier
	 * @return Model|null
	 */
	public function getUserById($id);

	/**
	 * Create or update a user based on its unique identifier
	 *
	 * @param  integer|null $id
	 * @return Model
	 */
	public function createOrUpdate($id = null);
}