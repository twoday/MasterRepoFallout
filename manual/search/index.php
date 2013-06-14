<?php

include ("dbconnect.php");

if(isset($_POST['submit'])) {
	$term = ucwords(trim(addslashes(strip_tags($_POST['term']))));
	$select_match = mysqli_query($link,
		"SELECT `id` FROM `items` WHERE `name` LIKE '" . $term . "'");
	if(mysqli_num_rows($select_match) == 1) {
		$match = mysqli_fetch_assoc($select_match);
		header("Refresh:0; url=\"../items/item.php?id=" . $match['id'] . "\"");
	} else {
		$select_close_matches = mysqli_query($link,
			"SELECT `id`, `name` FROM `items` WHERE `name` LIKE '" . $term ." %' OR `name` LIKE '% ".$term."' OR `name` LIKE '%".$term."%' ORDER BY `name` ASC");
		if(mysqli_num_rows($select_close_matches) > 0) {
			$matches = "No exact matched found. Did you mean: <br />";
			while ($close_matches = mysqli_fetch_assoc($select_close_matches)) {
				$matches .= "<a href=\"../items/item.php?id=" . $close_matches['id'] . "\" class=\"manlinks\">" . $close_matches['name'] .
					"</a><br />";
			}
		} else {
			$matches = "No matches found for " . $term . ". Please try a new search term.";
		}
	}
}
?>
	<!doctype html>
	<html>
		<head>
			<title>
				Fallout Chronicle
			</title>
			<meta charset="UTF-8">
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
							Search for an Item
						</center>
					</div>
                    <form action="search.php" method="post">
                    Item Name: <input type="text" name="term" class="fdi" <?php

if(isset($_POST['term'])) {
	echo "value=\"" . $_POST['term'] . "\"";
}
?> />
                    <input type="submit" name="submit" class="fdi" value="Search" />
                    </form>
                    <?php

if(isset($matches)) {
	echo "<div>";
	echo $matches;
	echo "</div>";
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