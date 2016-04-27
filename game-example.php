<?php
include 'class/dbc.php';
include 'class/game.php';

include 'parts/header.php';

$banner = 'banner_pennyarcade';

$page = file_get_contents('parts/game.php');
$title= 'PENNY ARCADE THE GAME: GAMERS VS. EVIL';

echo sprintf($page, $banner, $title);

include 'parts/footer.php';
