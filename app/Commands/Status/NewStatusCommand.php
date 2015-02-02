<?php namespace App\Commands\Status;

use App\Commands\Command;

class NewStatusCommand extends Command {

	/**
	 * The user_id of the User whos profile the status is going on
	 *
	 * @var integer $profileUserId
	 */
	public $profileUserId;

	/**
	 * The user_id of the User posting the status
	 *
	 * @var integer $authorId
	 */
	public $authorId;


	/**
	 * The status to be posted
	 *
	 * @var string $status
	 */
	public $status;

	/**
	 * Instantiate the Object
	 *
	 * @param integer $profileUserId
	 * @param integer $authorId
	 * @param string $status
	 */
	public function __construct($profileUserId, $authorId, $status)
	{
		$this->profileUserId	= $profileUserId;
		$this->authorId			= $authorId;
		$this->status			= $status;
	}
}