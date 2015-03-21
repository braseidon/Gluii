<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Auth;
use Mail;
use Reminder;
use Cartalyst\Sentinel\Addons\UniquePasswords\Exceptions\NotUniquePasswordException;

class PasswordController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Show the form for the forgot password.
     *
     * @return \Illuminate\View\View
     */
    public function getForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle posting of the form for the forgot password.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postForgotPassword(\App\Http\Requests\Auth\ForgotPasswordRequest $request)
    {
        $email = $request->input('email');

        if ($user = Auth::findByCredentials(compact('email'))) {
            $reminder = Reminder::exists($user) ?: Reminder::create($user);

            $code = $reminder->code;

            $sent = Mail::send('emails.auth.reset-password', compact('user', 'code'), function ($m) use ($user) {
                $m->to($user->email)->subject('Reset your account password.');
            });
        }

        return redirect()->route('auth/forgot-password')->withSuccess(
            'An email was sent with instructions on how to reset your password.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Show the form for the password reminder confirmation.
     *
     * @return \Illuminate\View\View
     */
    public function getResetPassword($id, $code)
    {
        return view('auth.reset-password', ['userId' => $id, 'code' => $code]);
    }

    /**
     * Handle posting of the form for the password reminder confirmation.
     *
     * @param  int  $id
     * @param  string  $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postResetPassword(\App\Http\Requests\Auth\ResetPasswordRequest $request, $id, $code)
    {
        if (! $user = Auth::findById($id)) {
            return redirect()->back()->withInput()->withErrors('The user no longer exists.');
        }

        try {
            if (! Reminder::complete($user, $code, $request->input('password'))) {
                return redirect()->route('auth/login')->withErrors('Invalid or expired reset code.');
            }

            return redirect()->route('auth/login')->withSuccess('Password was successfully reset.');
        } catch (NotUniquePasswordException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
