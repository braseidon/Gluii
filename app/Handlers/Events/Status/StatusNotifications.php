<?php namespace App\Handlers\Events\Status;

use App\Events\Status\UserReceivedNewStatus;

class StatusNotifications {

	/**
	 * A User received a wall Status from another User
	 *
	 * @param UserReceivedNewStatus $event
	 */
	public function userReceivedNewStatus(UserReceivedNewStatus $event)
	{
		// dd($event);
	}

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  Illuminate\Events\Dispatcher  $events
	 * @return array
	 */
	public function subscribe($events)
	{
		$events->listen(\App\Events\Status\UserReceivedNewStatus::class,
			'App\Handlers\Events\Status\StatusNotifications@userReceivedNewStatus');
	}

}
