<?php namespace App\Commands\Activities;

use App\Events\Activities\UserCommentedOnActivity;
use App\Models\User;
use App\Repositories\ActivityRepositoryInterface;
use Event;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class NewCommentCommand extends Command implements SelfHandling
{

    /**
     * The Activity type being liked
     *
     * @var Model
     */
    public $activityType;

    /**
     * The Activity being liked
     *
     * @var integer
     */
    public $activityId;

    /**
     * The body of the comment
     *
     * @var string
     */
    public $body;

    /**
     * The User liking a Activity
     *
     * @var integer
     */
    public $userId;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($activityType, $activityId, $body, $userId)
    {
        $this->activityType     = $activityType;
        $this->activityId       = $activityId;
        $this->body             = $body;
        $this->userId           = $userId;
    }

    /**
     * Execute the command.
     *
     * @param  ActivityRepositoryInterface $repository
     * @return Void
     */
    public function handle(ActivityRepositoryInterface $repository)
    {
        $user = User::find($this->userId);

        $repository->commentOnActivity($this->activityType, $this->activityId, $this->body, $this->userId);
    }
}
