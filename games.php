<?php
include 'class/dbc.php';
include 'class/game.php';
include 'parts/header.php';
?>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <div class="card sp caption page-title">
                    <span class="glyphicon glyphicon-tower"></span> 
                    <h1>PLAYDEK GAMES</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row game-previews" ng-controller="gamesCtrl">
        <div ng-repeat="game in games | filter:{game_published:1}" class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <a href="game.php?game_id={{game.game_id}}">{{game.game_name}}
                <img class="game-banner-sm" src="uploads/banners/{{game.game_banner}}"/>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
include 'parts/footer.php';