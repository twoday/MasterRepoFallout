<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$username = $userinfo['username'];

$check1 = mysql_query("SELECT * FROM `guild_members` WHERE `userid` = '$userid' LIMIT 1") or die('Error');
$guild = mysql_fetch_array($check1);
$guild_id = $guild['guild_id'];

$get = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'") or die('Error');
$have = mysql_fetch_array($get);
$have2 = mysql_num_rows($get);
$name = $have['name'];
$tag = $have['tag'];
$level = $have['level'];
$exp = $have['exp'];
$thexp1 = floor( ($level/2) * pow( floor(($level*5)) , 2)) - $exp;

$check2 = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$have[leader]' LIMIT 1") or die('Error');
$tribe2 = mysql_fetch_array($check2);
$clanleader = $have['leader'];
?>
<style>
.gtab{
	width:700px;
	height:400px;
	border:1px solid #000;
	font:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.gheader{
	height:20px;
	text-align:left;
	padding:4px;
	border:1px solid #000;
	font:Arial, Helvetica, sans-serif;
}
.gheaderright{
	height:20px;
	text-align:center;
	padding:4px;
	width:50px;
	border:1px solid #000;
	font:Arial, Helvetica, sans-serif;
}
.gmember{
	vertical-align:top;
	padding:7px;
	border:1px solid #000;
	font:Arial, Helvetica, sans-serif;
}
.ingmember{
    height:400px;
	width:100%;
	border:1px solid #000;
	font:Arial, Helvetica, sans-serif;
}
.memberinfo{
	width:100%;
	height:400;
	border:1px solid #000;
	vertical-align:top;
	font:Arial, Helvetica, sans-serif;
	margin-bottom:2px;
	overflow:auto;
}
.member{
	height:10px;
	padding:4px;
	text-align:left;
	vertical-align:top;
	font:Arial, Helvetica, sans-serif;
}
.memberdisplay{
	padding:4px;
	height:10px;
	width:150px;
	font:Arial, Helvetica, sans-serif;
	text-align:left;
	padding-bottom:10px;
}
.guildlinks{
	border:1px solid #000;
	height:20px;
	padding:4px;
	font:Arial, Helvetica, sans-serif;
	text-align:center;
}
.guild_links{
color:white;
cursor:pointer;
}
.guild_links2{
color:red;
cursor:pointer;
font-size:11px;
}
.guild_links3{
color:green;
cursor:pointer;
font-size:11px;
}

</style>
<script type="text/javascript">

function createGuild(){
name = document.getElementById("guild_name").value;
tag = document.getElementById("guild_tag").value;


if(name == "" && tag == ""){
	document.getElementById("error_mess").innerHTML = "In order to continue you must fill out each field."
    var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else if(name == ""){
	document.getElementById("error_mess").innerHTML = "A Guild Name is required."
    var error = document.getElementById("error_mess");
    error.style.color = 'Red';

}else if(tag == ""){
	document.getElementById("error_mess").innerHTML = "A Guild Tag is required."
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';

	
}else if(name.length > 30){
	document.getElementById("error_mess").innerHTML = "The Guild Name must be under 30 characters"
    var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else if(name.length < 3){
	document.getElementById("error_mess").innerHTML = "The Guild Name must be at least 3 characters"
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';

}else if(tag.length > 7){
	document.getElementById("error_mess").innerHTML = "The Guild Tag must be under 7 characters"
    var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
}else if(tag.length < 1){
	document.getElementById("error_mess").innerHTML = "The Guild Tag must be at least 1 character"
	var error = document.getElementById("error_mess");
    error.style.color = 'Red';
	
	
}else{

$.post("everything.php", { p:21, name:name, tag:tag },
	function(data) {
		eval(data);
	});	
	
}
}

function applyGuild(){
guild_id = document.getElementById("guild_apply").value;

$.post("everything.php", { p:15, guild_id:guild_id },
	function(data) {
		eval(data);
	});	
}

function deleteReq(req_id){

$.post("everything.php", { p:16, req_id:req_id },
	function(data) {
		eval(data);
	});	

}

function disbandGuild(guild_id){

$.post("everything.php", { p:17, guild_id:guild_id },
	function(data) {
		eval(data);
	});	
}

function AcceptRequest(req_id){
$.post("everything.php", { p:18, req_id:req_id },
	function(data) {
		eval(data);
	});	
}

function DeclineRequest(req_id){
$.post("everything.php", { p:19, req_id:req_id },
	function(data) {
		eval(data);
	});	
}

function leaveGuild(){
$.post("everything.php", { p:20 },
	function(data) {
		eval(data);
	});	
}
</script>
<?php
if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == "1"){


if ($have2 == 0){
?>
<div class="title" align="left">
<table width="100%" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;"><tr><td align="center" >Guild</td>
<td align="right"><span class="link" onclick="closeguild();">Close</span></td></tr></table>

<span class="guild_text" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">Create Guild:</span><br />
<table style="width:700px; border:0px;">
<tr><td class="message_send" width="100px">Guild Name</td><td><input class="input" type="text" id="guild_name"></td></tr>
<tr><td class="message_send">Guild Tag</td><td><input class="input" type="text" id="guild_tag"></td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Create" onclick="createGuild();"></td></tr>
</table>
<div id="error_mess" style="font-size:14px;"></div>




<?php

echo "<br><br><span class=\"guild_text\" style=\"font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;\">Apply to guild:</span><br />";
echo "<form method=\"POST\" accept-charset=\"UTF-8\">";
echo "<select name='guild_list' id=\"guild_apply\" length='20'>";
$result = mysql_query("SELECT * FROM `guilds`");
while($row = mysql_fetch_array($result)){
print "<option value=\"$row[id]\">$row[name] ($row[tag])</option>";
}
print "</select></form>";

?>
<input class="input" type="submit" value="Apply" onclick="applyGuild();">
<div id="error_mess2" style="font-size:14px;"></div><br>
<?php

$result = mysql_query("SELECT * FROM `guild_requests` WHERE `userid` = '$userid'");
while($row = mysql_fetch_array($result)){
$guild_id = $row['guild_id'];
$req_id = $row['req_id'];

$result2 = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'");	
while($row2 = mysql_fetch_array($result2)){

echo "<span class=\"guild_text\">- $row2[name] ($row2[tag]) </span>";
echo "<span onclick=\"deleteReq($req_id);\" class=\"guild_links2\">(Delete Request)</span><br />";

}
}   

}else{

?>
<table class="gtab">
<td class="gheader" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<?php
echo "$name [$tag]";
?>
</td>
<td class="gheaderright">
<span class="link" onclick="closeguild();">Close</span>
</td>
<tr>
<td class="gheader" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
Guild Level: <?php echo "$level"; ?>

[<?php echo "$exp "; ?>Exp /<?php echo " $thexp1 "; ?>Remaining Exp]
</td>
</tr>
<tr>
<td class="guildlinks" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="guild_links" onclick="guild(1)">Members</span> | <span class="guild_links" onclick="guild(2)">Guild Settings</span> | <span class="guild_links" onclick="guild(3)">Guild Highscores</span> | <span class="guild_links" onclick="guild(4)">Guild Logs</span>  
</td>
</tr>
<tr>


<td colspan="2" class="gmember" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">

<?php
$result = mysql_query("SELECT * FROM `guild_members` WHERE `guild_id` = '$guild_id'");
while($row = mysql_fetch_array($result)){
$member_id = $row['userid'];

$result2 = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$member_id'");	
while($row2 = mysql_fetch_array($result2)){

$location_check = mysql_query("SELECT * FROM `locations` WHERE `id` = '$row2[location_id]' LIMIT 1") or die('Error');
$view = mysql_fetch_array($location_check);
$location_name = $view['name'];
if($row2['logged_in'] == 1){
$status = "<font color=\"lime\">Online</font>";
}else {
$status = "<font color=\"red\"><i>Offline</i></font>";
}
?>
	<table class="memberinfo">
        <td class="member">
        <div class="memberdisplay">
        <?php echo "$row2[username]"; ?>
        </div>
        </td>
        <td class="member">
        <div class="memberdisplay">
        <?php echo "[ $row[rank] ]"; ?>
        </div>
        </td>
        <td class="member">
        <div class="memberdisplay">
       <?php echo "$location_name"; ?>
        </div>
        </td>
        <td class="member">
         <div class="memberdisplay">
           <?php echo "[ $status ]"; ?>
          </div>
        </td>
    </table>
<?php 
}
}
?>
</td>
</tr>
</table>
<?php



}
}else if($type == "2"){
?>
<table class="gtab">
<td class="gheader" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<?php
echo "$name [$tag]";
?>
</td>
<td class="gheaderright" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="link" onclick="closeguild();">Close</span>
</td>
<tr>
<td class="gheader" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
Guild Level: <?php echo "$level"; ?>

[<?php echo "$exp"; ?> Exp / <?php echo "$thexp1"; ?> Remaining Exp]
</td>
</tr>
<tr>
<td class="guildlinks" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="guild_links" onclick="guild(1)">Members</span> | <span class="guild_links" onclick="guild(2)">Guild Settings</span> | <span class="guild_links" onclick="guild(3)">Guild Highscores</span> | <span class="guild_links" onclick="guild(4)">Guild Logs</span>  
</td>
</tr>
<tr>


<td colspan="2" class="gmember" align="left" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<?php
if($userid == $clanleader){
echo "<span class=\"guild_links\" onclick=\"disbandGuild($guild_id);\">Disband Guild</span><br><br>";

echo "<span>Member Requests:</span><br>";
$result = mysql_query("SELECT * FROM `guild_requests` WHERE `guild_id` = '$guild_id'");
while($row = mysql_fetch_array($result)){
$member_id = $row['userid'];

$result2 = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$member_id'");	
while($row2 = mysql_fetch_array($result2)){

echo "<span>$row2[username]</span>";
echo "<span class=\"guild_links3\" onclick=\"AcceptRequest($row[req_id]);\"> [Accept Request] </span>";
echo "<span class=\"guild_links2\" onclick=\"DeclineRequest($row[req_id]);\">[Decline Request]</span><br>";
}
}

}else{
echo "<span class=\"guild_links\" onclick=\"leaveGuild($guild_id);\">Leave Guild</span><br><br>";

}
?>



</td>
</tr>
</table>
<?php
}else if($type == "3"){
?>
<table class="gtab">
<td class="gheader" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<?php
echo "$name [$tag]";
?>
</td>
<td class="gheaderright" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="link" onclick="closeguild();">Close</span>
</td>
<tr>
<td class="gheader" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;"> 
Guild Level: <?php echo "$level"; ?>

[<?php echo "$exp"; ?> Exp / <?php echo "$thexp1"; ?> Remaining Exp]
</td>
</tr>
<tr>
<td class="guildlinks" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="guild_links" onclick="guild(1)">Members</span> | <span class="guild_links" onclick="guild(2)">Guild Settings</span> | <span class="guild_links" onclick="guild(3)">Guild Highscores</span> | <span class="guild_links" onclick="guild(4)">Guild Logs</span>  
</td>
</tr>
<tr>


<td colspan="2" class="gmember" align="left" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">





</td>
</tr>
</table>
<?php
}else if($type == "4"){
?>
<table class="gtab">
<td class="gheader" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<?php
echo "$name [$tag]";
?>
</td>
<td class="gheaderright" style="font-size:17px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="link" onclick="closeguild();">Close</span>
</td>
<tr>
<td class="gheader" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
Guild Level: <?php echo "$level"; ?>

[<?php echo "$exp"; ?> Exp / <?php echo "$thexp1"; ?> Remaining Exp]
</td>
</tr>
<tr>
<td class="guildlinks" colspan="2" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">
<span class="guild_links" onclick="guild(1)">Members</span> | <span class="guild_links" onclick="guild(2)">Guild Settings</span> | <span class="guild_links" onclick="guild(3)">Guild Highscores</span> | <span class="guild_links" onclick="guild(4)">Guild Logs</span>  
</td>
</tr>
<tr>


<td colspan="2" class="gmember" align="left" style="font-size:14px;font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;">




</td>
</tr>
</table>
<?php
}
?>
</div>