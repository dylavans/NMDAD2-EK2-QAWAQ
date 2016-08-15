/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.account').controller('AccountController', AccountController);

    ProductController.$inject = [ '$log', '$scope', '$http'];

    function AccountController($log, $scope, $http)
    {
        var vm = this;
        vm.$$ui = { classname: 'Account' }

        var customer_data = JSON.parse(localStorage.getItem('customer_data'));

        $scope.first_name = customer_data.first_name;
        $scope.last_name = customer_data.last_name;

        /*
        $http.get('http://www.nmdad2.local/api/v1/orders/customers/' + customer_data.id).success(function(response) {

            $scope.my_orders = response;
            console.log('dataOrders opgehaald :)');

        });
        */

        var data_to_fill = [];
        var per_click = 10;
        var data = [];
        var clicks = 1;

        $http.get('http://www.nmdad2.local/api/v1/orders/customers' + customer_data.id).success(function(data_)
        {
            console.log("test");

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
                $scope.orders = data_to_fill;
            }
            else
            {
                // Hide more button
                $('.md_fab .cta__more').css({"display": "none"});
                $scope.orders = data_;
            }

            data = data_;
        });

        $scope.addOrders = addOrders;

        function addOrders(e) {

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
                    if (data.length <= document.querySelectorAll(".order").length)
                    {
                        // Show more button
                        $('.md_fab .cta__more').css({"display": "block"});
                    }
                    else
                    {
                        // Hide more button
                        $('.md_fab .cta__more').css({"display": "none"});
                        $('.md_fab .cta__more .end').css({"display": "block"});
                        $scope.orders = data;
                    }
                }
            }

            $scope.orders = data_to_fill;
        }


        $scope.updateName = function() {
            if (document.querySelector('input[name=first_name]').value != "" && document.querySelector('input[name=last_name]').value != "")
            {
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "http://www.nmdad2.local/api/v1/customers/" + customer_data.id + "/update",
                    "method": "POST",
                    "headers": {
                        "content-type": "application/x-www-form-urlencoded"
                    },
                    "data": {
                        "last_name": document.querySelector('input[name=last_name]').value,
                        "first_name": document.querySelector('input[name=first_name]').value
                    }
                }

                $.ajax(settings).done(function (response) {


                    document.querySelector('.update_name').style.display = "none";
                    document.querySelector('.updated').style.display = "block";

                    location.reload();
                });
            }
        }

        $scope.deleteAccount = function() {
            if (localStorage.getItem('customer_data') != null)
            {
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "http://www.nmdad2.local/api/v1/customers/" + customer_data.id + "/delete",
                    "method": "DELETE",
                    "headers": {
                        "content-type": "application/x-www-form-urlencoded"
                    }
                }

                $.ajax(settings).done(function (response) {

                    localStorage.removeItem('customer_data');
                    location.reload();

                });
            }
        }
    }

})();
