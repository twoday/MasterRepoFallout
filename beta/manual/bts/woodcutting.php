<?php
include("dbconnect.php");
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
								Actions
								<table class="insk">
                                <tr>
									<td class="insktr">
										Name
									</td>
									<td class="insktr">
										Level
									</td>
									<td class="insktr">
										Experience
									</td>
									<td class="insktr">
										Drop(s)
									</td>
									<td class="insktr">
										Type
									</td>
									<td class="insktr">
										Location
									</td>
									</tr>
                                    <?php
                                    $select_item_info = mysqli_query($link, "SELECT `Towns`, `Resources`, `Levels`, `Item_Drop(s)` FROM `items` WHERE `Skills` = \"Woodcutting\"");
                                        while ($item_info = mysqli_fetch_assoc($select_item_info)) {
                                            echo "<tr>";
                                            echo "    <td>" . $item_info['Resources'] . "</td>";
                                            echo "    <td>" . $item_info['Levels'] . "</td>";
                                            echo "    <td>?</td>";
                                            echo "    <td>" . $item_info['Item_Drop(s)'] . "</td>";
                                            echo "    <td>Basic</td>";
                                            echo "    <td><a class=\"manlinks\" href=\"../locations/".$item_info['Towns'].".php\">" . $item_info['Towns'] . "</a></td>";
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
			<a href="woodcutting.php" class="manlinks">Woodcutting</a>
		</div>
		<footer>
			<br>
			<center>
				&copy; Fallout Chronicle 2012. All rights reserved.
			</center>
		</footer>
	</body>

</html>