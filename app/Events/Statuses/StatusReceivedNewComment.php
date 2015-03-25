<?php namespace App\Events\Statuses;

use App\Models\Status;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class StatusReceivedNewComment extends Event
{

    use SerializesModels;

    /**
     * The User posting the Comment
     *
     * @var integer $fromId
     */
    public $fromId;

    /**
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
     * @param integer $statusId
     */
    public function __construct($fromId, $toId, Status $status)
    {
        $this->fromId    = $fromId;
        $this->toId        = $toId;
        $this->status    = $status;
    }
}
