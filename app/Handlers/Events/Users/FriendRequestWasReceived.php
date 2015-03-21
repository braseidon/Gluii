<?php namespace App\Handlers\Events\Users;

use App\Events\Users\FriendRequestReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class FriendRequestWasReceived
{

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(FriendRequestReceived $event)
    {
        // dd($event);
    }
}
