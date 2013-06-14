<?php

include '../core/database/connect.php';
$select_users = mysql_query("SELECT `username` FROM `users`");
$num_users = mysql_num_rows($select_users);

$select_guilds = mysql_query("SELECT `name` FROM `guilds`");
$num_guilds = mysql_num_rows($select_guilds);

$select_bans = mysql_query("SELECT `player` FROM `banned`");
$num_bans = mysql_num_rows($select_bans);

$select_actions = mysql_query("SELECT `name` FROM `actions`");
$num_actions = mysql_num_rows($select_actions);

$select_exp = mysql_query("SELECT SUM(`exp`) FROM `player_skill`");
$exp = mysql_fetch_array($select_exp, MYSQL_NUM);
$total_exp = number_format($exp[0], 0, ".", ",");
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
   

  <script type="text/javascript" src="../javascript/jquery.js"></script>
<script type="text/javascript">

function closeplayers(){
document.getElementById("players").style.display = "none";
}

function players(){
$('#players').load("players.php");
document.getElementById("players").style.display = "block";
}
</script>


</head>     
 <body>
<header>

      <center><img src="FC.png" border="0"></img></center> 
    <div class="clear"></div>
</header>   
<div id="container">
    
<div class="conall">
<div class="townmin">
<center>
Server Information
</center>
</div>
<div class="concenter">
<table>
<td>
<div class="mincen">
<div class="minhead">
<center>
General Stats
</center>
</div>
<table class="dtabcen">
<td class="dtab">
Registered Players:
</td>
<td class="dtab">
<?php

echo $num_users;
?>
</td>
<tr>
<td class="dtab">
Currently Open Slots:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Online Players:
</td>
<td class="dtab">
<div id="players"></div> 
N/A

</td>
<tr>
<td class="dtab">
Active Players Daily:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Active Players Weekly:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Banned Players:
</td>
<td class="dtab">
<?php

echo $num_bans;
?>
</td>
</table>
</div>
</td>
<td>
<div class="mincen">
<div class="minhead">
<center>
Gameplay
</center>
</div>
<table class="dtabcen">
<td class="dtab">
Guilds Created:
</td>
<td class="dtab">
<?

echo $num_guilds;
?>
</td>
<tr>
<td class="dtab">
House Created:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Minions Trained:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Experience Gained:
</td>
<td class="dtab">
<?php

echo $total_exp;
?>
</td>
<tr>
<td class="dtab">
Platina Earned:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Resources Gained:
</td>
<td class="dtab">
N/A
</td>
<tr>
<td class="dtab">
Actions in-game:
</td>
<td class="dtab">
<?php

echo $num_actions;
?>
</td>
</tr>
</table>
</div>
</td>
<tr>
<td colspan="2">
<div class="tmidbot">
<div class="minhead">
<center>
Credits and Thanks
</center>
</div>
<b>Kebb</b><br>
Has provided the server, and images. <br>
<a href="http://www.twitter.com/Kebbrokk" class="manlinks" target="_blank">@Kebbrokk</a> - Twitter<br>
<a class="manlinks">kebbrokkvalley</a> - Skype [Do Not Abuse]
<br>
<br>
<b>Markus</b><br>
Is our main programmer. <br>
*So if there is a bug, he'll squash it.<br>
<a href="http://www.twitter.com/MarkusNewHart" class="manlinks" target="_blank">@MarkusNewhart</a> - Twitter<Br>
<a class="manlinks">Markus.Newhart</a> - Skype [Do Not Abuse]
<br><br>
<b>Shoaulin</b><br>
Is our forum developer.<br>
If there is a problem with the forum, Shout for Shoaulin.<br>
<a href="http://oi50.tinypic.com/2wof5ap.jpg" class="manlinks" target="_blank"> Shoaulin </a> - Random
<br>
<br>
<b>Other Thanks:</b><br>
We have to thank our following for getting us started and motivated to code the game. <br>

</div>
</td>
</table>


</div>


</div>

<a href="/manual" class="manlinks">Manual</a> > <a href="stats.php" class="manlinks">Server Information</a>
</div>
<footer>
    <br><center>&copy; Fallout Chronicle 2012. All rights reserved.</center>
</footer></body>
</html>