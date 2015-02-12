<?php namespace App\Commands\Auth;

use Sentinel;

use App\Commands\Command;
use App\Events\Auth\UserRegistered;
use Event;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterUserCommand extends Command implements SelfHandling {

	/**
	 * The user input
	 *
	 * @var array $input
	 */
	public $input;

	/**
	 * Create a new command instance.
	 *
	 * @param array $input
	 */
	public function __construct($input)
	{
		$this->input = $input;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$attributes = [
			'email'			=> $this->input['email'],
			'password'		=> $this->input['password'],
			'first_name'	=> $this->input['first_name'],
			'last_name'		=> $this->input['last_name'],
			'birthday'		=> "{$this->input['birthday_year']}-{$this->input['birthday_month']}-{$this->input['birthday_day']}",
			'gender'		=> $this->input['gender'],
		];

		$user = Sentinel::register($attributes);

		if($user)
		{
			// Fire the event that sends activation email, sets up new account, etc
			Event::fire(new UserRegistered($user));

			return true;
		}

		return false;
	}
}