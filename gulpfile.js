var gulp			= require('gulp'),
	path			= require('path'),
	del				= require('del'),
	gutil			= require('gulp-util');
var plugins			= require('gulp-load-plugins')();

// Distribution aka the fishing line for all files
var dir = {
	build:		'resources/assets/build/',
	dist:		'public/assets/dist/',
	source:		'resources/assets/',
	vendor:		'resources/assets/vendor/'
	};

var config = {
	paths: {

		// Less
		less: [
			dir.source + 'less/bootstrap/bootstrap.less',
			dir.source + 'less/app.less',
		],

		// CSS
		css: [
				// Essentials
				dir.source + 'css/fonts.css',
				dir.vendor + 'font-awesome/css/font-awesome.css',
				dir.vendor + 'simple-line-icons/css/simple-line-icons.css',
				// dir.vendor + 'ionicons/css/ionicons.css',
				dir.source + 'css/gluii.css',
				// Plugins
				dir.vendor + 'animate.css/animate.css',
				dir.vendor + 'jcrop/css/jquery.Jcrop.css',
		],

		// Fonts
		fonts: [
			dir.vendor + 'bootstrap/fonts/',
			dir.vendor + 'ionicons/fonts/',
		],

		// Javascripts
		js: [
			// Essentials
			dir.vendor + 'jquery/dist/jquery.min.js',
			dir.vendor + 'modernizr/modernizr.js',
			dir.vendor + 'bootstrap/dist/js/bootstrap.js',
			dir.source + 'js/gluii.js',
			dir.source + 'js/gluii.plugins.js',
			dir.source + 'js/app/ui-load.js',
			dir.source + 'js/app/ui-nav.js',
			dir.source + 'js/app/ui-toggle.js',
			// Plugins
			dir.vendor + 'jqueryui-touch-punch/jquery.ui.touch-punch.min.js',
			dir.vendor + 'jcrop/js/jquery.Jcrop.js',
			dir.vendor + 'slimscroll/jquery.slimscroll.js',
			dir.vendor + 'bootstrap-filestyle/src/bootstrap-filestyle.js',
		],

		build: {
			css: [
				dir.build + 'css/less.css',
				dir.build + 'css/styles.css',
			],
			js: [
				dir.build + 'js/scripts.js',
			],
		}
	},
	autoPrefixBrowers: ['Android2.3','Android>=4','Chrome>=20','Firefox>=24','Explorer>=8','iOS>=6','Opera>=12','Safari>=6']
};

// Less
gulp.task('less', function(){
	return gulp.src(config.paths.less, {base: dir.vendor + './css'})
		.pipe(plugins.expectFile(config.paths.less))
		.pipe(plugins.less().on('error', gutil.log))
		.pipe(plugins.concat('less.css'))
		.pipe(gulp.dest(dir.build + 'css/'))
		.pipe(plugins.notify({ message: 'Less compiled' }));
});

// CSS Scripts
gulp.task('css', ['less'], function(){
	return gulp.src(config.paths.css)
		.pipe(plugins.expectFile(config.paths.css))
		.pipe(plugins.concat('styles.css'))
		.pipe(gulp.dest(dir.build + 'css/'))
		.pipe(plugins.notify({ message: 'CSS from source + vendors compiled' }));
});

// Compile all CSS
gulp.task('styles', ['less', 'css'], function(){
	return gulp.src(config.paths.build.css)
		.pipe(plugins.expectFile(config.paths.build.css))
		.pipe(plugins.concat('gluii.css'))
		.pipe(plugins.autoprefixer(config.autoPrefixBrowers))
		.pipe(gulp.dest(dir.dist + 'css/'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest(dir.dist + 'css/'))
		.pipe(plugins.notify({ message: 'All CSS in build folder compiled & minified' }));
});

// Javascript
gulp.task('scripts', function(){
	return gulp.src(config.paths.js)
		.pipe(plugins.expectFile(config.paths.js))
		.pipe(plugins.concat('gluii.js'))
		.pipe(gulp.dest(dir.dist + 'js/'))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.uglify())
		.pipe(gulp.dest(dir.dist + 'js/'))
		.pipe(plugins.notify({ message: 'Javascripts compiled and minified' }));
});

// Clean the public dist folder
gulp.task('clean', function(cb) {
	del([
		'./resources/assets/build/**',
		'./public/assets/dist/css/**',
		'./public/assets/dist/js/**',
	], cb);
});

gulp.task('default', ['clean', 'less', 'css', 'styles', 'scripts']); // 'scripts',