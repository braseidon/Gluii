<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\SendFriendRequestCommand;

use App\User;
use App\Repositories\UserRepository;
use Auth;
use Event;
use Illuminate\Queue\InteractsWithQueue;

class SendFriendRequestCommandHandler {

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

		// Make sure there is no friendship already
		$friendship = $user->getFriendship($command->toId, $user);

		if($friendship !== false)
			return false;

		// Perform the action
		$this->userRepository->addFriend($command->toId, $user);

		Event::fire(new \App\Events\Users\FriendRequestReceived(
			$user->id,	// fromId
			$command->toId	// toId
		));

		return true;
	}

}