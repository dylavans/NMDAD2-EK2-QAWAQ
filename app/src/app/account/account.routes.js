/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.account')
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
            .state('account', {
                cache: false, // false will reload on every visit.
                controller: 'AccountController as vm',
                templateUrl: 'html/account/account.view.html',
                url: '/account'
            });
            /*
            .state('orders', {
                cache: false, // false will reload on every visit.
                controller: 'AccountController as vm',
                templateUrl: 'html/account/orders.view.html',
                url: '/account/orders'
            });
            */
    }

})();
