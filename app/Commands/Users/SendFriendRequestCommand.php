<?php namespace App\Commands\Users;

use App\Repositories\UserRepository;
use App\User;
use Event;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class SendFriendRequestCommand extends Command implements SelfHandling {

	/**
	 * The User sending the friend request
	 *
	 * @var integer $fromId
	 */
	public $fromId;

	/**
	 * The User sending the friend request
	 *
	 * @var integer $toId
	 */
	public $toId;

	/**
	 * Create a new command instance.
	 *
	 * @param integer $fromId
	 * @param integer $toId
	 */
	public function __construct($fromId, $toId)
	{
		$this->fromId	= $fromId;
		$this->toId		= $toId;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(UserRepository $userRepository)
	{
		// No friend requests to self!
		if($this->fromId == $this->toId)
			return false;

		if(! $user = User::find($this->fromId))
			return false;

		// Make sure there is no friendship already
		$friendship = $user->getFriendship($this->toId, $user);

		if($friendship !== false)
			return false;

		// Perform the action
		$userRepository->addFriend($this->toId, $user);

		Event::fire(new \App\Events\Users\FriendRequestReceived(
			$user->id,	// fromId
			$this->toId	// toId
		));

		return true;
	}

}