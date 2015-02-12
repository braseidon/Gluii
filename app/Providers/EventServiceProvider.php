<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The subscriber classes to register.
	 *
	 * @var array
	 */
	protected $subscribe = [
		\App\Handlers\Events\Status\StatusNotifications::class
	];

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],

		// Users
		\App\Events\Users\UserRegistered::class => [
			\App\Handlers\Events\SendWelcomeEmail::class,
		],
		\App\Events\Users\FriendRequestReceived::class => [
			\App\Handlers\Events\Users\FriendRequestWasReceived::class,
		],
		\App\Events\Users\FriendRequestAccepted::class => [
			\App\Handlers\Events\Users\FriendRequestWasAccepted::class,
		],
		\App\Events\Users\FriendRequestCanceled::class => [
			\App\Handlers\Events\Users\FriendRequestWasCanceled::class,
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		\Event::subscribe(\App\Handlers\Events\Auth\UserJustRegistered::class);
		\Event::subscribe(\App\Handlers\Events\Status\StatusNotifications::class);
	}

}
