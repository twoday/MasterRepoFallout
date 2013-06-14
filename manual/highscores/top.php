<?php

include ("dbconnect.php");
include ("../../game_includes/functions.php");
?>

<!doctype html>
    <html>
<head>
    <title>Fallout Chronicle</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="screen.css" />
	<link rel="shortcut icon" href="favicon.png" />
    <meta name="title" content="Fallout Chronicle" />
    <meta name="description" content="Fallout Chronicle is a browser text based game, with 12 skills, over hundreds of resources to collect, guilds to build, and quests to complete." />

</head>     
 <body>
<header>
      <center><img src="FC.png" /></center> 
    <div class="clear"></div>
</header>        
<div id="container">

<div class="conall">
<div class="minhead">
<center>
Top 10
</center>
</div>
<?php

$get_skill_info = mysqli_query($link,
	"SELECT DISTINCT `skill_name` FROM `player_skill` ORDER BY `skill_name` ASC, `exp` DESC");

if(function_exists("mysqli_fetch_all")) {
	$skill_info = mysqli_fetch_all($get_skill_info, MYSQLI_ASSOC);
	for ($skill = 0; $skill < count($skill_info); $skill++) {
		$rank = 1;
		echo $skill_info[$skill]['skill_name'] . "<br />";
		echo "<table>";
		echo "<tr>";
		echo "<td>Rank</td>";
		echo "<td>Username</td>";
		echo "<td>Level</td>";
		echo "<td>Exp</td>";
		echo "</tr>";

		$get_player_info = mysqli_query($link,
			"SELECT `player_id`, `exp` FROM `player_skill` WHERE `skill_name`=\"" . $skill_info[$skill]['skill_name'] .
			"\" ORDER BY `exp` DESC LIMIT 0,10");
		$player_info = mysqli_fetch_all($get_player_info, MYSQLI_ASSOC);

		for ($player = 0; $player < 10; $player++) {
			$get_username = mysqli_query($link,
				"SELECT `username` FROM `users` WHERE `user_id`=" . $player_info[$player]['player_id']);
			$username = mysqli_fetch_assoc($get_username);
			echo "<tr>";
			echo "<td>" . ($player + 1) . "</td>";
			echo "<td>" . $username['username'] . "</td>";
			echo "<td>" . calculateLevel($player_info[$player]['exp']) . "</td>";
			echo "<td>" . $player_info[$player]['exp'] . "</td>";
			echo "</tr>";
		}
		echo "</table><br />";
	}
} else {
	while ($skill_info = mysqli_fetch_assoc($get_skill_info)) {
		$skill = $skill_info['skill_name'];
        $rank = 1;
		echo $skill . "<br />";
		echo "<table>";
		echo "<tr>";
		echo "<td>Rank</td>";
		echo "<td>Username</td>";
		echo "<td>Level</td>";
		echo "<td>Exp</td>";
		echo "</tr>";

		$get_player_info = mysqli_query($link,
			"SELECT `player_id`, `exp` FROM `player_skill` WHERE `skill_name`=\"" . $skill .
			"\" ORDER BY `exp` DESC LIMIT 0,10");
		while ($player_info = mysqli_fetch_assoc($get_player_info)) {
			$get_username = mysqli_query($link,
				"SELECT `username` FROM `users` WHERE `user_id`=" . $player_info['player_id']);
			$username = mysqli_fetch_assoc($get_username);
			echo "<tr>";
			echo "<td>" . ($rank) . "</td>";
			echo "<td>" . $username['username'] . "</td>";
			echo "<td>" . calculateLevel($player_info['exp']) . "</td>";
			echo "<td>" . $player_info['exp'] . "</td>";
			echo "</tr>";
            $rank++;
		}
		echo "</table><br />";
        $rank = 1;
	}

}

//$get_username = mysqli_query($link, "SELECT `username` FROM `users` WHERE `user_id` = ".$player_info['player_id']);
//    $username = mysqli_fetch_assoc($get_username);
//    echo "<tr><td>".$rank."</td><td>".$username['username']."</td><td>".calculateLevel($player_info['exp'])."</td><td>".$player_info['exp']."</td></tr>";
//    $rank++;
//}


//</table>

?>
</div>
</div>
<footer>
    <br><center>&copy; Fallout Chronicle 2012. All rights reserved.</center>
</footer></body>
</html>