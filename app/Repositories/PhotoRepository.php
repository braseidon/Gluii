<?php namespace App\Repositories;

use App\Photo;

class PhotoRepository extends AbstractRepository implements PhotoRepositoryInterface
{

    /**
     * Find a Photo by it's ID
     *
     * @param  integer $id
     * @return App\Photo
     */
    public function findPhotoById($id)
    {
        return Photo::find($id);
    }

    /**
     * Returns all of a User's Photos
     *
     * @param  integer $id
     * @return Collection
     */
    public function loadUserPhotos($id, $perPage = 30)
    {
        return Photo::where('user_id', $id)
            ->orderBy('id')
            ->paginate($perPage);
    }

    /**
     * Create a new Photo
     *
     * @param  array $attributes
     * @return Photo
     */
    public function create($attributes = [])
    {
        return Photo::create($attributes);
    }
}
