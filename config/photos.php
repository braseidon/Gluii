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

		'dimensions' => [
			'w'					=> 1920,
			'h'					=> 1080,
		],

		'size'					=> '1MB',

	],

	/*
	|--------------------------------------------------------------------------
	| Directories
	|--------------------------------------------------------------------------
	|
	| There's really no reason to change these, but here's the options.
	|
	*/

	'dir' => [

		''

	],

];