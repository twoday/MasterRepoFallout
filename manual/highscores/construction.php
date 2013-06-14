<?php
include("dbconnect.php");
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
Construction Highscores
</center>
</div>
<table>
<tr>
    <td>Rank</td>
    <td>Username</td>
    <td>Level</td>
    <td>Exp</td>
</tr>
<?php
$get_player_info = mysqli_query($link, "SELECT `player_id`, `level`, `exp` FROM `player_skill` WHERE `skill_name` = \"Construction\" ORDER BY `exp` DESC LIMIT 0, 100");
$rank = 1;
while($player_info = mysqli_fetch_assoc($get_player_info)){
    $get_username = mysqli_query($link, "SELECT `username` FROM `users` WHERE `user_id` = ".$player_info['player_id']);
    $username = mysqli_fetch_assoc($get_username);
    echo "<tr><td>".$rank."</td><td>".$username['username']."</td><td>".$player_info['level']."</td><td>".$player_info['exp']."</td></tr>";
    $rank++; 
}
?>
</table>
</div>
</div>
<footer>
    <br><center>&copy; Fallout Chronicle 2012. All rights reserved.</center>
</footer></body>
</html>