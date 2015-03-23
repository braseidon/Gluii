<?php namespace app\Handlers\Events;

use App\Events\Statuses\StatusReceivedNewComment;
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
     * Notify subscribed Users of a new Comment
     *
     * @param  StatusReceivedNewComment $event
     * @return void
     */
    public function whenStatusReceivedNewComment(StatusReceivedNewComment $event)
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
        $this->repository->push($event->toId, 'status.received', $event->toId, ['id' => $event->toId]);
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
        $events->listen(\App\Events\Statuses\StatusReceivedNewComment::class,
            'App\Handlers\Events\NotificationSubscriber@whenStatusReceivedNewComment');
        $events->listen(\App\Events\Statuses\UserReceivedNewStatus::class,
            'App\Handlers\Events\NotificationSubscriber@whenUserReceivedNewStatus');
        $events->listen(\App\Events\Users\FriendRequestAccepted::class,
            'App\Handlers\Events\NotificationSubscriber@whenUserAcceptsFriendRequest');
    }
}
