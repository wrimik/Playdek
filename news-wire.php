<?php
include 'class/dbc.php';
include 'class/game.php';
include 'class/article.php';

$c = new Article();

$news = $c->getArticles('news', 3);
$recent = array(array_shift($news), array_shift($news));

include 'parts/header.php';
?>

<script type="text/javascript" language="javascript">
    function newsCtrl($scope) {
        var articles = <?php echo json($news); ?>;
        var recent = <?php echo json($recent); ?>;
        $scope.articles = articles;
        $scope.recent = recent;                 console.log($scope);

        $scope.addArticles = function(){
            $.get('get/articles.php', {
                type:'news',
                shift:2
             }, function(result){
                 $scope.articles = JSON.parse(result);
                 $scope.$apply();
                 htmlSafe();
                 $('#addArticles').hide();
             });
        };
    }

//    var app = angular.module('app', []);
//    app.controller('newsCtrl', ['$scope', function($scope) {
//        var articles = <?php //echo json($news); ?>;
//        var recent = <?php //echo json($recent); ?>;
//        $scope.articles = articles;
//        $scope.recent = recent;
//    }]);
//
//    
//    app.directive('addArticles', ['$scope', function(scope) {
//        $.get('get/articles.php', {
//           type:'news',
//           shift:2
//       }, function(result){
//           scope.recent = result;
//       });
//    }]);
</script>
<div  ng-controller="newsCtrl">
<div class="container-fluid primary">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <div class="card sp caption">
                    <img src="images/icon-news-title.png"/>
                    <h1>BREAKING NEWS</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" ng-repeat="first in recent">
                    <div class="card news-preview">
                        <div class="col-xs-12">
                            <div class="col-sm-6 col-xs-12 news-img-col">
                                <div class='htmlsafe news-img'>{{first.img}}</div>
                            </div>
                            <h3><a href="news.php?article={{first.a_id}}" class="news-title">{{first.a_title}}</a></h3>
                            <div class='htmlsafe'>{{first.a_preview}}</div>
                            <span class="news-date">{{first.date}}</span>
                            <a class="btn btn-primary pull-right" href="news.php?article={{first.a_id}}">READ ON &#9658;</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" ng-repeat="news in articles">
                    <div class="card news-preview">
                        <div class="col-xs-12">
                            <h3><a href="news.php?article={{news.a_id}}" class="news-title">{{news.a_title}}</a></h3>
                            <div class='htmlsafe'>{{news.a_preview}}</div>
                            <span class="news-date">{{news.date}}</span>
                            <a class="btn btn-primary pull-right" href="news.php?article={{news.a_id}}">READ ON &#9658;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-xs-12">
            <div ng-click='addArticles()' class="card btn btn-primary" id='addArticles'>
                SHOW OLDER STORIES &#9658;
            </div>
        </div>
    </div>
</div>
    </div>
<?php
include 'parts/footer.php';