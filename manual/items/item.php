<?php

include ("dbconnect.php");

if(!isset($_GET['id']) || $_GET['id'] == "") {
	header("Refresh: 0; url=\"index.php\"");
} else {
	$id = $_GET['id'];
	$select_item_info = mysqli_query($link, "SELECT * FROM `items` WHERE `id` = " .
		$id);
	$item_info = mysqli_fetch_assoc($select_item_info);
?>
	<!doctype html>
	<html>
		<head>
			<title>
				Fallout Chronicle
			</title>
			<meta charset="UTF-8" />
			<link rel="stylesheet" href="screen.css" />
			<link rel="shortcut icon" href="favicon.png" />
			<meta name="title" content="Fallout Chronicle" />
			<meta name="description" content="Fallout Chronicle is a browser text based game, with 12 skills, over hundreds of resources to collect, guilds to build, and quests to complete." />
		</head>
		<body>
			<header>
				<center>
					<img src="FC.png" />
				</center>
				<div class="clear">
				</div>
			</header>
			<div id="container">
				<div class="conall">
					<div class="minhead">
						<center>
						<?php

	echo $item_info['name'];
?>
						</center>
					</div>
                    <table>
                    <tr>
                    <td>ID</td>
                    <td>Class</td>
                    <td>Weight</td>
                    <?php

	$info_content .= "<tr><td>" . $item_info['id'] . "</td><td>" . $item_info['type'] .
		"</td>";

	if($item_info['poundals'] > 0) {
		$info_content .= "<td>" . $item_info['poundals'];
		if($item_info['poundals'] > 1) {
			$info_content .= " Poundals";
		} else {
			$info_content .= " Poundal";
		}
		if($item_info['ouncels'] > 0) {
			$info_content .= " and " . $item_info['ouncels'] . "";
			if($item_info['ouncels'] > 1) {
				$info_content .= " Ouncels</td>";
			} else {
				$info_content .= " Ouncel</td>";
			}
		} else {
			$info_content .= "</td>";
		}
	} else {
		if($item_info['ouncels'] > 1) {
			$info_content .= "<td>" . $item_info['ouncels'] . " Ouncels</td>";
		} else {
			$info_content .= "<td>" . $item_info['ouncels'] . " Ouncel</td>";
		}
	}
	if($item_info['type'] == "Food") {
		echo "<td>Effect</td>";
		$select_effect = mysqli_query($link,
			"SELECT `affected_stat`, `effect_on_stat` FROM `food` WHERE `item_id`=" . $item_info['id']) or
			die(mysqli_erorr($link));
		if(mysqli_num_rows($select_effect) > 0) {
			$effect = mysqli_fetch_assoc($select_effect);
			$select_stat = mysqli_query($link, "SELECT `name` FROM `stats` WHERE `id`=" . $effect['affected_stat']);
			$stat = mysqli_fetch_assoc($select_stat);

			if($effect['effect_on_stat'] == "0") {
				$info_content = "<tr><td>No effects</td></tr>";
			} else {
				if($effect['effect_on_stat'] > 0) {
					$bonus = "+" . $effect['effect_on_stat'];
				} else {
					$bonus = $effect['effect_on_stat'];
				}
				$info_content .= "<td>" . $bonus . " " . $stat['name'] . "</td></tr>";
			}
		}
	} else {
		$info_content .= "</tr>";
	}
?>
                    </tr>
                    <?php

	echo $info_content;
?>
                    </table>
                    <?php

	$select_uses = mysqli_query($link,
		"SELECT * FROM `required_items` WHERE `item_id` =" . $item_info['id']);
	if(mysqli_num_rows($select_uses) > 0) {
		while ($uses = mysqli_fetch_assoc($select_uses)) {
			$select_use_actions = mysqli_query($link, "SELECT * FROM `actions` WHERE `id`=" .
				$uses['action_id']);
			if(mysqli_num_rows($select_use_actions) > 0) {
				while ($use_actions = mysqli_fetch_assoc($select_use_actions)) {
					$select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id`=" .
						$use_actions['skill_id']);
					$skill = mysqli_fetch_assoc($select_skill);

					$select_location = mysqli_query($link,
						"SELECT `name` FROM `locations` WHERE `id`=" . $use_actions['location_id']);
					$location = mysqli_fetch_assoc($select_location);

					$uses_content .= "<tr><td>" . $use_actions['name'] . "</td><td>" . $location['name'] .
						"</td><td>Level " . $use_actions['level'] . " " . $skill['name'] . "</td><td>" .
						$uses['quantity'] . "</td></tr>";
				}
			}
		}
	} else {
		$uses_content = "<tr><td colspan=\"4\">No uses</td></tr>";
	}
	$select_obtained = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `item_id`=" . $item_info['id']);
	if(mysqli_num_rows($select_obtained) > 0) {
		while ($obtained = mysqli_fetch_assoc($select_obtained)) {
			$select_obtain_actions = mysqli_query($link,
				"SELECT * FROM `actions` WHERE `id`=" . $obtained['action_id']);
			if(mysqli_num_rows($select_obtain_actions) > 0) {
				while ($obtain_actions = mysqli_fetch_assoc($select_obtain_actions)) {
					$select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id`=" .
						$obtain_actions['skill_id']);
					$skill = mysqli_fetch_assoc($select_skill);

					$select_location = mysqli_query($link,
						"SELECT `name` FROM `locations` WHERE `id`=" . $obtain_actions['location_id']);
					$location = mysqli_fetch_assoc($select_location);

					if($obtained['min_amount'] == $obtained['max_amount']) {
						$quantity = $obtained['min_amount'];
					} else {
						$quantity = $obtained['min_amount'] . " - " . $obtained['max_amount'];
					}
					$obtain_content .= "<tr><td>" . $obtain_actions['name'] . "</td><td>" . $location['name'] .
						"</td><td>Level " . $obtain_actions['level'] . " " . $skill['name'] .
						"</td><td>" . $quantity . "</td></tr>";
				}
			}
		}
	} else {
		$obtain_content = "<tr><td colspan=\"4\">Not obtainable</td></tr>";
	}

	if($item_info['type'] == "Food") {

	} elseif($item_info['type'] == "Armour" || $item_info['type'] == "Weapon") {
		$select_combat_equipment_info = mysqli_query($link,
			"SELECT `slot`, `required_skill`, `skill_level` FROM `equipment` WHERE `item_id`=" .
			$id);
		$combat_equipment_info = mysqli_fetch_assoc($select_combat_equipment_info);


		$select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id` = " .
			$combat_equipment_info['required_skill']);
		$skill = mysqli_fetch_assoc($select_skill);

		$select_combat_bonuses = mysqli_query($link,
			"SELECT `armour`, `power`, `accuracy` FROM `combat_equipment` WHERE `item_id`=" .
			$id);
		$combat_bonuses = mysqli_fetch_assoc($select_combat_bonuses);

		$combat_content .= "<tr><td>" . $combat_equipment_info['slot'] .
			"</td><td>Level " . $combat_equipment_info['skill_level'] . " " . $skill['name'] .
			"</td><td>" . $combat_bonuses['armour'] . "</td><td>" . $combat_bonuses['power'] .
			"</td><td>" . $combat_bonuses['accuracy'] . "</td>";
?>
                    <br />
                    Item Stats:
                    <br /> 
                    <table>
                    <tr>
                    <td>Equipment Slot</td>
                    <td>Level Requirements</td>
                    <td>Armour</td>
                    <td>Power</td>
                    <td>Accuracy</td>
                    </tr>
                    <?php

		echo $combat_content;
?>
                    </table>
<?php

	} elseif($item_info['type'] == "Tool") {
		$select_skill_equipment_info = mysqli_query($link,
			"SELECT `slot`, `required_skill`, `skill_level` FROM `equipment` WHERE `item_id`=" .
			$id);
		$skill_equipment_info = mysqli_fetch_assoc($select_skill_equipment_info);

		$select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id` = " .
			$skill_equipment_info['required_skill']);
		$skill = mysqli_fetch_assoc($select_skill);
		$skill_content .= "<tr><td>" . $skill_equipment_info['slot'] . "</td><td>Level " .
			$skill_equipment_info['skill_level'] . " " . $skill['name'] . "</td><td>";

		$select_skill_bonuses = mysqli_query($link,
			"SELECT `affected_stat`, `effect_on_stat`, `type`, `tier` FROM `skill_equipment` WHERE `item_id`=" .
			$id);
		while ($skill_bonuses = mysqli_fetch_assoc($select_skill_bonuses)) {
			$select_stat = mysqli_query($link, "SELECT `name` FROM `stats` WHERE `id`=" . $skill_bonuses['affected_stat']);
			$stat = mysqli_fetch_assoc($select_stat);
			if($skill_bonuses['effect_on_stat'] == "0") {
				$skill_content = "<tr><td>No effects";
			} else {
				if($skill_bonuses['effect_on_stat'] > 0) {
					$bonus = "+" . $skill_bonuses['effect_on_stat'];
				} else {
					$bonus = $skill_bonuses['effect_on_stat'];
				}
				$bonuses .= $bonus . " " . $stat['name'] . ", ";
			}
			$select_required = mysqli_query($link,
				"SELECT `action_id` FROM `required_equipment` WHERE `item_type`=" . $skill_bonuses['type'] .
				" AND `tier` = " . $skill_bonuses['tier']);
			if(mysqli_num_rows($select_required) > 0) {
				while ($required = mysqli_fetch_assoc($select_required)) {
					$select_required_actions = mysqli_query($link,
						"SELECT * FROM `actions` WHERE `id`=" . $required['action_id']);
					if(mysqli_num_rows($select_required_actions) > 0) {
						while ($required_actions = mysqli_fetch_assoc($select_required_actions)) {
							$select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id`=" .
								$required_actions['skill_id']);
							$skill = mysqli_fetch_assoc($select_skill);

							$select_location = mysqli_query($link,
								"SELECT `name` FROM `locations` WHERE `id`=" . $required_actions['location_id']);
							$location = mysqli_fetch_assoc($select_location);

							$required_content .= "<tr><td>" . $required_actions['name'] . "</td><td>" . $location['name'] .
								"</td><td>Level " . $required_actions['level'] . " " . $skill['name'] .
								"</td></tr>";
						}
					}
				}
			} else {
				$required_content = "<tr><td>Not required for any actions</td></tr>";
			}
		}
		$skill_content .= rtrim($bonuses, ", ");
		$skill_content .= "</td></tr>";
?>
                    <br />
                    Required For:
                    <br /> 
                    <table>
                    <tr>
                    <td>Action</td>
                    <td>Location</td>
                    <td>Skill Level</td>
                    </tr>
                    <?php

		echo $required_content;
?>
                    </table>
                    <br />
                    Item Stats:
                    <br /> 
                    <table>
                    <tr>
                    <td>Equipment Slot</td>
                    <td>Level Requirements</td>
                    <td>Effects</td>
                    </tr>
                    <?php

		echo $skill_content;
?>
                    </table>
        <?php

	}
?>
                    <br />
                    Used In:
                    <br /> 
                    <table>
                    <tr>
                    <td>Action</td>
                    <td>Location</td>
                    <td>Skill Level</td>
                    <td>Quantity</td>
                    </tr>
                    <?php

	echo $uses_content;
?>
                    </table>
                    <br />
                    Obtained From:
                    <br /> 
                    <table>
                    <tr>
                    <td>Action</td>
                    <td>Location</td>
                    <td>Skill Level</td>
                    <td>Quantity</td>
                    </tr>
                    <?php

	echo $obtain_content;
?>
                    </table>
				</div>
			</div>
			<footer>
				<br />
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	</html>
    <?php

}
?>