<?php namespace app\Http\Controllers\Account\Security;

use Auth;
use Cartalyst\Sentinel\Addons\UniquePasswords\Exceptions\NotUniquePasswordException;
use App\Http\Controllers\BaseController;
use App\Http\Requests;
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
    public function postUpdateEmail()
    {
        return view('account.security.update-email');
    }

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
     * View active sessions
     *
     * @return Response
     */
    public function getActiveSessions()
    {
        $persistence = Auth::getPersistenceRepository();

        return view('account.security.active-sessions', compact('persistence'));
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
