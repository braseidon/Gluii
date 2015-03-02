<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Photo Settings
	|--------------------------------------------------------------------------
	|
	| These are settings that control how photos work.
	|
	*/

	'options' => [
		'source_dir'			=> 'app/' . env('IMAGE_SRC_DIR', 'images'),
		'cache_dir'				=> 'app/' . env('IMAGE_CACHE_DIR', 'images/.cache'),
	],

	/*
	|--------------------------------------------------------------------------
	| Image Templates
	|--------------------------------------------------------------------------
	|
	| Pre-defined templates for image sizes, e.g. 'thumb', 'small', 'large', etc
	|
	*/

	'templates' => [

		'thumb-sm' => [
			'w'					=> 65,
			'h'					=> 65,
			'q'					=> 70,
			'fit'				=> 'crop',
		],
		'thumb-md' => [
			'w'					=> 120,
			'h'					=> 120,
			'q'					=> 80,
			'fit'				=> 'crop',
		],
		'thumb-lg' => [
			'w'					=> 160,
			'h'					=> 160,
			'q'					=> 90,
			'fit'				=> 'crop',
		],

		'large' => [
			'w'					=> 1920,
			'h'					=> 1080,
			'q'					=> 90,
			'fit'				=> 'max',
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Size/Dimension Limits
	|--------------------------------------------------------------------------
	|
	| Set the limits for photo sizes and dimensions. This is important as to
	| not take up too much disk space. Although, larger restrictions will make
	| photographers very happy.
	|
	| Supported sizes: 'KB', 'MB'
	|
	*/

	'limits' => [
		'width'					=> 1920,
		'height'				=> 1200,
		'size'					=> '2MB',
	],

	/*
	|--------------------------------------------------------------------------
	| Directories
	|--------------------------------------------------------------------------
	|
	| There's really no reason to change these, but here's the options. The
	| base folder is Laravel's storage folder.
	|
	*/

	'dirs' => [

		// Image source and cache paths
		'source_path_prefix'	=> env('IMAGE_SRC_DIR', storage_path('images')),
		'cache_path_prefix'		=> env('IMAGE_CACHE_DIR', storage_path('images/.cache')),
		'base_url'				=> 'img',

		// The categories of images to store
		'types' => [
			'profile'			=> 'user/{id}',
			'photo'				=> 'photo/{id}',
			'event'				=> 'event/{id}',
		],

	],

];