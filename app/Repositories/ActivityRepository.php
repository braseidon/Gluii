<?php namespace App\Repositories;

use App\Activity;

class ActivityRepository extends AbstractRepository implements ActivityRepositoryInterface
{

    /**
     * Retrieve all Activities from the database
     *
     * @return Collection
     */
    public function all()
    {
        return Activity::latest();
    }

    /**
     * Retrieve a Activity by their unique identifier
     *
     * @param  integer    $identifier
     * @return Activity|null
     */
    public function findById($id)
    {
        return Activity::find($id);
    }

    /**
     * Delete a Activity by its id
     *
     * @param  integer $id
     * @return bool
     */
    public function deleteById($id)
    {
        if (! $activity = Activity::find($id)) {
            return $activity->delete();
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | User Activity Feed
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Returns a User's activity feed, based on an array of User ID's
     *
     * @param  array   $userIds
     * @param  integer $limit
     * @return Collection
     */
    public function getFeedByUserIds(array $userIds, $limit = 20)
    {
        return Activity::with([
                'status',
                'photo',
                'photoalbum',
            ])
            ->whereIn('user_id', $userIds)
            ->limit($limit)
            ->get();
    }
}
