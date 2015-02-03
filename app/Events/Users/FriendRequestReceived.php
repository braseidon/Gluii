<?php namespace App\Events\Users;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class FriendRequestReceived extends Event {

	use SerializesModels;

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
	 * Create a new event instance.
	 *
	 * @param integer $fromId
	 * @param integer $toId
	 * @return void
	 */
	public function __construct($fromId, $toId)
	{
		$this->fromId	= $fromId;
		$this->toId		= $toId;
	}

}
