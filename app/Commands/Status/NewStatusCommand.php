<?php namespace App\Commands\Status;

use App\Commands\Command;

class NewStatusCommand extends Command {

	/**
	 * The user_id of the User posting the status
	 *
	 * @var integer $userId
	 */
	public $userId;

	/**
	 * The status to be posted
	 *
	 * @var string $status
	 */
	public $status;

	/**
	 * Instantiate the Object
	 *
	 * @param integer $userId
	 * @param string $status
	 */
	public function __construct($userId, $status)
	{
		$this->userId = $userId;
		$this->status = $status;
	}
}