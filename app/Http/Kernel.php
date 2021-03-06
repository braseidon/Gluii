<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'Illuminate\Foundation\Http\Middleware\VerifyCsrfToken',
        'Clockwork\Support\Laravel\ClockworkMiddleware',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'            => 'App\Http\Middleware\Auth',
        'auth.admin'    => 'App\Http\Middleware\AuthAdmin',
        'auth.basic'    => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest'            => 'App\Http\Middleware\RedirectIfAuthenticated',
    ];
}
