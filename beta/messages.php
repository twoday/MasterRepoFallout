<?php
session_start();
include 'core/database/connect.php';

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$username = $userinfo['username'];
?>
<script type="text/javascript">

function readMessage(id){
$("#message_area").load("game_includes/readmessage.php", { id:id });
usermenu2();
}

function readMessage2(id3){
$("#message_area2").load("game_includes/readmessage2.php", { id2:id3 });
}

function delete_message(mess_id2){

$.post("everything.php", { p:1, id:mess_id2 },
	function(data) {
		eval(data);
	});	
	
}

function delete_sent(mess_id){

$.post("everything.php", { p:2, id:mess_id },
	function(data) {
		eval(data);
	});	
	
}

function sendMessage(){
play = document.getElementById("play").value;
mess = document.getElementById("player_message").value;
subj = document.getElementById("subject").value;
	
if(play == ""){
	document.getElementById("error_mess").innerHTML = "The players name is required."
    var error = document.getElementById("error_mess");
    error.style.color = 'Red';

}else if(mess == ""){
	document.getElementById("error_mess").innerHTML = "The message is required."
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';

}else if(subj == ""){
	document.getElementById("error_mess").innerHTML = "The topic  is required."
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else if(play == "<?php echo $username; ?>") {
	document.getElementById("error_mess").innerHTML = "You can\'t send a message to yourself!"
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else if(subj.length > 30){
	document.getElementById("error_mess").innerHTML = "The topic must be under 30 characters"
    var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else if(subj.length < 3){
	document.getElementById("error_mess").innerHTML = "The topic must be at least 3 characters"
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else{

$.post("everything.php", { p:3, play:play, mess:mess, subj:subj },
	function(data) {
		eval(data);
	});	
	
}
} 

</script>
<?php
if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == "1"){
?>	

<span id="contents">
<div style="background-color:black;" class="title" align="center">
<table width="100%"><tr><td align="center">Messages
<?php
$sql33 = "SELECT count(*) AS new FROM `new_messages` WHERE `to` = '$userinfo[username]' || `to` = '$userinfo[user_id]'";

                  $res33 = mysql_query($sql33) or die(mysql_error());
                  $row23 = mysql_fetch_assoc($res33);
echo "<span style=\"font-size:12px; color:green;\">( $row23[new] ) </span>";

?>
 <span style="color:red; font-size:13px;">( Last 50 received messages )</span></td>
<td align="right"><span class="link" onclick="closemessages();">Close</span></td></tr></table>
</div>
<div style="margin-left:0px;" align="left">

<table style="width:700px;" id="main_tables"><tr class="alt">
<td><span onclick="messages(1);" class="link"><b>Messages</b></span></td>
<td><span onclick="messages(2);" class="link"><b>Sent Messages</b></span></td>
<td><span onclick="messages(3);" class="link"><b>Compose</b></span></td>
</tr></table><br>
<div>

<div id="message_area">
<table style="100%" id="main_tables2">
<?php
$readresult3 = mysql_query("SELECT `id`,`title`,`date`,`from`,`status` FROM `new_messages` WHERE `to` = '$userinfo[username]' || `to` = '$userinfo[user_id]' ORDER BY `time` ASC LIMIT 50");
while($read55 = mysql_fetch_array($readresult3))
{
	
?>
<tr class="other">
<?php
if($read55['status'] == "0"){
?>
<td><b><span onclick="readMessage(<?php echo "$read55[id]"; ?>);" class="link"><?php echo "$read55[title]";?></span></b></td>
<?php
}else{
?>
<td><span onclick="readMessage(<?php echo "$read55[id]"; ?>);" class="link"><?php echo "$read55[title]";?></span></td>
<?php
	
}
?>
<td><?php echo "$read55[from]";?></td>
<td><?php echo "$read55[date]";?></td>
<td><span onclick="delete_message(<?php echo "$read55[id]"; ?>);" class="link">Delete</span></td>
</tr>
<?php

}
?>
</table>
</div>


</div>
</div>

</span>

<?php
}
if($type == "2"){
?>	

<span id="contents">
<div style="background-color:black;" class="title" align="center">
<table width="100%"><tr><td align="center">Sent Messages

<?php
$sql32 = "SELECT count(*) AS new FROM `sent_messages` WHERE `from` = '$userinfo[username]' || `from` = '$userinfo[user_id]' LIMIT 5";

                  $res32 = mysql_query($sql32) or die(mysql_error());
                  $row22 = mysql_fetch_assoc($res32);
echo "<span style=\"color:green; font-size:12px;\">( $row22[new] ) </span>";

?>
<span style="color:red; font-size:13px;">( Last 10 messages sent  )</span></td>
<td align="right"><span class="link" onclick="closemessages();">Close</span></td></tr></table>
</div><div style="margin-left:0px;" align="left">

<table style="width:100%;" id="main_tables"><tr class="alt">
<td><span onclick="messages(1);" class="link"><b>Messages</b></span></td>
<td><span onclick="messages(2);" class="link"><b>Sent Messages</b></span></td>
<td><span onclick="messages(3);" class="link"><b>Compose</b></span></td>
</tr></table><br>
<div>


<div id="message_area2">
<table style="width:700px;" id="main_tables2">
<?php
$readresult4 = mysql_query("SELECT `id`,`title`,`date`,`to` FROM `sent_messages` WHERE `from` = '$userinfo[username]' || `from` = '$userinfo[user_id]' ORDER BY `time` ASC LIMIT 10");
while($read54 = mysql_fetch_array($readresult4))
{
	
?>
<tr class="other">
<td><span onclick="readMessage2(<?php echo "$read54[id]"; ?>);" class="link"><?php echo "$read54[title]";?></span></td>

<td><?php echo "$read54[to]";?></td>
<td><?php echo "$read54[date]";?></td>
<td><span onclick="delete_sent(<?php echo "$read54[id]"; ?>);" class="link">Delete</span></td>
</tr>
<?php

}
?>
</table>
</div>


</div>

</div>
</span>

<?php
}
if($type == "3"){
?>	

<span id="contents">
<div style="background-color:black;" class="title" align="center">
<table width="100%"><tr><td align="center">Compose a Message</td>
<td align="right"><span class="link" onclick="closemessages();">Close</span></td></tr></table>
</div><div style="margin-left:0px;" align="left">

<table style="width:700px;" id="main_tables"><tr class="alt">
<td><span onclick="messages(1);" class="link"><b>Messages</b></span></td>
<td><span onclick="messages(2);" class="link"><b>Sent Messages</b></span></td>
<td><span onclick="messages(3);" class="link"><b>Compose</b></span></td>
</tr></table>

<div>

<table style="width:700px; border:0px;">
<tr><td class="message_send" width="100px">Player</td><td><input class="input" type="text" id="play"></td></tr>
<tr><td class="message_send">Topic</td><td><input class="input" type="text" id="subject"></td></tr>

<tr><td align="center" colspan="2">

<textarea class="input" style="width:650px; height:200px;" id="player_message">

</textarea>

</td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Send Message" onclick="sendMessage();"></td></tr>

</table>



<div id="error_mess" style="font-size:14px;"></div>


</div>

</div>
</span>

<?php
}
if($type == "4"){
?>	

<span id="contents">
<div style="background-color:black;" class="title" align="center">
<table width="100%"><tr><td align="center">Compose a Message</td>
<td align="right"><span class="link" onclick="closemessages();">Close</span></td></tr></table>
</div><div style="margin-left:0px;" align="left">

<table style="width:700px;" id="main_tables"><tr class="alt">
<td><span onclick="messages(1);" class="link"><b>Messages</b></span></td>
<td><span onclick="messages(2);" class="link"><b>Sent Messages</b></span></td>
<td><span onclick="messages(3);" class="link"><b>Compose</b></span></td>
</tr></table>

<div>

<table style="width:700px; border:0px;">
<tr><td class="message_send" width="100px">Player</td><td><input class="input" type="text" id="play"></td></tr>
<tr><td class="message_send">Topic</td><td><input class="input" type="text" id="subject"></td></tr>

<tr><td align="center" colspan="2">

<textarea class="input" style="width:650px; height:200px;" id="player_message">

</textarea>

</td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Send Message" onclick="sendMessage();"></td></tr>

</table>



<div id="error_mess" style="font-size:14px; color:green;">Message Sent!</div>


</div>

</div>
</span>

<?php
}

?>

