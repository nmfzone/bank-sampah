/*
 |--------------------------------------------------------------------------
 | Gulp Asset Management
 |--------------------------------------------------------------------------
 */

var gulp         = require('gulp'),
    gutil        = require('gulp-util'),
    notify       = require('gulp-notify'), // push notify into OS
    colors       = require('colors'), // coloring log output
    jshint       = require('gulp-jshint'),
    //sass         = require('gulp-sass'), // compile Sass/SCSS
    concat       = require('gulp-concat'), // concat css/js files
    sourcemaps   = require('gulp-sourcemaps'), // autogenerate sourcemaps
    flatten      = require('gulp-flatten'), // remove source relative path
    imagemin     = require('gulp-imagemin'), // minify images
    pngquant     = require('imagemin-pngquant'), // minify png files
    imageResize  = require('gulp-image-resize'), // resize images
    cssmin       = require('gulp-cssmin'), // minify css
    uglify       = require('gulp-uglify'), // minify js
    rename       = require('gulp-rename'), // rename files
    gulpIgnore   = require('gulp-ignore'), // ignone files
    // Configuration for process all assets in each Vendor folder
    // into Laravel resources folder
    inputVendorCss = [
      'resources/assets/css/vendor/bootstrap.css',
      'resources/assets/css/vendor/*.css'
    ],
    inputVendorJs = [
      'resources/assets/js/vendor/jquery.min.js',
      'resources/assets/js/vendor/bootstrap.min.js',
      'resources/assets/js/vendor/dataTables.min.js',
      'resources/assets/js/vendor/dataTables.bootstrap.min.js',
      'resources/assets/js/vendor/metisMenu.min.js',
      'resources/assets/js/vendor/sweetalert.min.js',
      'resources/assets/js/vendor/*.js'
    ],
    outputVendor = {
      'stylesheets': 'resources/assets/css/',
      'javascript' : 'resources/assets/js/concat/'
    },
    vendorConcatName = {
      'stylesheets': 'style.css',
      'javascript' : 'A-js-concat.js'
    },
    // Configuration for proccess all assets in frontend and resources folder
    // into Laravel public folder
    inputLaravelCss = [
      'resources/assets/css/*',
    ],
    inputLaravelJsConcat = [
      'resources/assets/js/concat/*',
    ],
    inputLaravelJsNotConcat = [
      'resources/assets/js/*',
    ],
    inputLaravelFonts = [
      'resources/assets/fonts/**/*',
    ],
    inputLaravelImages = [
      { path: 'resources/assets/images/' },
    ],
    outputLaravel = {
      'stylesheets': 'public/assets/css/',
      'javascript' : 'public/assets/js/',
      'fonts'      : 'public/assets/fonts/',
      'images'     : 'public/assets/images/',
    },
    laravelConcatName = {
      'javascript' : 'script.js',
    },
    // Settings for Images Tasks
    // Install imagemagick and graphicsmagick first
    images = [
      { folder: '32x32', width: 32, height: 32, crop: false },
      { folder: '40x40', width: 40, height: 40, crop: false },
    ],
    acceptedImageExtensions = "jpg,gif,png,jpeg";

// Gulp Tasks
gulp.task('default', ['watch']);

gulp.task('watch', function() {
  gulp.watch('resources/assets/css/*.css', ['build-css']);
  gulp.watch('resources/assets/js/**/*.js', ['build-js']);
  gulp.watch('resources/assets/images/**/*', ['build-images']);
});

gulp.task('vendor', [
    'build-vendor-css',
    'build-vendor-js'
]);

gulp.task('laravel', [
    'build-css',
    'build-js',
    'build-images',
    'build-fonts',
]);

// ===========
// Bower Tasks
// ===========
gulp.task('build-vendor-css', function() {
  console.log("\n Processing Vendor Assets! ".bgBlue.white.bold);
  return gulp.src(inputVendorCss)
  .pipe(flatten())
  .pipe(concat(vendorConcatName.stylesheets))
  .pipe(gulp.dest(outputVendor.stylesheets));
});
gulp.task('build-vendor-js', function() {
  return gulp.src(inputVendorJs)
  .pipe(flatten())
  .pipe(concat(vendorConcatName.javascript))
  .pipe(gulp.dest(outputVendor.javascript));
});

// =============
// Laravel Tasks
// =============
gulp.task('build-css', function() {
  console.log("\n Processing Laravel Assets! ".bgBlue.white.bold);
  gulp.src(inputLaravelCss)
  // .pipe(gutil.env.env === 'production' ? cssmin() : gutil.noop())
  .pipe(cssmin())
  .pipe(rename({
    suffix: '.min'
  }))
  .pipe(flatten())
  .pipe(gulp.dest(outputLaravel.stylesheets));
});
gulp.task('build-js', function() {
  gulp.src(inputLaravelJsConcat)
  .pipe(concat(laravelConcatName.javascript))
  // .pipe(gutil.env.env === 'production' ? uglify() : gutil.noop())
  .pipe(uglify())
  .pipe(rename({
    suffix: '.min'
  }))
  .pipe(flatten())
  .pipe(gulp.dest(outputLaravel.javascript));

  gulp.src(inputLaravelJsNotConcat)
  // .pipe(gutil.env.env === 'production' ? uglify() : gutil.noop())
  .pipe(uglify())
  .pipe(rename({
    suffix: '.min'
  }))
  .pipe(flatten())
  .pipe(gulp.dest(outputLaravel.javascript));
});
gulp.task('build-images', function() {
  inputLaravelImages.forEach(function(inp){
    images.forEach(function(img){
      var resize_settings = {
        width: img.width,
        crop: img.crop,
        upscale : false
      }
      if (img.hasOwnProperty("height")) {
        resize_settings.height = img.height
      }
      gulp.src(inp.path+img.folder+'/**/*.{'+acceptedImageExtensions+'}')
      .pipe(imageResize(resize_settings))
      .pipe(imagemin({
        progressive: true,
        svgoPlugins: [{removeViewBox: false}],
        use: [pngquant()]
      }))
      .pipe(flatten())
      .pipe(gulp.dest(outputLaravel.images));
    });
    gulp.src(inp.path+'/*.{'+acceptedImageExtensions+'}')
    .pipe(imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [pngquant()]
    }))
    .pipe(flatten())
    .pipe(gulp.dest(outputLaravel.images));
  });
});
gulp.task('build-fonts', function() {
  return gulp.src(inputLaravelFonts)
  .pipe(flatten())
  .pipe(gulp.dest(outputLaravel.fonts))
  .pipe(notify({
    message: "Laravel Tasks Success :)",
    onLast: true
  }));
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

//var elixir = require('laravel-elixir');

//elixir(function(mix) {
    //
//});
