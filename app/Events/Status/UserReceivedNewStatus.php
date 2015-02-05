<?php namespace App\Events\Status;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserReceivedNewStatus extends Event {

	use SerializesModels;

	/**
	 * @var integer $fromId
	 */
	public $fromId;

	/**
	 * @var integer $toId
	 */
	public $toId;

	/**
	 * Create a new event instance.
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
