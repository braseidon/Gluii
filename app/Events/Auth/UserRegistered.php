<?php namespace App\Events\Auth;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Event {

	use SerializesModels;

	/**
	 * @var App\User $user
	 */
	public $user;

	/**
	 * Construct the Event
	 *
	 * @param App\User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
}