<?php namespace App\Repositories;

use App\Models\PhotoAlbum;

class PhotoAlbumRepository extends AbstractRepository implements PhotoAlbumRepositoryInterface
{

    /**
     * Find a PhotoAlbum by it's ID
     *
     * @param  integer $id
     * @return App\Models\PhotoAlbum
     */
    public function findPhotoAlbumById($id)
    {
        return PhotoAlbum::findOrFail($id);
    }

    /**
     * Returns all of a User's PhotoAlbums
     *
     * @param  integer $id
     * @return Collection
     */
    public function loadUserPhotoAlbums($id, $perPage = 30)
    {
        return PhotoAlbum::where('user_id', $id)
            ->orderBy('id')
            ->paginate($perPage);
    }

    public function create($attributes = [])
    {
        //
    }
}
