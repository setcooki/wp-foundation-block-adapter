'use strict';

const argv = require('minimist')(process.argv.slice(2));
const path = require('path');
const gulp = require('gulp');
const noop = require('gulp-noop');
const csso = require('gulp-csso');
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const cleanCss = require('gulp-clean-css');
const tildeImporter = require('node-sass-tilde-importer');

const prod = ('prod' in argv && argv.prod) || false;

function scss() {
  return gulp.src('./assets/scss/*.scss')
    .pipe(sass({
        style: "expanded",
        importer: tildeImporter,
        includePaths: [
          "node_modules/foundation-sites/scss"
        ]
      }
    ))
    .pipe(prod ? csso({
      restructure: false,
      debug: false,
      sourceMap: false
    }) : noop())
    .pipe(prod ? cleanCss({
      debug: false,
      level: 2,
      compatibility: "*",
      sourceMap: true
    }) : noop())
    .pipe(prod ? rename({suffix: '.min'}) : noop())
    .pipe(gulp.dest('./static/css'))
}

function watch() {
  gulp.watch('./assets/scss/**/*.scss').on('all', gulp.series(scss));
}

gulp.task('scss', gulp.series(scss));
gulp.task('dev', gulp.series(scss, watch));
gulp.task('build', gulp.series(scss));
