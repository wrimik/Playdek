<?php

$d = strtotime('9/5/2014');

for($n = 0; $n<100; $n++){
    $d = strtotime('+2 Weeks', $d);
    echo date('m/d/Y', $d).'<br/>';
}