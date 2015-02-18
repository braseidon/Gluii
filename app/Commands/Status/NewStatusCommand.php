<?php namespace App\Commands\Status;

use App\Commands\Command;
use App\Repositories\StatusRepository;
use Event;

use Illuminate\Contracts\Bus\SelfHandling;

class NewStatusCommand extends Command implements SelfHandling {

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

	/**
	 * Handle the command.
	 *
	 * @param  NewCommand  $command
	 * @return void
	 */
	public function handle(StatusRepository $repository)
	{
		$status = $repository->postStatus($this->profileUserId, $this->authorId, $this->status);

		// Fire the Events
		Event::fire(new \App\Events\Statuses\NewStatusPosted($status));
		Event::fire(new \App\Events\Statuses\UserReceivedNewStatus($this->authorId, $this->profileUserId, $status));

		return true;
	}

}