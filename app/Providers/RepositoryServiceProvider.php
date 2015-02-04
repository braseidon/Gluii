<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
		$this->app->bind(
			'App\Repositories\UserRepositoryInterface',
			'App\Repositories\UserRepository'
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['App\Repositories\UserRepositoryInterface'];
	}

}