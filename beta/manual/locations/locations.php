<?php include ( "dbconnect.php"); ?>
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
					<img src="FC.png" border="0" />
				</center>
				<div class="clear">
				</div>
			</header>
			<div id="container">
				<div class="mapconall">
                <?php
                $select_contintents = mysqli_query($link, "SELECT * FROM `continents`");
                while($continents = mysqli_fetch_assoc($select_contintents)){
                    if(str_word_count($continents['name']) > 1){
                        $name = strtolower(preg_replace("/ /", "_",$continents['name']));    
                    }else {
                        $name = strtolower($continents['name']);
                    }
                    
                    
                ?>
					<div class="mapcen">
						<div class="minhead">
							<center>
								<?php echo $continents['name']; ?>
							</center>
						</div>
                        <img src="<?php echo $name.".png"; ?>" border="0" width="400" height="300" alt="<?php echo $continents['name']. " Map"; ?>" />
                        <br />
						<center>
							<table class="dtabcen">
                            <tr>
                            <?php
                            $select_towns = mysqli_query($link, "SELECT * FROM `locations` WHERE `continent_id` = ".$continents['id']." LIMIT 0,3");
                            while($towns = mysqli_fetch_assoc($select_towns)){
                                if(str_word_count($towns['name']) > 1){
                                    $name = preg_replace("/ /", "_", $towns['name']);
                                }else {
                                    $name = $towns['name'];    
                                }
                                echo "<td class=\"dtab\"><a href=\"location.php?id=".$towns['id']."\" class=\"manlinks\">".$towns['name']."<a></td>";
                            }
                            ?>
                            </tr>
                            <tr>
                            <?php
                            $select_towns2 = mysqli_query($link, "SELECT * FROM `locations` WHERE `continent_id` = ".$continents['id']." AND `name` NOT LIKE 'All' AND `name` NOT LIKE 'House' LIMIT 3,6");
                            while($towns2 = mysqli_fetch_assoc($select_towns2)){
                                if(str_word_count($towns2['name']) > 1){
                                    $name2 = preg_replace("/ /", "_", $towns2['name']);
                                }else {
                                    $name2 = $towns2['name'];
                                }
                                echo "<td class=\"dtab\"><a href=\"location.php?id=".$towns2['id']."\" class=\"manlinks\">".$towns2['name']."<a></td>";
                            }
                            ?>
                            </tr>
							</table>
						</center>
					</div>
					<br />
                <?php
                }
                ?>
				</div>
                <a href="/manual" class="manlinks">Manual</a>
				>
				<a href="fmap.php" class="manlinks">Locations</a>
			</div>
			<footer>
				<br />
				<center>
					&copy; Fallout Chronicle 2012. All rights reserved.
				</center>
			</footer>
		</body>
	
	</html>