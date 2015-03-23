<?php namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Retrieve all models from the database
     *
     * @return Collection
     */
    public function all();

    /**
     * Retrieve a model by their unique identifier
     *
     * @param  integer    $identifier
     * @return model|null
     */
    public function findById($id);

    /**
     * Delete a model by its id
     *
     * @param  integer $id
     * @return bool
     */
    public function deleteById($id);
}
