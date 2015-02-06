<?php namespace App\Repositories;

interface StatusRepositoryInterface {

	/**
	 * Retrieve all users from the database
	 *
	 * @return Collection
	 */
	public function allStatuses($limit = 20);

	/**
	 * Retrieve a Status by their unique identifier.
	 *
	 * @param  integer  $identifier
	 * @return Status\null
	 */
	public function findStatusById($id);

}