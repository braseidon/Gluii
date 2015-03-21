<?php namespace App\Http\Controllers\User;

use App\User;
use Auth;
use Notification;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{

    /**
     * View friend requests in the drop-down
     *
     * @param  \App\Repositories\UserRepositoryInterface $repository
     * @return Response
     */
    public function getFriendRequests(\App\Repositories\UserRepositoryInterface $repository)
    {
        $pendingFriends = Auth::getUser()->getRequestsPending();

        $output = '';

        foreach ($pendingFriends as $pendingFriend) {
            $output .= view('template.header.dropdowns.friendrequest', ['pendingFriend' => $pendingFriend])->render();
        }

        return $this->returnAjax(true, $output, null);
    }

    /**
     * View Notifications in the drop-down
     *
     * @param  \App\Repositories\UserRepositoryInterface $repository
     * @return Response
     */
    public function getNotifications(\App\Repositories\NotificationRepositoryInterface $repository)
    {
        $notifications = Auth::getUser()->getNotifications();

        $output = '';

        foreach ($notifications as $notification) {
            $output .= view('template.header.dropdowns.notification', ['notification' => $notification])->render();
        }

        return $this->returnAjax(true, $output, null);
    }

    /**
     * View Messages in the drop-down
     *
     * @param  \App\Repositories\UserRepositoryInterface $repository
     * @return Response
     */
    public function getMessages(\App\Repositories\MessageRepositoryInterface $repository)
    {
        //

        return $this->returnAjax(true, $output, null);
    }
}
