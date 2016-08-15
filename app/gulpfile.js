/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
((fs, yaml) => {
    'use strict';

    try {
        global.isProduction = (process.argv.slice(2).indexOf('--production') >= 0);
        global.CONFIG = yaml.safeLoad(fs.readFileSync('./gulpfile/config.yaml', 'utf8'));

        fs.readdirSync('./gulpfile/tasks')
            .filter(filename => {
                return filename.match(/\.js$/i);
            })
            .map(filename => {
                require(`./gulpfile/tasks/${filename}`);
            });

    } catch (error) {
        console.log(error);
    }

})(require('fs'), require('js-yaml'));