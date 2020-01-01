<?php
Route::group([
	'middleware' => config('latrell-swagger.middleware'),
	'prefix' => config('latrell-swagger.prefix')
], function ()
{

	Route::get('/', [
		'as' => 'swagger_index',
		'uses' => 'SwaggerController@getIndex'
	]);

	Route::get('docs/{page?}', [
		'as' => 'swagger_docs',
		'uses' => 'SwaggerController@getDocs'
	]);
});