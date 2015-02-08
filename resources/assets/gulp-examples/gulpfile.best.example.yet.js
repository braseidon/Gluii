var gulp       = require("gulp"),
    minifyHTML = require("gulp-minify-html"),
    concat     = require("gulp-concat"),
    uglify     = require("gulp-uglify"),
    cssmin     = require("gulp-cssmin");
 
var config = {
    paths: {
        html: {
            src:  ["src/**/*.html"],
            dest: "build"
        },
        javascript: {
            src:  ["src/js/**/*.js"],
            dest: "build/js"
        },
        css: {
            src: ["src/css/**/*.css"],
            dest: "build/css"
        }
    }
}
 
gulp.task("html", function(){
    return gulp.src(config.paths.html.src)
        .pipe(minifyHTML())
        .pipe(gulp.dest(config.paths.html.dest));
});
 
gulp.task("scripts", function(){
    return gulp.src(config.paths.javascript.src)
        .pipe(uglify())
        .pipe(concat("app.min.js"))
        .pipe(gulp.dest(config.paths.javascript.dest));
});
 
gulp.task("css", function(){
    return gulp.src(config.paths.css.src)
        .pipe(cssmin())
        .pipe(gulp.dest(config.paths.css.dest));
});
 
gulp.task("default", ["html", "scripts", "css"]);