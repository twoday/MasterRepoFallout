<?php

session_start();
include 'core/database/connect.php';
include_once 'game_includes/functions.php';

if(isset($_POST['i'])) {
	$action_id = $_POST['i'];
} else {
	die("No action ID");
}
if(isset($_POST['x'])) {
	$x = 1;
} else {
	$x = 0;
} // 1 = timer has counted down, 0 = start of work.

$q = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 0,1") or
	die(mysql_error());
$userinfo = mysql_fetch_array($q);
$userid = $userinfo['user_id'];
$player_location = $userinfo['location_id'];


$q = mysql_query("SELECT * FROM `actions` WHERE `id` = '$action_id' LIMIT 0,1") or
	die(mysql_error());
if(mysql_num_rows($q) == 0) {
	die("Action does not exist");
} else {
	$row = mysql_fetch_assoc($q);
	$base_time = $row['base_timer'];
	$gained_exp = $row['success_exp'];
	$fail_exp = $row['fail_exp'];
	$req_level = $row['level'];
	$location_id = $row['location_id'];
	$req_skill = strtolower($row['skill']); // Double check this column name is correct
	$name = strtolower($row['name']);

	$q2 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && LCASE(`skill_name`) = '$req_skill' ") or
		die(mysql_error());
	$skillw = mysql_fetch_array($q2);
	$current_exp = $skillw['exp'];
	$current_level = calculateLevel($current_exp);
	$level_diff = floor(($current_level - $req_level) / 3); // -1 second for every 3 lvls
	$timer = $base_time - $level_diff;

	if($timer < 20) {
		$timer = 20;
	}

	if($player_location != $location_id) {
		die("You are not at the correct location.");
	}
	if($current_level < $req_level) {
		die("You do not have the correct level.");
	}

	mysql_query("UPDATE `users` SET `action_id` = '$action_id', `action_skill` = '" .
		ucfirst($req_skill) . "' WHERE `user_id` = '$userid'") or die(mysql_error());

	$q = mysql_query("SELECT * FROM `action_drops` WHERE `action_id` = '$action_id' LIMIT 0,1") or
		die(mysql_error());
	$row = mysql_fetch_assoc($q);
	$item = $row['item_id'];
	$min_amount = $row['min_amount'];
	$max_amount = $row['max_amount'];

	$q = mysql_query("SELECT * FROM `item_drop` WHERE `action_id` = '$action_id' LIMIT 0,1") or
		die(mysql_error());
	$row = mysql_fetch_assoc($q);
	$gcount2 = mysql_num_rows($q);
	$dropped_item = $row['item_drop'];
	$drop_min_amount = $row['min_amount'];
	$drop_max_amount = $row['max_amount'];


	if($userinfo['check_time'] <= time()) { // Will do this if the action file works
		die("botcheck|show|");
	}


	if($x == 0) {
		$remainingexp = calculateNextLevel($current_level, $current_exp);
		echo "alterDiv|levelinfo|" . ucfirst($req_skill) . " level: $current_level [$current_exp Exp / $remainingexp Exp remaining].|";
	}
	$time = time() + (15 * 1);

	$sql33 = "SELECT count(action_id) AS tnew2 FROM `users` WHERE `action_id` = '$id' AND `check_time` >= '$time' AND `logged_in` = 1";
	$res33 = mysql_query($sql33) or die(mysql_error());
	$row23 = mysql_fetch_assoc($res33);
	$players_number = $row23['tnew2'] >= 0;

	if($players_number == 0) {
		echo "alterDiv|crowd|You are working alone today.|";
	} else {
		echo "alterDiv|crowd|You are working along with $players_number others.|";
		$timer += floor($players_number / 3);
	}


	if($x == 0) {
		echo "action|$action_id|$timer|";
		echo "alterDiv|workmessage|You start to $name|";
		$itemcount = countItem($userid, $item);
		$itemname = getItemname($item, $itemcount);
		echo "alterDiv|itemcount|You have $itemcount $itemname|";

	} else {
		echo "action|$action_id|$base_time|";

		// Add to the database
		$rand1 = rand($min_amount, $max_amount);
		addtoinv($userid, $item, $rand1);
		mysql_query("UPDATE `player_skill` SET `exp` = `exp` + '$gained_exp' WHERE LCASE(`skill_name`) = '$req_skill' AND `player_id` = '$userid'") or
			die(mysql_error());

		$select_guild = mysql_query("SELECT `guild_id` FROM `guild_members` WHERE `userid`=" .
			$userid);
		if(mysql_num_rows($select_guild) > 0) {
			$guild = mysql_fetch_assoc($select_guild);
			$guild_id = $guild['guild_id'];
			$guild_exp = ceil($gained_exp / 3);
			$select_guild_level = mysql_query("SELECT `level` FROM `guilds` WHERE `id` =" .
				$guild_id) or die(mysql_error());
			$guild_level = mysql_fetch_assoc($select_guild_level);
			mysql_query("UPDATE `guilds` SET `exp` = `exp` + '$guild_exp' WHERE `id` =" . $guild_id) or
				die(mysql_error());
			$select_guild_exp = mysql_query("SELECT `exp`, `level` FROM `guilds` WHERE `id`=" .
				$guild_id);
			$guild_info = mysql_fetch_assoc($select_guild_exp);
			$curr_guild_lvl = calculateLevel($guild_info['exp']);
			if($curr_guild_lvl > $guild_level['level']) {
				mysql_query("UPDATE `guilds` SET `level` =" . $curr_guild_lvl . " WHERE `id` =" .
					$guild_id) or die(mysql_error());
			}
		}
        
        $charac_exp = floor($gained_exp/3);
		mysql_query("UPDATE `users` SET `exp` = `exp` + '$charac_exp' WHERE `user_id` = '$userid'") or
			die(mysql_error());
		$char_exp = mysql_query("SELECT `exp`, `level`, `health`, `mana` FROM `users` WHERE `user_id`=" . $userid);
		$exp = mysql_fetch_assoc($char_exp);
		$curr_char_lvl = calculateLevel($exp['exp']);
		echo "alterDiv|level|" . $curr_char_lvl . "|alterDiv|exp|" . $exp['exp'] . "|";

		if($curr_char_lvl > $exp['level']) {
			mysql_query("UPDATE `users` SET `level` =" . $curr_char_lvl .
				" WHERE `user_id` = '$userid'") or die(mysql_error());
                $new_hp = 25 + (floor($curr_char_lvl/3)*5);
                if($new_hp > $exp['health']){
                    mysql_query("UPDATE `users` SET `health` =" . $new_hp .
				" WHERE `user_id` = '$userid'") or die(mysql_error());
                echo "alterDiv|health|".$new_hp." / ".$new_hp."|";
                }
                
                $new_mp = 25 + (floor($curr_char_lvl/3)*5);
                if($new_mp > $exp['mana']){
                    mysql_query("UPDATE `users` SET `mana` =" . $new_hp .
				" WHERE `user_id` = '$userid'") or die(mysql_error());
                echo "alterDiv|mana|".$new_mp." / ".$new_mp."|";
                }
		}
		$q2 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && LCASE(`skill_name`) = '$req_skill' ") or
			die(mysql_error());
		$skillw = mysql_fetch_array($q2);
		$current_exp = $skillw['exp'];
		$current_level = calculateLevel($current_exp);
		$remainingexp = calculateNextLevel($current_level, $current_exp);
		echo "alterDiv|levelinfo|" . ucfirst($req_skill) . " level: $current_level [$current_exp Exp / $remainingexp Exp remaining].|";

		echo "updateSkill|$req_skill|$current_exp|$current_level|$remainingexp|";

		$itemcount = countItem($userid, $item);
		$itemname = getItemname($item, $itemcount);
		echo "alterDiv|itemcount|You have $itemcount $itemname|";
		echo "alterDiv|workmessage|You gain $rand1 $itemname|";

	}
}
?>