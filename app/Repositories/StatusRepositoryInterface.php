<?php namespace App\Repositories;

interface StatusRepositoryInterface
{

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
     * @return Status|null
     */
    public function findStatusById($id);

    /**
     * Delete a Status including its StatusLikes, Comments, and CommentLikes by ID
     *
     * @param  integer $id
     * @return bool
     */
    public function deleteStatusById($id);
}
