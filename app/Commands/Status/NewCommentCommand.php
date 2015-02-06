<?php namespace App\Commands\Status;

use App\Commands\Command;
use App\Events\Status\StatusReceivedNewComment;
use App\Repositories\StatusRepository;
use Event;

use Illuminate\Contracts\Bus\SelfHandling;

class NewCommentCommand extends Command implements SelfHandling {

	/**
	 * The Status being Commented
	 *
	 * @var integer
	 */
	public $statusId;

	/**
	 * The User writing the Comment
	 *
	 * @var integer
	 */
	public $userId;

	/**
	 * The Comment
	 *
	 * @var string
	 */
	public $body;

	/**
	 * Create a new command instance.
	 *
	 * @param integer $statusId
	 * @param integer $userId
	 * @param string  $body
	 */
	public function __construct($statusId, $userId, $body)
	{
		$this->statusId	= $statusId;
		$this->userId	= $userId;
		$this->body		= $body;
	}

	/**
	 * Execute the command.
	 *
	 * @param  StatusRepository $repository
	 * @return bool
	 */
	public function handle(StatusRepository $repository)
	{
		$repository->postNewComment($this->statusId, $this->userId, $this->body);

		$status = $repository->findStatusById($this->statusId);

		// If the status was posted on someone's wall...
		if($status->profile_user_id == $this->userId)
			return true;

		Event::fire(new StatusReceivedNewComment(
			$this->userId,
			$status->profile_user_id,
			$status->id
		));

		return true;
	}

}
