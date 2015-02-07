var gulp			= require('gulp'),
	path			= require('path'),
	util		= require('gulp-util'),
	rename			= require('gulp-rename');
	// less			= require(' '),
	// autoPrefixer	= require('gulp-autoprefixer');
	// minifyCss		= require('gulp-minify-css'),
	// concatJs		= require('gulp-concat'),
	// concatCss		= require('gulp-concat-css'),
	// uglify			= require('gulp-uglify'),
//load in the plugins via the gulp-load-plugins plugin - the plugins are defined in the package.json file
var plugins = require('gulp-load-plugins')();

var config = {
	paths: {
		vendors: {
			less:	[],
			css:	['resources/assets/vendor/normalize.css', 'resources/assets/vendor/animate.css', 'resources/assets/vendor/bootstrap.css'],
			js:		['jquery.min.js', 'bootstrap.js']
		},
		less: {
			src:	['resources/assets/less/app.less']
		},
		javascript: {
			src:	["resources/assets/js/ui-*.js", 'eldarion-ajax.min.js', 'jquery.ui.touch-punch.min.js']
		},
		css: {
			src:	["resources/assets/css/*.css"]
		},
		fonts: {
			src:	['resources/assets/fonts']
		},
		dist: {
			build:	"public/assets",
			dist:	"public/assets/dist",
		},
	}
};

gulp.task("less", function(){
	return gulp.src(config.paths.less.src)
		.pipe(plugins.less().on('error', gutil.log(log)))
		.pipe(plugins.autoprefixer('last 10 versions'))
		// .pipe(gulp.dest(config.paths.dist.build))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifycss())
		.pipe(gulp.dest(config.paths.dist.dist))
		.pipe(plugins.notify({ message: 'Less compiled and minified' }));
});

gulp.task("scripts", function(){
	return gulp.src(config.paths.javascript.src, config.paths.custom.js)
		.pipe(plugins.concat("app.min.js"))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.uglify())
		.pipe(gulp.dest(config.paths.dist.dist))
		.pipe(plugins.notify({ message: 'Javascripts compiled and minified' }));
});

gulp.task("css", function(){	//	['', ' ', 'public/assets/build/css']
	return gulp.src(config.paths.css.src, config.paths.vendors.css)
		.pipe(plugins.autoprefixer('last 10 versions'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest(config.paths.dist.dist))
		.pipe(plugins.notify({ message: 'Stylesheets compiled and minified' }));
});

gulp.task("default", ["less", "scripts", "css"]);