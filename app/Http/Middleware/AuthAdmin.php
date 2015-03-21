<?php namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Sentinel;

class AuthAdmin
{

    /**
     * The Sentinel instance.
     *
     * @var \Cartalyst\Sentinel\Sentinel
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  \Cartalyst\Sentinel\Sentinel  $auth
     * @return void
     */
    public function __construct(Sentinel $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check() && ! $this->auth->hasAccess('admin')) {
            return redirect()->to('account')->withErrors(['Only admins can access this page.']);
        }

        return $next($request);
    }
}
