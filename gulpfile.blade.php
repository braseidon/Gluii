var gulp			= require('gulp'),
	path			= require('path'),
	util		= require('gulp-util'),
	rename			= require('gulp-rename');
	// concatCss		= require('gulp-concat-css'),
	// less			= require(' '),
	// autoPrefixer	= require('gulp-autoprefixer');
	// minifyCss		= require('gulp-minify-css'),
	// concatJs		= require('gulp-concat'),
	// uglify			= require('gulp-uglify'),

//load in the plugins via the gulp-load-plugins plugin - the plugins are defined in the package.json file
var plugins = require('gulp-load-plugins')();

var dir = {
	assets	= '/resources/assets/',
	src		= dir.assets + 'source/',
var vendor	= dir.assets + 'vendor/';
// Distribution aka the fishing line for all files
var pub = {
	dist	= "public/assets/dist"
}

var config = {
	paths: {
		vendors: {
			css:	[dir.vendor + 'normalize.css', dir.vendor + 'animate.css', dir.vendor + 'bootstrap.css'],
			js:		[dir.vendor + 'jquery.min.js', dir.vendor + 'bootstrap.js']
		},
		less: {
			src:	[dir.src + 'less/app.less']
		},
		javascript: {
			src:	["resources/assets/js/*.js"]
		},
		css: {
			src:	["resources/assets/css/*.css"]
		},
		fonts: {
			src:	['resources/assets/fonts']
		},
	}
};

gulp.task("less", function(){
	return gulp.src(config.paths.less.src)
		.pipe(plugins.less().on('error', gutil.log(log)))
		.pipe(plugins.autoprefixer('last 10 versions'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifycss())
		.pipe(gulp.dest(pub.dist + '/css/'))
		.pipe(plugins.notify({ message: 'Less compiled and minified' }));
});

gulp.task("scripts", function(){
	return gulp.src(config.paths.javascript.src, config.paths.custom.js)
		.pipe(plugins.concat("app.min.js"))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.uglify())
		.pipe(gulp.dest(pub.dist + '/js/'))
		.pipe(plugins.notify({ message: 'Javascripts compiled and minified' }));
});

gulp.task('css', ['scripts', 'less'], function(){
	return gulp.src(config.paths.css.src, config.paths.vendors.css)
		.pipe(plugins.autoprefixer('last 10 versions'))
		// .pipe(concatCss())
		.pipe(plugins.rename({ suffix: '.min' }))
		// .pipe(plugins.minifyCss())
		.pipe(gulp.dest(pub.dist + '/css/'))
		.pipe(plugins.notify({ message: 'Stylesheets compiled and minified' }));
});

gulp.task("default", ["less", "scripts", "css"]);