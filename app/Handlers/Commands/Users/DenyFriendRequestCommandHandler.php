<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\DenyFriendRequestCommand;

use App\User;
use Auth;
use Event;
use Illuminate\Queue\InteractsWithQueue;

class DenyFriendRequestCommandHandler {

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
	 * @param  DenyFriendRequestCommand  $command
	 * @return void
	 */
	public function handle(DenyFriendRequestCommand $command)
	{
		// No friend requests to self!
		if($command->fromId == $command->toId)
			return false;

		if(! $user = User::find($command->fromId))
			return false;

		$friendship = $user->isFriendsWith($command->toId);

		if(! $friendship)
			return false;

		$user->removeFriend($command->toId);

		// Event::fire(new \App\Events\Users\FriendRequestDenied(
		// 	$user->id,	// fromId
		// 	$command->toId		// toId
		// ));
	}

}