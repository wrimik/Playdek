<?php
include '../class/dbc.php';
include '../class/game.php';

$dbc = dbc::getInstance(false);

$g = new Game();
$get = $g->dbc->cleanArray($_GET);
$games = $g->getGames();

$banners = $g->getBanners(1);

include 'parts/header.php';
?>
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script type="text/javascript" language="javascript">
    function bannersCtrl($scope) {
        $scope.banners = <?php echo json($banners); ?>;
    }
</script>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-12">
            <div class="card" ng-controller="bannersCtrl">
                <h2>BANNERS</h2>

                <form ng-repeat='banner in banners' class='col-xs-12 banner-img-uploads' enctype="multipart/form-data" method="post" action="process/banner-img.php" role="form">
                    <div class="form-group col-xs-8">
                        Current:
                        <img class='banner-small' src='{{banner.src}}'/>
                    </div>
                    <div class='col-xs-4'>
                        <div class="form-group">
                            <input type='hidden' name='id' value='{{banner.b_id}}'/>
                        <br/>
                        <br/>
                            <label>UPDATE SLIDE {{banner.b_id}}</label>
                            <input type="file" name="banner"/>
                            <br/>
                            <label>UPDATE URL</label>
                            <input ng-model='banner.b_url' class='form-control' type="text" name="url"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
