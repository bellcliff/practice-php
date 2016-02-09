(function(window) {

    "use strict";

    angular.module('main', ['ui.bootstrap'])
        .controller('PageCtrl', function($scope, $http) {
            $scope.currentPage = 1;
            $scope.perPage = 10;

            $scope.$watch('currentPage', function(n, o) {
                console.log(n, o);
                $http({
                    url: '/test.php',
                    method: 'GET',
                    params: {
                        page: n,
                        per: $scope.perPage
                    }
                }).then(function(data) {
                    $scope.interviews = data.data.items;
                    $scope.totalItems = data.data.count;
                });
            });
        });
})(this);
