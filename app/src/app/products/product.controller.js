/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.products')
        .controller('ProductController', ProductController);

    ProductController.$inject = [ '$log', '$scope', '$rootScope', '$http', '$state' ];

    function ProductController($log, $scope, $rootScope, $http, $state) {

        var vm = this;
        vm.$$ui = { classname: 'Product Details' }

        var params = { product_id: $state.params.product_id };

        $http.get('http://nmdad2.local/api/v1/products/').success(function(product_id);



        $scope.placeOrder = function(){
            event.preventDefault();

            // Refresh user data
            if (localStorage.getItem('customer_data') != null)
            {
                $.ajax({
                    "async": true,
                    "crossDomain": true,
                    "url": "http://www.nmdad2.local/api/v1/customers/" + JSON.parse(localStorage.getItem('customer_data')).id,
                    "method": "GET"
                }).done(function (response) {
                    localStorage.setItem("customer_data", JSON.stringify({
                        'id': response[0].id,
                        'user_name': response.user_name,
                        'first_name': response[0].first_name,
                        'last_name': response[0].last_name,
                        'email': response[0].email
                    }));

                    document.querySelector(".md-warn").style.display = "none";

                    document.querySelector(".md-success").style.display = "block";
                    document.querySelector(".md-success").innerHTML = "Bestelling geplaatst!";


                    // DO JSON POST
                    var settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "http://www.nmdad2.local/api/v1/orders/add",
                        "method": "POST",
                        "headers": {
                            "content-type": "application/x-www-form-urlencoded"
                        },
                        "data": {
                            "customer_id": JSON.parse(localStorage.getItem('customer_data')).id,
                            "product_id": params.product_id
                        }
                    }

                    $.ajax(settings).done(function (response) {
                        console.log(response);
                    });

                });
            } else {
                document.querySelector(".md-warn").style.display = "block";
            }
        };
    }

})();
