<?php

include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or
	die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];

$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid'");
$total_poundals = 0;
$total_ouncels = 0;
$total_tons = 0;
while ($row = mysql_fetch_array($result)) {
	$item_id = $row['itemid'];
	$item_count = $row['count'];

	$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id'");
	while ($row = mysql_fetch_array($result2)) {
		$ouncels = $item_count * $row['ouncels'];
		$extra_poundals = intval($ouncels / 16);
		$total_ouncels += $ouncels % 16;
		$total_poundals += ($item_count * $row['poundals']) + $extra_poundals;
	}
}
$total_tons = intval($total_poundals / 1000);
$total_poundals = $total_poundals % 1000;
?>
<script type="text/javascript">

function seeItem(id){
$("#content_main").load("game_includes/see_item.php", { id:id });
}


</script>

<div align="center">
<table width="100%"><tr>
<td align="right"><div class="link" onclick="closeinventory();">Back to game</div></td></tr></table>
</div>

<table id="inventory_table" width="100%" height="95%" align="left" ><tr class="alt">
<td valign="top" width="25%">
<h4>Player Items</h4>
 <span style="font-size:13px;">
 <?php

echo $total_tons . " Tons, " . $total_poundals . " Poundals, " . $total_ouncels .
	" Ouncels";
?>
 </span>
<br><br>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(1);">All</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(2);">Weapons</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(3);">Armour</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(9);">Tools</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(4);">Food</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(5);">Potions</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(6);">Gems</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(8);">Orbs</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(7);">Resources</div>
<div class="inven_menu_links" style="cursor:pointer;" onclick="inventory(10);">Equipped Items</div>

</td>
<td valign="top" id="content_main" width="75%" align="left">

<?php

if(isset($_POST['id'])) {
	$type = $_POST['id'];
} else {
	$type = $_GET['id'];
}

if($type == "1") {
?>
All<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "2") {
?>
Weapons<br /><br />

<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Weapon'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "3") {
?>
Armour<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Armour'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "4") {
?>
Food<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Food'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "5") {
?>
Potions<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Potion'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "6") {
?>
Gems<br /><br />

<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Gem'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}
} elseif($type == "8") {
?>
Orbs<br /><br />

<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Orb'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "7") {
?>
Resources<br /><br />

<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Resource'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
		}
	}

} elseif($type == "9") {
?>
Tools<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Tool'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			echo " $item_name ($tons Tons, $poundals Poundals, $ouncels Ouncels)</span><br />";
		}
	}
} elseif($type == "10") {
?>
Equipped Items<br /><br />
<table width="100%">

<tr><td width="80px"><span class="doll_heading">Head</span></td><td><span class="doll_item"></span></td><td><span class="doll_effects"></span></td></tr>
<tr><td><span class="doll_heading">Neck</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Torso</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Legs</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Feet</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Left Hand</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Right Hand</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Gloves</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Ring</span></td><td></td><td></td></tr>
</table>
<?php

	}
?>

</td>

</tr></table>