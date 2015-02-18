<?php namespace App\Handlers\Events\Statuses;

use App\Events\Statuses\NewStatusPosted;
use App\Events\Statuses\StatusReceivedNewComment;
use App\Repositories\StatusRepositoryInterface;

class StatusSubscriber {

	/**
	 * @var StatusRepository $repository
	 */
	protected $repository;

	/**
	 * Instantiate the Object
	 *
	 * @param StatusRepositoryInterface $repository
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
	 * @param  StatusReceivedNewComment $event
	 * @return void
	 */
	public function whenStatusReceivedNewComment(StatusReceivedNewComment $event)
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
		$events->listen(\App\Events\Statuses\StatusReceivedNewComment::class,
			'App\Handlers\Events\Statuses\StatusSubscriber@whenStatusReceivedNewComment');
	}

}
