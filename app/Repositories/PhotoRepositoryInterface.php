<?php namespace App\Repositories;

interface PhotoRepositoryInterface {

	/**
	 * Retrieve a Photo by their unique identifier.
	 *
	 * @param  integer  $identifier
	 * @return Photo|null
	 */
	public function findPhotoById($id);
}