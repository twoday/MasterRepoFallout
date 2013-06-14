<?php
$host = "localhost";
$dbuser="falloutc_Kebb"; 
$dbpass = "7IuBW61VEh2";
$dbname = "falloutc_newdb";

$connection = mysql_connect($host,$dbuser,$dbpass);
$db = mysql_select_db($dbname,$connection);

define("USER_LIMIT", 21);
date_default_timezone_set("UTC");
?>