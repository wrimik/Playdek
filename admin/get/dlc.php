<?php

include '../../class/dbc.php';
include '../../class/game.php';

$dbc = dbc::getInstance(false);
$g = new Game();

$dlc = $g->getDlc($_GET['id']);
echo json($dlc);
