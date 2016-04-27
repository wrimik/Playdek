<?php

include '../../class/dbc.php';
include '../../class/game.php';

$game = new Game();

$game_id = 1;
$type = 'highlights';
$list = <<<EOT
Spiel des Jahres winning game (Best Complex Game 2008)
Family Game, Basic Deck and Solo Series
Universal game application - buy once and play on all your devices
Retina support
iPhone5 / iPod 5 screen support
EOT;
$list = $game->dbc->cleanArray(explode("\n", $list));
foreach($list as $listItem){
    
    $game->addList($game_id, $type, $listItem);
}