<?php namespace App\Handlers\Events\Auth;

use App\Commands\Auth\SendActivationEmail;
use App\Events\Auth\UserRegistered;

use Illuminate\Foundation\Bus\DispatchesCommands;

class UserJustRegistered {

	use DispatchesCommands;

	/**
	 * Send activation email to new User
	 *
	 * @param  UserRegistered $event
	 * @return void
	 */
	public function sendActivationEmail(UserRegistered $event)
	{
		$this->dispatch(new SendActivationEmail($event->user));
	}

	/**
	 * Register the listeners for the new User registration
	 *
	 * @param  Illuminate\Events\Dispatcher  $events
	 * @return array
	 */
	public function subscribe($events)
	{
		// Send activation email
		$events->listen(\App\Events\Auth\UserRegistered::class,
			'App\Handlers\Events\Auth\UserJustRegistered@sendActivationEmail');
	}
}