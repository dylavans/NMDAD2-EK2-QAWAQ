/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    let serve       = require('gulp-serve'),
        browserSync = require('browser-sync').create();

    gulp.task('serve:server',
        serve(CFG.serve));

    gulp.task('serve:browser-sync', ['watch'], () => {
        browserSync.init(CFG.browserSync);
        gulp.watch(`${CFG.browserSync.server.baseDir}**/*`).on('change', browserSync.reload);
    });

})(require('gulp'));