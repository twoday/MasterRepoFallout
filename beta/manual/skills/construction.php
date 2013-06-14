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
                                              <a href="/manual/guilds/compounds" class="manlinks">Compound Information</a> | <a href="/manual/guilds/shops" class="manlinks"> Guild Shops </a>
						<table>
							<td>
								<div class="skillcen">
									Walnut
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Walnut %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Elm
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Elm %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Cedar
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Cedar %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Sycamore
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Sycamore %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Birch
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Birch %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Hawthorne
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Hawthorne %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Hickory
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Hickory %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Ashwood
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Ashwood %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Mahogany
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Mahogany %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Aspen
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Aspen %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Willow
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE 'Carve Willow %' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Misc
									<table class="insk">
										<tr>
											<td class="insktr" rowspan="2">Name</td>
											<td class="insktr" rowspan="2">Level</td>
											<td class="insktr" colspan="2">Experience</td>											
                                            <td class="insktr" rowspan="2">Tool</td>
                                            <td class="insktr" rowspan="2">Required Mats</td>
											<td class="insktr" rowspan="2">Location</td>
										</tr>
                                        <tr>
                                            <td class="insktr">Success</td>
                                            <td class="insktr">Failure</td>
                                        </tr>
										<?php

$select_actions = mysqli_query($link,
	"SELECT * FROM `actions` WHERE `name` LIKE '% Parchment' AND `skill_id` = \"4\" ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	$tool_info = mysqli_fetch_assoc($select_tool_info);

	$select_tool_id = mysqli_query($link,
		"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
		" AND `tier`=" . $tool_info['tier']);
	$tool_id = mysqli_fetch_assoc($select_tool_id);

	$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);
	$tool = mysqli_fetch_assoc($select_tool);

	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";
	echo "    <td>" . $tool['name'] . "</td>";
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
	echo "    <td><a class=\"manlinks\" href=\"../locations/location.php?id=" . $actions['location_id'] .
		"\">" . $location['name'] . "</a></td>";

	echo "</tr>";
}
?>
									</table>
                                    <br />
                                    Equipment
									<table class="insk">
										<tr>
											<td class="insktr">Name</td>
											<td class="insktr">Level</td>
											<td class="insktr">Slot(s)</td>
                                            <td class="insktr">Tier</td>											
											<td class="insktr">Effects</td>
										</tr>
                                        <?php

$select_equipment = mysqli_query($link,
	"SELECT * FROM `equipment` WHERE `required_skill` = \"4\" ORDER BY `skill_level` ASC");
while ($equipment = mysqli_fetch_assoc($select_equipment)) {
	$select_item = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $equipment['item_id']);
	$item = mysqli_fetch_assoc($select_item);

	$select_tier = mysqli_query($link,
		"SELECT `tier` FROM `skill_equipment` WHERE `item_id` = " . $equipment['item_id']);
    $tier = mysqli_fetch_assoc($select_tier);
	echo "<tr>";
	echo "    <td>" . $item['name'] . "</td>";
	echo "    <td>" . $equipment['skill_level'] . "</td>";
	echo "    <td>" . $equipment['slot'] . "</td>";
	echo "    <td>" . $tier['tier'] . "</td>";
    
    $select_stats = mysqli_query($link,
		"SELECT * FROM `skill_equipment` WHERE `item_id` = " . $equipment['item_id']);
    $affected_stats = "";
    while ($stats = mysqli_fetch_assoc($select_stats)) {
		$select_effects = mysqli_query($link, "SELECT `name` FROM `stats` WHERE `id` = " .
			$stats['affected_stat']);
		$effects = mysqli_fetch_assoc($select_effects);
		
        if($stats['effect_on_stat'] > 0){
            $stats['effect_on_stat'] = "+".$stats['effect_on_stat'];
        }
        
		if($stats['effect_on_stat'] != "0") {
			if(mysqli_num_rows($select_stats) > 1) {
				$affected_stats .= $stats['effect_on_stat'] . " " . $effects['name'] . "<br />";
			} else {
				$affected_stats = $stats['effect_on_stat'] . " " . $effects['name'];
			}
		} else {
			$affected_stats = "None";
		}
	}
	echo "    <td>" . $affected_stats . "</td>";
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
				<a href="construction.php" class="manlinks">Construction</a>
			</div>
			<footer>
				<br>
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	
	</html>