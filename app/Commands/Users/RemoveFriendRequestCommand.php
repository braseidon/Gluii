<?php namespace App\Commands\Users;

use App\Commands\Command;

class RemoveFriendRequestCommand extends Command {

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

}