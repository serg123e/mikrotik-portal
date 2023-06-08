<?php

function logger($str) {
    $now = date("Y-m-d H:i:s"); 
    $fp = fopen('/var/www/portal.123automate.it/public/vardump.txt', 'a');
    fwrite($fp,  $now."\t". $str."\n");
    fclose($fp);
}


session_start();


require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$business_name = $_SERVER['BUSINESS_NAME'];