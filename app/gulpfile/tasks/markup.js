/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    gulp.task('markup', [
        'markup:app',
        'markup:templates',
        'markup:images'
    ]);

    gulp.task('markup:app', () => {
        gulp.src(`${CFG.dir.src}*.html`)
            .pipe(gulp.dest(CFG.dir.dest));
    });

    gulp.task('markup:templates', () => {
        gulp.src(CFG.dir.templates.src)
            .pipe(gulp.dest(CFG.dir.templates.dest));
    });

    gulp.task('markup:images', () => {
        gulp.src(CFG.dir.images.src)
            .pipe(gulp.dest(CFG.dir.images.dest));
    });

})(require('gulp'));
