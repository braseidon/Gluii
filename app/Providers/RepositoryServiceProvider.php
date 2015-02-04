<?php namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\AbstractRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
		// $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

		// $this->app->bind('App\Repositories\UserRepositoryInterface', 'App\Repositories\UserRepository');
		$this->app->bind(UserRepositoryInterface::class, UserRepository::class);

		// $this->app->bind('App\Repositories\UserRepository');
		// $this->app->bind(UserRepository::class);


		// $this->app->singleton('App\Repositories\UserRepository');

		// $this->app['UserRepository'] = $this->app->share(function($app)
		// {
		// 	return new UserRepository; //$this->app['cache.store']
		// });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'UserRepository'
		];
	}

}