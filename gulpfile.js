const { src, dest, watch, parallel } = require('gulp'),
	sass = require('gulp-sass'),
	postcss = require('gulp-postcss'),
	sourcemaps = require('gulp-sourcemaps'),
	autoprefixer = require('autoprefixer'),
	babel = require('gulp-babel'),
	uglify = require('gulp-uglify'),
	livereload = require('gulp-livereload');

function css() {
	return src('src/scss/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle:'compressed'}).on('error', sass.logError))
		.pipe(postcss([autoprefixer()]))
		.pipe(sourcemaps.write('/maps'))
		.pipe(dest('css'))
		.pipe(livereload());
}

function js() {
	return src(['src/js/*.js'])
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(uglify())
		.pipe(sourcemaps.write('/maps'))
		.pipe(dest('js'));
}

function gulpWatch() {
	livereload.listen();
	watch( 'src/scss/**/*.scss', css );
	watch( 'src/js/*.js', js );
}

exports.js = js;
exports.css = css;
exports.gulpWatch = gulpWatch;
exports.default = parallel( css, js, gulpWatch );
