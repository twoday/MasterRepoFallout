<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
?>

<div align="center">
<table width="100%"><tr><td><b>Online Players</b></td>
<td align="right"><span class="link" onclick="closeplayers();">Close</span></td></tr></table>
</div>

<div id="contents"><br />
<?php
echo "<table width=\"100%\">";
$mult == 15 * 60;
$time == time()+$mult;

$select_users = mysql_query("SELECT `username`,`user_id`,`theme`,`check_time`,`logged_in` FROM `users` WHERE `logged_in` = 1 AND `check_time` >= '$time' AND `check_time` != 0 ORDER BY username ASC");
while($users = mysql_fetch_assoc($select_users)){

if($users['user_id'] == 1 || $users['user_id'] == 2){
echo "<tr class=\"alt\"><td id=\"player_td\"><span style=\"color:red;\">$users[username] [$users[user_id]] ($users[theme])</span></td></tr>";
}elseif($users['user_id'] == 14){
echo "<tr class=\"alt\"><td id=\"player_td\"><span style=\"color:yellow;\">$users[username] ($users[theme])</span><br></td></tr>";
}else{
echo "<tr class=\"alt\"><td id=\"player_td\"><span style=\"color:#d9e1f8;\">$users[username] [$users[user_id]] ($users[theme])</span><br></td></tr>";
}
}
echo "</table>";
?>
<table width="100%"><td>[] = player id () = theme</td><tr><td>Game = Default Theme</td></tr></table>
</div>