var gulp			= require('gulp');
var path			= require('path');
var autoPrefixer	= require('gulp-autoprefixer');
var clean			= require('gulp-rimraf');
var concat			= require('gulp-concat');
var concatCss		= require('gulp-concat-css');
var del				= require('del');
// var es				= require('event-stream');
var gutil			= require('gulp-util');
var less			= require('gulp-less');
var minifyCss		= require('gulp-minify-css');
var notify			= require('gulp-notify');
var rename			= require('gulp-rename');
var uglify			= require('gulp-uglify');

//load in the plugins via the gulp-load-plugins plugin - the plugins are defined in the package.json file
var plugins = require('gulp-load-plugins')();

// Distribution aka the fishing line for all files
var dir = {
	assets:		'./resources/assets/',
	build:		'./resources/assets/build/',
	dist:		'./public/assets/dist/',
	source:		'./resources/assets/src/',
	vendor:		'./resources/assets/vendor/'
	};

var config = {
	paths: {
		vendors: {
			css:	[dir.vendor + 'animate.css/animate.css'],
			js:		[dir.vendor + 'jquery/jquery.js', dir.vendor + 'bootstrap/dist/js/bootstrap.js']
		},
		less: {
			src:	[
				dir.vendor + 'bootstrap/less/bootstrap.less',
				dir.source + 'less/app.less',
				dir.vendor + 'simple-line-icons/less/simple-line-icons.less',
				dir.vendor + 'font-awesome/less/font-awesome.less',
			]
		},
		js: {
			src:	[dir.source + 'js/*.js']
		},
		build: {
			less:	dir.build + 'css/less.css',
			css:	dir.build + 'css/app.css',
			js:		dir.build + 'js/app.js',
		}
	},
	autoPrefixBrowers: ['Android2.3','Android>=4','Chrome>=20','Firefox>=24','Explorer>=8','iOS>=6','Opera>=12','Safari>=6']
};

// Less
gulp.task('less', ['clean'], function(){
	return gulp.src(config.paths.less.src, {base: dir.vendor + './css'})
		.pipe(less().on('error', gutil.log))
		.pipe(concatCss('app1.less.css'))
		.pipe(gulp.dest(dir.build + 'css/'))
		.pipe(notify({ message: 'Less compiled' }));
});

// CSS Scripts
gulp.task('css', ['less'], function(){
	return gulp.src([dir.source + 'css/*.css', config.paths.vendors.css])
		.pipe(concatCss('app2.css.css'))
		.pipe(gulp.dest(dir.build + 'css/'))
		.pipe(notify({ message: 'CSS from source + vendors compiled' }));
});

// Compile all CSS
gulp.task('styles', ['less', 'css'], function(){
	return gulp.src(dir.build + 'css/*.css')
		.pipe(autoPrefixer(config.autoPrefixBrowers))
		.pipe(gulp.dest(dir.dist + 'css/'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifyCss())
		.pipe(gulp.dest(dir.dist + 'css/'))
		.pipe(notify({ message: 'All CSS in build folder compiled & minified' }));
});

// Javascript
gulp.task('js', function(){
	return gulp.src(config.paths.js.src)
		.pipe(concat('app.js'))
		.pipe(gulp.dest(dir.dist + 'js/'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest(dir.dist + 'js/'))
		.pipe(notify({ message: 'Javascripts compiled and minified' }));
});

// Clean the public dist folder
gulp.task('clean', function(cb) {
	del([
		'./resources/assets/build/**',
		'./public/assets/dist/css/**',
		'./public/assets/dist/js/**',
	], cb);
});

gulp.task('default', ['clean', 'less', 'js']); // 'scripts',