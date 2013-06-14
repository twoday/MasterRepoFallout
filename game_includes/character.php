<?php

session_start();
include ("../core/database/connect.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or
	die('Error');
$userinfo = mysql_fetch_array($check);

$select_avatar = mysql_query("SELECT `forum_avatar`, `active_avatar` FROM `perks` WHERE `userid`=" .
	$_SESSION['user_id']);
$avatar = mysql_fetch_assoc($select_avatar);

echo "<span class=\"character\"><b>";
echo "$userinfo[username]";
echo "</b></span><br>";

echo "<span class=\"character\">Level: </span>";
echo "<span class=\"other\" id=\"level\">$userinfo[level]</span><br>";

echo "<span class=\"character\">Experience: </span>";
echo "<span class=\"other\" id=\"exp\">$userinfo[exp]</span><br>";

echo "<span class=\"character\">Health: </span>";
echo "<span class=\"other\" id=\"health\">$userinfo[health] / $userinfo[health]</span><br>";

echo "<span class=\"character\">Mana: </span>";
echo "<span class=\"other\" id=\"mana\">$userinfo[mana] / $userinfo[mana]</span><br>";

echo "<span class=\"character\">Currency: </span>";
$with_commas = number_format($userinfo['currency']);
echo "<span class=\"other\">$with_commas Platina<br>";

if($avatar['forum_avatar'] != "" && $avatar['active_avatar'] == 1) {
	echo "<br /><a href=\"/manual/settings.php?p=perks\" target=\"_blank\"><img src=\"../player/avatar/" . $avatar['forum_avatar'] . "\" width=\"125px\" height=\"125px\" /></a>";
}
?>

