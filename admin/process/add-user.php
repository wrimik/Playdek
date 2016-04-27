<?php

include '../../class/dbc.php';

$dbc = dbc::getInstance(false);

$post= $dbc->cleanArray($_POST);

$user= $post['user'];
$pass= $dbc->password($post['pass']);

$query = "INSERT INTO users (username, password) VALUES ('$user', '$pass');";
$dbc->insert($query);
back();
