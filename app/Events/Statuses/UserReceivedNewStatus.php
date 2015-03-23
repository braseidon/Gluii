<?php namespace App\Events\Statuses;

use App\Status;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserReceivedNewStatus extends Event
{

    use SerializesModels;

    /**
     * The User writing the Status
     *
     * @var integer $fromId
     */
    public $fromId;

    /**
     * The User receiving the Status
     *
     * @var integer $toId
     */
    public $toId;

    /**
     * @var Status $status
     */
    public $status;

    /**
     * Create a new event instance.
     *
     * @param integer $fromId
     * @param integer $toId
     * @param Status  $status
     */
    public function __construct($fromId, $toId, Status $status)
    {
        $this->fromId    = $fromId;
        $this->toId        = $toId;
        $this->status    = $status;
    }
}
