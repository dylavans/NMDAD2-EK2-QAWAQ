/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    let concat     = require('gulp-concat'),
        gulp_if    = require('gulp-if'),
        ngAnnotate = require('gulp-ng-annotate'),
        uglify     = require('gulp-uglify');

    gulp.task('scripts', [
        'scripts:app'
    ]);

    gulp.task('scripts:app', () => {
        return gulp.src(`${CFG.dir.src}app/**/*.js`)
            .pipe(concat('app.js', CFG.concat))
            .pipe(ngAnnotate(CFG.ngAnnotate))
            .pipe(gulp_if(isProduction, uglify(CFG.uglify)))
            .pipe(gulp.dest(`${CFG.dir.dest}js/`));
    });

})(require('gulp'));
