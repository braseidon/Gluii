<?php namespace App\Repositories;

interface NotificationRepositoryInterface
{

    /**
     * Push a Notification to a User
     *
     * @param  integer $userId
     * @param  string  $type
     * @param  integer $friendId
     * @return bool
     */
    public function push($userId, $type, $friendId = null);
}
