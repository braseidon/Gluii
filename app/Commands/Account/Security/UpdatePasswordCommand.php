<?php namespace App\Commands\Account\Security;

use App\Events\Account\Security\UserUpdatedPassword;
use App\User;
use Auth;
use Cartalyst\Sentinel\Addons\UniquePasswords\Exceptions\NotUniquePasswordException;
use Event;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdatePasswordCommand extends Command implements SelfHandling
{
    /**
     * The User being updated
     *
     * @var int
     */
    protected $userId;

    /**
     * The settings being updated
     *
     * @var array
     */
    protected $input;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($userId, array $input)
    {
        $this->userId   = $userId;
        $this->input    = $input;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if (! $user = User::find($this->userId)) {
            return false;
        }

        Auth::getUserRepository()->update($user, $this->input);

        // Fire Event
        Event::fire(new UserUpdatedPassword($this->userId));
    }
}
