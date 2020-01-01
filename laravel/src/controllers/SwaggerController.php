<?php
namespace Swagger\laravel;

use Illuminate\Routing\Controller;

class SwaggerController extends Controller
{

	public function getIndex()
	{
		return view('index');
	}

	public function getDocs($page = 'api-docs.json')
	{
		$directory = config('latrell-swagger.paths');
		$exclude = config('latrell-swagger.exclude');

		$swagger = \Swagger\scan($directory, [
			'exclude' => $exclude
		]);
		return response((string) $swagger, 200, [
			'Content-Type' => 'application/json'
		]);
	}
}
