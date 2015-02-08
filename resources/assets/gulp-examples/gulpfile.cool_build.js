var path = require('path');
var gulp = require("gulp");
//load in the plugins via the gulp-load-plugins plugin - the plugins are defined in the package.json file
var plugins = require("gulp-load-plugins")();
 
//object with directories, glob paths that can be re-used in the gulp file
var settings = {
	"styles" : {
		"bootstrap" : ["./src/css/vendor/normalize.min.css",'src/less/vendor/bootstrap/bootstrap_custom.less'],
		"default" : ["./src/css/vendor/normalize.min.css","./src/css/vendor/**/*.css", 'src/less/custom/**/*.less', './src/css/custom/**/*.css'],
	},
	"js" : {
		"vendor" : ['./src/js/vendor/**/*.js'],
		"default" : ['./src/js/custom/**/*.js']
	},
	"paths" : {
		"default" : {
			"js" : './assets/js/',
			"css" : './assets/css/'
		},
		"build" : {
			"js" : './build/js/',
			"css" : './build/css/'
		}
	},
	"clean" : {
		"default" : ['./assets/js/','./assets/css/'],
		"build" : ['./build/js/','./build/css/']
	}
};
 
 
 
//Make a general "style compiling" function to re-use in certain task calls
function compileStyles(compilationItems, filename, dest, minify){
  return gulp.src(compilationItems)
    .pipe(plugins.less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .on('error', plugins.util.log)
    .pipe(plugins.autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    //if the minify flag is set run the css minification
    .pipe(plugins.if(minify, plugins.minifyCss()))
    .on('error', plugins.util.log)
    .pipe(plugins.concat(filename))
    .pipe(plugins.filesize())
    .pipe(gulp.dest(dest))
    .on('error', plugins.util.log);
}
 
//Make a general "js compiling" function to re-use in certain task calls
function compileJS(compilationItems, filename, dest, minify, cleandebug){
  return gulp.src(compilationItems)
    .pipe(plugins.concat(filename))
    //if the cleandebug flag is set run the strigDebug plugin
    .pipe(plugins.if(cleandebug, plugins.stripDebug()))
    .on('error', plugins.util.log)
    //if the minify flag is set run the js minification
    .pipe(plugins.if(minify, plugins.uglify()))
		/*.pipe(plugins.jshint())
  	.pipe(plugins.jshint.reporter('default'))*/
    .on('error', plugins.util.log)
    .pipe(plugins.filesize())
    .pipe(gulp.dest(dest))
    .on('error', plugins.util.log);
}
 
//function that adds all the values of an array subkey into one array - useful for grabbing all style or JS paths on-the-fly
function concatAll(type){
	var finaloutput = [];
	for (var k in settings[type]) {
			var arr = settings[type][k];
	    finaloutput = finaloutput.concat(arr);
	}
	return finaloutput;
}
 
// JS
 
//production version of your scripts
gulp.task('scripts', function() {
  return compileJS(settings.js.default, 'scripts.min.js',settings.paths.default.js, true, true);
});
 
//build version of your scripts
gulp.task('scripts-nomin', function() {
  return compileJS(settings.js.default, 'scripts.js', settings.paths.build.js, false, false);
});
 
//production version of vendor scripts
gulp.task('scripts-vendor', function() {
  return compileJS(settings.js.vendor, 'vendor.min.js',settings.paths.default.js, true, true);
});
 
//build version of your scripts
gulp.task('scripts-vendor-nomin', function() {
  return compileJS(settings.js.vendor, 'vendor.js', settings.paths.build.js, false, false);
});
 
// CSS
 
//production version of all boostrap and your custom files into one - not preferred but available if needed
gulp.task('all-styles-together', function () {
  return compileStyles(concatAll("styles"), 'styles.min.css', settings.paths.default.css, true);
});
 
//build version of all boostrap and your custom files into one - not preferred but available if needed
gulp.task('all-styles-together-nomin', function () {
  return compileStyles(concatAll("styles"), 'styles.css', settings.paths.build.css, false);
});
 
//production version of a bootstrap css
gulp.task('bootstrap-styles', function () {
	  return compileStyles(settings.styles.bootstrap, 'bootstrap.custom.min.css', settings.paths.default.css, true);
});
 
//production version of your styles
gulp.task('styles', function () {
  return compileStyles(settings.styles.default, 'styles.min.css', settings.paths.default.css, true);
});
 
//build version of a bootstrap css
gulp.task('bootstrap-styles-nomin', function () {
	  return compileStyles(settings.styles.bootstrap, 'bootstrap.custom.css', settings.paths.build.css, false);
});
 
//build version of your styles
gulp.task('styles-nomin', function () {
  return compileStyles(settings.styles.default, 'styles.css', settings.paths.build.css, false);
});
 
 
// Watch
gulp.task('watch', function() {
	var style = concatAll("styles");
	var js = concatAll("js");
	var all = style.concat(js);
 
	gulp.watch(style, ['bootstrap-styles', 'styles']);
	gulp.watch(js, ['scripts', 'scripts-vendor']);
	gulp.watch(all, function(event) {
		console.log('File '+event.path+' was '+event.type+', running tasks...');
	});
 
});
 
// Clean
 
//clean both the production and build files
gulp.task('clean', function() {
	gulp.start('clean-default', 'clean-build');
});
 
//clean the production files
gulp.task('clean-default', function() {
	return gulp.src(settings.clean.default, {read: false})
	.pipe(plugins.clean());
});
 
//clean the build files
gulp.task('clean-build', function() {
	return gulp.src(settings.clean.build, {read: false})
	.pipe(plugins.clean());
});
 
//default task  - clean production directory first
gulp.task('default', ['clean-default'], function() {
	gulp.start('styles', 'scripts', 'scripts-vendor');
});
 
//task that combines all scripts - clean production directory first
gulp.task('combinedbootstrap', ['clean-default'], function() {
	gulp.start('all-styles-together', 'scripts', 'scripts-vendor');
});
 
//build task - clean build directory first
gulp.task('build', ['clean-build'], function() {
	gulp.start('styles-nomin', 'scripts-nomin', 'scripts-vendor-nomin');
});
 
//run both the build and production tasks
gulp.task('all', ['build','default'], function() {
});