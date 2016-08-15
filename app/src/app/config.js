/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app')
        .config(Config);

    /* @ngInject */
    function Config(
        // Angular
        $compileProvider,
        // Angular Material Design
        $mdThemingProvider
    ) {
        // Debugging
        // ---------
        var debug = true; // Set to `false` for production
        $compileProvider.debugInfoEnabled(debug);

        // Angular Material Design
        // -----------------------
        // All built-in colour palettes
        var colour = {
            amber     : 'amber',
            blue      : 'blue',
            blueGrey  : 'blue-grey',
            brown     : 'brown',
            cyan      : 'cyan',
            deepOrange: 'deep-orange',
            deepPurple: 'deep-purple',
            green     : 'green',
            grey      : 'grey',
            indigo    : 'indigo',
            lightBlue : 'light-blue',
            lightGreen: 'light-green',
            lime      : 'lime',
            orange    : 'orange',
            pink      : 'pink',
            purple    : 'purple',
            red       : 'red',
            teal      : 'teal',
            yellow    : 'yellow'
        };

        // `default` theme configuration
        $mdThemingProvider.theme('default')
            .primaryPalette(colour.indigo);

        // `alternative` theme configuration
        $mdThemingProvider.theme('alternative')
            .dark()
            .primaryPalette(colour.blue)
            .accentPalette(colour.lime)
            .warnPalette(colour.orange)
        ;
    }

})();
