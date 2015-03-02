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
		'source_dir'			=> env('IMAGE_SRC_DIR', storage_path('img/')),
		'cache_dir'				=> env('IMAGE_CACHE_DIR', storage_path('img/.cache/')),
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
		'source_path_prefix'	=> 'images',
		'cache_path_prefix'		=> 'images/.cache',
		'base_url'				=> 'img',

		// The categories of images to store
		'types' => [
			'profile'			=> 'user/{id}',
			'photo'				=> 'photo/{id}',
			'event'				=> 'event/{id}',
		],

	],

];