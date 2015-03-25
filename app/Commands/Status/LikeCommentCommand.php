<?php namespace App\Commands\Status;

use App\Commands\Command;
use App\Repositories\StatusRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class LikeCommentCommand extends Command implements SelfHandling
{

    /**
     * The User doing the liking
     *
     * @var User
     */
    public $userId;

    /**
     * The ID of the Status.Comment being liked
     *
     * @var integer
     */
    public $commentId;

    /**
     * Create a new command instance.
     *
     * @param integer $commentId
     * @param integer $userId
     */
    public function __construct($userId, $commentId)
    {
        $this->userId        = $userId;
        $this->commentId    = $commentId;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(StatusRepository $repository)
    {
        $user = \App\Models\User::find($this->userId);

        $repository->likeComment($user, $this->commentId);
    }
}
