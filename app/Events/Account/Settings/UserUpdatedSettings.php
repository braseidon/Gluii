<?php namespace app\Events\Account\Settings;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserUpdatedSettings extends Event
{
    use SerializesModels;

    /**
     * User ID
     *
     * @var integer
     */
    protected $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}
