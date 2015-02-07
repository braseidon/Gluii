var gulp		= require('gulp');

var es			= require('event-stream');
var gutil		= require('gulp-util');
	autoprefixer	= require('gulp-autoprefixer'),
	jshint			= require('gulp-jshint'),
	less			= require('gulp-less'),
	concatCss		= requuire('gulp-concat-css'),
	minifyCss		= require('gulp-minify-css'),
	notify			= require('gulp-notify'),
	rename			= require('gulp-rename'),
	uglify			= require('gulp-uglify');
	gutil			= require('gulp-util');

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~ OPTIONS
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Minify CSS Options
var gulpMinifyCSS = {
	"advanced": true,			// Advanced merging
	"aggressiveMerging": true,	// Aggressive merging
	"keepBreaks": false			// Keep line breaks
};
//  Auto Prefixer setup
var autoPrefixSetup = 'last 15 versions';

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~ FILE PATHS
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Paths
var assetSrc	= 'resources/assets',
	fontDir		= 'resources/assets/fonts/',
	distDir		= 'resources/assets/dist/',
	publicDir	= 'public/assets',
	bowerDir	= 'bower_components'

// LESS
var lessSrc	= assetSrc + '/less/app.less';
	// lessOut	= './css/';

// Stylesheets
var styles = [
	'normalize.css',					// The LESS-compiled stylesheet
	'animate.css',
	'fontawesome.css',
	'simple-line-icons.css'.
	'gluii.css',
	'normalize.css',
];

// Scripts
var scripts = [
	'app.js',
	'gluii.js',
	'eldarion-ajax.min.js'
];

/*
 |--------------------------------------------------------------------------
 | Gulp Tasks :: LESS + CSS
 |--------------------------------------------------------------------------
 |
 |
 */

// Compile LESS and put the CSS with the rest of the CSS files
gulp.task('less', function () {
	return gulp.src( lessSrc )
		.pipe(less().on('error', gutil.log))
		.pipe(gulp.dest( assetSrcSrc + '/css/' ))
		.pipe(notify({ message: 'Less compiled & prefixed.' }));
});

/*
 |--------------------------------------------------------------------------
 | Gulp Task :: CSS
 |--------------------------------------------------------------------------
 |
 |
 */
gulp.task('css', function() {
	return gulp.src( source )
	.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
	.pipe(gulp.dest( distDir + '/css/' ))
	.pipe(rename({ suffix: '.min' }))
	.pipe(minifyCss( gulpMinifyCSS ))
	.pipe(gulp.dest( distDir + '/css/' ))
	.pipe(notify({ message: 'CSS minification complete' }));
});

/*
 |--------------------------------------------------------------------------
 | Gulp Task :: Javascripts
 |--------------------------------------------------------------------------
 |
 |
 */
gulp.task('js', function() {
	return gulp.src('src/scripts/**/*.js')
		.pipe(jshint('.jshintrc'))
		.pipe(jshint.reporter('default'))
		.pipe(concat('main.js'))
		.pipe(gulp.dest('dist/scripts'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest('dist/scripts'))
		.pipe(notify({ message: 'Scripts task complete' }));
});

/*
 |--------------------------------------------------------------------------
 | Gulp Task :: NOT SURE WHICH IS NEWER
 |--------------------------------------------------------------------------
 |
 |
 */




var gulp		= require('gulp');

var es			= require('event-stream');
var gutil		= require('gulp-util');

var plugins		= require("gulp-load-plugins")({
    pattern: ['gulp-*', 'gulp.*'],
    replaceString: /\bgulp[\-.]/
});
	// autoprefixer	= require('gulp-autoprefixer'),
	// jshint			= require('gulp-jshint'),
	// less			= require('gulp-less'),
	// concatCss		= requuire('gulp-concat-css'),
	// minifyCss		= require('gulp-minify-css'),
	// notify			= require('gulp-notify'),
	// rename			= require('gulp-rename'),
	// uglify			= require('gulp-uglify');
	// gutil			= require('gulp-util');

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~ OPTIONS
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Minify CSS Options
var gulpMinifyCSS = {
	"advanced": true,			// Advanced merging
	"aggressiveMerging": true,	// Aggressive merging
	"keepBreaks": false			// Keep line breaks
};
//  Auto Prefixer setup
var autoPrefixSetup = 'last 15 versions';

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~ FILE PATHS
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Paths
var assetSrc	= 'resources/assets',
	fontDir		= 'resources/assets/fonts/',
	distDir		= 'resources/assets/dist/',
	publicDir	= 'public/assets',
	bowerDir	= 'bower_components'

// LESS
var lessSrc	= assetSrc + '/less/app.less';
	// lessOut	= './css/';

// Stylesheets
var styles = [
	'',					// The LESS-compiled stylesheet
	'simple-line-icons.css',
	'fontawesome.css',
	'gluii.css',
	'normalize.css',
];

// Scripts
var scripts = [
	'app.js',
	'gluii.js',
	'eldarion-ajax.min.js'
];

/*
 |--------------------------------------------------------------------------
 | Gulp Tasks :: LESS + CSS
 |--------------------------------------------------------------------------
 |
 |
 */

// Compile LESS and put the CSS with the rest of the CSS files
gulp.task('less', function () {
	return gulp.src( lessSrc )
		.pipe(less().on('error', gutil.log))
		.pipe(gulp.dest( assetSrcSrc + '/css/' ))
		.pipe(notify({ message: 'Less compiled & prefixed.' }));
});

/*
 |--------------------------------------------------------------------------
 | Gulp Task :: CSS
 |--------------------------------------------------------------------------
 |
 |
 */
gulp.task('css', function() {
	return gulp.src( source )
	.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
	.pipe(gulp.dest( distDir + '/css/' ))
	.pipe(rename({ suffix: '.min' }))
	.pipe(minifyCss( gulpMinifyCSS ))
	.pipe(gulp.dest( distDir + '/css/' ))
	.pipe(notify({ message: 'CSS minification complete' }));
});

/*
 |--------------------------------------------------------------------------
 | Gulp Task :: Javascripts
 |--------------------------------------------------------------------------
 |
 |
 */
gulp.task('js', function() {
	return gulp.src('src/scripts/**/*.js')
		.pipe(jshint('.jshintrc'))
		.pipe(jshint.reporter('default'))
		.pipe(concat('main.js'))
		.pipe(gulp.dest('dist/scripts'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest('dist/scripts'))
		.pipe(notify({ message: 'Scripts task complete' }));
});

/*
 |--------------------------------------------------------------------------
 | Gulp Task :: Fonts
 |--------------------------------------------------------------------------
 |
 |
 */