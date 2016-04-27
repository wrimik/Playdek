<?php
include 'class/dbc.php';
include 'class/game.php';

$game->rootLocation = '';

$get  = $game->dbc->cleanArray($_GET);
$profile = $game->getGame($get['game_id']);
$dlc     = $game->getGameDlc($get['game_id']);

include 'parts/header.php';
?>
<!--  FANCYBOX STUFF -->
<link rel="stylesheet" href="fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" href="fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<link rel="stylesheet" href="fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<!--   END FANCYBOX STUFF -->

<script type="text/javascript" language="javascript">
    game = <?php echo json($profile); ?>;
    dlc  = <?php echo json($dlc); ?>;
    function gameCtrl($scope){
        $scope.game = game;
    }
    function dlcCtrl($scope){
        $scope.dlc = dlc;
    }
    $(document).ready(function(){
        $('#game_top').html(game.game_top);
        $('#game_bottom').html(game.game_bottom);
    });
    $(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    });
</script>
<div class="container-fluid primary" ng-controller="gameCtrl">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <img class="game-banner" src="uploads/banners/{{game.game_banner}}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="row pb40">
                    <div class="col-sm-8 col-xs-12">
                        <h2>
                            Welcome to {{game.game_name}}!
                        </h2>
                        <div id="game_top">
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12 game-specs pull-right">
                        <h2>AVAILABILITY</h2>
                        <span ng-repeat="a in game.available">
                            <span class="glyphicon glyphicon-ok"></span> {{a.name}} <br/>
                        </span>
                        <br/>
                        <i>{{game.game_ios_v}}</i><br/>
                        <i>{{game.game_android_v}}</i>
                        
                        <a class="btn btn-primary" href="{{game.game_itunes}}" >iTUNES &#9658;</a>
                        <a class="btn btn-primary" href="{{game.game_google_play}}">GOOGLE PLAY &#9658;</a>
                        <a class="btn btn-primary" href="{{game.game_amazon}}">AMAZON &#9658;</a>
                        <a class="btn btn-primary" href="{{game.game_pc}}">PC &#9658;</a>
                        <a class="btn btn-primary" href="{{game.game_steam}}">STEAM &#9658;</a>
                        <a class="btn btn-primary" href="{{game.game_mac}}">MAC &#9658;</a>
                        <a class="btn btn-primary" href="{{game.game_forum}}">VISIT THE FORUMS &#9658;</a>
                    </div>
                </div>
                <div align="center" class="game-imgs">
                    <div class='game-thumb' ng-repeat="img in game.imgs">
                        <a class="fancybox" rel="gallery1" href="{{img}}">
                            <img src="{{img}}"/>
                        </a>
                    </div>
                </div>
                <div ng-controller="dlcCtrl" id="dlc" align="center" class='col-xs-12 np'>
                    <h2>EXPANSIONS</h2>
                    <div id='dlc-titles' class="col-xs-3 np">
                        <div class='dlc-title' ng-repeat="d in dlc | filter: {dlc_published : '1'}">
                            {{d.dlc_title}}
                        </div>
                    </div>
                    <div id='dlc-content' class="col-xs-9 np">
                        <div class='dlc-content' ng-repeat="d in dlc | filter: {dlc_published : '1'}">
                            <h3>{{d.dlc_title}}</h3>
                            <div class="htmlsafe">{{d.dlc_content}}</div>
                            <div align="center" class="game-imgs">
                                <div class='game-thumb' ng-repeat="img in d.imgs">
                                    <a class="fancybox" rel="gallery{{d.dlc_id}}" href="{{img}}">
                                        <img src="{{img}}"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="card  game-desc">
                <div class="row pb40">                
                    <h1>{{game.game_name}}</h1>
                    <div class="col-sm-6">
                        <div class="list-head">
                            HIGHLIGHTS
                        </div>
                        <div class="list-body">
                            <div ng-repeat="highlight in game.highlights" class="card">
                                {{highlight}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="list-head">
                            FEATURES
                        </div>
                        <div class="list-body">
                            <div ng-repeat="feature in game.features" class="card">
                                {{feature}}
                            </div>
                        </div>
                    </div> 
                </div>
                
                <div class="row pb40">
                    <div id="game_bottom"></div>
                    <div class="row game-over">
                        <div class="col-sm-5">
                            <h3><a href="games.php">Check Out Our Other Games</a></h3>
                        </div>
                        <div class="col-sm-1">
                            <h4>OR</h4>
                        </div>
                        <div class="col-sm-6">
                            <a target="_blank" href="{{game.game_itunes}}" class="btn btn-primary btn-big">VISIT iTUNES TO DOWNLOAD  &#9658;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'parts/footer.php';