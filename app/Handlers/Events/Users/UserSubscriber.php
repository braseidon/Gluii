<?php namespace App\Handlers\Events\Users;

use App\Events\Status\NewStatusPosted;

class UserSubscriber {

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  Illuminate\Events\Dispatcher  $events
	 * @return array
	 */
	public function subscribe($events)
	{
		$events->listen(\App\Events\Users\UserRegistered::class,
			\App\Handlers\Events\SendWelcomeEmail::class);

		$events->listen(\App\Events\Users\FriendRequestReceived::class,
			\App\Handlers\Events\Users\FriendRequestWasReceived::class);

		$events->listen(\App\Events\Users\FriendRequestAccepted::class,
			\App\Handlers\Events\Users\FriendRequestWasAccepted::class);

		$events->listen(\App\Events\Users\FriendRequestCanceled::class,
			\App\Handlers\Events\Users\FriendRequestWasCanceled::class);
	}

}
