<?php

include ("dbconnect.php");
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
					<img src="FC.png" border="0">
					</img>
				</center>
				<div class="clear">
				</div>
			</header>
			<div id="skillcontainer">
				<div class="conall">
					<div class="skillcenter">
						<table>
							<td>
								<div class="skillcen">
                                    Gathering
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Drop(s)</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Gather %' AND `skill_id` = \"7\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	$dropped_items = "";
	while ($drops = mysqli_fetch_assoc($select_drops)) {
		$select_items = mysqli_query($link, "SELECT * FROM `items` WHERE `id` =" . $drops['item_id']);
		$items = mysqli_fetch_assoc($select_items);
		if(mysqli_num_rows($select_drops) > 1) {
			if($drops['max_amount'] > 1) {
				$dropped_items .= "1 - " . $drops['max_amount'] . " " . $items['plural'] .
					"<br /> ";
			} else {
				$dropped_items .= "1 " . $items['name'] . "<br /> ";
			}
		} else {
			if($drops['max_amount'] > 1) {
				$dropped_items = "1 - " . $drops['max_amount'] . " " . $items['plural'];
			} else {
				$dropped_items = "1 " . $items['name'];
			}

		}
	}
	echo "    <td>" . $dropped_items . "</td>";

	$select_location = mysqli_query($link,
		"SELECT `name` FROM `locations` WHERE `id`=" . $actions['location_id']);
	$location = mysqli_fetch_assoc($select_location);
	if($location['name'] == "All") {
		echo "<td>All</td>";
	} else {
		echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $action['location_id'] .
			"\">" . $location['name'] . "</a></td>";
	}
	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Planting
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Plant %' AND `skill_id` = \"7\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	$require_items = "";
	$select_required_items = mysqli_query($link,
		"SELECT * FROM `required_items` WHERE `action_id`=" . $actions['id']);
	while ($required_items = mysqli_fetch_assoc($select_required_items)) {
		$select_items = mysqli_query($link, "SELECT * FROM `items` WHERE `id` =" . $required_items['item_id']);
		$items = mysqli_fetch_assoc($select_items);
		if($required_items['quantity'] > 1) {
			$name = $items['plural'];
		} else {
			$name = $items['name'];
		}
		if(mysqli_num_rows($select_required_items) > 1) {
			$require_items .= $required_items['quantity'] . " " . $name . ", ";
		} else {
			$require_items = $required_items['quantity'] . " " . $name;
		}
	}
	echo "    <td>" . rtrim($require_items, ", ") . "</td>";

	$select_location = mysqli_query($link,
		"SELECT `name` FROM `locations` WHERE `id`=" . $actions['location_id']);
	$location = mysqli_fetch_assoc($select_location);
	if($location['name'] == "All") {
		echo "<td>All</td>";
	} else {
		echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $action['location_id'] .
			"\">" . $location['name'] . "</a></td>";
	}
	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Picking
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Drop(s)</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Pick %' AND `skill_id` = \"7\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	$dropped_items = "";
	while ($drops = mysqli_fetch_assoc($select_drops)) {
		$select_items = mysqli_query($link, "SELECT * FROM `items` WHERE `id` =" . $drops['item_id']);
		$items = mysqli_fetch_assoc($select_items);
		if(mysqli_num_rows($select_drops) > 1) {
			if($drops['max_amount'] > 1) {
				$dropped_items .= "1 - " . $drops['max_amount'] . " " . $items['plural'] .
					"<br /> ";
			} else {
				$dropped_items .= "1 " . $items['name'] . "<br /> ";
			}
		} else {
			if($drops['max_amount'] > 1) {
				$dropped_items = "1 - " . $drops['max_amount'] . " " . $items['plural'];
			} else {
				$dropped_items = "1 " . $items['name'];
			}

		}
	}
	echo "    <td>" . $dropped_items . "</td>";

	$select_location = mysqli_query($link,
		"SELECT `name` FROM `locations` WHERE `id`=" . $actions['location_id']);
	$location = mysqli_fetch_assoc($select_location);
	if($location['name'] == "All") {
		echo "<td>All</td>";
	} else {
		echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $action['location_id'] .
			"\">" . $location['name'] . "</a></td>";
	}
	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Filling Containers
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Fill %' AND `skill_id` = \"7\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	$require_items = "";
	$select_required_items = mysqli_query($link,
		"SELECT * FROM `required_items` WHERE `action_id`=" . $actions['id']);
	while ($required_items = mysqli_fetch_assoc($select_required_items)) {
		$select_items = mysqli_query($link, "SELECT * FROM `items` WHERE `id` =" . $required_items['item_id']);
		$items = mysqli_fetch_assoc($select_items);
		if($required_items['quantity'] > 1) {
			$name = $items['plural'];
		} else {
			$name = $items['name'];
		}
		if(mysqli_num_rows($select_required_items) > 1) {
			$require_items .= $required_items['quantity'] . " " . $name . ", ";
		} else {
			$require_items = $required_items['quantity'] . " " . $name;
		}
	}
	echo "    <td>" . rtrim($require_items, ", ") . "</td>";

	$select_location = mysqli_query($link,
		"SELECT `name` FROM `locations` WHERE `id`=" . $actions['location_id']);
	$location = mysqli_fetch_assoc($select_location);
	if($location['name'] == "All") {
		echo "<td>All</td>";
	} else {
		echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $action['location_id'] .
			"\">" . $location['name'] . "</a></td>";
	}
	echo "</tr>";
}
?>
                                    </table>
								</div>
							</td>
						</table>
					</div>
				</div>
				<a href="/manual/skills" class="manlinks">Skills</a>
				>
				<a href="gathering.php" class="manlinks">Gathering</a>
			</div>
			<footer>
				<br>
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	
	</html>