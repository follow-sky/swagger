<?php
namespace Swagger\laravel;

use Illuminate\Support\ServiceProvider;

class SwaggerServiceProvider extends ServiceProvider
{

	/**
	 * boot process
	 */
	public function boot()
	{
		$this->publishes([
			'config/config.php' => config_path('latrell-swagger.php')
		]);

		$this->loadViewsFrom(__DIR__ . '/views', 'latrell/swagger');

		$this->publishes([
			__DIR__ . '/views' => base_path('resources/views/vendor/swagger6/swagger')
		], 'views');

		$this->publishes([
			__DIR__ . '/../public' => public_path('vendor/swagger6/swagger')
		], 'public');

		$enable = config('latrell-swagger.enable');
		if ($enable === null) {
			$enable = config('app.debug') && ! app()->runningInConsole() && ! app()->environment('testing');
		}
		if ($enable) {
			require __DIR__ . 'routes.php';
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/config/config.php', 'swagger6');
	}
}