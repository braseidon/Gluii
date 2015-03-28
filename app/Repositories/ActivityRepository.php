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
    public function getFeedByUserId($userId, $subjectTypes = ['status', 'photo'], $perPage = 20)
    {
        $activities = Activity::with(['user', 'subject'])
            ->where('user_id', $userId);

        if ($subjectTypes !== []) {
            $activities = $activities->whereIn('name', $subjectTypes);
        }

        return $activities->latest()->paginate($perPage);
    }

    /**
     * Returns multiple Users' Activity feeds
     *
     * @param  array      $userIds
     * @param  array      $subjectTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getFeedByUserIds(array $userIds, $subjectTypes = ['status', 'photo'], $perPage = 20)
    {
        $activities = Activity::with(['user', 'subject'])
            ->whereIn('user_id', $userIds);

        if ($subjectTypes !== []) {
            $activities = $activities->latest()->whereIn('name', $subjectTypes);
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

    /*
    |--------------------------------------------------------------------------
    | Likes
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Like a Activity
     *
     * @param  Model   $activity
     * @param  integer $userId
     * @return void
     */
    public function likeActivity($activityType, $activityId, $userId)
    {
        $activity = $this->getActivityModel($activityType, $activityId);

        return $activity->like($userId);
    }

    /**
     * Unfollow a Activity
     *
     * @param $userIdToUnfollow
     * @param User $user
     * @return mixed
     */
    public function unlikeActivity($activityType, $activityId, $userId)
    {
        $activity = $this->getActivityModel($activityType, $activityId);

        return $activity->unlike($userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    |
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Check if a given Activity is an existing Model
     *
     * @param  string  $activityType
     * @param  integer $activityId
     * @return Model
     */
    public function getActivityModel($activityType, $activityId)
    {
        $model = 'App\\Models\\' . ucwords($activityType);

        if (! class_exists($model) or ! in_array('App\Gluii\Support\Traits\PublishesActivity', class_uses($model, false))) {
            \App::abort(404);
        }

        return (new $model())->findOrFail($activityId);
    }
}
