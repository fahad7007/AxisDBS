<?php

$host = "localhost";
$dbname = "axis_dbs";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!defined('MYSQL_BOTH')) {
    define('MYSQL_BOTH',MYSQLI_BOTH);
}

if(!defined('MYSQL_NUM')) {
    define('MYSQL_NUM',MYSQLI_NUM);
}

if(!defined('MYSQL_ASSOC')) {
    define('MYSQL_ASSOC',MYSQLI_ASSOC);
}

?>
