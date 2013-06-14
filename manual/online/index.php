<?php
include("mysql.php");
$select_users = mysql_query("SELECT `username` FROM `users` WHERE `logged_in` = 1");
while($users = mysql_fetch_assoc($select_users)){
echo $users['username'] ." , ";
}
?>