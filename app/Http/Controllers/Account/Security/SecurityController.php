<?php namespace App\Http\Controllers\Account\Security;

use Auth;
use Cartalyst\Sentinel\Addons\UniquePasswords\Exceptions\NotUniquePasswordException;
use App\Commands\Account\Security\SendEmailConfirmEmailCommand;
use App\Commands\Account\Security\UpdateEmailCommand;
use App\Commands\Account\Security\UpdatePasswordCommand;
use Session;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SecurityController extends BaseController
{
    /**
     * Security Dashboard
     *
     * @return Response
     */
    public function getSecurityDashboard()
    {
        return view('account.security.security');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Email Address
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * View update email
     *
     * @return Response
     */
    public function getUpdateEmail()
    {
        return view('account.security.update-email');
    }

    /**
     * Process update email
     *
     * @return Response
     */
    public function postUpdateEmail(\App\Http\Requests\Account\Security\UpdateEmailRequest $request)
    {
        $this->dispatch(
            new SendEmailConfirmEmailCommand(Auth::getUser(), $request->input())
        );

        return redirect()->route('account/security/update-email')->withSuccess('We sent an activation email to your new email address. Please confirm it to change your email.');
    }

    /**
     * Confirm the new email address
     *
     * @return Response
     */
    public function getConfirmNewEmail($code)
    {
        if (! Session::has('user.update-email.email.' . Auth::getUser()->id)) {
            return redirect()->back()->withErrors('The session data for changing your email has expired. Please re-enter your email.');
        }

        $this->dispatch(
            new UpdateEmailCommand(
                Auth::getUser()->id,
                $code
            )
        );

        return redirect()->route('account/security/update-email')->withSuccess('Your email address has been changed.');
    }

    /*
    |--------------------------------------------------------------------------
    | Update Password
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * View update password
     *
     * @return Response
     */
    public function getUpdatePassword()
    {
        return view('account.security.update-password');
    }

    /**
     * Update User password
     *
     * @param  UpdatePasswordRequest $request
     * @return Response
     */
    public function postUpdatePassword(\App\Http\Requests\Account\Security\UpdatePasswordRequest $request)
    {
        try {
            $this->dispatch(
                new UpdatePasswordCommand(
                    Auth::getUser()->id,
                    $request->input()
                )
            );

            return redirect()->route('account/security/update-password')->withSuccess('Your password was successfully updated.');

        } catch (NotUniquePasswordException $e) {
            return redirect()->back()->withInput()->withErrors('This password was used before. You must choose a unique password.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Active Sessions
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * View active sessions
     *
     * @return Response
     */
    public function getActiveSessions()
    {
        $persistence  = Auth::getPersistenceRepository();
        $persistences = Auth::getUser()->persistences->reverse();

        return view('account.security.active-sessions', compact('persistence', 'persistences'));
    }

    /**
     * Flushes all sessions except the current.
     *
     * @return RedirectResponse
     */
    public function getFlush()
    {
        Auth::getPersistenceRepository()->flush(
            Auth::getUser(),
            false
        );

        return redirect()->route('account/security/sessions');
    }

    /**
     * Flushes a specific persistence sessions.
     *
     * @param  string  $code
     * @return RedirectResponse
     */
    public function getFlushCode($code)
    {
        Auth::getPersistenceRepository()->remove($code);

        return redirect()->route('account/security/sessions');
    }

    /**
     * Flushes all sessions.
     *
     * @return RedirectResponse
     */
    public function getFlushAllSessions()
    {
        Auth::getPersistenceRepository()->flush(
            Auth::getUser()
        );

        return redirect()->route('auth/login');
    }
}
