<?php
echo $this->Html->script([
    'https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js',
    'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit',
    
        ], ['block' => 'scriptLibraries']
);
$urlToRestApi = $this->Url->build([
    'prefix' => 'api',
    'controller' => 'Vineyards'], true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Vineyards/index', ['block' => 'scriptBottom']);
?>
<!-- salt = 
<?php
use Cake\Utility\Security;
echo Security::salt();
?>
-->

<div  ng-app="app" ng-controller="VineyardCRUDCtrl">
    <div class="float-left">
        <a href="javascript:void(0);" class="btn btn-success" data-type="add" data-toggle="modal" data-target="#modalVineyardAddEdit" ng-click="addModal()"><i class="plus"></i>New vineyard</a>
    </div>
    
    <div class="float-right">
        <a href="javascript:void(0);" class="btn btn-success" data-type="add" data-toggle="modal" data-target="#modalLoginLogout" ng-click="loginModal()"><i class="plus"></i>Login/Logout</a>
    </div>
    
    <p style="color:red;">{{ captcha_status }}</p>

    <p style="color: green">{{message}}</p>
    <p style="color: red">{{errorMessage}}</p>
    
    <table class="hoverable bordered">
        <thead>
            <tr>
                <th class="text-align-center" ng-init="getAllVineyards()">ID</th>
                <th class="width-30-pct">Name</th>
                <th class="text-align-center">Actions</th>
            </tr>
        </thead>
        
        <tbody ng-init="getAllVineyards()">
            
            <tr ng-repeat="vineyard in vineyards| filter:search">
                <td class="text-align-center">
                    {{vineyard.id}}
                </td>
                <td>
                    {{vineyard.name}}
                </td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalVineyardAddEdit" ng-click="getVineyard(vineyard.id)">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" ng-click="deleteVineyard(vineyard.id)">Delete</button>
                </td>
                
            </tr>
            
        </tbody>
        
    </table>
    
    <!-- Modal Add and Edit Form -->
        <div class="modal fade" id="modalVineyardAddEdit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" ng-model="addEditTitle">{{addEditTitle}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="addEditStatusMsg"></div>
                        <form role="form">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter the name" ng-model="vineyard.name">
                            </div>
                            <input type="hidden" class="form-control" name="id" id="id" ng-model="vineyard.id"/>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="vineyardAdd" ng-click="updateVineyard(vineyard)" ng-show="editButton">Update Vineyard</button>
                        <button type="button" class="btn btn-success" id="vineyardEdit" ng-click="addVineyard(vineyard.name)" ng-show="addButton">Add Vineyard</button>
                        
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Modal Login and Logout Form -->
        <div class="modal fade" id="modalLoginLogout" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" ng-model="LoginLogoutTitle">{{LoginLogoutTitle}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="userStatusMsg"></div>
                        <form role="form">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter the username" ng-model="user.username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="Enter the password" ng-model="user.password">
                            </div>
                            
                                <div id="example1"></div> 
                                
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="userLogin" ng-click="login(user)" ng-show="loginButton">Login</button>
                        <button type="button" class="btn btn-success" id="userLogout" ng-click="logout()" ng-show="logoutButton">Logout</button>
                        <button type="button" class="btn btn-success" id="changePassword" ng-click="changePassword(user.password)" ng-show="changePasswordButton">Change password</button>
                    </div>
                </div>
            </div>
        </div>

</div>