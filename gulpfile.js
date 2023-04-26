/**
 * ***********************************************
 * ** MACCA COMPUTER. TUTTI I DIRITTI RISERVATI **
 * **   Software prodotto a ferrara. (c) 2022   **
 * **           www.maccacomputer.com           **
 * ***********************************************
 */

var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var pkg = require('./package.json');
gulp.task('vendor', function() {

  gulp.src([
      './node_modules/bootstrap/dist/**/*',
      '!./node_modules/bootstrap/dist/css/bootstrap-grid*',
      '!./node_modules/bootstrap/dist/css/bootstrap-reboot*'
    ])
    .pipe(gulp.dest('./vendor/bootstrap'))

  gulp.src([
      './node_modules/jquery/dist/*',
      '!./node_modules/jquery/dist/core.js'
    ])
    .pipe(gulp.dest('./vendor/jquery'))

})

gulp.task('default', ['vendor']);

gulp.task('browserSync', function() {
  browserSync.init({
    server: {
      baseDir: "./"
    }
  });
});

gulp.task('dev', ['browserSync'], function() {
  gulp.watch('./css/*.css', browserSync.reload);
  gulp.watch('./*.html', browserSync.reload);
});
