<?php
include '../../class/dbc.php';
include '../../class/game.php';

dbc::getInstance(false);//login required

$game = new Game();

$post = $game->dbc->cleanArray($_POST);
$game->fromPost($post);
$game->saveGame();
back();
//header('location: ../games.php?game_id='.$game->id);