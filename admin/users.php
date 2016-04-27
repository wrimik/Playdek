<?php
include '../class/dbc.php';
include '../class/game.php';

$dbc = dbc::getInstance(false);

$users = $dbc->getUsers();

include 'parts/header.php';
?>
<script type="text/javascript" language="javascript">
    function usersCtrl($scope) {
        $scope.users = <?php echo json($users); ?>;
    }
</script>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-12">
            <div class="card" ng-controller="usersCtrl">
                <form class='col-xs-6' method="post" action="process/add-user.php" role="form">
                    <div class='col-xs-12'>
                        <h2>ADD USER</h2>
                        <div class="form-group">
                            <label>USERNAME</label>
                            <input type='text' name='user'/>
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input type='text' name='pass'/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">ADD</button>
                        </div>
                    </div>
                </form>
                <div class='col-xs-6'>
                    <h2>Existing Users:</h2>
                    <div ng-repeat="user in users">
                        {{user.username}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
