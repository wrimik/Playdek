<?php

include '../../class/dbc.php';
include '../../class/forum.php';

$dbc = dbc::getInstance(false);
$forum = new Forum();

$post = $forum->dbc->cleanArray($_POST);

foreach($post['text'] as $key => $p){
    $forum->save($post['text'][$key], $post['url'][$key]);
}
back();