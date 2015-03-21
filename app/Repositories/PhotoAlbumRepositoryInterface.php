<?php namespace App\Repositories;

interface PhotoAlbumRepositoryInterface
{

    /**
     * Retrieve a PhotoAlbum by their unique identifier.
     *
     * @param  integer  $identifier
     * @return PhotoAlbum|null
     */
    public function findPhotoAlbumById($id);
}
