<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\StatusRepository;

class RepositoryServiceProvider extends ServiceProvider {

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
		$this->app->bind('App\Repositories\UserRepositoryInterface',
			'App\Repositories\UserRepository');

		// StatusRepository
		$this->app->bind('App\Repositories\StatusRepository');
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
			'App\Repositories\StatusRepository',
		];
	}

}