<?php namespace App\Commands\Account\Security;

use App\Events\Account\Security\UserUpdatedEmail;
use App\Models\User;
use Auth;
use Event;
use Session;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;

class UpdateEmailCommand extends Command implements SelfHandling
{
    use SerializesModels;

    /**
     * The User being updated
     *
     * @var int
     */
    protected $userId;

    /**
     * The confirm email code from the User's browser
     *
     * @var string
     */
    protected $code;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($userId, $code)
    {
        $this->userId   = $userId;
        $this->code     = $code;
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

        $seshCode  = Session::get('user.update-email.code.' . $user->id);
        $seshEmail = Session::get('user.update-email.email.' . $user->id);

        if ($this->code !== $seshCode) {
            return false;
        }

        Auth::getUserRepository()->update($user, ['email' => $seshEmail]);

        // Fire Event
        Event::fire(new UserUpdatedEmail($this->userId));
    }
}
