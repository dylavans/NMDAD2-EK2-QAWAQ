/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.products')
        .controller('ProductsController', ProductsController);

    // Inject dependencies into constructor (needed when JS minification is applied).
    ProductsController.$inject = [
        // Angular
        '$log',
        '$scope',
        '$http'
    ];

    function ProductsController(
        // Angular
        $log,
        $scope,
        $http
    ) {
        // ViewModel
        var vm = this;

        // User Interface
        vm.$$ui = {
            classname: 'Store'
        };

        var data_to_fill = [];
        var per_click = 20;
        var data = [];
        var clicks = 1;

        $http.get('http://nmdad2.local/api/v1/products').success(function(data_)
        {
            if (data_.length > per_click)
            {
                // Show more button
                $('.md-fab .cta__more').css({"display": "block"});

                // Add the next entries
                for (var i = 0; i < per_click; i++)
                {
                    // Dont go out of index
                    if (i != data_.length)
                    {
                        data_to_fill.push(data_[i]);
                    }
                }

                // Fill datav
                $scope.products = data_to_fill;
            }
            else
            {
                // Hide more button
                $('.md_fab .cta__more').css({"display": "none"});
                $scope.products = data_;
            }

            data = data_;
        });

        $scope.addProducts = addProducts;

        function addProducts(e) {

            e.preventDefault();
            clicks++;

            for (var i = per_click * (clicks - 1); i < per_click * clicks; i++) {
                // Dont go out of index
                if (i < data.length) {
                    console.log(i);
                    data_to_fill.push(data[i]);
                }
                else
                {
                    if (data.length <= document.querySelectorAll(".product").length)
                    {
                        // Show more button
                        $('.md_fab .cta__more').css({"display": "block"});
                    }
                    else
                    {
                        // Hide more button
                        $('.md_fab .cta__more').css({"display": "none"});
                        $('.md_fab .cta__more .end').css({"display": "block"});
                        $scope.products = data;
                    }
                }
            }

            $scope.products = data_to_fill;
        }

    }

})();
