<?php

session_start();
include '../../core/database/connect.php';
include ("../../game_includes/functions.php");

$userid = $_SESSION['user_id'];
$check2 = mysql_query("SELECT `guild_id` FROM `guild_members` WHERE `userid` = '$userid' LIMIT 1") or
	die('Error');
$guild2 = mysql_fetch_array($check2);
$guild_id2 = $guild2['guild_id'];
$get2 = mysql_query("SELECT `tag` FROM `guilds` WHERE `id` = '$guild_id2'") or
	die('Error');
$have3 = mysql_fetch_array($get2);
$tag3 = $have3['tag'];
$time = 24 * 60 * 60;

if(isset($_GET['chat'])) {
	$channel = ucfirst($_GET['chat']);
	$to = "all";
	$sql = "SELECT * FROM `chat` WHERE `channel`= \"" . $channel . "\" AND `posttime` >= " . (time
		() - $time);

	if($channel == "W") {
		$sql = "SELECT * FROM `chat` WHERE `channel` = \"w\" AND `posttime` >= " . (time
			() - $time) . " AND (`to` = \"" . $userid . "\" OR `userid` = " . $userid . ")";
		//die($channel);
	} elseif($channel == "World") {
		$sql = "SELECT * FROM `chat` WHERE (`channel` = \"World\" OR `channel`=\"Login\" OR `channel`=\"Forum\") AND `posttime` >= " . (time
			() - $time);
		//die($channel);
	} elseif($channel == "Staff") {
		$sql = "SELECT * FROM `chat` WHERE (`channel` = \"Staff\" OR `channel`=\"Staff Forum\") AND `posttime` >= " . (time
			() - $time);
		//die($channel);
	}

	$get_chat = mysql_query($sql);
	if(mysql_num_rows($get_chat) > 0) {
		while ($chat = mysql_fetch_assoc($get_chat)) {
			$get_user = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = " . $chat['userid']);
			$user = mysql_fetch_assoc($get_user);
			$posttime = date("H:i:s", $chat['posttime']);
			$select_name = mysql_query("SELECT `staff_name` FROM `staff_members` WHERE `player_id`=" .
				$chat['userid']);
			if(mysql_num_rows($select_name) > 0) {
				$name = mysql_fetch_assoc($select_name);
			}
			$chat['message'] = chatemote($chat['message'], $chat['userid']);

			if(substr($chat['message'], 0, 3) == "/me") {
				$message = substr($chat['message'], 3);
				$postername = $user['username'] ;
				if($chat['channel'] == "Admin" || $chat['channel'] == "Mod") {
					$postername = $name['staff_name'] ;
				}
				$message = "*" . $postername . $message . "*";
				$post = "<i>($posttime) $message</i>";
			} elseif($chat['channel'] == "Login" || $chat['channel'] == "Forum" || $chat['channel'] ==
				"Staff Forum") {
				if($chat['channel'] == "Staff Forum") {
					$post = "($posttime) " . $name['staff_name'] . " " . $chat['message'];
				} else {
					$post = "($posttime) " . $user['username'] . " " . $chat['message'];
				}
			} elseif($chat['channel'] == "w") {
				$select_recipient = mysql_query("SELECT `username` FROM `users` WHERE `user_id` = " .
					$chat['to']);
				$recipient = mysql_fetch_assoc($select_recipient);
				if($chat['userid'] == $_SESSION['user_id']) {
					$post = "($posttime) [To " . $recipient['username'] . "]: " . $chat['message'];
				} elseif($chat['to'] == $_SESSION['user_id']) {
					$post = "($posttime) [w]" . $user['username'] . ": " . $chat['message'];
				}
			} elseif($chat['channel'] == "Staff" || $chat['channel'] == "Mod" || $chat['channel'] ==
			"Admin") {
				if($chat['channel'] == "Staff") {
					if($_SESSION['access_level'] >= 50) {
						if($chat['tag'] != "") {
							$post = "($posttime) " . $user['username'] . " [" . $name['staff_name'] . "] [" .
								$chat['tag'] . "]: " . $chat['message'];
						} else {
							$post = "($posttime) " . $user['username'] . " [" . $name['staff_name'] . "]: " .
								$chat['message'];
						}
					} else {
						$chatlog = "You do not have permission to be here";
					}
				} else {
					$post = "($posttime) " . $name['staff_name'] . ": " . $chat['message'];
				}
			} else {
				if($chat['tag'] != "") {
					$post = "($posttime) " . $user['username'] . " [" . $chat['tag'] . "]: " . $chat['message'];
				} else {
					$post = "($posttime) " . $user['username'] . ": " . $chat['message'];
				}
			}

			if($chat['channel'] == "Guild") {
				if($tag3 == $chat['tag']) {
					$chatlog .= "<span class=\"" . strtolower($chat['channel']) . "\">" . $post .
						"</span><br />";
				}
			} else {
				$chatlog .= "<span class=\"" . strtolower($chat['channel']) . "\">" . $post .
					"</span><br />";
			}
		}
	} else {
		$chatlog = "No chat in the last 24 hours";
	}
} else {
	$sql = mysql_query("SELECT * FROM `chat` WHERE `channel` != \"w\" AND `channel` != \"Staff\"  AND `channel` != \"Staff Forum\" AND `channel` != \"Guide\" AND `posttime`>=" .
		(time() - $time));
	if(mysql_num_rows($sql) > 0) {
		while ($chat = mysql_fetch_assoc($sql)) {
			$get_user = mysql_query("SELECT `username` FROM `users` WHERE `user_id`=" . $chat['userid']);
			$user = mysql_fetch_assoc($get_user);
			$posttime = date("H:i:s", $chat['posttime']);
			$select_name = mysql_query("SELECT `staff_name` FROM `staff_members` WHERE `player_id`=" .
				$chat['userid']);
			if(mysql_num_rows($select_name) > 0) {
				$name = mysql_fetch_assoc($select_name);
			}
			
			$chat['message'] = chatemote($chat['message'], $chat['userid']);
			if($chat['tag'] != "") {
				$post = "<span class=\"" . strtolower($chat['channel']) . "\">($posttime) " . $user['username'] .
					" [" . $chat['tag'] . "]: " . $chat['message'] . "</span><br />";
			} else {
				$post = "<span class=\"" . strtolower($chat['channel']) . "\">($posttime) " . $user['username'] .
					": " . $chat['message'] . "</span><br />";
			}

			if($_SESSION['access_level'] >= MOD_LEVEL) {
				if($chat['channel'] == "Staff" || $chat['channel'] == "Staff Forum") {
					$chatlog .= $post;
				}
			}

			if(substr($chat['message'], 0, 3) == "/me") {
				$message = substr($chat['message'], 3);
				$postername = $user['username'] ;
				if($chat['channel'] == "Admin" || $chat['channel'] == "Mod") {
					$postername = $name['staff_name'] ;
				}
				$message = "*" . $postername . $message . "*";
				$post = "<i>($posttime) $message</i>";
			} elseif($chat['channel'] == "Mod" || $chat['channel'] == "Admin") {
				$post = "($posttime) " . $name['staff_name'] .
					": " . $chat['message'];
			} elseif($chat['channel'] == "Punishment") {
				$post = "($posttime) " . $chat['message'];
			} else {
				if($chat['tag'] != "") {
					$post = "($posttime) " . $user['username'] . " [" . $chat['tag'] . "]: " 
						. $chat['message'];
				} else {
					$post = "($posttime) " . $user['username'] .
						": " . $chat['message'];
				}
			}
			if($chat['channel'] == "Guild") {
				if($tag3 != $chat['tag']) {
					$post = "";
				}
			}
			if($post!=""){
				$chatlog .= "<span class=\"" . strtolower($chat['channel']) . "\">". $post . "</span><br />";
			}
		}
	} else {
		$chatlog = "No chat";
	}
}
?>
	<!doctype html>
	<html>
		<head>
			<title>
				Fallout Chronicle
			</title>
			<meta charset="UTF-8">
			<link rel="stylesheet" href="screen.css">
			<link rel="shortcut icon" href="favicon.png" />
			<meta name="title" content="Fallout Chronicle" />
			<meta name="description" content="Fallout Chronicle is a browser text based game, with 12 skills, over hundreds of resources to collect, guilds to build, and quests to complete." />
		</head>
		<body>
			<header>
				<center>
					<img src="FC.png" border="0" />
				</center>
				<div class="clear">
				</div>
			</header>
			<div id="container">
				<div class="conall">
					<table>
						<td class="fdi">
							<a class="world" href="index.php">All</a>
						</td>
						<td class="fdi">
							<a class="world" href="index.php?chat=world">World</a>
						</td>
						<td class="fdi">
							<a class="guild" href="index.php?chat=guild">Guild</a>
						</td>
						<td class="fdi">
							<a class="help" href="index.php?chat=help">Help</a>
						</td>
						<td class="fdi">
							<a class="trade" href="index.php?chat=trade">Trade</a>
						</td>
						<td class="fdi">
							<a class="tutorial" href="index.php?chat=tutorial">Tutorial</a>
						</td>
						<td class="fdi">
							<a class="mod" href="index.php?chat=mod">Mod</a>
						</td>
						<td class="fdi">
							<a class="admin" href="index.php?chat=admin">Admin</a>
						</td>
						<?php

if($_SESSION['access_level'] >= "50") {
?>
							<td class="fdi">
								<a class="staff" href="index.php?chat=staff">Staff</a>
							</td>
							<?php

}
?>
								<td class="fdi">
									<a class="server" href="index.php?chat=server">Server</a>
								</td>
								<td class="fdi">
									<a class="whisper" href="index.php?chat=w">Whisper</a>
								</td>
					</table>
					<?php

echo $chatlog;
?>
				</div>
			</div>
			</div>
			<footer>
				<br>
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	</html>