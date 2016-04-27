<?php

include '../../class/dbc.php';
include '../../class/article.php';

dbc::getInstance(false);//login required

$a = new Article();
$post = $a->dbc->cleanArray($_POST);

$id = $post['article_id'];
$type = $post['type'];
$title= $post['title'];
$forwarding_url = $post['forwarding_url'];
$date = $post['date'];
$published = $post['published'];
$content = $post['content'];
$preview = $post['preview'];

$a->saveArticle($id, $type, $title, $forwarding_url, $date, $published, $content, $preview);
back();

