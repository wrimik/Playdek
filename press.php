<?php
include 'class/dbc.php';
include 'class/game.php';
include 'class/article.php';

$c = new Article();
$press = $c->getArticles('press');

include 'parts/header.php';
?>

<script type="text/javascript" language="javascript">
    var articles = <?php echo json($press); ?>;

    function newsCtrl($scope){
        $scope.articles = articles;
    }
</script>

<div class="container-fluid primary" ng-controller="newsCtrl">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <div class="card sp caption">
                    <img src="images/icon-news-title.png"/>
                    <h1>PRESS RELEASES</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" ng-repeat="press in articles">
                    <div class="card news-preview">
                        <div class="col-xs-12">
                            <h3><a href="press-release.php?id={{press.a_id}}" class="news-title">{{press.a_title}}</a></h3>
                            <p>{{press.a_preview}}</p>
                            <a class="btn btn-primary pull-right" href="press-release.php?id={{press.a_id}}">READ ON &#9658;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include 'parts/footer.php';