<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\AcceptFriendRequestCommand;

use App\User;
use Auth;
use Event;
use Illuminate\Queue\InteractsWithQueue;

class AcceptFriendRequestCommandHandler {

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
	 * @param  AcceptFriendRequestCommand  $command
	 * @return void
	 */
	public function handle(AcceptFriendRequestCommand $command)
	{
		// No friend requests to self!
		if($command->fromId == $command->toId)
			return false;

		if(! $user = User::find($command->toId))
			return false;

		if(! $friendship = $user->isFriendsWith($command->fromId))
			return false;

		$user->acceptRequest($command->fromId);

		Event::fire(new \App\Events\Users\FriendRequestAccepted(
			$command->fromId,	// fromId
			$command->toId		// toId
		));

		return true;
	}

}