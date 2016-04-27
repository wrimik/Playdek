<?php

include '../../class/dbc.php';
include '../../class/game.php';

$dbc = dbc::getInstance(false);

$g = new Game();
$post = $g->dbc->cleanArray($_POST);

if($post['dlc_id'] == 'new'){
    $post['dlc_id'] = $g->newDlc($post);
}

$g->updateDlc($post['dlc_id'], $post['dlc_gameID'], $post['dlc_published'], $post['dlc_title'], $post['dlc_content']);

back();