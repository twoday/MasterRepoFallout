<?php
$host = "localhost";
$dbuser="fallou_Kazz"; 
$dbpass = "DWhGlX4+EDF#";
$dbname = "fallou_falloutc_newdb";

$connection = mysql_connect($host,$dbuser,$dbpass);
$db = mysql_select_db($dbname,$connection);

define("USER_LIMIT", 40);
date_default_timezone_set("UTC");
?>