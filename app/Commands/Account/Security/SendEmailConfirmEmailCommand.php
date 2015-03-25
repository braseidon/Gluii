<?php namespace App\Commands\Account\Security;

use App\Models\User;
use Auth;
use Mail;
use Session;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\SerializesModels;

class SendEmailConfirmEmailCommand extends Command implements SelfHandling, ShouldBeQueued
{
    use SerializesModels;

    /**
     * The User being updated
     *
     * @var User
     */
    protected $user;

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
    public function __construct(User $user, array $input)
    {
        $this->user     = $user;
        $this->input    = $input;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $code = str_random(20);
        $user = $this->user;
        Session::put('user.update-email.email.' . $user->id, $this->input['email']);
        Session::put('user.update-email.code.' . $user->id, $code);

        $sent = Mail::send('emails.account.security.confirm-email-change', compact('code'), function ($m) use ($user) {
            $m->to($this->input['email'])->subject('Confirm Your New Email');
        });

        if ($sent === 0) {
            dd($sent);
            Log::error('Failed to send email to ' . $user->email);
            Log::error('Email: emails.account.security.confirm-email-change');
        }
    }
}
