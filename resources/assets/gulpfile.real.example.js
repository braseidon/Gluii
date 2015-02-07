var gulp		= require("gulp"),
	path		= require('path'),
	concat		= require("gulp-concat"),
	uglift		= require("gulp-uglify"),
	cssmin		= require("gulp-cssmin");
//load in the plugins via the gulp-load-plugins plugin - the plugins are defined in the package.json file
var plugins = require("gulp-load-plugins")();


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