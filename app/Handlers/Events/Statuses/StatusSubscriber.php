<?php namespace App\Handlers\Events\Statuses;

use App\Events\Statuses\NewStatusPosted;
use App\Events\Activities\UserCommentedOnActivity;
use App\Repositories\StatusRepositoryInterface;

class StatusSubscriber
{

    /**
     * @var StatusRepositoryInterface $repository
     */
    protected $repository;

    /**
     * Instantiate the Object
     *
     * @param StatusRepositoryInterface $this->repository
     */
    public function __construct(StatusRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Subscribe Users to a Status when it's posted
     *
     * @param  NewStatusPosted $event
     * @return void
     */
    public function subscribeUsersToStatus(NewStatusPosted $event)
    {
        $this->repository->subscribeNewStatus($event->status);
    }

    /**
     * Subscribe the User that commented to the Status
     *
     * @param  UserCommentedOnActivity $event
     * @return void
     */
    public function whenUserCommentedOnActivity(UserCommentedOnActivity $event)
    {
        $this->repository->subscriberFirstOrNew($event->status, $event->fromId);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(\App\Events\Statuses\NewStatusPosted::class,
            'App\Handlers\Events\Statuses\StatusSubscriber@subscribeUsersToStatus');
        $events->listen(\App\Events\Activities\UserCommentedOnActivity::class,
            'App\Handlers\Events\Statuses\StatusSubscriber@whenUserCommentedOnActivity');
    }
}
