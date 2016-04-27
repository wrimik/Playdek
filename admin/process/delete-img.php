<?php

include '../../class/dbc.php';

dbc::getInstance(false);//login required

$file = $_POST['img'];
if(strpos($file, '../uploads/') !== -1){
    unlink('../'.$file);
}