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
                    </tr>
                    <tr>
                    <td><?php

	echo $item_info['id'];
?></td>
                    <td><?php

	echo $item_info['type'];
?></td>
                    <td>
                    <?php

	if($item_info['poundals'] > 0) {
		echo $item_info['poundals'];
		if($item_info['poundals'] > 1) {
			echo " Poundals";
		} else {
			echo " Poundal";
		}
		if($item_info['ouncels'] > 0) {
			echo " and " . $item_info['ouncels'];
			if($item_info['ouncels'] > 1) {
				echo " Ouncels";
			} else {
				echo " Ouncel";
			}
		}
	} else {
		if($item_info['ouncels'] > 1) {
			echo $item_info['ouncels'] . " Ouncels";
		} else {
			echo $item_info['ouncels'] . " Ouncel";
		}
	}
?></td>
                    </tr>
                    </table>
                    <?php

	if($item_info['type'] == "Resource") {
		$select_uses = mysqli_query($link,
			"SELECT * FROM `required_items` WHERE `item_id` =" . $item_info['id']);
		if(mysqli_num_rows($select_uses) > 0) {
			while ($uses = mysqli_fetch_assoc($select_uses)) {
				$select_use_actions = mysqli_query($link, "SELECT * FROM `actions` WHERE `id`=" . $uses['action_id']);
				if(mysqli_num_rows($select_use_actions) > 0) {
					while ($use_actions = mysqli_fetch_assoc($select_use_actions)) {
						$select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id`=" .
							$use_actions['skill_id']);
						$skill = mysqli_fetch_assoc($select_skill);
                        
                        $select_location = mysqli_query($link, "SELECT `name` FROM `locations` WHERE `id`=".$use_actions['location_id']);
                        $location = mysqli_fetch_assoc($select_location);
                        
						$uses_content .= "<tr><td>" . $use_actions['name'] . "</td><td>".$location['name']."</td><td>Level " . $use_actions['level'] .
							" " . $skill['name'] . "</td><td>" . $uses['quantity'] . "</td></tr>";
					}
				}
			}
		} else {
			$uses_content = "<tr><td>No uses</td></tr>";
		}
        
		$select_obtained = mysqli_query($link,
			"SELECT * FROM `action_drops` WHERE `item_id`=" . $item_info['id']);
		if(mysqli_num_rows($select_obtained) > 0) {
			while ($obtained = mysqli_fetch_assoc($select_obtained)) {
                $select_obtain_actions = mysqli_query($link, "SELECT * FROM `actions` WHERE `id`=" . $obtained['action_id']);
                if(mysqli_num_rows($select_obtained) > 0){
                    while($obtain_actions = mysqli_fetch_assoc($select_obtain_actions)){
                        $select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id`=" .
							$obtain_actions['skill_id']);
						$skill = mysqli_fetch_assoc($select_skill);
                        
                        $select_location = mysqli_query($link, "SELECT `name` FROM `locations` WHERE `id`=".$obtain_actions['location_id']);
                        $location = mysqli_fetch_assoc($select_location);
                        
						$obtain_content .= "<tr><td>" . $obtain_actions['name'] . "</td><td>".$location['name']."</td><td>Level " . $obtain_actions['level'] .
							" " . $skill['name'] . "</td><td>" . $uses['quantity'] . "</td></tr>";
                    }
                }
			}
		}else {
		  $obtain_content = "<tr><td>Not obtainable</td></tr>";
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
                    <?php

	}
?>
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