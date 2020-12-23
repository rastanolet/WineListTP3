var onloadCallback = function() {
        widgetId1 = grecaptcha.render('example1', {
            'sitekey' : '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
            'theme' : 'light'
        });
};

var app = angular.module('app', []);

var urlToRestApiUsers = urlToRestApi.substring(0, urlToRestApi.lastIndexOf('/') + 1) + 'users';

app.controller('VineyardCRUDCtrl', ['$scope', 'VineyardCRUDService', function ($scope, VineyardCRUDService) {

        $scope.editModal = function() {
            $scope.addEditTitle = "Modify Vineyard";
            $scope.editButton = true;
            $scope.addButton = false;
        }
        $scope.updateVineyard = function (vineyard) {
            VineyardCRUDService.updateVineyard(vineyard)
                    .then(function success(response) {
                        $scope.message = 'Vineyard data updated!';
                        $scope.errorMessage = '';
                        
                        $scope.getAllVineyards();
                    },
                            function error(response) {
                                $scope.errorMessage = 'Error updating vineyard!';
                                $scope.message = '';
                            });
        }

        $scope.getVineyard = function (id) {
 //           var id = $scope.vineyard.id;
            $scope.editModal();
            VineyardCRUDService.getVineyard(id)
                    .then(function success(response) {
                        $scope.vineyard = response.data.vineyard;
                        $scope.vineyard.id = id;
                        $scope.message = '';
                        $scope.errorMessage = '';
                    },
                            function error(response) {
                                $scope.message = '';
                                if (response.status === 404) {
                                    $scope.errorMessage = 'Vineyard not found!';
                                } else {
                                    $scope.errorMessage = "Error getting vineyard!";
                                }
                            });
        }
        
        $scope.addModal = function() {
            $scope.addEditTitle = "Add a Vineyard";
            $scope.addButton = true;
            $scope.editButton = false;
        }

        $scope.addVineyard = function () {
            if ($scope.vineyard != null && $scope.vineyard.name) {
                VineyardCRUDService.addVineyard($scope.vineyard.name)
                        .then(function success(response) {
                            $scope.message = 'Vineyard added!';
                            $scope.errorMessage = '';
                            
                            $scope.getAllVineyards();
                        },
                                function error(response) {
                                    $scope.errorMessage = 'Error adding vineyard!';
                                    $scope.message = '';
                                });
            } else {
                $scope.errorMessage = 'Please enter a name!';
                $scope.message = '';
            }
        }

        $scope.deleteVineyard = function () {
            VineyardCRUDService.deleteVineyard($scope.vineyard.id)
                    .then(function success(response) {
                        $scope.message = 'Vineyard deleted!';
                        $scope.vineyard = null;
                        $scope.errorMessage = '';
                        
                        $scope.getAllVineyards();
                    },
                            function error(response) {
                                $scope.errorMessage = 'Error deleting vineyard!';
                                $scope.message = '';
                            })
        }

        $scope.getAllVineyards = function () {
            VineyardCRUDService.getAllVineyards()
                    .then(function success(response) {
                        $scope.vineyards = response.data.vineyards;
                        $scope.message = '';
                        $scope.errorMessage = '';
                    },
                            function error(response) {
                                $scope.message = '';
                                $scope.errorMessage = 'Error getting vineyards!';
                            });
        }
        $scope.loginModal = function() {
            
            if($scope.user != null){
                $scope.LoginLogoutTitle = "User";
                $scope.logoutButton = true;
                $scope.changePasswordButton = true;
                $scope.loginButton = false;
            } else{
                $scope.LoginLogoutTitle = "Login";
                $scope.loginButton = true;
                $scope.logoutButton = false;
                $scope.changePasswordButton = false;
            }
        }
        $scope.login = function () {
            $scope.loginModal();
            if(grecaptcha.getResponse(widgetId1)==''){
                $scope.captcha_status='Please verify captha.';
                return;
            }
            if ($scope.user != null && $scope.user.username) {
                VineyardCRUDService.login($scope.user)
                        .then(function success(response) {
                            $scope.message = $scope.user.username + ' in session!';
                            $scope.errorMessage = '';
                            localStorage.setItem('token', response.data.data.token);
                            localStorage.setItem('user_id', response.data.data.id);
                        },
                                function error(response) {
                                    $scope.errorMessage = 'The username or pasword was invalide...';
                                    $scope.message = '';
                                });
            } else {
                $scope.errorMessage = 'Please enter a username';
                $scope.message = '';
            }

        }
        

        
        $scope.logout = function () {
            $scope.loginModal();
            localStorage.setItem('token', "no token");
            localStorage.setItem('user', "no user");
            $scope.message = '';
            $scope.errorMessage = 'User disconnected!';
        }
        $scope.changePassword = function () {
            VineyardCRUDService.changePassword($scope.user.password)
                    .then(function success(response) {
                        $scope.message = 'Password updated!';
                        $scope.errorMessage = '';
                    },
                            function error(response) {
                                $scope.errorMessage = 'Password couldn\'t be changed!';
                                $scope.message = '';
                            });
        }

    }]);

app.service('VineyardCRUDService', ['$http', function ($http) {

        this.getVineyard = function getVineyard(vineyardId) {
            return $http({
                method: 'GET',
                url: urlToRestApi + '/' + vineyardId,
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            });
        }

        this.addVineyard = function addVineyard(name) {
            return $http({
                method: 'POST',
                url: urlToRestApi,
                data: {name: name},
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            });
        }

        this.deleteVineyard = function deleteVineyard(id) {
            return $http({
                method: 'DELETE',
                url: urlToRestApi + '/' + id,
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            })
        }

        this.updateVineyard = function updateVineyard(vineyard) {
            return $http({
                method: 'PATCH',
                url: urlToRestApi + '/' + vineyard.id,
                data: {name: vineyard.name},
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")}
            })
        }

        this.getAllVineyards = function getAllVineyards() {
            return $http({
                method: 'GET',
                url: urlToRestApi,
                headers: { 'X-Requested-With' : 'XMLHttpRequest',
                    'Accept' : 'application/json'}
            });
        }
        
        this.login = function login(user) {
            return $http({
                method: 'POST',
                url: urlToRestApiUsers + '/token',
                data: {username: user.username, password: user.password},
                headers: {'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'}
            });
        }
        this.changePassword = function changePassword(password) {
            return $http({
                method: 'PATCH',
                url: urlToRestApiUsers + '/' + localStorage.getItem("user_id"),
                data: {password: password},
                headers: {'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem("token")
                }
            })
        }

    }]);



