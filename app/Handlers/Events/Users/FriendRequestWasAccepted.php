<?php namespace App\Handlers\Events\Users;

use App\Events\Users\FriendRequestAccepted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class FriendRequestWasAccepted {

	/**
	 * Handle the event.
	 *
	 * @param  UserRegistered  $event
	 * @return void
	 */
	public function handle(FriendRequestAccepted $event)
	{
		// dd($event);
	}

}
