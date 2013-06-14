<?php

session_start();
include ("mysql.php");
include_once ("game_includes/functions.php");

if(!isset($_SESSION['user_id'])) {
	die(); // Not logged in.
}

$msg = mysql_real_escape_string(auto_link_text(sanitize(strip_tags(urldecode($_POST['msg']), "<b><u><i>"))));
$channel = $_POST['c'];
$userid = $_SESSION['user_id'];
$to = "all";

$check2 = mysql_query("SELECT `guild_id` FROM `guild_members` WHERE `userid` = '$userid' LIMIT 1") or
	die('Error');
$guild2 = mysql_fetch_array($check2);
$guild_id2 = $guild2['guild_id'];

$get2 = mysql_query("SELECT `tag` FROM `guilds` WHERE `id` = '$guild_id2'") or
	die('Error');
$have3 = mysql_fetch_array($get2);
$tag = $have3['tag'];

if($have3 == 0) {
	$tag = "";
}

if($channel == "Server") {
	$userid = 14;
}

if(isMuted($userid) == false) {


	if(strpos($msg, "@") >= 1) {
		$name = substr($msg, 0, strpos($msg, '@'));
		$message = substr($msg, (strpos($msg, '@') + 1));
		$query = mysql_query("SELECT `user_id`, `username` FROM `users` WHERE LCASE(`username`) = '" .
			strtolower($name) . "' ");
		if(mysql_num_rows($query) != 0) {
			$row = mysql_fetch_assoc($query);
			$to = $row['user_id'];
			$channel = "w";
			$msg = $message;
		}
	}

	if(strpos($msg, "/me") !== false) {
		$message = substr($msg, 3);
		$query = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '" . $userid .
			"'");
		if(mysql_num_rows($query) != 0) {
			$row = mysql_fetch_assoc($query);
			if($channel == "Admin" || $channel == "Mod") {
				$query1 = mysql_query("SELECT `staff_name` FROM `staff_members` WHERE `player_id`=" .
					$userid);
				$row1 = mysql_fetch_assoc($query1);
				$row['username'] = $row1['staff_name'];
			}
			$msg = "*" . $row['username'] . $message . "*";
		}
	}

	if($msg == "/myid") {
		$to = $_SESSION['user_id'];
		$msg = "Your ID is " . $to;
		$userid = 14;
		$channel = "w";
	}
	mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"".$msg."\", \"".$channel."\", '" . time() . "', '$to','$tag')");
	echo "updateChat|";
}
?>