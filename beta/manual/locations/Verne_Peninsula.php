<?php 
include ("dbconnect.php");

if($name = preg_replace("/_/", " ", basename($_SERVER["SCRIPT_NAME"], ".php"))){
    
}else {
    $name = basename($_SERVER["SCRIPT_NAME"], ".php");
}

$select_town_info = mysqli_query($link, "SELECT `id`, `description` FROM `locations` WHERE `name` = \"".$name."\"");
$town_info = mysqli_fetch_assoc($select_town_info);

$select_adjacent_towns = mysqli_query($link, "SELECT `adjacent_location_id` FROM `adjacent_towns` WHERE `location_id` = ".$town_info['id']);
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
			</center>
			<div class="clear">
			</div>
		</header>
		<div id="container">
			<div class="conall">
				<div class="townmin">
					<center>
						<?php echo $name; ?>
					</center>
				</div>
				<div class="concenter">
					<table>
						<td>
							<div class="mincen">
								<div class="minhead">
									<center>
										Activities
									</center>
								</div> 
                                                     
                                <?php
                                $select_actions = mysqli_query($link, "SELECT `name`, `skill_id` FROM `actions` WHERE `location_id` = ".$town_info['id']);
                                while($actions = mysqli_fetch_assoc($select_actions)){
                                    $select_skill = mysqli_query($link, "SELECT `name` FROM `skills` WHERE `id` = ".$actions['skill_id']);
                                    $skill = mysqli_fetch_assoc($select_skill);
                                    echo "<a href=\"../skills/".strtolower($skill['name']).".php\" class=\"manlinks\">".$actions['name'] ."</a><br />";
                                }
                                ?>                
							</div>
						</td>
						<td>
							<div class="mincen">
								<div class="minhead">
									<center>
										Gameplay
									</center>
								</div>
								<b>
									Adjacent Towns
								</b>
                                <br />
                                <?php
                                while($adjactent_towns = mysqli_fetch_assoc($select_adjacent_towns)){
                                    $select_town_name = mysqli_query($link, "SELECT `name` FROM `locations` WHERE `id`=".$adjactent_towns['adjacent_location_id']);
                                    $town_name = mysqli_fetch_assoc($select_town_name);
                                    echo "<a href=\"".$town_name['name'].".php\" class=\"manlinks\">".$town_name['name']."<a>";
                                    echo "<br />";
                                }
                                ?>
							</div>
						</td>
						<tr>
							<td colspan="2">
								<div class="tmidbot">
									<div class="minhead">
										<center>
											Description
										</center>
									</div>
                                    <br />
                                    <?php echo $town_info['description']; ?>
								</div>
							</td>
					</table>
				</div>
			</div>
			<a href="/manual/locations" class="manlinks">Locations</a>
			>
			<a href="" class="manlinks">Verne Peninsula</a>
		</div>
		<footer>
			<br>
			<center>
				&copy; Fallout Chronicle 2012. All rights reserved.
			</center>
		</footer>
	</body>

</html>