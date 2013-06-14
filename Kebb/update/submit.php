<?php

/**
 * @author Alasdair Ross
 * @copyright 2009
 */

//grabs the variables
$news = $_POST["news"];
$title = $_POST["title"];
//gets mysql info
include ("dbconnect.php");
//gets the current date...
$date = time();
$time = gmstrftime("%H:%M %Z", time());
$sql = "INSERT INTO `news` (title,date,news,time) VALUES ('$title','$date','$news','$time')";
$res = mysql_query($sql);
//success...
echo ("News Added!");
?>