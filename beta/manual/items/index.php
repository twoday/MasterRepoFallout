<?php

/**
 * @author Alasdair Ross
 * @copyright 2013
 */

include ("dbconnect.php");
if(isset($_GET['type'])) {


	if($_GET['type'] == "gems_orbs") {
		$select_items = mysqli_query($link, "SELECT * FROM `items` WHERE `type` = \"Gem\" OR `type`=\"Orb\" ");
	}elseif($_GET['type'] == "all") {
		$select_items = mysqli_query($link, "SELECT * FROM `items`");
	}else {
	$select_items = mysqli_query($link, "SELECT * FROM `items` WHERE `type` =\"" . $_GET['type'] .
		"\"");
        }
	if(mysqli_num_rows($select_items) > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<td>ID</td>";
		echo "<td>Name</td>";
		echo "<td>Type</td>";
		echo "</tr>";
		while ($items = mysqli_fetch_assoc($select_items)) {
			echo "<tr><td>" . $items['id'] . "</td><td>" . $items['name'] . "</td><td>" . $items['type'] .
				"</td></tr>";
	   	}
        echo "</table>";
	}else {
	   echo "No items in this category";
	}

	
} else {
?>
<html>
<body>
<form action="index.php" method="get">
Show: 
<select name="type">
<option value="all">All</option>
<option value="armour">Armour</option>
<option value="chest">Chests</option>
<option value="food">Food</option>
<option value="gem">Gems</option>
<option value="orb">Orbs</option>
<option value="potion">Potions</option>
<option value="resource">Resources</option>
<option value="tool">Tools</option>
<option value="weapon">Weapons</option>
</select>
<input type="submit" value="Submit" />
</form>
</body>
</html>
<?php

}
?>