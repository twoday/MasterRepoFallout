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
                                    <table class="insk" style="width: auto; floar:left;">
                                        <tr><td class="insktr">Contents</td></tr>
                                        <tr><td><a class="manlinks" href="#Smelting">Smelting</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Bronze">Bronze Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Iron">Iron Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Travertine">Travertine Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Jaspillite">Jaspillite Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Hyaloclastite">Hyaloclastite Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Kimberlite">Kimberlite Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Obsidian">Obsidian Smithing</a></td></tr>
                                        <tr><td><a class="manlinks" href="#Alluere">Alluere Smithing</a></td></tr>
                                    </table>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Smelting">
									Smelting
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smelt %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Bronze">
                                    <br />
                                    Bronze Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Bronze %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <br />
                                    <div id="Iron">
                                    Iron Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Iron %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Travertine">
                                    Travertine Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Travertine %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Jaspillite">
                                    Jaspillite Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Jaspillite %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Hyaloclastite">
                                    Hyaloclastite Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Hyaloclastite %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Kimberlite">
                                    Kimberlite Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Kimberlite %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Obsidian">
                                    Obsidian Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Obsidian %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <a class="manlinks" href="#">&lt;Top&gt;</a>
                                    <div id="Alluere">
                                    Alluere Smithing
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
	"SELECT * FROM `actions` WHERE `name` LIKE 'Smith Alluere %' ORDER BY `level` ASC");
while ($actions = mysqli_fetch_assoc($select_actions)) {
	$select_drops = mysqli_query($link,
		"SELECT * FROM `action_drops` WHERE `action_id` = " . $actions['id']);
	echo "<tr>";
	echo "    <td>" . $actions['name'] . "</td>";
	echo "    <td>" . $actions['level'] . "</td>";
	echo "    <td>" . $actions['success_exp'] . "</td>";
	echo "    <td>" . $actions['fail_exp'] . "</td>";

	$select_tool_info = mysqli_query($link,
		"SELECT * FROM `required_equipment` WHERE `action_id`=" . $actions['id']);
	if(mysqli_num_rows($select_tool_info) > 0) {
		$tool_info = mysqli_fetch_assoc($select_tool_info);

		$select_tool_id = mysqli_query($link,
			"SELECT `item_id` FROM `skill_equipment` WHERE `type`=" . $tool_info['item_type'] .
			" AND `tier`=" . $tool_info['tier']);
		$tool_id = mysqli_fetch_assoc($select_tool_id);

		$select_tool = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $tool_id['item_id']);

		$tool = mysqli_fetch_assoc($select_tool);
		echo "    <td>" . $tool['name'] . "</td>";
	} else {
		echo "    <td>None</td>";
	}

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
                                    </div>
                                    <br />
                                    <div id="Equipment">
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
	"SELECT * FROM `equipment` WHERE `required_skill` = \"2\"");
while ($equipment = mysqli_fetch_assoc($select_equipment)) {
	$select_item = mysqli_query($link, "SELECT `name` FROM `items` WHERE `id`=" . $equipment['item_id']);
	$item = mysqli_fetch_assoc($select_item);

	$select_stats = mysqli_query($link,
		"SELECT * FROM `skill_equipment` WHERE `item_id` = " . $equipment['item_id']);
	$stats = mysqli_fetch_assoc($select_stats);

	$select_effects = mysqli_query($link, "SELECT `name` FROM `stats` WHERE `id` = " .
		$stats['affected_stat']);
	$effects = mysqli_fetch_assoc($select_effects);
	echo "<tr>";
	echo "    <td>" . $item['name'] . "</td>";
	echo "    <td>" . $equipment['skill_level'] . "</td>";
	echo "    <td>" . $equipment['slot'] . "</td>";
    echo "    <td>" . $stats['tier'] . "</td>";
	$affected_stats = "";

	if($stats['effect_on_stat'] > 0) {
		$stats['effect_on_stat'] = "+" . $stats['effect_on_stat'];
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
	echo "    <td>" . $affected_stats . "</td>";
	echo "</tr>";
}
?>
                                    </table>
                                    </div>
								</div>
							</td>
						</table>
					</div>
				</div>
				<a href="/manual/skills" class="manlinks">Skills</a>
				>
				<a href="smith.php" class="manlinks">Blacksmithing</a>
			</div>
			<footer>
				<br>
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	
	</html>