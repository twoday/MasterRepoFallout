<?php
include '../core/database/connect.php';
$select_user = mysql_query("SELECT `username`,`access_level` FROM `users` WHERE `username`=\"Charlotte Macbeth\"");
$user = mysql_fetch_assoc($select_user);
$skillc4 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Fishing' ") or die('Error');
$skill4 = mysql_fetch_array($skillc4);
$fish = $skill4['level'];
$fish2 = $skill4['exp'];

$skillc = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Mining' ") or die('Error');
$skill = mysql_fetch_array($skillc);
$mining = $skill['level'];
$mining2 = $skill['exp'];

$skillc11 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Speed' ") or die('Error');
$skill11 = mysql_fetch_array($skillc11);
$speed = $skill11['level'];
$speed2 = $skill11['exp'];

$skillc12 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Woodcutting' ") or die('Error');
$skill12 = mysql_fetch_array($skillc12);
$wc = $skill12['level'];
$wc2 = $skill12['exp'];
?>
<!doctype html>
    <html>
<head>
    <title>Fallout Chronicle</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="screen.css">
	<link rel="shortcut icon" href="favicon.png" />
    <meta name="title" content="Fallout Chronicle" />
    <meta name="description" content="Fallout Chronicle is a browser text based game, with 12 skills, over hundreds of resources to collect, guilds to build, and quests to complete." />

</head> 
 <body>
<header>

      <center><img src="FC.png" border="0"></img></center> 
    <div class="clear"></div>
</header>        
<div id="container">

<div class="conall">
<div class="concenter">
<table>
<td>
<div class="mincen">
<div class="minhead" style="text-align:center;">
<?php
 echo "$user[username]"
?>
</div>
<b>Staff Position</b>: <?php if($user['access_level'] == 99) {
echo "<span style=\"color:#d9e1f8;\">Server</span>";} ?><br>
<b>Location</b>: Benadalid
</div>
</td>
<td>
<div class="mincen">
<div class="minhead" style="text-align:center;">
Skills
</div>
<span class="skill">Fishing: </span><span class="skill" id="fishing_level"><?php echo "$fish"; ?></span><br>
<span class="skill">Mining: </span><span class="skill" id="mining_level"><?php echo "$mining"; ?></span><br>
<span class="skill">Speed: </span><span class="skill" id="speed_level"><?php echo "$speed"; ?></span><br>
<span class="skill">Woodcutting: </span><span class="skill" id="wc_level"><?php echo "$wc"; ?></span><br>
</div>
</td>
<tr>
<td colspan="2">
<div class="tmidbot">
<div class="minhead" style="text-align:center;">

Description

</div>
Charlotte,<br>
She will provide the news through server communication to all players when updates, game mechanics, or punishments are mentioned. Charlotte will not be a bot that punishes players for breaking rules or not following staff direction. Her actions consist of pre- emptively muting players who enter curse words or inappropriate links through any form of public communication. Staff; "Moderators, Administrators" are the main source of punishments for non-law abiding citizens. Also punishments by staff will appear by the punishing staff member, <b>NOT</b> Charlotte. The only punishments that will show by Charlotte of those that are automatically registered by the previously stated. <br>
<br>
Players will have the option to message Charlotte. Though respect the right of messages or you will be punished accordingly. If you abusively message Charlotte the option will be taken away. Her responses will be minimal so don't expect much replies. <br><br>
Acknowledge, Charlotte MacBeth is not an actual player, she is the server. 
</div>
</td>
</table>

</div>

</div>

<a href="/manual" class="manlinks">Manual</a> > <a href="/manual/Charlotte.php" class="manlinks">Charlotte</a>
</div>
<footer>
    <br><center>&copy; Fallout Chronicle 2012. All rights reserved.</center>
</footer></body>
</html>