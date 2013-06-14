<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);

?>

<div align="center">
<table width="100%"><tr><td align="center"><b>Messages</b></td>

<td align="right"><span class="link" onclick="closemessages();">Close</span></td></tr></table>


</div>
<div id="special1" style="margin-left:10px;" align="left"><br />
Coming Soon
</div>