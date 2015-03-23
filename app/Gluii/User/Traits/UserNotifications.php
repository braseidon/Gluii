<?php namespace App\Gluii\User\Traits;

use App\User;
use App\Notification;

trait UserNotifications
{

    /**
     * Cache for All Notifications
     *
     * @var Collection
     */
    protected $cacheNotifications = [];

    /**
     * Cache for Requests Sent
     *
     * @var Collection
     */
    protected $requestsSent = null;

    /*
    |--------------------------------------------------------------------------
    | Get Friend Requests
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Get a User's pending received friend requets
     *
     * @return Collection
     */
    public function getRequestsPending()
    {
        if (isset($this->cacheNotifications['requestsPending'])) {
            return $this->cacheNotifications['requestsPending'];
        }

        $this->cacheNotifications['requestsPending'] = $this->friendsfrom()
            ->wherePivot('accepted', '=', 0)
            ->get(['users.id', 'first_name', 'last_name', 'email']);



        return $this->cacheNotifications['requestsPending'];
    }

    /**
     * Get a User's pending sent friend requets
     *
     * @return Collection
     */
    public function getRequestsSent()
    {
        if ($this->requestsSent !== null) {
            return $this->requestsSent;
        }

        $this->requestsSent = $this->friendsto()
            ->wherePivot('accepted', '=', 0)
            ->get(['users.id', 'first_name', 'last_name', 'email']);

        return $this->requestsSent;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Notifications
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Get a User's pending received friend requets
     *
     * @return Collection
     */
    public function getNotifications()
    {
        if (isset($this->cacheNotifications['notifications'])) {
            return $this->cacheNotifications['notifications'];
        }

        $notifications = Notification::with([
                'friend' => function ($q) {
                    $q->selectForFeed();
                }
            ])
            ->where('user_id', '=', $this->id)
            ->orderBy('id', 'DESC')
            ->limit(10);

        $this->cacheNotifications['notifications'] = $notifications->get();

        $notifications->update(['is_read' => true]);

        return $this->cacheNotifications['notifications'];
    }
}
