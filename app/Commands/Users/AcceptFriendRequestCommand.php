<?php namespace App\Commands\Users;

use App\Repositories\UserRepository;
use App\User;
use Event;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class AcceptFriendRequestCommand extends Command implements SelfHandling
{

    /**
     * The User sending the friend request
     *
     * @var integer $fromId
     */
    public $fromId;

    /**
     * The User sending the friend request
     *
     * @var integer $toId
     */
    public $toId;

    /**
     * Create a new command instance.
     *
     * @param integer $fromId
     * @param integer $toId
     */
    public function __construct($fromId, $toId)
    {
        $this->fromId    = $fromId;
        $this->toId        = $toId;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(UserRepository $userRepository)
    {
        // No friend requests to self!
        if ($this->fromId == $this->toId) {
            return false;
        }

        if (! $user = User::find($this->toId)) {
            return false;
        }

        // Check friendship
        // if(! $friendship = $user->isFriendsWith($this->fromId))
        // 	return false;

        $userRepository->acceptRequest($this->fromId, $user);

        Event::fire(new \App\Events\Users\FriendRequestAccepted(
            $this->fromId,    // fromId
            $this->toId        // toId
        ));

        return true;
    }
}
