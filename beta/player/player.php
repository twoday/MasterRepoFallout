<?php

ob_start();
include ("dbconnect.php");
include ("../game_includes/functions.php");
if(isset($_GET['id']) && $_GET['id'] != "") {
	$select_player_info = mysqli_query($link,
		"SELECT `username`, `access_level`, `location_id`, `join_date` FROM `users` WHERE `user_id`=" .
		$_GET['id']);
	if(mysqli_num_rows($select_player_info) > 0) {
		$player_info = mysqli_fetch_assoc($select_player_info);
		$skill_info = "";
		$join_info = "<b>Member since: </b>" . $player_info['join_date'] . "<br />";
		$join_info .= "<b>Player ID: </b>" . $_GET['id'];

		$select_player_skills = mysqli_query($link,
			"SELECT * FROM `player_skill` WHERE `player_id` = " . $_GET['id']);
		if(mysqli_num_rows($select_player_skills) > 0) {
			while ($player_skills = mysqli_fetch_assoc($select_player_skills)) {
			 $level = calculateLevel($player_skills['exp']);
				$remaining = calculateNextLevel($level, $player_skills['exp']);
				$skill_info .= "<div class=\"skill\" id=\"" . strtolower($player_skills['skill_name']) .
					"\" style=\"display: block; cursor: pointer;\">" . $player_skills['skill_name'] .
					": " . $level . "  </div>";
				$skill_info .= "<div id=\"" . strtolower($player_skills['skill_name']) . "_exp\" style=\"display: none;\">- " .
					number_format($player_skills['exp'], 0) . " Exp / " . number_format($remaining,
					0) . " Remaining</div>";
			}
		} else {
			$skill_info = "No skill data available";
		}

		$select_avatar = mysqli_query($link,
			"SELECT `forum_avatar` FROM `perks` WHERE `userid`=" . $_GET['id']);
		$avatar = mysqli_fetch_assoc($select_avatar);

		$staff_info = "<b>Staff Position: </b>No data available";
		foreach (get_defined_constants() as $key => $value) {
			if(strpos($key, "_LEVEL") != false) {
				if($player_info['access_level'] == $value) {
					$staff_info = "<b>Staff Position: </b>" . trim(ucfirst(strtolower(str_replace("_",
						" ", $key))), " level");
				}
			}
		}

		$select_location = mysqli_query($link,
			"SELECT `name` FROM `locations` WHERE `id`=" . $player_info['location_id']);
		if(mysqli_num_rows($select_location) > 0) {
			$location = mysqli_fetch_assoc($select_location);
			$location_info = "<b>Location:</b> " . $location['name'];
		} else {
			$location_info = "<b>Location:</b> No data available";
		}
		$select_guild_id = mysqli_query($link,
			"SELECT `guild_id`, `rank` FROM `guild_members` WHERE `userid`=" . $_GET['id']);
		if(mysqli_num_rows($select_guild_id) > 0) {
			$guild_id = mysqli_fetch_assoc($select_guild_id);
			$select_guild = mysqli_query($link,
				"SELECT `name`, `tag` FROM `guilds` WHERE `id`=" . $guild_id['guild_id']);
			if(mysqli_num_rows($select_guild) > 0) {
				$guild = mysqli_fetch_assoc($select_guild);
				$guild_info = "<b>Guild: </b>" . $guild['name'] . " [" . $guild['tag'] .
					"]<br />";
				$guild_info .= "<b>Rank: </b>" . $guild_id['rank'];
			}
		} else {
			$guild_info = "<b>Guild: </b>None";
		}
	} else {
		$error = "No user found with id: " . $_GET['id'];
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
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
			<script>
				$(document).ready(function() {
					$('.skill').click(function() {
						var id = $(this).attr('id');
						$("#"+id+"_exp").toggle();
					});

				});
			</script>
			<header>
				<center>
					<img src="FC.png" border="0">
					</img>
				</center>
				<div class="clear">
				</div>
			</header>
			<div id="container">
				<div class="conall">
					<div class="concenter">
						<table>
							<td>
								<div class="mincen">
									<div class="minhead" style="text-align:center;">
										<?php

	echo $player_info['username'];
?>
									</div>
									<?php

	echo $join_info . "<br />" . $staff_info . " <br />" . $location_info .
		" <br />" . $guild_info . "<br />";
	echo "<b>Avatar:</b> ";

	if($avatar['forum_avatar'] != "") {
		echo "<br /><img src=\"./avatar/" . $avatar['forum_avatar'] . "\" width=\"125px\" height=\"125px\" />";
	} else {
		echo "None";
	}
?>
								</div>
							</td>
							<td>
								<div class="mincen">
									<div class="minhead" style="text-align:center;">
										Skills
									</div>
									<?php

	echo $skill_info;
?>
										<br />
								</div>
							</td>
							<tr>
								<td colspan="2">
									<div class="tmidbot">
										<?php

	if(isset($error)) {
		echo $error;
	} else {
?>
											<div class="minhead" style="text-align:center;">
												Description
											</div>
											Charlotte,
											<br>
											She will provide the news through server communication to all players when updates, game mechanics, or punishments are mentioned. Charlotte will not be a bot that punishes players for breaking rules or
											not following staff direction. Her actions consist of pre- emptively muting players who enter curse words or inappropriate links through any form of public communication. Staff; "Moderators, Administrators"
											are the main source of punishments for non-law abiding citizens. Also punishments by staff will appear by the punishing staff member,
											<b>
												NOT
											</b>
											Charlotte. The only punishments that will show by Charlotte of those that are automatically registered by the previously stated.
											<br>
											<br>
											Players will have the option to message Charlotte. Though respect the right of messages or you will be punished accordingly. If you abusively message Charlotte the option will be taken away. Her responses
											will be minimal so don't expect much replies.
											<br>
											<br>
											Acknowledge, Charlotte MacBeth is not an actual player, she is the server.
											<?php

	}
?>
									</div>
								</td>
						</table>
					</div>
				</div>
				<a href="/manual" class="manlinks">Manual</a>
				>
				<a href="/manual/Charlotte.php" class="manlinks">Charlotte</a>
			</div>
			<footer>
				<br>
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	
	</html>
	<?php

} else {
	header("Location: index.php");
}
ob_flush();
?>