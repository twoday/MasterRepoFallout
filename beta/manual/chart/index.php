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
							Level Chart
						</center>
					</div>
					<table>
						<tr>
							<td>Level</td>
							<td>Exp</td>
						</tr>
						<?php
                        
                        for($i=1;$i<=100;$i++){
                            $exp = round(pow($i, 4.25));
                            echo "<tr><td>".$i."</td><td>".number_format($exp, 0, '.', ',')."</td></tr>";
                        }
                        ?>
					</table>
				</div>
			</div>
			<footer>
				<br>
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	
	</html>