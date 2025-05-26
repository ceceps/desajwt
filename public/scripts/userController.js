//Untuk Anggular
(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('UserController', UserController);

    function UserController($http, $auth, $rootScope) {

        var vm = this;

        vm.users;
        vm.error;

        vm.getUsers = function() {

            // This request will hit the index method in the AuthenticateController
            // on the Laravel side and will return the list of users
            $http.get('api/user').then(function(response) {
                vm.users = response.data;
            });

            // $http.get('/api/usser').success(function(users) {
            //            vm.users = users;
            // });
        }

        vm.logout = function() {

            $auth.logout().then(function() {

              // Remove the authenticated user from local storage
              localStorage.removeItem('user');

              // Flip authenticated to false so that we no longer
              // show UI elements dependant on the user being logged in
              $rootScope.authenticated = false;

              // Remove the current user info from rootscope
              $rootScope.currentUser = null;
            });
          }
    }

/*
    angular.module('authApp').factory('UserController', function($http) {
        var vm = this;

        vm.users;
        vm.error;
        return {
            getUsers: function() {
                return $http.get('/api/login').then(function(users) {
                    return response.users;
                });
            }
        };
    }); */

})();
