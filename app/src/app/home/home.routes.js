/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.home')
        .config(Routes);

    // Inject dependencies into constructor (needed when JS minification is applied).
    Routes.$inject = [
        // Angular
        '$stateProvider'
    ];

    function Routes(
        // Angular
        $stateProvider
    ) {
        $stateProvider
            .state('home', {
                cache: false, // false will reload on every visit.
                controller: 'HomeController as vm',
                templateUrl: 'html/home/home.view.html',
                url: '/'
            })
            .state('login', {
                cache: false, // false will reload on every visit.
                controller: 'HomeController as vm',
                templateUrl: 'html/home/login.view.html',
                url: '/login'
            })
            .state('about', {
                cache: false, // false will reload on every visit.
                controller: 'HomeController as vm',
                templateUrl: 'html/home/about.view.html',
                url: '/about'
            });
    }

})();
