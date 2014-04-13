/*
    See dev dependencies https://gist.github.com/isimmons/8927890
    Compiles sass to compressed css with autoprefixing
    Compiles coffee to javascript
    Livereloads on changes to coffee, sass, and blade templates
    Runs PHPUnit tests
    Watches sass, coffee, blade, and phpunit
    Default tasks sass, coffee, phpunit, watch
*/

var gulp = require('gulp');
var gutil = require('gulp-util');
var notify = require('gulp-notify');
var phpunit = require('gulp-phpunit');//notify requires >= v 0.0.3


// livereload
var livereload = require('gulp-livereload');
var lr = require('tiny-lr');
var server = lr();

//uncomment for growl notify for windows users
//Specify custom icon by passing object to growl() { icon: fs.readFileSync('path_to_icon_file') } 
//var growl = ('gulp-notify-growl');
//var growlNotifier = growl();

//CSS directories
var targetCSSDir = 'public/css';

//javascript directories
var targetJSDir = 'public/js';

// blade directory
var bladeDir = 'app/views';

// Tasks
/* Blade Templates */
gulp.task('blade', function() {
    return gulp.src(bladeDir + '/**/*.blade.php')
        .pipe(livereload(server));
});

/* PHPUnit */
gulp.task('phpunit', function() {
    //notify defaults to false. If you don't want to use a notifier or worry with errors in this task leave it off
    var options = {debug: false, notify: true} 
    gulp.src('app/tests/*.php')
        .pipe(phpunit('', options)) //empty phpunit path defaults ./vendor/bin/phpunit for windows specify with double back slashes
        
        //both notify and notify.onError will take optional notifier: growlNotifier for windows notifications
        //if options.notify is true be sure to handle the error here or suffer the consequenses!
        .on('error', notify.onError({
            title: 'PHPUnit Failed',
            message: 'One or more tests failed, see the cli for details.'
        }))
        
        //will fire only if no error is caught
        .pipe(notify({
            title: 'PHPUnit Passed',
            message: 'All tests passed!'
        }));
});

/* Watcher */
gulp.task('watch', function() {
    
    server.listen(35729, function(err) {
        if(err) {console.log(err);}

        gulp.watch(bladeDir + '/**/*.blade.php', ['blade']);
    });

    //gulp.watch('app/**/*.php', ['phpunit']); 
});

/* Default Task */
gulp.task('default', ['watch']);