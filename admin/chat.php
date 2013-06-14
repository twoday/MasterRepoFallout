<?php

include ("mysql.php");
include ("game_includes/functions.php");
session_start();

$userid = $_SESSION['user_id'];
$select_chats = mysql_query("SELECT `world`, `guild`, `help`, `trade`, `whispers` FROM `users` WHERE `user_id`=" .
	$userid);
$chats = mysql_fetch_assoc($select_chats);

$check2 = mysql_query("SELECT `guild_id` FROM `guild_members` WHERE `userid` = '$userid' LIMIT 1") or
	die('Error');
$guild2 = mysql_fetch_array($check2);
$guild_id2 = $guild2['guild_id'];

$get2 = mysql_query("SELECT `tag` FROM `guilds` WHERE `id` = '$guild_id2'") or
	die('Error');
$have3 = mysql_fetch_array($get2);
$tag3 = $have3['tag'];

$chatlog = "";
$lastid = $_SESSION['last_chat_line'];
if(isset($_SESSION['guild_id']) && !is_null($_SESSION['guild_id'])) {
	$get_guild = mysql_query("SELECT `tag` FROM `guilds` WHERE `id`=" . $_SESSION['id']);
	$tag = mysql_fetch_assoc($get_guild);
}
$get_chat = mysql_query("SELECT * FROM `chat` WHERE `id` > '$lastid'");
if(mysql_num_rows($get_chat) != 0) {
	while ($chat = mysql_fetch_assoc($get_chat)) {

		$posterid = $chat['userid'];
		$channel = $chat['channel'];
		$tag = $chat['tag'];
		$msg = chatemote($chat['message'], $posterid);
		$posttime = date("H:i:s", $chat['posttime']);
		$chatid = $chat['id'];
		$post_to = $chat['to'];

		$get_sender = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$posterid'");

		if(mysql_num_rows($get_sender) > 0) {
			$sender = mysql_fetch_assoc($get_sender);
			$postername = $sender['username'];
		}
		$get_recipient = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = '$post_to'");
		$recipient = mysql_fetch_assoc($get_recipient);
		$postername2 = $recipient['username'];

		$check_ignored = mysql_query("SELECT `ignored` FROM `ignore` WHERE `ignoring`=" .
			$userid . " AND `ignored`=" . $posterid);
		if(mysql_num_rows($check_ignored) > 0) {
			$ignored = true;
		} else {
			$ignored = false;
		}

		if(strpos($msg, "*") === 0 && substr($msg, -1, 1) == "*" && substr($msg, -2, 1) !=
			"*" && substr($msg, 1, 1) != "*") {
			$post = "<i>($posttime) $msg</i>";
		} elseif($channel == "Login" || $channel == "Forum") {
			$post = "($posttime) $postername $msg";
		} elseif($channel == "Admin" || $channel == "Mod" || $channel == "Staff" || $channel ==
		"Staff Forum") {
			$select_name = mysql_query("SELECT `staff_name` FROM `staff_members` WHERE `player_id` = " .
				$posterid);
			$name = mysql_fetch_assoc($select_name);
			if($channel == "Staff") {
				$post = "($posttime) <span style=\"cursor:pointer;\" onclick=\"Tie.whisperPlayer('$postername');\">$postername</span> [" .
					$name['staff_name'] . "]: $msg";
			} elseif($channel == "Staff Forum") {
				$post = "($posttime) $postername [" . $name['staff_name'] . "] $msg";
			} else {
				$post = "($posttime) " . $name['staff_name'] . ": $msg";
			}
		} elseif($channel == "Server") {
			$post = "($posttime) Charlotte MacBeth: $msg";
		} elseif($channel == "Punishment") {
			$post = "($posttime) " . $msg;
		} else {
			if($tag) {
				$post = "($posttime) <span style=\"cursor:pointer;\" onclick=\"Tie.whisperPlayer('$postername');\">$postername</span> [$tag]: $msg";
			} else {
				$post = "($posttime) <span style=\"cursor:pointer;\" onclick=\"Tie.whisperPlayer('$postername');\">$postername</span>: $msg";
			}
		}

		if($channel == "w" && $chats['whispers'] == 1) {
			if($ignored == false) {
				if($posterid == $userid) {
					$chatlog .= "<span style='font-size:13px; color:#6DA6BC;'>($posttime) [To $postername2]: $msg </span><br />";
				} elseif($post_to == $userid) {
					$chatlog .= "<span style='font-size:13px; color:#6DA6BC;'>($posttime) [w] $postername: $msg </span><br />";
				} else
					if($post_to == 14 && ($userid == 1 || $userid == 2)) {
						$chatlog .= "<span style='font-size:13px; color:#6DA6BC;;'>($posttime) [w via Charlotte] $postername: $msg </span><br />";
					}
			}
		} elseif($channel == "World" && $chats['world'] == 1) {
			if($ignored == false) {
				$chatlog .= "<span style='font-size:13px; color:#d9e1f8;'>$post</span><br />";
			}
		} elseif($channel == "Guild" && $chats['guild'] == 1) {
			if($ignored == false) {
				if($tag) {
					if($tag == $tag3) {
						$chatlog .= "<span style='font-size:13px; color:#4CC417;'>$post</span><br />";
					}
				}
			}
		} elseif($channel == "Help" && $chats['help'] == 1) {
			if($ignored == false) {
				$chatlog .= "<span style='font-size:13px; color:#FFF380;'>$post</span><br />";
			}
		} elseif($channel == "Trade" && $chats['trade'] == 1) {
			if($ignored == false) {
				$chatlog .= "<span style='font-size:13px; color:#8D38C9;'>$post</span><br />";
			}
		} elseif($channel == "Tutorial") {
			if($ignored == false) {
				$chatlog .= "<span style='font-size:13px; color:#43BFC7;'>$post</span><br />";
			}
		} elseif($channel == "Forum") {
			if($ignored == false) {
				$chatlog .= "<span style='font-size:13px; color:#8888EE;'>$post</span><br />";
			}
		} elseif($channel == "Login") {
			if($ignored == false) {
				$chatlog .= "<span style='font-size:13px; color:#a74574;'>$post</span><br />";
			}
		} elseif($channel == "Admin") {
			$chatlog .= "<span style='font-size:13px; color:#ea0606;'>$post</span><br />";

		} elseif($channel == "Mod") {
			$chatlog .= "<span style='font-size:13px; color:#065cea;'>$post</span><br />";

		} elseif($channel == "Server") {
			$chatlog .= "<span style='font-size:13px; color:yellow;'>$post</span><br />";

		} elseif($channel == "Staff") {
			if($_SESSION['access_level'] >= "50") {
				$chatlog .= "<span style='font-size:13px; color:#ADA96E;'>$post</span><br />";
			}
		} elseif($channel == "Staff Forum") {
			if($_SESSION['access_level'] >= "50") {
				$chatlog .= "<span style='font-size:13px; color:#ADA96E;'>$post</span><br />";
			}
		} elseif($channel == "Punishment") {
			$chatlog .= "<span style='font-size:13px; color:#C35817;font-weight:bold;'>$post</span><br />";
		}
	}
}

if($chatlog != "") {

	echo "chatLog|$chatlog|";
	$_SESSION['last_chat_line'] = $chatid;

}
?>