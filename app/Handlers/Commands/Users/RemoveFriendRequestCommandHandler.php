<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\RemoveFriendRequestCommand;

use App\User;
use App\Repositories\UserRepository;
use Auth;
use Event;
use Illuminate\Queue\InteractsWithQueue;

class RemoveFriendRequestCommandHandler {

	/**
	 * User Repository
	 *
	 * @var UserRepository $userRepository
	 */
	protected $userRepository;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @param  RemoveFriendRequestCommand  $command
	 * @return void
	 */
	public function handle(RemoveFriendRequestCommand $command)
	{
		// No friend requests to self!
		if($command->fromId == $command->toId)
			return false;

		if(! $user = User::find($command->fromId))
			return false;

		// Perform the action
		$this->userRepository->removeFriend($command->toId, $user);

		Event::fire(new \App\Events\Users\FriendRequestRemoved(
			$user->id,			// fromId
			$command->toId		// toId
		));

		return true;
	}

}