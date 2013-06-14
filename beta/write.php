<?php

session_start();
include ("mysql.php");
include_once ("game_includes/functions.php");

if(!isset($_SESSION['user_id'])) {
	die(); // Not logged in.
}

//remove tags
$msg = str_replace(array('<','>','|'), array('&lt;','&gt;','&#124;') , $_POST['msg']);

$msg = mysql_real_escape_string(auto_link_text(sanitize($msg)));
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

if(isMuted($userid) == false && trim($msg) != "") {
	if($_SESSION['admin_mode'] == 0 || !isset($_SESSION['admin_mode']) || ($_SESSION['admin_mode'] ==
		1 && strpos($mmsg, "/chat ") == 0)) {
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

		if(substr($msg, 0, 2) == "/r") {
			$message = substr($msg, 2);
			$get_last_whisper = mysql_query("SELECT `userid` FROM `chat` WHERE `to`=" . $_SESSION['user_id'] .
				" AND `channel`=\"w\" AND `posttime` >= " . (time() - (24 * 60 * 60)) .
				" ORDER BY `posttime` DESC LIMIT 0, 1");
			if(mysql_num_rows($get_last_whisper) > 0) {
				$last_whisper = mysql_fetch_assoc($get_last_whisper);
				$to = $last_whisper['userid'];
				$msg = $message;
				$channel = "w";
				$userid = $_SESSION['user_id'];
			} else {
				$to = $_SESSION['user_id'];
				$msg = "No whispers recieved in the last 24 hours";
				$channel = "w";
				$userid = 14;
			}
		}
	}

	if($msg == "/myid") {
		$to = $_SESSION['user_id'];
		$msg = "Your ID is " . $to;
		$userid = 14;
		$channel = "w";
	} elseif($msg == "/force") {
		echo "botcheck|show|";
		die();
	} elseif($msg == "/logout") {
		//header("Location: logout.php");
	} elseif($msg == "/clear") {
		// Code to clear chat, probably a call to a JS function
	} elseif($msg == "/stop") {
		// Code to stop chat
	}


	if($msg == "/adminmode") {
		if($_SESSION['access_level'] > 50) {
			if($_SESSION['admin_mode'] == 1) {
				$_SESSION['admin_mode'] = 0;
				$to = $_SESSION['user_id'];
				$msg = "Admin mode disabled";
				$userid = 14;
				$channel = "w";
			} else {
				$_SESSION['admin_mode'] = 1;
				$to = $_SESSION['user_id'];
				$msg = "Admin mode enabled";
				$userid = 14;
				$channel = "w";
			}
		}
	}

	if($_SESSION['admin_mode'] == 1) {
		if(substr($msg, 0, 9) == "/userinfo") {
			$user = trim(substr($msg, 9));
			$select_info = mysql_query("SELECT * FROM `users` WHERE `user_id`=\"" . $user .
				"\" OR LCASE(`username`)=\"" . (strtolower($user)) . "\"");
			if(mysql_num_rows($select_info) > 0) {
				$info = mysql_fetch_assoc($select_info);
				$to = $_SESSION['user_id'];

				if($info['register_ip'] != "") {
					$ip = $info['register_ip'];
				} else {
					$ip = "No data available";
				}
				if($info['banned'] == 1) {
					$banned = "true";
				} else {
					$banned = "false";
				}

				$chats = "";
				if($info['world'] == 1) {
					$chats .= "world, ";
				}
				if($info['guild'] == 1) {
					$chats .= "guild, ";
				}
				if($info['trade'] == 1) {
					$chats .= "trade, ";
				}
				if($info['help'] == 1) {
					$chats .= "help";
				}

				$mesg[0] = "User id: " . $info['user_id'];
				$mesg[1] = "Username: " . $info['username'];
				$mesg[2] = "Alias: " . $info['alias'];
				$mesg[3] = "Location: " . $info['location_id'];
				$mesg[4] = "Botcheck: " . $info['botcheck'];
				$mesg[5] = "Botcheck Number: " . $info['botcheck_number'];
				$mesg[6] = "Join Date: " . $info['join_date'];
				$mesg[7] = "IP: " . $ip;
				$mesg[8] = "Banned: " . $banned;
				$mesg[9] = "Level: " . $info['level'];
				$mesg[10] = "Currency: " . $info['currency'];
				$mesg[11] = "Theme: " . $info['theme'];
				$mesg[12] = "Active Chats: " . rtrim($chats, ",");
				$userid = 14;
				$channel = "w";
				for ($i = 0; $i < count($mesg); $i++) {
					mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"" . $mesg[$i] . "\", \"" . $channel . "\", '" . time() .
						"', '$to', '$tag')");
				}
			} else {
				$to = $_SESSION['user_id'];
				$msg = "User " . $user . " not found";
				$userid = 14;
				$channel = "w";
			}
		} elseif($msg == "/help") {
			$to = $_SESSION['user_id'];
			$channel = "w";
			$userid = 14;
			$mesg[0] = "Available commands: ";
			$mesg[1] = "/adminmode - toggles admin mode";
			$mesg[2] = "/help - lists commands";
			$mesg[3] = "/userinfo [id/name] - outputs info about user with user id = [id] or username [name]";
			$mesg[4] = "/sql [some SQL] - runs some sql code on the server";
			$mesg[5] = "/perkinfo [id/name] - outputs info about the user's perks (avatar etc)";

			for ($i = 0; $i < count($mesg); $i++) {
				mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"" . $mesg[$i] . "\", \"" . $channel . "\", '" . time() .
					"', '$to', '$tag')");
			}
		} elseif(substr($msg, 0, 4) == "/sql") {
			$mesg = substr($msg, 4);
			$mesg = stripslashes($mesg);
			$to = $_SESSION['user_id'];
			$channel = "w";
			$userid = 14;
			if(mysql_query($mesg)) {
				mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"User info updated\", \"" . $channel . "\", '" . time() .
					"', '$to', '$tag')");
			} else {
				mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"Error: " . mysql_error() . " sql: " . $mesg . "\", \"" .
					$channel . "\", '" . time() . "', '$to', '$tag')");
			}
		} elseif(substr($msg, 0, 9) == "/perkinfo") {
			//$to = $_SESSION['user_id'];
			//		$channel = "w";
			//		$userid = 14;
			//		$msg = "perkinfo";
			$user = trim(substr($msg, 9));
			$select_user = mysql_query("SELECT `user_id`, `username` FROM `users` WHERE `user_id`=\"" .
				$user . "\" OR LCASE(`username`)=\"" . (strtolower($user)) . "\"");
			if(mysql_num_rows($select_user) > 0) {
				$userinfo = mysql_fetch_assoc($select_user);
				$select_info = mysql_query("SELECT * FROM `perks` WHERE `userid`=\"" . $userinfo['user_id'] .
					"\"");
				if(mysql_num_rows($select_info) > 0) {
					$info = mysql_fetch_assoc($select_info);
					$to = $_SESSION['user_id'];
					$channel = "w";
					$userid = 14;

					foreach ($info as $key => &$value) {
						if($value == "1") {
							$value = "true";
						} elseif($value == "0") {
							$value = "false";
						} else
							if($value == "") {
								$value = "No data available";
							}
					}

					$mesg[0] = "Extra Emotes: " . $info['extra_emotes'];
					$mesg[1] = "Chat Colour: " . $info['chat_color'];
					$mesg[2] = "Forum Signature: " . $info['forum_signature'];
					$mesg[3] = "Forum Avatar: " . $info['forum_avatar'];
					$mesg[4] = "Active Avatar: " . $info['active_avatar'];
					$mesg[5] = "Extended Botcheck: " . $info['ext_botcheck'];
					$mesg[6] = "Inactive Whispers: " . $info['inactive_whispers'];
					$mesg[7] = "Custom Login: " . $userinfo['username'] . " " . $info['custom_login'];

					for ($i = 0; $i < count($mesg); $i++) {
						mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"" . $mesg[$i] . "\", \"" . $channel . "\", '" . time() .
							"', '$to', '$tag')");
					}
				} else {
					$to = $_SESSION['user_id'];
					$msg = "User " . $user . " not found. stage: 1";
					$userid = 14;
					$channel = "w";
				}
			} else {
				$to = $_SESSION['user_id'];
				$msg = "User " . $user . " not found. stage: 2";
				$userid = 14;
				$channel = "w";
			}
		}
	}
	if(!isset($mesg)) {
		mysql_query("INSERT INTO `chat` (`userid`,`message`,`channel`,`posttime`,`to`,`tag`)
   VALUES ('$userid', \"" . $msg . "\", \"" . $channel . "\", '" . time() .
			"', '$to', '$tag')");
	}
	echo "updateChat|";
}
?>