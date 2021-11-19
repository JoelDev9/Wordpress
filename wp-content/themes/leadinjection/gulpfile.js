var gulp = require('gulp');
var sass = require('gulp-sass');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var gsgc = require('gulp-sass-generate-contents');
var cssbeautify = require('gulp-cssbeautify');
var clean = require('gulp-clean');


var creds = {
    "Theme Name":   "Leadinjection",
    "Theme URI":  "http://leadinjection.io/",
    "Author":  "http://themeinjection.com/",
    "Author URI":  "http://themeinjection.com/",
    "Description":  "Leadinjection was designed for professional marketeers, business owners and affiliates to launch landing pages within minutes.",
    "Version":  "2.3.14",
    "License":  "GNU General Public License v2 or later",
    "License URI":  "http://www.gnu.org/licenses/gpl-2.0.html",
    "Text Domain":  "leadinjection",
    "Tags":  "one-column, two-columns, right-sidebar, custom-header, custom-menu, editor-style, featured-images, translation-ready",
}

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  })
};

// Sass
gulp.task('sass', function () {
    gulp.src('./css/*.scss')
    	.pipe(plumber(plumberErrorHandler))
        .pipe(sass())
        .pipe(gulp.dest('./css/'))
});

//sass-generate-contents
gulp.task('sass-generate-toc', function () {
    gulp.src('css/src/*.scss')
        .pipe(gsgc('css/style.scss', creds))
        .pipe(gulp.dest('css'));
});

// Css Beautify
gulp.task('css-beautify', function() {
    return gulp.src('./css/style.css')
        .pipe(cssbeautify())
        .pipe(gulp.dest('./'));
});

// Watch
gulp.task('watch', function() {
    gulp.watch('css/src/*.scss', ['sass-generate-toc']);
    gulp.watch('css/*.scss', ['sass']);
    gulp.watch('css/style.css', ['css-beautify']);
});

gulp.task('default', ['sass-generate-toc', 'sass', 'css-beautify', 'watch']);





// gulp.task('default', function(){

//     console.log('default gulp task...')

// });
