<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
        //
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/Routes/UserRoutes.php');
            require app_path('Http/Routes/AdminRoutes.php');
            require app_path('Http/Routes/AccountRoutes.php');
            require app_path('Http/Routes/AssetRoutes.php');
        });
    }

    /**
     * Router parameter constraints
     *
     * @param  Router $router
     * @return void
     */
    public function before(Router $router)
    {
        // Route patterns
        $router->pattern('id', '[0-9]+');
        $router->pattern('userId', '[0-9]+');
        $router->pattern('slug', '[a-z0-9-]+');
        $router->pattern('path', '.+');
        $router->pattern('username', '[a-zA-Z0-9]+');
    }
}
