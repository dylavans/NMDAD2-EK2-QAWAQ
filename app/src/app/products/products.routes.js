/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.products')
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
            .state('products', {
                cache: false, // false will reload on every visit.
                controller: 'ProductsController as vm',
                templateUrl: 'html/products/products.view.html',
                url: '/products'
            })
            .state('product', {
                cache: false, // false will reload on every visit.
                controller: 'ProductController as vm',
                templateUrl: 'html/products/product.view.html',
                url: '/products/{product_id:int}'
            });
    }

})();
