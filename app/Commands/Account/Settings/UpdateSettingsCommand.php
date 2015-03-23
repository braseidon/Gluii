<?php namespace App\Commands\Account\Settings;

use Auth;
use App\Events\Account\Settings\UserUpdatedSettings;
use App\User;
use Event;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateSettingsCommand extends Command implements SelfHandling
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

        // Username
        $user->username = $this->input['username'];
        $user->save();

        // Fire Event
        Event::fire(new UserUpdatedSettings($this->userId));
    }
}
