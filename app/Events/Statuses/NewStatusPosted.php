<?php namespace App\Events\Statuses;

use App\Models\Status;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class NewStatusPosted extends Event
{

    use SerializesModels;

    /**
     * @var Status $status
     */
    public $status;

    /**
     * Create a new event instance.
     *
     * @param Status $status
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }
}
