<?php namespace App\Commands\Activities;

use App\Commands\Command;
use App\Models\User;
use App\Repositories\ActivityRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class LikeActivityCommand extends Command implements SelfHandling
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
    public function __construct($activityType, $activityId, $userId)
    {
        $this->activityType = $activityType;
        $this->activityId   = $activityId;
        $this->userId       = $userId;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(ActivityRepositoryInterface $repository)
    {
        $user = User::find($this->userId);

        $repository->likeActivity($this->activityType, $this->activityId, $this->userId);
    }
}
