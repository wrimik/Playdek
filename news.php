<?php
include 'class/dbc.php';
include 'class/game.php';
include 'class/article.php';

$c = new Article();
$get = $c->dbc->cleanArray($_GET);
$news = $c->getArticle($get['article'], 'news');

include 'parts/header.php';
?>

<script type="text/javascript" language="javascript">
    var article = <?php echo json($news); ?>;
    function newsCtrl($scope){
        $scope.article = article;
    }
</script>

<div class="container-fluid primary" ng-controller="newsCtrl">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <div class="card sp caption">
                    <img src="images/icon-news-title.png"/>
                    <h1>BREAKING NEWS</h1>
                </div>
            </div>
            <div class="col-xs-12 np">
                <div class="card">
                    <div class='htmlsafe article-img'>{{article.img}}</div>
                    <h2>{{article.a_title}}</h2>
                    <i>{{article.a_date}}</i><br/><br/>
                    <div class='htmlsafe'>
                        {{article.a_html}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include 'parts/footer.php';