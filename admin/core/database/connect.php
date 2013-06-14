<?php
$connect_error = 'Sorry, we\'re experiencing connection problems!';
mysql_connect('localhost','falloutc_Kazz','DWhGlX4+EDF#') or die($connect_error);
mysql_select_db('falloutc_newdb') or die($connect_error);
date_default_timezone_set("UTC");
?>