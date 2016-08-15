/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    let concat = require('gulp-concat');

    gulp.task('vendor', [
        'vendor:angular',
        'vendor:faker',
        'vendor:font-awesome',
        'vendor:lodash'
    ]);

    gulp.task('vendor:angular', () => {
        let extension = isProduction ? 'min.js' : 'js'

        return gulp // JavaScript
            .src([
                `${CFG.dir.node}angular/angular.${extension}`,
                `${CFG.dir.node}angular-animate/angular-animate.${extension}`,
                `${CFG.dir.node}angular-aria/angular-aria.${extension}`,
                `${CFG.dir.node}angular-material/angular-material.${extension}`,
                `${CFG.dir.node}angular-messages/angular-messages.${extension}`,
                `${CFG.dir.node}angular-resource/angular-resource.${extension}`,
                `${CFG.dir.node}angular-ui-router/release/angular-ui-router.${extension}`
            ])
            .pipe(concat('angular.js'))
            .pipe(gulp.dest(`${CFG.dir.vendor}angular/`));
    });

    gulp.task('vendor:faker', () => {
        return gulp // JavaScript
            .src(`${CFG.dir.node}faker/build/build/faker.min.js`)
            .pipe(gulp.dest(`${CFG.dir.vendor}faker/`));
    });

    gulp.task('vendor:font-awesome', () => {
        gulp // Fonts
            .src(`${CFG.dir.node}font-awesome/fonts/*`)
            .pipe(gulp.dest(`${CFG.dir.vendor}font-awesome/fonts/`));
        gulp // CSS
            .src(`${CFG.dir.node}font-awesome/css/*.*.*`)
            .pipe(gulp.dest(`${CFG.dir.vendor}font-awesome/css/`));

        return gulp;
    });

    gulp.task('vendor:lodash', () => {
        return gulp // JavaScript
            .src(`${CFG.dir.node}lodash/lodash.min.js`)
            .pipe(gulp.dest(`${CFG.dir.vendor}lodash/`));
    });

})(require('gulp'));
