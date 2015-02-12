<?php namespace App\Commands\Auth;

use Activation;
use App\User;
use Log;
use Mail;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendActivationEmail extends Command implements SelfHandling, ShouldBeQueued {

	/**
	 * The user input
	 *
	 * @var User $user
	 */
	protected $user;

	/**
	 * Create a new command instance.
	 *
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$user = $this->user;

		$activation = Activation::create($user);

		$code = $activation->code;

		$sent = Mail::send('emails.auth.activate', compact('user', 'code'), function($m) use ($user)
		{
			$m->to($user->email)->subject('Activate Your Account');
		});

		if ($sent === 0)
			Log::error('Failed to send activation email to ' . $user->email);
	}
}