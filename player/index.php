<?php

include ("dbconnect.php");

if(isset($_POST['submit'])) {
	$term = trim($_POST['term']);
	$select_match = mysqli_query($link,
		"SELECT `user_id` FROM `users` WHERE `username` LIKE \"" . strtolower($term) . "\"");
	if(mysqli_num_rows($select_match) == 1) {
		$match = mysqli_fetch_assoc($select_match);
		header("Refresh:0; url=\"player.php?id=" . $match['user_id'] . "\"");
	} else {
		$matches = "No matches found for " . $term . ". Please try a new search term.";
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
							Search for an User
						</center>
					</div>
                    <form action="index.php" method="post">
                    Username: <input type="text" name="term" class="fdi" <?php

if(isset($_POST['term'])) {
echo "value=\"" . $_POST['term'] . "\"";
}
?> />
                    <input type="submit" name="submit" class="fdi" value="Submit" />
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