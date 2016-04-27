<?php
include 'class/dbc.php';
include 'class/game.php';
include 'class/article.php';

$c = new Article();
$get = $c->dbc->cleanArray($_GET);
$press  = $c->getArticle($get['id']);

if($press['a_forwarding_url']){
    header('location: '.$press['a_forwarding_url']);
    exit();
}

include 'parts/header.php';
?>

<script type="text/javascript" language="javascript">
    var article = <?php echo json($press); ?>;
    function pressCtrl($scope){
        $scope.article = article;
    }
</script>

<div class="container-fluid primary" ng-controller="pressCtrl">
    <div class="row">
        <div class="col-xs-12">
                <div class="col-xs-12 np">
                    <div class="card sp">
                        <h1>{{article.a_title}}</h1>
                        <div class='htmlsafe'>
                            {{article.a_html}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include 'parts/footer.php';