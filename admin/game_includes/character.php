<?php
session_start();
include("../core/database/connect.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);


echo "<span class=\"character\"><b>";
echo "$userinfo[username]";
echo "</b></span><br>";

echo "<span class=\"character\">Level: </span>";
echo "<span class=\"other\">$userinfo[level]</span><br>";

echo "<span class=\"character\">Experience: </span>";
echo "<span class=\"other\">X [X left]</span><br>";

echo "<span class=\"character\">Health: </span>";
echo "<span class=\"other\">X / X</span><br>";

echo "<span class=\"character\">Mana: </span>";
echo "<span class=\"other\">X / X</span><br>";

echo "<span class=\"character\">Currency: </span>";
$with_commas = number_format($userinfo['currency']); 
echo "<span class=\"other\">$with_commas Platina<br>";
?>

