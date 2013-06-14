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
<table>
<td class="fdi">
<a class="world" href="index.php">All</a>
</td>
<td class="fdi">
<a class="world" href="world.php">World</a>
</td>
<td class="fdi">
<a class="guild" href="guild.php">Guild</a>
</td>
<td class="fdi">
<a class="help" href="help.php">Help</a>
</td>
<td class="fdi">
<a class="trade" href="trade.php">Trade</a>
</td>
<td class="fdi">
<a class="tutorial" href="tutorial.php">Tutorial</a>
</td>
<td class="fdi">
<a class="mod" href="mod.php">Mod</a>
</td>
<td class="fdi">
<a class="admin" href="admin.php">Admin</a>
</td>
<td class="fdi">
<?php

if($_SESSION['access_level'] >= "50") {
?>
<a class="staff" href="staff.php">Staff</a>
</td>
<td class="fdi">
<?php

}
?>
<a class="server" href="server.php">Server</a>
</td>
<td class="fdi">
<a class="whisper" href="whisper.php">Whisper</a>
</td>
</table>
<?php

include ("mysql.php");

$time = 24 * 60 * 60;
$select_chat = mysql_query("SELECT * FROM `chat` WHERE `posttime` >= " . $time .
	" AND `to` = \"" . $_SESSION['user_id'] . "\" OR `userid` = \"" . $_SESSION['user_id'] .
	"\" AND `to` > 0 AND `channel` =\"w\"");
if(mysql_num_rows($select_chat) > 0) {
	while ($chat = mysql_fetch_assoc($select_chat)) {
		$select_user = mysql_query("SELECT `username` FROM `users` WHERE `user_id` =" .
			$chat['userid']);
		$user = mysql_fetch_assoc($select_user);
		$posttime = date("H:i:s", $chat['posttime']);

		$select_recipient = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = " .
			$chat['to']);
		$recipient = mysql_fetch_assoc($select_recipient);
		if($chat['userid'] == $_SESSION['user_id']) {
			echo "<span style='font-size:13px; color:#6DA6BC;'>($posttime) [To " . $recipient['username'] .
				"]: " . $chat['message'] . "</span><br />";
		} elseif($chat['to'] == $_SESSION['user_id']) {
			echo "<span style='font-size:13px; color:#6DA6BC;'>($posttime) [w] " . $user['username'] .
				": " . $chat['message'] . "</span><br />";
		}
		if(strpos($chat['message'], "*") === 0 && substr($chat['message'], -1, 1) == "*" &&
			substr($chat['message'], -2, 1) != "*" && substr($chat['message'], 1, 1) != "*") {
			$post = "<i>($posttime) " . $chat['message'] . "</i>";
		} else {
			$post = "($posttime) " . $user['username'] . ": " . $chat['message'];
		}

		echo "<span style='font-size:13px; color:#43BFC7;'>$post</span><br />";
	}
} else {
	echo "No chat in the last 24 hours";
}
?>
</div>


</div>
</div>
<footer>
    <br><center>&copy; Fallout Chronicle 2012. All rights reserved.</center>
</footer></body>
</html>