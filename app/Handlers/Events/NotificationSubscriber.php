<?php namespace App\Handlers\Events;

use App\Events\Activities\UserCommentedOnActivity;
use App\Events\Activities\UserLikedActivity;
use App\Events\Statuses\UserReceivedNewStatus;
use App\Events\Users\FriendRequestAccepted;

use App\Repositories\NotificationRepositoryInterface;

class NotificationSubscriber
{

    /**
     * @var NotificationRepositoryInterface $repository
     */
    protected $repository;

    /**
     * Instantiate the Object
     *
     * @param \App\Repositories\NotificationRepositoryInterface $repository
     */
    public function __construct(NotificationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Send a Notification when a User liked an Activity
     *
     * @param  UserLikedActivity $event
     * @return void
     */
    public function whenUserLikedActivity(UserLikedActivity $event)
    {
        if ($event->activity->user->id !== $event->user->id) {
            $this->repository->push($event->activity->user->id, $event->activity->shortName . '.like', $event->user->id, $routeParams = ['id' => $event->activity->id]);
        }
    }

    /**
     * Notify subscribed Users of a new Comment
     *
     * @param  UserCommentedOnActivity $event
     * @return void
     */
    public function whenUserCommentedOnActivity(UserCommentedOnActivity $event)
    {
        $subscribers = $event->status->subscribers->lists('id');

        // Remove the User that posted the Comment from being notified
        $subscribers = array_diff($subscribers, [$event->fromId]);

        $this->repository->pushMany('status.comment', $subscribers, $event->fromId, ['id' => $event->status->id]);
    }

    /**
     * When a User receives a Status on their wall
     *
     * @param  UserReceivedNewStatus $event
     * @return void
     */
    public function whenUserReceivedNewStatus(UserReceivedNewStatus $event)
    {
        if ($event->fromId !== $event->toId) {
            $this->repository->push($event->toId, 'status.received', $event->toId, ['id' => $event->toId]);
        }
    }

    /**
     * When a User accepts a friend request
     *
     * @param  FriendRequestAccepted $event
     * @return void
     */
    public function whenUserAcceptsFriendRequest(FriendRequestAccepted $event)
    {
        $this->repository->push($event->fromId, 'friendrequest.accepted', $event->toId, ['id' => $event->toId]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(\App\Events\Activities\UserLikedActivity::class,
            'App\Handlers\Events\NotificationSubscriber@whenUserLikedActivity');
        $events->listen(\App\Events\Activities\UserCommentedOnActivity::class,
            'App\Handlers\Events\NotificationSubscriber@whenUserCommentedOnActivity');
        $events->listen(\App\Events\Statuses\UserReceivedNewStatus::class,
            'App\Handlers\Events\NotificationSubscriber@whenUserReceivedNewStatus');
        $events->listen(\App\Events\Users\FriendRequestAccepted::class,
            'App\Handlers\Events\NotificationSubscriber@whenUserAcceptsFriendRequest');
    }
}
