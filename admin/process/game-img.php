<?php

include '../../class/dbc.php';

$dbc = dbc::getInstance(false);//login required

$game_id = intval($_POST['game_id']);

$types = array(
    1 => 'game-imgs'. '/' . $game_id,
    2 => 'banners'. '/' . $game_id,
    3 => 'game-icons'. '/' . $game_id,
    4 => 'dlc-imgs/'.intval($_POST['dlc_id'])
);

$type    = $_POST['type'];

$folder  = '../../uploads/' . $types[$type] ;

if(!is_dir($folder)){
    mkdir($folder);
}

if($type == 1 || $type == 4){
    $name = time(); // can add as many galary images as you want
    $n = 0;
    foreach($_FILES['imgs']['name'] as $key => $val){
        $ext = strtolower(substr($_FILES['imgs']["name"][$key], -3));
        $tmp_name = $_FILES['imgs']["tmp_name"][$key];
        $name = $name.$n;
        $n++;
        $new_name = "$folder/$name.$ext";
        move_uploaded_file($tmp_name, $new_name);
    }
    
}else if($type == 2){
    $name = 'banner_'. $game_id; // only ever one banner
    $query = "UPDATE games 
                SET game_banner = '$game_id/banner_$game_id.jpg' 
                WHERE game_id = '$game_id' LIMIT 1;";
    $dbc->update($query);
    foreach($_FILES['imgs']['name'] as $key => $val){
        $tmp_name = $_FILES['imgs']["tmp_name"][$key];
        $new_name = "$folder/$name.jpg";
        move_uploaded_file($tmp_name, $new_name);
    }
    
}else{
    foreach($_FILES['imgs']['name'] as $key => $val){
        $tmp_name = $_FILES['imgs']["tmp_name"][$key];
        $new_name = "$folder.png";
        move_uploaded_file($tmp_name, $new_name);
    }
}


back();