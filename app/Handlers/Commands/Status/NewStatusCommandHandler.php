<?php namespace App\Handlers\Commands\Status;

use App\Commands\Status\NewStatusCommand;

use App\Status;
use Illuminate\Queue\InteractsWithQueue;

class NewStatusCommandHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the command.
	 *
	 * @param  NewCommand  $command
	 * @return void
	 */
	public function handle(NewStatusCommand $command)
	{
		Status::create([
			'profile_user_id'	=> $command->profileUserId,
			'author_id'			=> $command->authorId,
			'body'				=> $command->status,
		]);

		// If the status was posted on someone's wall...
		if($command->profileUserId !== $command->authorId)
		{
			//
		}
	}

}
