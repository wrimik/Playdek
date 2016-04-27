<?php
include '../class/dbc.php';
include '../class/game.php';

$g = new Game();
$get = $g->dbc->cleanArray($_GET);

$games = $g->getGames();

if ($get['game_id']) {
    $game = $g->getGame($get['game_id']);
} else {
    $game = $g->defaultGame();
}

include 'parts/header.php';
?>
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script type="text/javascript" language="javascript">
    function bannersCtrl($scope) {
        $scope.banners = [
            {
                'id':1,
                'src': '../uploads/banners-home/1.jpg'
            },
            {
                'id':2,
                'src': '../uploads/banners-home/2.jpg'
            },
            {
                'id':3,
                'src': '../uploads/banners-home/3.jpg'
            },
            {
                'id':4,
                'src': '../uploads/banners-home/4.jpg'
            },
            {
                'id':5,
                'src': '../uploads/banners-home/5.jpg'
            },
            {
                'id':6,
                'src': '../uploads/banners-home/6.jpg'
            }
        ];
    }
</script>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-12">
            <div class="card" ng-controller="bannersCtrl">
                <h2>BANNERS</h2>

                <form ng-repeat='banner in banners' class='col-xs-5 banner-img-uploads' enctype="multipart/form-data" method="post" action="process/banner-img.php" role="form">
                    <div class="form-group">
                        <label>SLIDE {{banner.id}}</label>
                        <input type='hidden' name='id' value='{{banner.id}}'/>
                        <input type="file" name="banner"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                    </div>
                    <div class="form-group">
                        Current:
                        <img class='banner-small' src='{{banner.src}}'/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

<?php
include '../parts/footer.php';