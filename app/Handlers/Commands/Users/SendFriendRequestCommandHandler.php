<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\SendFriendRequestCommand;

use App\User;
use Auth;
use Event;
use Illuminate\Queue\InteractsWithQueue;

class SendFriendRequestCommandHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the command.
	 *
	 * @param  SendFriendRequestCommand  $command
	 * @return void
	 */
	public function handle(SendFriendRequestCommand $command)
	{
		// No friend requests to self!
		if($command->fromId == $command->toId)
			return false;

		if(! $user = User::find($command->fromId))
			return false;

		$friendship = $user->isFriendsWith($command->toId);

		if($friendship)
			return false;

		$user->addFriend($command->toId);

		Event::fire(new \App\Events\Users\FriendRequestReceived(
			$user->id,	// fromId
			$command->toId		// toId
		));
	}

}