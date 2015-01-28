<?php namespace App\Events\Users;

use App\Events\Event;
use Illuminate\Queue\SerializeModels;

class UserRegistered extends Event {

	use SerializeModels;

	/**
	 * @var integer $userId
	 */
	public $userId;

	/**
	 * Construct the Event
	 *
	 * @param integer $userId
	 */
	public function __construct($userId)
	{
		$this->userId = $userId;
	}
}