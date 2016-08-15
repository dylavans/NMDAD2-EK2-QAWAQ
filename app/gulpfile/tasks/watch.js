/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    gulp.task('watch', [
        'watch:templates',
        'watch:scripts'
    ]);

    gulp.task('watch:templates', () => {
        gulp.watch(CFG.dir.templates.src, ['markup:templates']);
    });

    gulp.task('watch:scripts', () => {
        gulp.watch(`${CFG.dir.src}app/**/*.js`, ['scripts:app']);
    });

})(require('gulp'));