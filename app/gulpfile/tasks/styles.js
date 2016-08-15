/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    let gulp_if = require('gulp-if'),
        sass    = require('gulp-sass');

    gulp.task('styles', [
        'styles:app'
    ]);

    gulp.task('styles:app', () => {
        gulp.src(`${CFG.dir.src}css/*.scss`)
            .pipe(sass(gulp_if(isProduction, CFG.sass)).on('error', sass.logError))
            .pipe(gulp.dest(`${CFG.dir.dest}css/`));
    });

})(require('gulp'));