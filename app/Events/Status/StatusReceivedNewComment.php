<?php namespace App\Events\Status;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class StatusReceivedNewComment extends Event {

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
	 * @var integer $statusId
	 */
	public $statusId;

	/**
	 * Create a new event instance.
	 *
	 * @param integer $fromId
	 * @param integer $toId
	 * @param integer $statusId
	 */
	public function __construct($fromId, $toId, $statusId)
	{
		$this->fromId	= $fromId;
		$this->toId		= $toId;
		$this->statusId	= $statusId;
	}

}
