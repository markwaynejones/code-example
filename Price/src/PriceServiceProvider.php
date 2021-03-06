<?php namespace Caramba\Price;

use Illuminate\Support\ServiceProvider;

class PriceServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{

		require __DIR__.'/routes.php';
		
		$this->loadViewsFrom(__DIR__.'/views', 'Price');
		
		$this->publishes([__DIR__.'/views' => base_path('resources/views/vendor/Price'),]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}