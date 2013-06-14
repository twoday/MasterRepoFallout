<?php

session_start();
include 'core/database/connect.php';

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or
	die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$username = $userinfo['username'];
$staff = $userinfo['type'];

function email($to, $subject, $body) {
	mail($to, $subject, $body, 'From: admin@falloutchronicle.com');
}

if(isset($_POST['p'])) {
	$page = $_POST['p'];
} else {
	$page = $_GET['p'];
}

switch ($page) {


		//Delete Sent Messages in Mailbox Section
	case 1:

		$select = "SELECT * FROM `new_messages`";
		$select_resutlts = mysql_query($select) or die(mysql_error());
		while ($row = mysql_fetch_assoc($select_resutlts)) {
			$id = $row['id'];

			if(isset($_POST['id'])) {
				$type = $_POST['id'];
			} else {
				$type = $_GET['id'];
			}

			if($type == $id) {

				mysql_query("DELETE FROM `new_messages` WHERE `id` = '$id'");


				echo "messages(1)";
			}
		}

		break;

		//Delete New Messages in Mailbox Section
	case 2:

		$select = "SELECT * FROM `sent_messages`";
		$select_resutlts = mysql_query($select) or die(mysql_error());
		while ($row = mysql_fetch_assoc($select_resutlts)) {
			$mess_id = $row['id'];

			if(isset($_POST['id'])) {
				$type = $_POST['id'];
			} else {
				$type = $_GET['id'];
			}

			if($type == $mess_id) {

				mysql_query("DELETE FROM `sent_messages` WHERE `id` = '$mess_id'");

				echo "messages(2)";

			}
		}

		break;

		//Send Message in Mailbox Section
	case 3:

		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['play'])));
		$m = htmlentities(strip_tags(mysql_real_escape_string($_POST['mess'])));
		$s = htmlentities(strip_tags(mysql_real_escape_string($_POST['subj'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$time = time();
			$date = date("M. d, Y") . " - " . date("h:i a");


			mysql_query("INSERT INTO `new_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $p . "', '" . $username . "', '" . $date . "', '" . $m .
				"','" . $time . "')") or die('Error: Cannot send message!');

			mysql_query("INSERT INTO `sent_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $p . "', '" . $username . "', '" . $date . "', '" . $m .
				"','" . $time . "')") or die('Error: Cannot send message!');

			echo "messages(4)";

		} else {
			echo "error_message(4)";

		}
		break;

		// Ban Player
	case 4:
		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['player'])));
		$l = htmlentities(strip_tags(mysql_real_escape_string($_POST['length'])));
		$r = htmlentities(strip_tags(mysql_real_escape_string($_POST['reason'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$user_check = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'") or
				die('Error');
			$userinfo2 = mysql_fetch_array($user_check);
			$banned = $userinfo2['banned'];
			$number = $userinfo2['num_ban'];
			$num = $number + 1;

			if($banned == 0) {

				$staff_c = mysql_query("SELECT * FROM `staff_members` WHERE `player_name` = '$username'") or
					die('Error');
				$staffinfo = mysql_fetch_array($staff_c);
				$name = $staffinfo['staff_name'];
				$date = date("M. d, Y") . " - " . date("h:i a");

				mysql_query("INSERT INTO `banned` (`player`,`length`,`reason`,`staff_member`,`date`) VALUES
 ('" . $p . "', '" . $l . "', '" . $r . "', '" . $name . "', '" . $date . "')") or
					die('Error: Cannot send!');

				mysql_query("UPDATE `users` SET `num_ban` = '$num' WHERE `username` = '$p'");
				mysql_query("UPDATE `users` SET `banned` = '1' WHERE `username` = '$p'");

				email($userinfo2['email'], 'Account has been Banned', "Dear " . $p . ",\n\nIt has come to our attention that you have broken the rules of Fallout Chronicle and you were banned for the following reasons;\n\n " .
					$r . "\nYour ban will last " . $l . " minutes.\n\n if you would like to appeal your ban please contact the Fallout Chronicle Administration by emailing them at admin@falloutchronicle.com\n\n Thanks for understanding,\n-- Fallout Chronicle Administration");


				echo "admin_panel(9)";


			} else
				if($banned == 1) {
					echo "error_message(1)";
				}

		} else {
			echo "error_message(4)";
		}
		break;

		// Unban Player
	case 5:
		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['player'])));
		$r = htmlentities(strip_tags(mysql_real_escape_string($_POST['reason'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$user_check = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'") or
				die('Error');
			$userinfo2 = mysql_fetch_array($user_check);
			$number = $userinfo2['num_ban'];
			$banned = $userinfo2['banned'];

			if($banned == 1) {

				if($number == 2) {
					echo "error_message(2)";

				} else {

					$staff_c = mysql_query("SELECT * FROM `staff_members` WHERE `player_name` = '$username'") or
						die('Error');
					$staffinfo = mysql_fetch_array($staff_c);
					$name = $staffinfo['staff_name'];
					$date = date("M. d, Y") . " - " . date("h:i a");

					mysql_query("INSERT INTO `unbanned` (`player`,`reason`,`staff_member`,`date`) VALUES
 ('" . $p . "', '" . $r . "', '" . $name . "', '" . $date . "')") or die('Error: Cannot send!');

					mysql_query("UPDATE `users` SET `banned` = '0' WHERE `username` = '$p'");

					email($userinfo2['email'], 'Account has been Unbanned', "Dear " . $p . ",\n\nYour appeal has come to our attention for being unbanned and has been accepted. You are able to login and play now.\nWe are to notify you that if you are banned again, you will not be able to appeal your ban.\n\nIf you have any questions plase contact the Fallout Chronicle Staff upon your return.\n\n\nEnjoy your time in Fallout Chronicle,\n-- Fallout Chronicle Administration");


					echo "admin_panel(10)";
				}

			} else
				if($banned == 0) {
					echo "error_message(3)";
				}

		} else {
			echo "error_message(4)";
		}
		break;

		// Mute Player
	case 6:
		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['player'])));
		$l = htmlentities(strip_tags(mysql_real_escape_string($_POST['length'])));
		$r = htmlentities(strip_tags(mysql_real_escape_string($_POST['reason'])));
		$c = htmlentities(strip_tags(mysql_real_escape_string($_POST['comment'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$user_check = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'") or
				die('Error');
			$userinfo2 = mysql_fetch_array($user_check);
			$mutes = $userinfo2['num_mutes'];
			$num = $mutes + 1;

			$staff_c = mysql_query("SELECT * FROM `staff_members` WHERE `player_name` = '$username'") or
				die('Error');
			$staffinfo = mysql_fetch_array($staff_c);
			$name = $staffinfo['staff_name'];
			$date = time();

			mysql_query("INSERT INTO `punishments` (`player`,`length`,`reason`,`comment`,`type`,`staff_member`,`date`) VALUES
 ('" . $userinfo2['user_id'] . "', '" . $l . "', '" . $r . "', '" . $c .
				"', 'Mute', '" . $name . "', '" . $date . "')") or die('Error: Cannot send!');

			if($l == 1) {
				$msg = $p . " has been muted for " . $r . " for " . $l . " minute by " . $name;
			} else {
				$msg = $p . " has been muted for " . $r . " for " . $l . " minutes by " . $name;
			}

			mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
   VALUES (" . $userinfo2['user_id'] . ", '$msg', 'Punishment', '" . time() .
				"', 'all')");

			mysql_query("UPDATE `users` SET `num_mutes` = '$num' WHERE `username` = '$p'");

			if($staff == 1) {
				echo "admin_panel(11)";
			} else
				if($staff == 2) {
					echo "mod_panel(11)";
				}

		} else {
			echo "error_message(4)";
		}
		break;

		// Time Out
	case 7:
		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['player'])));
		$r = htmlentities(strip_tags(mysql_real_escape_string($_POST['reason'])));
		$c = htmlentities(strip_tags(mysql_real_escape_string($_POST['comment'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$user_check = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'") or
				die('Error');
			$userinfo2 = mysql_fetch_array($user_check);
			$time_out = $userinfo2['num_time_out'];
			$num = $time_out + 1;

			$staff_c = mysql_query("SELECT * FROM `staff_members` WHERE `player_name` = '$username'") or
				die('Error');
			$staffinfo = mysql_fetch_array($staff_c);
			$name = $staffinfo['staff_name'];
			$date = time();

			mysql_query("INSERT INTO `punishments` (`player`,`length`,`reason`,`comment`,`type`,`staff_member`,`date`) VALUES
 ('" . $userinfo2['user_id'] . "', '10', '" . $r . "', '" . $c .
				"', 'Time Out', '" . $name . "', '" . $date . "')") or die('Error: Cannot send!');
			$msg = $p . " has been give a 10 minute time out for " . $r . " by " . $name;
			mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
   VALUES (" . $userinfo2['user_id'] . ", '$msg', 'Punishment', '" . time() .
				"', 'all')");

			mysql_query("UPDATE `users` SET `num_time_out` = '$num' WHERE `username` = '$p'");

			if($staff == 1) {
				echo "admin_panel(12)";
			} else
				if($staff == 2) {
					echo "mod_panel(12)";
				}

		} else {
			echo "error_message(4)";
		}
		break;

		// Appeal Punishment
	case 8:
		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['player'])));
		$c = htmlentities(strip_tags(mysql_real_escape_string($_POST['comment'])));
		$r = htmlentities(strip_tags(mysql_real_escape_string($_POST['reason'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$staff_c = mysql_query("SELECT * FROM `staff_members` WHERE `player_name` = '$username'") or
				die('Error');
			$staffinfo = mysql_fetch_array($staff_c);
			$name = $staffinfo['staff_name'];
			$date = date("M. d, Y") . " - " . date("h:i a");

			mysql_query("INSERT INTO `appeals` (`player`,`reason`,`comment`,`staff_member`,`date`) VALUES
 ('" . $p . "', '" . $r . "', '" . $c . "', '" . $name . "', '" . $date . "')") or
				die('Error: Cannot send!');

			if($staff == 1) {
				echo "admin_panel(13)";
			} else
				if($staff == 2) {
					echo "mod_panel(13)";
				}

		} else {
			echo "error_message(4)";
		}
		break;

		// Warn Player
	case 9:
		$p = htmlentities(strip_tags(mysql_real_escape_string($_POST['player'])));
		$r = htmlentities(strip_tags(mysql_real_escape_string($_POST['reason'])));
		$c = htmlentities(strip_tags(mysql_real_escape_string($_POST['comment'])));

		$namecheck = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'");
		$count = mysql_num_rows($namecheck);
		if($count != 0) {

			$user_check = mysql_query("SELECT * FROM `users` WHERE `username` = '$p'") or
				die('Error');
			$userinfo2 = mysql_fetch_array($user_check);
			$warning = $userinfo2['num_warnings'];
			$num = $warning + 1;

			$staff_c = mysql_query("SELECT * FROM `staff_members` WHERE `player_name` = '$username'") or
				die('Error');
			$staffinfo = mysql_fetch_array($staff_c);
			$name = $staffinfo['staff_name'];
			$date = time();

			mysql_query("INSERT INTO `warning` (`player`,`reason`,`comment`,`staff_member`,`date`) VALUES
 ('" . $userinfo2['user_id'] . "', '" . $r . "', '" . $c . "', '" . $name .
				"', '" . $date . "')") or die('Error: Cannot send!');
			$msg = $p . " was warned for " . $r . " by " . $name;
			mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
   VALUES (" . $userinfo2['user_id'] . ", '$msg', 'Punishment', '" . time() .
				"', 'all')");

			mysql_query("UPDATE `users` SET `num_warnings` = '$num' WHERE `username` = '$p'");

			if($staff == 1) {
				echo "admin_panel(14)";
			} else
				if($staff == 2) {
					echo "mod_panel(14)";
				}

		} else {
			echo "error_message(5)";
		}
		break;

		// Check for New Messages
	case 10:
		$sql33 = "SELECT count(*) AS tnew2 FROM `new_messages` WHERE `status` = '0' AND `to` = '$userinfo[username]' || `to` = '$userinfo[user_id]'";
		$res33 = mysql_query($sql33) or die(mysql_error());
		$row23 = mysql_fetch_assoc($res33);


		echo "show_message($row23[tnew2])";


		break;

		// Mining Timer Stuff
	case 11:

		$select7 = "SELECT * FROM `actions`";
		$select_resutlts7 = mysql_query($select7) or die(mysql_error());
		while ($row1 = mysql_fetch_assoc($select_resutlts7)) {
			$id = $row1['id'];

			if(isset($_POST['aid'])) {
				$type1 = $_POST['aid'];
			} else {
				$type1 = $_GET['aid'];
			}

			if($type1 == $id) {

				$exp = $row1['success_exp'];


				$select8 = "SELECT * FROM `player_skill` WHERE  `skill_name` = 'Mining' AND `player_id` = '$userid'";
				$select_resutlts8 = mysql_query($select8) or die(mysql_error());
				while ($skill1 = mysql_fetch_assoc($select_resutlts8)) {

					$level = $skill1['level'];
					$texp = $skill1['exp'];

					$thexp3 = floor(($level / 2) * pow(floor(($level * 5)), 2));
					$amount = $texp + $exp;

					mysql_query("UPDATE `player_skill` SET `exp` = '$amount' WHERE `skill_name` = 'Mining' AND `player_id` = '$userid'");

					if($amount >= $thexp3) {
						$levelup = $level + 1;
						mysql_query("UPDATE `player_skill` SET `level` = '$levelup' WHERE `skill_name` = 'Mining' AND `player_id` = '$userid'");

					}

				}
			}
		}

		break;

		// Insert item into players Inventory (Db) when timer hits 0
	case 12:

		$select7 = "SELECT * FROM `actions`";
		$select_resutlts7 = mysql_query($select7) or die(mysql_error());
		while ($row1 = mysql_fetch_assoc($select_resutlts7)) {

			$id = $row1['id'];

			if(isset($_POST['aid'])) {
				$type1 = $_POST['aid'];
			} else {
				$type1 = $_GET['aid'];
			}

			if($type1 == $id) {
				$amount_from = mysql_real_escape_string($_POST['num']);

				$query1 = mysql_query("SELECT * FROM `action_drops` WHERE `action_id` = '$id' LIMIT 0,1");
				$row1 = mysql_fetch_assoc($query1);
				$id2 = $row1['item_id'];


				$selec = "SELECT * FROM `inventory` WHERE `itemid` = '$id2' AND `userid` = '$userid'";
				$select_res = mysql_query($selec) or die(mysql_error());
				$gcount = mysql_num_rows($select_res);
				while ($row5 = mysql_fetch_assoc($select_res)) {

					$the_amount = $row5['count'];
					$amount4 = $the_amount + $amount_from;
				}


				if($gcount == 0) {

					mysql_query("INSERT INTO `inventory` (`userid`,`itemid`,`count`) VALUES
 ('" . $userid . "','" . $id2 . "','" . $amount_from . "')") or die('Error: Cannot insert.');

				} else {

					mysql_query("UPDATE `inventory` SET `count` = '" . $amount4 .
						"' WHERE `itemid` = '" . $id2 . "' AND `userid` = '" . $userid . "'");
				}

			}
		}
		break;

		//Settings
	case 13:

		$theme = $_POST['type'];

		if($theme == "css/game") {
			$theme2 = "Game";
		}

		if($theme == "css/violet") {
			$theme2 = "Violet";
		}

		if($theme == "css/royal") {
			$theme2 = "Royal";
		}

		if($theme == "css/maroon") {
			$theme2 = "Maroon";
		}

		if($theme == "css/forest") {
			$theme2 = "Forest";
		}

		mysql_query("UPDATE `users` SET `theme` = '$theme2' WHERE `user_id` = '$userid'");

		break;

		//Mass Warn
	case 14:

		$warn = $_POST['warn'];


		mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
VALUES ('" . $userid . "', '" . $warn . "', 'Punishment', '" . time() .
			"', 'All')");
		break;

		//Create Guild
	case 21:
		$name = htmlentities(strip_tags(mysql_real_escape_string($_POST['name'])));
		$tag = htmlentities(strip_tags(mysql_real_escape_string($_POST['tag'])));

		$selec = "SELECT * FROM `guilds` WHERE `name` = '$name'";
		$select_res = mysql_query($selec) or die(mysql_error());
		$gcount = mysql_num_rows($select_res);

		$selec2 = "SELECT * FROM `guilds` WHERE `tag` = '$tag'";
		$select_res2 = mysql_query($selec2) or die(mysql_error());
		$gcount2 = mysql_num_rows($select_res2);

		$selec3 = "SELECT * FROM `guild_requests` WHERE `userid` = '$userid'";
		$select_res3 = mysql_query($selec3) or die(mysql_error());
		$gcount3 = mysql_num_rows($select_res3);

		if($gcount != 0) {
			echo "error_name()";
		} else
			if($gcount2 != 0) {
				echo "error_tag()";
			} else
				if($gcount3 != 0) {
					echo "error_guild()";
				} else {

					mysql_query("INSERT INTO `guilds` (`name`,`tag`,`leader`,`created`,`create_time`) VALUES
 ('" . $name . "','" . $tag . "','" . $userid . "','" . date("M-d-Y h:i a") .
						"','" . time() . "')") or die('Error: Cannot insert.');

					$query = mysql_query("SELECT * FROM `guilds` WHERE `name` = '$name'");
					$row = mysql_fetch_assoc($query);
					$guild_id = $row['id'];

					mysql_query("INSERT INTO `guild_members` (`userid`,`guild_id`,`leader`,`rank`) VALUES
 ('" . $userid . "','" . $guild_id . "','1','Leader')") or die('Error: Cannot insert.');

					mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
VALUES ('" . $_SESSION['user_id'] .
						"', 'In the midst of settling in Halloran, a few players have come together to create $name.', 'Server', '" .
						time() . "', 'All')");

					echo "guild(1)";
				}

				break;

		//Apply to Guild
	case 15:
		$guild_id = htmlentities(strip_tags(mysql_real_escape_string($_POST['guild_id'])));

		$selec2 = "SELECT * FROM `guild_requests` WHERE `userid` = '$userid'";
		$select_res2 = mysql_query($selec2) or die(mysql_error());
		$gcount2 = mysql_num_rows($select_res2);

		if($gcount2 != 0) {
			echo "error_joined()";
		} else {

			$check2 = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'") or die('Error');
			$view2 = mysql_fetch_array($check2);
			$leader = $view2['leader'];

			$time = time();
			$date = date("M. d, Y") . " - " . date("h:i a");

			$s = "Guild";
			$m = "$username has applied to be in your guild.";

			mysql_query("INSERT INTO `new_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $leader . "', 'System', '" . $date . "', '" . $m . "','" .
				$time . "')") or die('Error: Cannot send message!');

			mysql_query("INSERT INTO `guild_requests` (`userid`,`guild_id`) VALUES
 ('" . $userid . "','" . $guild_id . "')") or die('Error: Cannot insert.');

			echo "guild(1)";
		}
		break;

		//Delete sent guild request
	case 16:
		$req_id = htmlentities(strip_tags(mysql_real_escape_string($_POST['req_id'])));
		mysql_query("DELETE FROM `guild_requests` WHERE `req_id` = '$req_id'");
		echo "guild(1)";
		break;

		//Disband Guild
	case 17:
		$guild_id = htmlentities(strip_tags(mysql_real_escape_string($_POST['guild_id'])));

		$check2 = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'") or die('Error');
		$view2 = mysql_fetch_array($check2);
		$name = $view2['name'];

		$result = mysql_query("SELECT * FROM `guild_members` WHERE `guild_id` = '$guild_id'");
		while ($view = mysql_fetch_array($result)) {
			$member_id = $view['userid'];
			$time = time();
			$date = date("M. d, Y") . " - " . date("h:i a");

			$s = "Guild";
			$m = "$name has been disbanded.";

			mysql_query("INSERT INTO `new_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $member_id . "', 'System', '" . $date . "', '" . $m . "','" .
				$time . "')") or die('Error: Cannot send message!');

		}

		mysql_query("DELETE FROM `guild_members` WHERE `guild_id` = '$guild_id'");
		mysql_query("DELETE FROM `guilds` WHERE `id` = '$guild_id'");

		echo "guild(1)";
		break;

		//Accept Member Req
	case 18:
		$req_id = htmlentities(strip_tags(mysql_real_escape_string($_POST['req_id'])));

		$check = mysql_query("SELECT * FROM `guild_requests` WHERE `req_id` = '$req_id'") or
			die('Error');
		$view = mysql_fetch_array($check);
		$member_id = $view['userid'];
		$guild_id = $view['guild_id'];

		$check2 = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'") or die('Error');
		$view2 = mysql_fetch_array($check2);
		$name = $view2['name'];

		$time = time();
		$date = date("M. d, Y") . " - " . date("h:i a");

		$s = "Guild";
		$m = "Your request into $name has been accepted.";

		mysql_query("INSERT INTO `new_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $member_id . "', 'System', '" . $date . "', '" . $m . "','" .
			$time . "')") or die('Error: Cannot send message!');

		mysql_query("INSERT INTO `guild_members` (`userid`,`guild_id`,`leader`,`rank`) VALUES
 ('" . $member_id . "','" . $guild_id . "','0','New Recruit')") or die('Error: Cannot insert.');

		mysql_query("DELETE FROM `guild_requests` WHERE `req_id` = '$req_id'");
		echo "guild(1)";

		break;

		//Decline Member Req
	case 19:
		$req_id = htmlentities(strip_tags(mysql_real_escape_string($_POST['req_id'])));

		$check = mysql_query("SELECT * FROM `guild_requests` WHERE `req_id` = '$req_id'") or
			die('Error');
		$view = mysql_fetch_array($check);
		$member = $view['userid'];
		$guild_id = $view['guild_id'];

		$check2 = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'") or die('Error');
		$view2 = mysql_fetch_array($check2);
		$name = $view2['name'];

		$time = time();
		$date = date("M. d, Y") . " - " . date("h:i a");

		$s = "Guild";
		$m = "Your request into $name has been declined.";

		mysql_query("INSERT INTO `new_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $member . "', 'System', '" . $date . "', '" . $m . "','" .
			$time . "')") or die('Error: Cannot send message!');


		mysql_query("DELETE FROM `guild_requests` WHERE `req_id` = '$req_id'");
		echo "guild(2)";

		break;

		//Leave Guild
	case 20:

		$check = mysql_query("SELECT * FROM `guild_members` WHERE `userid` = '$userid'") or
			die('Error');
		$view = mysql_fetch_array($check);
		$guild_id = $view['guild_id'];

		$check2 = mysql_query("SELECT * FROM `guilds` WHERE `id` = '$guild_id'") or die('Error');
		$view2 = mysql_fetch_array($check2);
		$leader = $view2['leader'];

		$time = time();
		$date = date("M. d, Y") . " - " . date("h:i a");

		$s = "Guild";
		$m = "$username has left your guild.";

		mysql_query("INSERT INTO `new_messages` (`title`,`to`,`from`,`date`,`message`,`time`) VALUES
 ('" . $s . "', '" . $leader . "', 'System', '" . $date . "', '" . $m . "','" .$time . "')") or die('Error: Cannot send message!');

		mysql_query("DELETE FROM `guild_members` WHERE `userid` = '$userid'");

		echo "guild(1)";
		break;

//Woodcutting timer success
case 22 :

		$select7 = "SELECT * FROM `actions`";
		$select_resutlts7 = mysql_query($select7) or die(mysql_error());
		while ($row1 = mysql_fetch_assoc($select_resutlts7)) {
			$id = $row1['id'];

			if(isset($_POST['aid'])) {
				$type1 = $_POST['aid'];
			} else {
				$type1 = $_GET['aid'];
			}

			if($type1 == $id) {

				$exp = $row1['success_exp'];


				$select8 = "SELECT * FROM `player_skill` WHERE  `skill_name` = 'Woodcutting' AND `player_id` = '$userid'";
				$select_resutlts8 = mysql_query($select8) or die(mysql_error());
				while ($skill1 = mysql_fetch_assoc($select_resutlts8)) {

					$level = $skill1['level'];
					$texp = $skill1['exp'];

					$thexp3 = floor(($level / 2) * pow(floor(($level * 5)), 2));
					$amount = $texp + $exp;

					mysql_query("UPDATE `player_skill` SET `exp` = '$amount' WHERE `skill_name` = 'Woodcutting' AND `player_id` = '$userid'");

					if($amount >= $thexp3) {
						$levelup = $level + 1;
						mysql_query("UPDATE `player_skill` SET `level` = '$levelup' WHERE `skill_name` = 'Woodcutting' AND `player_id` = '$userid'");

					}

				}
			}
		}

break;

//Insert Woodcutting Drops
case 23 :

		$select7 = "SELECT * FROM `actions`";
		$select_resutlts7 = mysql_query($select7) or die(mysql_error());
		while ($row1 = mysql_fetch_assoc($select_resutlts7)) {

			$id = $row1['id'];

			if(isset($_POST['aid'])) {
				$type1 = $_POST['aid'];
			} else {
				$type1 = $_GET['aid'];
			}

			if($type1 == $id) {
				$amount_from = mysql_real_escape_string($_POST['drop']);

				$query1 = mysql_query("SELECT * FROM `item_drop` WHERE `action_id` = '$id' LIMIT 0,1");
				$row1 = mysql_fetch_assoc($query1);
				$id2 = $row1['item_drop'];


				$selec = "SELECT * FROM `inventory` WHERE `itemid` = '$id2' AND `userid` = '$userid'";
				$select_res = mysql_query($selec) or die(mysql_error());
				$gcount = mysql_num_rows($select_res);
				while ($row5 = mysql_fetch_assoc($select_res)) {

					$the_amount = $row5['count'];
					$amount4 = $the_amount + $amount_from;
				}


				if($gcount == 0) {

					mysql_query("INSERT INTO `inventory` (`userid`,`itemid`,`count`) VALUES
 ('" . $userid . "','" . $id2 . "','" . $amount_from . "')") or die('Error: Cannot insert.');

				} else {

					mysql_query("UPDATE `inventory` SET `count` = '" . $amount4 .
						"' WHERE `itemid` = '" . $id2 . "' AND `userid` = '" . $userid . "'");
				}

			}
		}
break;

//Insert Fail Exp for Mining
case 24 :
$select7 = "SELECT * FROM `actions`";
		$select_resutlts7 = mysql_query($select7) or die(mysql_error());
		while ($row1 = mysql_fetch_assoc($select_resutlts7)) {
			$id = $row1['id'];

			if(isset($_POST['aid'])) {
				$type1 = $_POST['aid'];
			} else {
				$type1 = $_GET['aid'];
			}

			if($type1 == $id) {

				$exp = $_POST['exp'];


				$select8 = "SELECT * FROM `player_skill` WHERE  `skill_name` = 'Mining' AND `player_id` = '$userid'";
				$select_resutlts8 = mysql_query($select8) or die(mysql_error());
				while ($skill1 = mysql_fetch_assoc($select_resutlts8)) {

					$level = $skill1['level'];
					$texp = $skill1['exp'];

					$thexp3 = floor(($level / 2) * pow(floor(($level * 5)), 2));
					$amount = $texp + $exp;

					mysql_query("UPDATE `player_skill` SET `exp` = '$amount' WHERE `skill_name` = 'Mining' AND `player_id` = '$userid'");

					if($amount >= $thexp3) {
						$levelup = $level + 1;
						mysql_query("UPDATE `player_skill` SET `level` = '$levelup' WHERE `skill_name` = 'Mining' AND `player_id` = '$userid'");

					}

				}
			}
		}
break;

//Insert Fail Exp for Woodcutting
case 25 :
$select7 = "SELECT * FROM `actions`";
		$select_resutlts7 = mysql_query($select7) or die(mysql_error());
		while ($row1 = mysql_fetch_assoc($select_resutlts7)) {
			$id = $row1['id'];

			if(isset($_POST['aid'])) {
				$type1 = $_POST['aid'];
			} else {
				$type1 = $_GET['aid'];
			}

			if($type1 == $id) {

				$exp = $_POST['exp'];


				$select8 = "SELECT * FROM `player_skill` WHERE  `skill_name` = 'Woodcutting' AND `player_id` = '$userid'";
				$select_resutlts8 = mysql_query($select8) or die(mysql_error());
				while ($skill1 = mysql_fetch_assoc($select_resutlts8)) {

					$level = $skill1['level'];
					$texp = $skill1['exp'];

					$thexp3 = floor(($level / 2) * pow(floor(($level * 5)), 2));
					$amount = $texp + $exp;

					mysql_query("UPDATE `player_skill` SET `exp` = '$amount' WHERE `skill_name` = 'Woodcutting' AND `player_id` = '$userid'");

					if($amount >= $thexp3) {
						$levelup = $level + 1;
						mysql_query("UPDATE `player_skill` SET `level` = '$levelup' WHERE `skill_name` = 'Woodcutting' AND `player_id` = '$userid'");

					}

				}
			}
		}
break;

//Insert into News Feed	
case 26 :
$m = $_POST['message'];

mysql_query("INSERT INTO `news_feeds` (`userid`,`message`) VALUES
 ('" . $userid . "', '" . $m . "')") or die('Error: Cannot send message!');
break;

//Update Botcheck
case 27 :

 mysql_query("UPDATE `users` SET `botcheck` = '0' WHERE `user_id` = '$userid'");
$time = 30*60;
$new = time()+$time;
mysql_query("UPDATE `users` SET `check_time` = '$new' WHERE `user_id` = '$userid'");

break;

case 28 :
$check2 = mysql_query("SELECT `user_id`,`username`,`botcheck`,`check_time` FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error1');
$userinfo2 = mysql_fetch_array($check2);

$time = time();
if($userinfo2['check_time'] >= $time){

}else{
 echo "botcheck();"; 
  
}

break;

}
?>