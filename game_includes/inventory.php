<?php

include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
?>
<script type="text/javascript">

function unequipItem(slot,number,item_id){
$.post("everything.php", { p:33, slot:slot, number:number, item_id:item_id },
	function(data) {
		eval(data);
	});
		
}

</script>
<?php

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

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];

$check4 = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid' AND `head` = '$item_id' || `neck` = '$item_id' || `torso` = '$item_id' || `legs` = '$item_id' || `feet` = '$item_id' || `left_hand` = '$item_id' || `right_hand` = '$item_id' || `gloves` = '$item_id' || `rings` = '$item_id'") or die('Error');
$gcount = mysql_num_rows($check4);

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
			

if($gcount != 0) {
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span>";
echo " <span style=\"color:red; font-size:12px;\">(Equipped) </span><br />";
}else{
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
}
		}
	}

} elseif($type == "2") {
?>
Weapons<br /><br />

<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];
$check4 = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid' AND `head` = '$item_id' || `neck` = '$item_id' || `torso` = '$item_id' || `legs` = '$item_id' || `feet` = '$item_id' || `left_hand` = '$item_id' || `right_hand` = '$item_id' || `gloves` = '$item_id' || `rings` = '$item_id'") or die('Error');
$gcount = mysql_num_rows($check4);

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Weapon'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
if($gcount != 0) {
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span>";
echo " <span style=\"color:red; font-size:12px;\">(Equipped) </span><br />";
}else{
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
}
		}
	}

} elseif($type == "3") {
?>
Armour<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];
$check4 = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid' AND `head` = '$item_id' || `neck` = '$item_id' || `torso` = '$item_id' || `legs` = '$item_id' || `feet` = '$item_id' || `left_hand` = '$item_id' || `right_hand` = '$item_id' || `gloves` = '$item_id' || `rings` = '$item_id'") or die('Error');
$gcount = mysql_num_rows($check4);

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Armour'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
if($gcount != 0) {
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span>";
echo " <span style=\"color:red; font-size:12px;\">(Equipped) </span><br />";
}else{
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
}
		}
	}

} elseif($type == "4") {
?>
Food<br /><br />
<?php

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
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

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
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

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
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

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
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

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
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

	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '$userid' AND `count` != 0 ORDER BY `count` ASC");
	while ($row = mysql_fetch_array($result)) {
		$item_id = $row['itemid'];
		$item_count = $row['count'];
$check4 = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid' AND `head` = '$item_id' || `neck` = '$item_id' || `torso` = '$item_id' || `legs` = '$item_id' || `feet` = '$item_id' || `left_hand` = '$item_id' || `right_hand` = '$item_id' || `gloves` = '$item_id' || `rings` = '$item_id'") or die('Error');
$gcount = mysql_num_rows($check4);

		$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id' AND `type` = 'Tool'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];

			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
			echo "<span  onclick=\"seeItem($item_id)\" style=\"cursor:pointer; font-size:14px;\"> $item_count";
if($gcount != 0) {
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span>";
echo " <span style=\"color:red; font-size:12px;\">(Equipped) </span><br />";
}else{
echo " $item_name [$tons Tons, $poundals Poundals, $ouncels Ouncels]</span><br />";
}
		}
	}
} elseif($type == "10") {
?>
Equipped Items<br /><br />
<table width="100%">

<tr><td width="80px"><span class="doll_heading">Head</span></td><td><span class="doll_item"></span></td><td><span class="doll_effects"></span></td></tr>

<tr><td><span class="doll_heading">Neck</span></td><td>
<?php
$selecta = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seea = mysql_fetch_array($selecta);
$item_ida = $seea['neck'];

$select2a = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_ida'") or die('Error');
$see2a = mysql_fetch_array($select2a);
$namea = $see2a['name'];

echo "<span onclick=\"unequipItem('Neck','1','$item_ida')\" style=\"cursor:pointer; color:red;\">$namea</span>";
?>
</td><td></td></tr>


<tr><td><span class="doll_heading">Torso</span></td><td>
<?php
$selectb = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seeb = mysql_fetch_array($selectb);
$item_idb = $seeb['torso'];

$select2b = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_idb'") or die('Error');
$see2b = mysql_fetch_array($select2b);
$nameb = $see2b['name'];

echo "<span onclick=\"unequipItem('Torso','1','$item_idb')\" style=\"cursor:pointer; color:red;\">$nameb</span>";
?>
</td><td></td></tr>


<tr><td><span class="doll_heading">Legs</span></td><td>
<?php
$selectc = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seec = mysql_fetch_array($selectc);
$item_idc = $seec['legs'];

$select2c = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_idc'") or die('Error');
$see2c = mysql_fetch_array($select2c);
$namec = $see2c['name'];

echo "<span onclick=\"unequipItem('Legs','1','$item_idc')\" style=\"cursor:pointer; color:red;\">$namec</span>";
?>
</td><td></td></tr>

<tr><td><span class="doll_heading">Feet</span></td><td>
<?php
$selectd = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seed = mysql_fetch_array($selectd);
$item_idd = $seed['feet'];

$select2d = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_idd'") or die('Error');
$see2d = mysql_fetch_array($select2d);
$named = $see2d['name'];

echo "<span onclick=\"unequipItem('Feet','1','$item_idd')\" style=\"cursor:pointer; color:red;\">$named</span>";
?>
</td><td></td></tr>

<tr><td><span class="doll_heading">Left Hand</span></td><td>
<?php
$selecte = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seee = mysql_fetch_array($selecte);
$item_ide = $seee['left_hand'];

$select2e = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_ide'") or die('Error');
$see2e = mysql_fetch_array($select2e);
$namee = $see2e['name'];

echo "<span onclick=\"unequipItem('Left Hand','1','$item_ide')\" style=\"cursor:pointer; color:red;\">$namee</span>";
?>
</td><td></td></tr>

<tr><td><span class="doll_heading">Right Hand</span></td><td>
<?php
$select = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$see = mysql_fetch_array($select);
$item_id = $see['right_hand'];

$select2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_id'") or die('Error');
$see2 = mysql_fetch_array($select2);
$name = $see2['name'];

echo "<span onclick=\"unequipItem('Right Hand','1','$item_id')\" style=\"cursor:pointer; color:red;\">$name</span>";
?>
</td><td></td></tr>

<tr><td><span class="doll_heading">Gloves</span></td><td>
<?php
$selectf = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seef = mysql_fetch_array($selectf);
$item_idf = $seef['gloves'];

$select2f = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_idf'") or die('Error');
$see2f = mysql_fetch_array($select2f);
$namef = $see2f['name'];

echo "<span onclick=\"unequipItem('Gloves','1','$item_idf')\" style=\"cursor:pointer; color:red;\">$namef</span>";
?>
</td><td></td></tr>

<tr><td><span class="doll_heading">Ring</span></td><td>
<?php
$selectg = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid'") or die('Error');
$seeg = mysql_fetch_array($selectg);
$item_idg = $seeg['rings'];

$select2g = mysql_query("SELECT * FROM `items` WHERE `id` = '$item_idg'") or die('Error');
$see2g = mysql_fetch_array($select2g);
$nameg = $see2g['name'];

echo "<span onclick=\"unequipItem('Rings','1','$item_idg')\" style=\"cursor:pointer; color:red;\">$nameg</span>";
?>
</td><td></td></tr>
</table>
<?php

	}
?>

</td>

</tr></table>