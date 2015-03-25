<?php namespace App\Repositories;

use App\Models\Notification;
use App\Models\User;

class NotificationRepository extends AbstractRepository implements NotificationRepositoryInterface
{

    /**
     * Push a Notification to a User
     *
     * @param  integer $userId
     * @param  string  $type
     * @param  integer $friendId
     * @param  array   $routeParams
     * @return Notification
     */
    public function push($userId, $type, $friendId = null, $routeParams = [])
    {
        return Notification::create([
            'user_id'                    => $userId,
            'notification_type'            => $type,
            'friend_id'                    => $friendId,
            'notification_route_params'    => $routeParams,
        ]);
    }

    /**
     * Push a Notification to multiple Users
     *
     * @param  array   $userIdList
     * @param  string  $type
     * @param  integer $friendId
     * @param  array   $routeParams
     * @return void
     */
    public function pushMany($type, $userIdList = [], $friendId = null, $routeParams = [])
    {
        if (count($userIdList) < 1) {
            return false;
        }

        foreach ($userIdList as $userId) {
            $this->push($userId, $type, $friendId, $routeParams);
        }
    }
}
