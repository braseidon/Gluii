<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\AcceptFriendRequestCommand;

use App\User;
use App\Repositories\UserRepository;
use Auth;
use Event;
use Illuminate\Queue\InteractsWithQueue;

class AcceptFriendRequestCommandHandler {

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

		// if(! $friendship = $user->isFriendsWith($command->fromId))
		// 	return false;

		$this->userRepository->acceptRequest($command->fromId, $user);

		Event::fire(new \App\Events\Users\FriendRequestAccepted(
			$command->fromId,	// fromId
			$command->toId		// toId
		));

		return true;
	}

}