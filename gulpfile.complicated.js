/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

// paths
var combine_dir = 'resources/assets/compiled',
	build_dir = 'resources/assets/build',
	less_file = 'app',
	less_output = combine_dir,
	// set scripts to combine
	scripts = [
		'vendor/jquery/jquery.js',
		'public/js/main.js'
	],
	// set styles to combine - compiled less file should be last
	styles = [
		'vendor/normalize/normalize.css',
		'css/' + less_file + '.css',
		'css/fontawesome.css',
		'css/icon.css',
		'css/gluii.css',
	];

	// files to version (cache bust)
	version = [
		'public/css/all.css',
		'public/js/all.js'
	];

// require elixir
var elixir = require('laravel-elixir');

// mix ingredients
elixir(function(mix) {
	mix.less(less_file + '.less', less_output)
		.styles(styles, combine_dir)
		.scripts(scripts, combine_dir)
		.version(version, build_dir);
});