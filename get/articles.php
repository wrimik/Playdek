<?php

include '../class/dbc.php';
include '../class/article.php';

$c = new Article();
$get = $c->dbc->cleanArray($_GET);

$articles = $c->getArticles($get['type'], 300);
for($n = 0; $n < $get['shift']; $n++){
    $remove = array_shift($articles);
}
echo json($articles);