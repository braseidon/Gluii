<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StatusRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // UserRepository
        $this->app->bindShared('App\Repositories\UserRepositoryInterface', function ($app) {
            return new \App\Repositories\UserRepository();
        });
        // StatusRepository
        $this->app->bind('App\Repositories\StatusRepositoryInterface',
            'App\Repositories\StatusRepository');
        // NotificationRepository
        $this->app->bind('App\Repositories\NotificationRepositoryInterface',
            'App\Repositories\NotificationRepository');
        // PhotoRepository
        $this->app->bind('App\Repositories\PhotoRepositoryInterface',
            'App\Repositories\PhotoRepository');
        // PhotoAlbumRepository
        $this->app->bind('App\Repositories\PhotoAlbumRepositoryInterface',
            'App\Repositories\PhotoAlbumRepository');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\StatusRepositoryInterface',
            'App\Repositories\NotificationRepositoryInterface',
            'App\Repositories\PhotoRepositoryInterface',
            'App\Repositories\PhotoAlbumRepositoryInterface',
        ];
    }
}
