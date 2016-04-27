<?php

include '../class/dbc.php';
include '../class/forum.php';
$dbc = dbc::getInstance(false);
$forum = new Forum();
$get     = $forum->dbc->cleanArray($_GET);
$links   = $forum->getLinks(6);
include 'parts/header.php';
?>
<script type='text/javascript' language='javascript'>
    function forumCtrl($scope){
        $scope.links = <?php echo json($links); ?>
    }
</script>
 
<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <div class="card" >
                <h1>FORUM LINKS</h1>
                <form id="sortable" ng-controller='forumCtrl' role="form" method="post" action="process/forum.php">
                    <div class="forum_link" ng-repeat="link in links">
                        <div class="col-xs-6" id='preview'>
                            <div class="form-group">
                                <label>TEXT</label>
                                <input class="form-control" value="{{link.fl_text}}" type="text" name="text[]"/>
                            </div>
                        </div>
                        <div class="col-xs-6" id='preview'>
                            <div class="form-group">
                                <label>URL</label>
                                <input class="form-control" value="{{link.fl_url}}" placeholder="http://www.example.com/" type="text" name="urls[]"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
