<?php namespace App\Repositories;

use App\Models\Activity;

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
     * Returns single User's Activity feed
     *
     * @param  integer    $userId
     * @param  array      $subjectTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getFeedByUserId($userId, $subjectTypes = [], $perPage = 20)
    {
        $activities = Activity::latest()->with(['user', 'subject'])
            ->where('user_id', $userId);

        if ($subjectTypes !== []) {
            $activities = $activities->whereIn('name', $subjectTypes);
        }

        return $activities->paginate($perPage);
    }

    /**
     * Returns multiple Users' Activity feeds
     *
     * @param  array      $userIds
     * @param  array      $subjectTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getFeedByUserIds(array $userIds, $subjectTypes = [], $perPage = 20)
    {
        $activities = Activity::latest()->with(['user', 'subject'])
            ->whereIn('user_id', $userIds);

        if ($subjectTypes !== []) {
            $activities = $activities->whereIn('name', $subjectTypes);
        }

        return $activities->paginate($perPage);
    }

    /**
     * Returns all Users' feeds
     *
     * @param  array      $subjectTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getAllUsersFeeds($subjectTypes = [], $perPage = 20)
    {
        $activities = Activity::with(['user', 'subject']);

        if ($subjectTypes !== []) {
            $activities = $activities->whereIn('name', $subjectTypes);
        }

        $activities = $activities->latest()->paginate($perPage);

        return $activities;
    }
}
