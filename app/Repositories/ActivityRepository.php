<?php namespace App\Repositories;

use Auth;
use App\Models\Activity;
use Event;

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
     * @param  array      $activityTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getFeedByUserId($userId, $activityTypes = ['status', 'photo'], $perPage = 20)
    {
        $activities = Activity::with(['user', 'subject'])
            ->where('user_id', $userId);

        if ($activityTypes !== []) {
            $activities = $activities->whereIn('name', $activityTypes);
        }

        return $activities->latest()->paginate($perPage);
    }

    /**
     * Returns multiple Users' Activity feeds
     *
     * @param  array      $userIds
     * @param  array      $activityTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getFeedByUserIds(array $userIds, $activityTypes = ['status', 'photo'], $perPage = 20)
    {
        $activities = Activity::with(['user', 'subject'])
            ->whereIn('user_id', $userIds);

        if ($activityTypes !== []) {
            $activities = $activities->latest()->whereIn('name', $activityTypes);
        }

        return $activities->paginate($perPage);
    }

    /**
     * Returns all Users' feeds
     *
     * @param  array      $activityTypes
     * @param  integer    $perPage
     * @return Collection
     */
    public function getAllUsersFeeds($activityTypes = [], $perPage = 20)
    {
        $activities = Activity::with(['user', 'subject', 'subject.user', 'subject.likes']);

        if ($activityTypes !== []) {
            $activities = $activities->whereIn('name', $activityTypes);
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

        // dd($activity);

        $activity->like($userId);

        Event::fire(new \App\Events\Activities\UserLikedActivity($activity, Auth::getUser()));
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

        $activity->unlike($userId);

        Event::fire(new \App\Events\Activities\UserUnlikedActivity($activity, Auth::getUser()));
    }

    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    |
    |
    */

    public function commentOnActivity($activityType, $activityId, $body, $userId)
    {
        $activity = $this->getActivityModel($activityType, $activityId);

        // dd($activity);

        $activity->addComment($body, $userId);

        Event::fire(new \App\Events\Activities\UserCommentedOnActivity($activity, Auth::getUser()));
    }

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

        return (new $model())->with(['user', 'likes'])->findOrFail($activityId);
    }
}
