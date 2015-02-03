<?php namespace App\Handlers\Events\Users;

use App\Events\Users\FriendRequestReceived;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class FriendRequestWasReceived {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserRegistered  $event
	 * @return void
	 */
	public function handle(FriendRequestReceived $event)
	{
		// dd($event);
	}

}
