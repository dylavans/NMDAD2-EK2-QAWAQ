/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    // Module declarations
    angular.module('app', [
        // Angular Module Dependencies
        // ---------------------------
        'ngAnimate',
        'ngMaterial',
        'ngMessages',
        'ngResource',

        // Third-party Module Dependencies
        // -------------------------------
        'ui.router', // Angular UI Router: https://github.com/angular-ui/ui-router/wiki

        // Custom Module Dependencies
        // --------------------------

        'app.home',
        'app.products',
        'app.account'

    ]).run(function($rootScope) {

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
            });
        }


        $rootScope.login = function()
        {
            event.preventDefault();
            console.log('login');

        }

        $rootScope.logout = function()
        {
            event.preventDefault();
            console.log('logout');

            localStorage.removeItem('customer_data');
            location.reload();
        }

        $rootScope.register_customer = function()
        {
            if (document.querySelector("input[name=register_email]").value != "" &&
                document.querySelector("input[name=register_password]").value != "" &&
                document.querySelector("input[name=register_confirm_password]").value != "" &&
                document.querySelector("input[name=register_first_name]").value != "" &&
                document.querySelector("input[name=register_last_name]").value != "" &&
                document.querySelector("input[name=register_user_name]").value != "" )
            {
                if (document.querySelector("input[name=register_password]").value == document.querySelector("input[name=register_confirm_password]").value)
                {
                    var settings = {
                        "crossDomain": true,
                        "url": 'http://www.nmdad2.local/api/v1/register',
                        "method": "POST",
                        "headers": {
                            "content-type": "application/x-www-form-urlencoded"
                        },
                        "data": {
                            "email": document.querySelector("input[name=register_email]").value,
                            "password": document.querySelector("input[name=register_password]").value,
                            "first_name": document.querySelector("input[name=register_first_name]").value,
                            "last_name": document.querySelector("input[name=register_last_name]").value,
                            "user_name": document.querySelector("input[name=register_user_name]").value
                        }
                    }

                    $.ajax(settings).done(function (response) {

                        document.querySelector(".md-success").style.display = "block";
                        document.querySelector(".md-success").innerHTML = "Logged in!";

                        var settings = {
                            "crossDomain": true,
                            "url": 'http://www.nmdad2.local/api/v1/customers',
                            "method": "GET"
                        }

                        $.ajax(settings).done(function (data_) {
                            console.log(data_);
                            var customers = data_.length;
                            localStorage.setItem("customer_data", JSON.stringify({
                                'id': customers,
                                'user_name': document.querySelector("input[name=register_user_name]").value,
                                'first_name': document.querySelector("input[name=register_first_name]").value,
                                'last_name': document.querySelector("input[name=register_last_name]").value,
                                'email': document.querySelector("input[name=register_email]").value
                            }));

                            location.reload();
                        });
                    });
                }
            }
            else
            {
                document.querySelector(".md-warn").style.display = "block";
            }
        }

        $rootScope.login_customer = function()
        {
            event.preventDefault();

            var username_form = document.querySelector("input[name=login_user_name]");
            var password_form = document.querySelector("input[name=login_password]");

            if (username_form.value != "" && password_form.value != "")
            {
                $.ajax({"crossDomain": true, "url": 'http://www.nmdad2.local/api/v1/customers', "method": "GET" }).done(function (response){
                    var customers = response;
                    for (var i = 0; i < customers.length; i++)
                    {
                        if (username_form.value == customers[i].user_name && password_form.value == customers[i].password)
                        {
                            console.log('logged in!');

                            localStorage.setItem("customer_data", JSON.stringify({
                                'id': customers[i].id,
                                'user_name': customers[i].user_name,
                                'first_name': customers[i].first_name,
                                'last_name': customers[i].last_name,
                                'email': customers[i].email
                            }));

                            location.reload();
                        }
                    }

                    document.querySelector(".md-warn logged_in").style.display = "block";
                });
            }
        }

        $rootScope.$on('$viewContentLoaded', function() {

            if (localStorage.getItem("customer_data") == null)
            {
                // NOT logged in
                var hide = document.querySelectorAll('.logged_in');
                var show = document.querySelectorAll('.not_logged_in');
                for (var i = 0; i < show.length; i++) show[i].style.display = "block";
                for (var i = 0; i < hide.length; i++) hide[i].style.display = "none";
            }
            else
            {
                // Logged in
                var show = document.querySelectorAll('.logged_in');
                var hide = document.querySelectorAll('.not_logged_in');
                for (var i = 0; i < show.length; i++) show[i].style.display = "block";
                for (var i = 0; i < hide.length; i++) hide[i].style.display = "none";
            }

        });

    });

    angular.module('app.home', []);
    angular.module('app.products', []);
    angular.module('app.account', []);

})();
