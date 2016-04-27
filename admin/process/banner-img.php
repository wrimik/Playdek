<?php

include '../../class/dbc.php';
include '../../class/game.php';

$dbc = dbc::getInstance(false);//login required
$g = new Game();
$post = $g->dbc->cleanArray($_POST);

$g->updateBanner($post['id'], $post['url']);

$tmp_name = $_FILES['banner']['tmp_name'];
$id = intval($_POST['id']);
$folder  = '../../uploads/banners-home';
$new_name = "$folder/$id.jpg";
if($tmp_name){
    move_uploaded_file($tmp_name, $new_name);
}
back();