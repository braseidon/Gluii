<?php namespace App\Providers;

use App\Models\Status;
use Event;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'event.name' => [
            'EventListener',
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

        $events->subscribe(\App\Handlers\Events\Auth\UserJustRegistered::class);
        $events->subscribe(\App\Handlers\Events\Users\UserSubscriber::class);
        $events->subscribe(\App\Handlers\Events\Statuses\StatusSubscriber::class);
        $events->subscribe(\App\Handlers\Events\NotificationSubscriber::class);
    }
}
