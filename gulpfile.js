var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function() {
  return gulp.src('./sass/**/*.scss')
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(gulp.dest('./public/styles'));
});

gulp.task('sass:watch', function() {
  gulp.watch('./sass/**/*.scss', gulp.series("sass"));
});
