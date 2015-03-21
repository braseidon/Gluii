<?php namespace App\Commands\Status;

use App\Commands\Command;
use App\Repositories\StatusRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class LikeStatusCommand extends Command implements SelfHandling
{

    /**
     * The User liking a Status
     *
     * @var integer
     */
    public $userId;

    /**
     * The Status being liked
     *
     * @var integer
     */
    public $statusId;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($userId, $statusId)
    {
        $this->userId    = $userId;
        $this->statusId    = $statusId;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(StatusRepository $repository)
    {
        $user = \App\User::find($this->userId);

        return $repository->likeStatus($user, $this->statusId);
    }
}
