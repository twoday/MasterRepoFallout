<?php

include '../core/database/connect.php';
session_start();
$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or
	die('Error');
$userinfo = mysql_fetch_array($check);

if($_SESSION['access_level'] != 100) {
?>
<script type="text/javascript">
closeadmin();
</script>
<?php

} else {
?>

<script type="text/javascript">

function ban(){
player = document.getElementById("player").value;
length = document.getElementById("length").value;
reason = document.getElementById("reason").value;

	if(player == ""){
		document.getElementById("error_mess").innerHTML = "The players name is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(length == ""){
		document.getElementById("error_mess").innerHTML = "The length of ban is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(reason == ""){
		document.getElementById("error_mess").innerHTML = "The reason is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	}else {
$.post("everything.php", { p:4, player:player, length:length, reason:reason },
	function(data) {
		eval(data);
	});	
	
	}

}

function unban(){
player = document.getElementById("player").value;
reason = document.getElementById("reason").value;

	if(player == ""){
		document.getElementById("error_mess").innerHTML = "The players name is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(reason == ""){
		document.getElementById("error_mess").innerHTML = "The reason is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	}else {
$.post("everything.php", { p:5, player:player, reason:reason },
	function(data) {
		eval(data);
	});
	}

}

function mute_player(){
player = document.getElementById("player").value;
length = document.getElementById("length").value;
reason = document.getElementById("reason").value;
comment = document.getElementById("comment").value;

	if(player == ""){
		document.getElementById("error_mess").innerHTML = "The players name is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(length == ""){
		document.getElementById("error_mess").innerHTML = "The length of mute is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(reason == ""){
		document.getElementById("error_mess").innerHTML = "The reason is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	}else if(comment == ""){
		document.getElementById("error_mess").innerHTML = "The players comment is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	} else {
$.post("everything.php", { p:6, player:player, length:length, reason:reason, comment:comment },
	function(data) {
		eval(data);	   
		});   
	}
}

function time_out(){
player = document.getElementById("player").value;
reason = document.getElementById("reason").value;
comment = document.getElementById("comment").value;

	if(player == ""){
		document.getElementById("error_mess").innerHTML = "The players name is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(reason == ""){
		document.getElementById("error_mess").innerHTML = "The reason is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	}else if(comment == ""){
		document.getElementById("error_mess").innerHTML = "The players comment is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	}else {
$.post("everything.php", { p:7, player:player, length:length, reason:reason, comment:comment },
	function(data) {
		eval(data);	   
		});   
		
	}
}

function warn(){
player = document.getElementById("player").value;
reason = document.getElementById("reason").value;
comment = document.getElementById("comment").value;

	if(player == ""){
		document.getElementById("error_mess2").innerHTML = "The players name is required."
		var error = document.getElementById("error_mess2");
		error.style.color = 'Red';

	}else if(reason == ""){
		document.getElementById("error_mess2").innerHTML = "The reason is required."
		var error = document.getElementById("error_mess2");
		error.style.color = 'Red';
		
	}else if(comment == ""){
		document.getElementById("error_mess2").innerHTML = "The comment is required."
		var error = document.getElementById("error_mess2");
		error.style.color = 'Red';

	}else{
$.post("everything.php", { p:9, player:player, reason:reason, comment:comment },
	function(data) {
		eval(data);	   
		});   	
	}
}

function mass_warn(){
warn = document.getElementById("mass_warn").value;

	if(warn == ""){
		document.getElementById("error_mess").innerHTML = "The warning is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else{
	$.post("everything.php", { p:14, warn:warn },
	function(data) {
		eval(data);	   
		});  
	}
}

function appeal(){
player = document.getElementById("player").value;
comment = document.getElementById("comment").value;
reason = document.getElementById("reason").value;

	if(player == ""){
		document.getElementById("error_mess").innerHTML = "The players name is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(comment == ""){
		document.getElementById("error_mess").innerHTML = "The appeal comment is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';

	}else if(reason == ""){
		document.getElementById("error_mess").innerHTML = "The reason is required."
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
		
	}else {
$.post("everything.php", { p:8, player:player, comment:comment, reason:reason },
	function(data) {
		eval(data);	   
		}); 	
	}

}
</script>

<div align="center">
<table width="100%"><tr><td align="center"><b>Admin Panel</b></td>

<td align="right"><span class="link" onclick="closeadmin();">Close</span></td></tr></table>


</div>
<div id="special2" style="margin-left:10px;" align="left">
<?php

	if(isset($_POST['id'])) {
		$type = $_POST['id'];
	} else {
		$type = $_GET['id'];
	}

	// Admin Main Page
	if($type == "1") {

		echo "<table  id=\"main_tables2\" width=\"100%\">";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(2)\">Mute Player</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(3)\">Warnings</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(4)\">Time Out</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(5)\">Appeal Punishment</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(6)\">Ban Player</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(7)\">Unban Player</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(15)\">Banned Players</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(16)\">Muted Players / Time Outs</span></td></tr>";
		echo "<tr class=\"alt\"><td><span class=\"link\" onclick=\"admin_panel(8)\">Staff Information</span></td></tr>";
		echo "</table>";
	}

	// Mute Player Page
	if($type == "2") {
?>
<span class="admin_header">Mute Player</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Length</td><td><input class="input" type="text" id="length"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>
<tr><td>Players Comment</td><td><input class="input" type="text" id="comment"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Mute Player" onclick="mute_player();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	// Warnings Page
	if($type == "3") {
?>
<span class="admin_header">Warnings</span><br><br>

<span class="other"><u>Warn Player</u></span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Reason</td><td><input class="input" type="text" id="reason"></td></tr>
<tr><td>Comment</td><td><input class="input" type="text" id="comment"></td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Warn Player" onclick="warn();"></td></tr>
</table><br>

<div id="error_mess2" style="font-size:14px;"></div>

<br><span class="other"><u>Mass Warn</u></span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Mass Warn</td><td><input class="input" type="text" id="mass_warn"></td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Mass Warn" onclick="mass_warn();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	// Time Out Page
	if($type == "4") {
?>
<span class="admin_header">Time Out</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>
<tr><td>Players Comment</td><td><input class="input" type="text" id="comment"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Time Out" onclick="time_out();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	// Appeal Punishment Page
	if($type == "5") {
?>
<span class="admin_header">Appeal Punishment</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Appeal Comment</td><td><input class="input" type="text" id="comment"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Appeal" onclick="appeal();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	// Ban Player Page
	if($type == "6") {
?>
<span class="admin_header">Ban Player</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Length</td><td><input class="input" type="text" id="length"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Ban Player" onclick="ban();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	// Unban Player Page
	if($type == "7") {
?>
<span class="admin_header">Unban Player</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Unban Player" onclick="unban();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	// Banned Success Page
	if($type == "9") {
?>
<span class="admin_header">Ban Player</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Length</td><td><input class="input" type="text" id="length"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Ban Player" onclick="ban();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px; color:Green;">Player Banned!</div>
<?php

	}

	// Unbanned Success Page
	if($type == "10") {
?>
<span class="admin_header">Unban Player</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Unban Player" onclick="unban();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px; color:green;">Player Unbanned!</div>
<?php

	}

	// Mute Player Success Page
	if($type == "11") {
?>
<span class="admin_header">Mute Player</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Length</td><td><input class="input" type="text" id="length"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>
<tr><td>Players Comment</td><td><input class="input" type="text" id="comment"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Mute Player" onclick="mute_player();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px; color:green;">Player Muted!</div>
<?php

	}

	// Time Out Success Page
	if($type == "12") {
?>
<span class="admin_header">Time Out</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>
<tr><td>Players Comment</td><td><input class="input" type="text" id="comment"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Time Out" onclick="time_out();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px; color:green;">Time Out given!</div>
<?php

	}

	// Appeal Punishment Success Page
	if($type == "13") {
?>
<span class="admin_header">Appeal Punishment</span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Appeal Comment</td><td><input class="input" type="text" id="comment"></td></tr>
<tr><td>Reasoning</td><td><input class="input" type="text" id="reason"></td></tr>

<tr><td colspan="2"><input class="input" type="submit" value="Appeal" onclick="appeal();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px; color:green;">Appeal Successful!</div>
<?php

	}

	// Warnings Page
	if($type == "14") {
?>
<span class="admin_header">Warnings</span><br><br>

<span class="other"><u>Warn Player</u></span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Player</td><td><input class="input" type="text" id="player"></td></tr>
<tr><td>Reason</td><td><input class="input" type="text" id="reason"></td></tr>
<tr><td>Comment</td><td><input class="input" type="text" id="comment"></td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Warn Player" onclick="warn();"></td></tr>
</table><br>

<div id="error_mess2" style="font-size:14px; color:green;">Player warning Given</div>

<br><span class="other"><u>Mass Warn</u></span><br><br>

<table width="100%" border="0px">
<tr><td width="110px">Mass Warn</td><td><input class="input" type="text" id="mass_warn"></td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Mass Warn" onclick="mass_warn();"></td></tr>
</table><br>

<div id="error_mess" style="font-size:14px;"></div>
<?php

	}

	//List of Banned Players Page
	if($type == "15") {
?>
<span class="admin_header">Banned Players</span><br><br>

<table style="100%" id="main_tables2">
<tr>
<th width="140px">Player</th>
<th width="140px">Length</th>
<th width="140px">Reason</th>
<th width="140px">Staff</th>
<th width="140px">Date</th>
</tr>
</table>

<table style="100%" id="main_tables2">
<?php

		$readresult3 = mysql_query("SELECT * FROM `banned` ORDER BY `id` ASC");
		while ($read55 = mysql_fetch_array($readresult3)) {
?>
<tr class="other">
<td width="140px"><?php

			echo "$read55[player]";
?></td>
<td width="140px"><?php

			echo "$read55[length]";
?> minutes</td>
<td width="140px"><?php

			echo "$read55[reason]";
?></td>
<td width="140px"><?php

			echo "$read55[staff_member]";
?></td>
<td width="140px"><?php

			echo "$read55[date]";
?></td>
</tr>
<?php

		}
?>
</table>

<?php

	}
	// List of Muted Players page.
	if($type == "16") {
?>
<span class="admin_header">Muted Players / Time Outs</span><br><br>

<table style="100%" id="main_tables2">
<tr>
<th width="100px">Player</th>
<th width="100px">Length</th>
<th width="100px">Reason</th>
<th width="100px">Comment</th>
<th width="100px">Staff</th>
<th width="100px">Type</th>
<th width="100px">Date</th>
</tr>
</table>

<table style="100%" id="main_tables2">
<?php

		$readresult3 = mysql_query("SELECT * FROM `punishments` ORDER BY `id` ASC");
		while ($read55 = mysql_fetch_array($readresult3)) {
			$select_user = mysql_query("SELECT `username` FROM `users` WHERE `user_id`=" . $read55['player']);
			$user = mysql_fetch_assoc($select_user);
?>
<tr class="other">
<td width="100px"><?php

			echo $user['username'];
?></td>
<td width="100px"><?php

			echo "$read55[length]";
?> minutes</td>
<td width="100px"><?php

			echo "$read55[reason]";
?></td>
<td width="100px"><?php

			echo "$read55[comment]";
?></td>
<td width="100px"><?php

			echo "$read55[staff_member]";
?></td>
<td width="100px"><?php

			echo "$read55[type]";
?></td>
<td width="100px"><?php

			echo date("Y-m-d H:i:s", $read55['date']);
?></td>
</tr>
<?php

		}
?>
</table>

<?php

	}

	if($type == "8") {
?>
<span class="admin_header">Staff Information</span><br><br>
<a href="rules/" class="link" target="_blank">Rules</a> | 
<a href="staff_rules.php" class="link" target="_blank">Staff Rules</a> | 
<a href="manual/updates" class="link" target="_blank">Updates</a><br><br>
<u>Administrators</u><br>
Atlas (Kebb)<br>
Constantine (Markus)<br>
<br>
<u>Moderators</u><br>
Caelia (SashaMkai)<br>
Meirchoin (Phaux)<br>
Elyan (Shoaulin)<br>
Balin (MuddyPalms)<br>
Merlin (Kenny666)<br>
Kahedin (Motters)
<br>
<u>Guides</u><br>
Lsw<br>
Kenny666<br>
<br>
<u>Forum Admins</u><br>
Kebb<br>
Markus<br>
Shoaulin<br>
<br>
<u>Forum Mods</u><br>
SashaMkai<br>
Silverstreak<br>
Phaux<br>

<?php

	}
	if($type != "1") {
?>
<br><br><span class="link" onclick="admin_panel(1)">Admin Panel</span>
<?php

	}
}
?>

</div>