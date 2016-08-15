/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
(gulp => {
    'use strict';

    const CFG = global.CONFIG;

    let exec = require('child_process').exec;

    gulp.task('default', [
        'default:remove',
        'vendor',
        'markup',
        'scripts',
        'styles'
    ]);

    gulp.task('default:remove', () => {
        exec(`rm -rf ${CFG.dir.dest}`);
    });

})(require('gulp'));