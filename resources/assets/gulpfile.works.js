var elixir = require('laravel-elixir');
var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var minifyCSS = require('gulp-minify-css');
var notify = require('gulp-notify');
var rename = require('gulp-rename');
// var publish = require('laravel-elixir/ingredients/commands/CopyFiles');

// Paths
var asset_dir = 'resources/assets';
var publish_dir = 'public/assets/compiled';

// Options
// var optionsMinifyCSS = ;

/*
 |--------------------------------------------------------------------------
 | Custom Gulp Tasks
 |--------------------------------------------------------------------------
 |
 |
 */

// Combine selectors on CSS
elixir.extend('minCSS', function(source, destination) {

	// Styles
	gulp.task('minCSS', function() {
	  return gulp.src(source)
		.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(gulp.dest(destination + '/dist'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifyCSS({advanced:false,aggressiveMerging:false,keepBreaks:true}))
		.pipe(gulp.dest(destination + '/min/'))
		.pipe(notify({ message: 'CSS minification complete' }));
	});

	return this.queueTask("minCSS");
});


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

// Stylesheets
var styles = [
	'angular.css',
	'simple-line-icons.css',
	'fontawesome.css',
	'gluii.css',
];



// Scripts
var scripts = [
	'app.js',
	'gluii.js',
	'eldarion-ajax.min.js'
];

// -----------------------------------------------------------
// BUILD TIME
// -----------------------------------------------------------

// Stylesheets
elixir(function(mix) {
	mix.less("angular.less", asset_dir + '/css/');

	mix.styles(styles, publish_dir + '/css/gluii.css', asset_dir + '/css');

	// mix.version(distCSS);

	mix.shutterfy(publish_dir + '/css/gluii.css', publish_dir + '/css');
});

// Javascripts
elixir(function(mix) {
	mix.scripts(scripts, publish_dir + '/js/allofthem.js', 'resources/assets/js');

	// mix.version(publish_dir + '/js/gluii.js');
});

// Trashed methods
// .copy(less_dir + '/angular.css', asset_dir + '/angular.css');