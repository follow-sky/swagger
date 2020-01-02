<?php
namespace FollowSky\Swagger;

use Illuminate\Support\ServiceProvider;

class SwaggerServiceProvider extends ServiceProvider
{

	/**
	 * boot process
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/config.php' => config_path('follow-sky-swagger.php')
		]);

		$this->loadViewsFrom(__DIR__ . '/../../views', 'follow-sky/swagger');

		$this->publishes([
			__DIR__ . '/../../views' => base_path('resources/views/vendor/follow-sky/swagger')
		], 'views');

		$this->publishes([
			__DIR__ . '/../../../public' => public_path('vendor/follow-sky/swagger')
		], 'public');

		$enable = config('follow-sky-swagger.enable');
		if ($enable === null) {
			$enable = config('app.debug') && ! app()->runningInConsole() && ! app()->environment('testing');
		}
		if ($enable) {
			require __DIR__ . '/../../routes.php';
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'follow-sky-swagger');
	}
}
