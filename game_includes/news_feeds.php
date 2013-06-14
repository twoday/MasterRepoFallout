<?php
session_start();
include("../core/database/connect.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);

$select = "SELECT * FROM `news_feeds` WHERE `userid` = '$userinfo[user_id]' ORDER BY `id` DESC";
$select_resutlts = mysql_query($select) or die(mysql_error());
while($row = mysql_fetch_assoc($select_resutlts)){

echo "<span style=\"color:white;font-size:13px;\">$row[message]</span><br />";

}

?>

