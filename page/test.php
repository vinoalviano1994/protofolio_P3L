<?php
$date = date('d-m-y');
$date = str_replace('-', '/', $date);
$date = date('d-m-Y',strtotime($date . "+1 days"));
$day = date('l', strtotime($date));
$date = str_replace('-', '/', $date);
$date = date('d-m-Y',strtotime($date . "+1 days"));
$day = date('l', strtotime($date));

var_dump($date);
var_dump($day);


        ?>