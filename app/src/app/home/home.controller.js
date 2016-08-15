/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.home').controller('HomeController', HomeController);

    // Inject dependencies into constructor (needed when JS minification is applied).
    HomeController.$inject = ['$log', '$scope', '$http'];

    function HomeController($log, $scope, $http)
    {
        var vm = this;
        vm.$$ui = { classname: 'Home' };

        var data_to_fill = [];

        // Do JSON
        $http.get('http://nmdad2.local/api/v1/products/').success(function(data_) {
            for (var i = 0; i < 3; i++)
                data_to_fill.push(data_[(data_.length - 1) - i]);

            $scope.products = data_to_fill;
        });
    }

})();
