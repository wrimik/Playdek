<?php
include '../class/dbc.php';
include '../class/game.php';

$dbc = dbc::getInstance(false);

$g = new Game();
$get = $g->dbc->cleanArray($_GET);

$games = $g->getGames();

if ($get['game_id']) {
    $game = $g->getGame($get['game_id']);
    $dlc = $g->getGameDlc($get['game_id']);
} else {
    $game = $g->defaultGame();
}

include 'parts/header.php';
?>
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script type="text/javascript" language="javascript">
    var gameList = <?php echo json($games); ?>;
    var game = <?php echo json($game); ?>;
    var dlc = <?php echo json($dlc); ?>;

    function gameListCtrl($scope) {
        $scope.gameList = gameList;
    }
    function gameCtrl($scope) {
        $scope.game = game;
    }
    function dlcCtrl($scope) {
        $scope.dlc = dlc;
    }
//    function gameImgCtrl($scope){
//        $scope.imgs = imgs;
//    }
</script>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <div class="card" ng-controller="gameCtrl">
                <h1>PLAYDEK ADMIN</h1>
                <form role="form" method="post" action="process/save-game.php">
                    <input value="{{game.game_id}}" type="hidden" name="game_id"/>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>GAME NAME</label>
                            <input name="game_name" value="{{game.game_name}}" class="form-control" type="text" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>STATUS</label><br/>
                            <label class="col-xs-6">
                                <input ng-model='game.game_published' type="radio" name="game_published" value="1"/>
                                Published
                            </label>
                            <label class="col-xs-6">
                                <input ng-model='game.game_published' type="radio" name="game_published" value="0"/>
                                Hidden
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>TOP CONTENT</label>
                            <textarea class="ckeditor" name="game_top">{{game.game_top}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>FEATURES <i class='hint'>Separate with <b>2</b> new lines</i></label>
                            <textarea style="height:225px" class="form-control" name="game_features">{{game.nl_features}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>HIGHLIGHTS <i class='hint'>Separate with <b>2</b> new lines</i></label>
                            <textarea style="height:225px" class="form-control" name="game_highlights" >{{game.nl_highlights}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>BOTTOM CONTENT</label>
                            <textarea class="ckeditor" name="game_bottom">{{game.game_bottom}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>AVAILABLE ON</label><br/>
                            <label class="avail">
                                <input name="available[iphone]" value="iPhone" ng-model="game.available.iPhone.on" type="checkbox" />
                                iPhone
                            </label>
                            <label class="avail">
                                <input name="available[ipod_touch]" value="iPod Touch" ng-model="game.available.iPod_Touch.on" type="checkbox" />
                                iPod Touch
                            </label>
                            <label class="avail">
                                <input name="available[ipad]" value="iPad" ng-model="game.available.iPad.on" type="checkbox" />
                                iPad
                            </label>
                            <label class="avail">
                                <input name="available[ipad_mini]" value="iPad Mini" ng-model="game.available.iPad_Mini.on" type="checkbox" />
                                iPad Mini
                            </label>
                            <label class="avail">
                                <input name="available[android]" value="Android" ng-model="game.available.Android.on" type="checkbox" />
                                Android
                            </label>
                            <label class="avail">
                                <input name="available[pc]" value="PC" ng-model="game.available.Android.on" type="checkbox" />
                                PC
                            </label>
                            <label class="avail">
                                <input name="available[steam]" value="Steam" ng-model="game.available.Android.on" type="checkbox" />
                                Steam
                            </label>
                            <label class="avail">
                                <input name="available[mac]" value="Mac" ng-model="game.available.Android.on" type="checkbox" />
                                Mac
                            </label>
                            <!--   If you add an option, pdate games class:  $this->available  = array   add zero option with same name-->
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>iOS Version</label>
                                    <input name="game_ios_v" value="{{game.game_ios_v}}" placeholder="REQUIRES iOS 4.3 OR LATER" class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Android Version</label>
                                    <input name="game_android_v" value="{{game.game_android_v}}" placeholder="REQUIRES ANDROID JELLY BEAN OR LATER" class="form-control" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>iTunes URL</label>
                                    <input name="game_itunes" value="{{game.game_itunes}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Google Play URL</label>
                                    <input name="game_google_play" value="{{game.game_google_play}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Amazon URL</label>
                                    <input name="game_amazon" value="{{game.game_amazon}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>PC URL</label>
                                    <input name="game_pc" value="{{game.game_pc}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Steam URL</label>
                                    <input name="game_steam" value="{{game.game_steam}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Mac URL</label>
                                    <input name="game_mac" value="{{game.game_mac}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Forum URL</label>
                                    <input name="game_forum" value="{{game.game_forum}}" class="form-control clean-url" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="security_bug_fix" value="1"/>
                        <button type="submit" id="clean-urls" class="btn btn-primary pull-right">SUBMIT</button>
                    </div>
                </form>
            </div>
            <hr/>

            <div class="card new_hide_{{game.game_id}}" ng-controller="gameCtrl">
                <h1>IMAGE MANAGER</h1>
                <div class='row'>
                    <form class='col-xs-6' enctype="multipart/form-data" method="post" action="process/game-img.php" role="form">
                        <div class="form-group">
                            <label>Add Game Gallery Images</label>
                            <input type='hidden' name='type' value='1'/>
                            <input type='hidden' name='game_id' value='{{game.game_id}}'/>
                            <input type="file" name="imgs[]" multiple/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <hr/>
                <div ng-repeat="img in game.imgs" class="game-img">
                    <div class='delete' data-id='{{img}}'>Remove Image</div>
                    <img src="{{img}}"/>
                </div>
                <div class='row'>
                    <form class='col-xs-12' enctype="multipart/form-data" method="post" action="process/game-img.php" role="form">
                        <div class="form-group">
                            <hr/>
                            <label>Update Primary Image</label>
                            <input type='hidden' name='type' value='2'/>
                            <input type='hidden' name='game_id' value='{{game.game_id}}'/>
                            <input type="file" name="imgs[]" multiple/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <div class='row'>
                    <form class='col-xs-12' enctype="multipart/form-data" method="post" action="process/game-img.php" role="form">
                        <div class="form-group">
                            <hr/>
                            <label>Update Icon/Nav Image <br/>(57px x 57px .PNG)</label>
                            <input type='hidden' name='type' value='3'/>
                            <input type='hidden' name='game_id' value='{{game.game_id}}'/>
                            <input type="file" name="imgs[]" multiple/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card" ng-controller="gameListCtrl">
                <h2>GAMES</h2>
                <a href='games.php'>New Game</a><br/><br/>
                <a ng-repeat="g in gameList" href="games.php?game_id={{g.game_id}}">
                    {{g.game_name}}
                    <br/>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <!--            EXPANSION CONTENT-->
            <div ng-controller="dlcCtrl" class="card new_hide_{{dlc.dlc_gameID}}">
                <h1>ADD EXPANSION</h1>
                <div class='row'>
                    <form method="post" action="process/game-dlc.php" role="form">
                        <div class="form-group col-xs-7">
                            <label>Expansion Name</label>
                            <input type='hidden' name='dlc_gameID' value='<?php echo $_GET['game_id']; ?>'/>
                            <input type='hidden' name='dlc_id' value='new'/>
                            <input class="form-control" type='text' name='dlc_title' value=''/>
                        </div>
                        <div class="form-group col-xs-5">
                            <label>STATUS</label><br/>
                            <label class="col-xs-6">
                                <input type="radio" name="dlc_published" value="1"/>
                                Published
                            </label>
                            <label class="col-xs-6">
                                <input type="radio" name="dlc_published" value="0"/>
                                Hidden
                            </label>
                        </div>
                        <div class="form-group col-xs-12">
                            <label>DESCRIPTION</label><br/>
                            <textarea class="ckeditor" name="dlc_content"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </form>
                </div>
                <div class='row' id="expansion-form">
                    <form class='col-xs-12' enctype="multipart/form-data" method="post" action="process/game-img.php" role="form">
                        <div class="form-group">
                            <hr/>
                            <label>Add Expansion Images</label>
                            <div class="form-group">
                                <label>Select Expansion</label>
                                <select name="dlc_id" class="form-contorl">
                                    <option ng-repeat="c in dlc" value="{{c.dlc_id}}">{{c.dlc_title}}</option>
                                </select>
                            </div>
                            <input type='hidden' name='type' value='4'/>
                            <input type="file" name="imgs[]" multiple/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </form>
                    
                    <div ng-controller="dlcCtrl">
                        <div ng-repeat="d in dlc" class="col-xs-12">
                            <hr/>
                            <h2>{{d.dlc_title}} Images</h2>
                            <div ng-repeat="img in d.imgs" class="game-img">
                                <div class='delete' data-id='{{img}}'>Remove Image</div>
                                <img src="{{img}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3 col-xs-12">
            <!--         EDIT   EXPANSIONS -->
            <div id="edit-expansions" ng-controller="dlcCtrl" class="card new_hide_{{dlc.dlc_gameID}}">
                <h2>EDIT EXPANSIONS</h2>
                <div ng-repeat="c in dlc" data-id="{{c.dlc_id}}">{{c.dlc_title}}</div>
            </div>
        </div>
    </div>
</div>
