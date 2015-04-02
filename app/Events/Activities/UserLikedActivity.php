<?php namespace App\Events\Activities;

use App\Models\User;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserLikedActivity extends Event
{

    use SerializesModels;

    /**
     * The Activity that was liked
     *
     * @var Activity
     */
    public $activity;

    /**
     * The User that did the liking
     *
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($activity, User $user)
    {
        $this->activity    = $activity;
        $this->user        = $user;
    }
}
