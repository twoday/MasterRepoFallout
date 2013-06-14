<?php
session_start();
include("../core/database/connect.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];

$result = mysql_query("SELECT * FROM `locations`");
while($row = mysql_fetch_array($result)){
$town_id = $row['id'];

$skillc = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Mining' ") or die('Error');
$skill = mysql_fetch_array($skillc);
$mining = $skill['level'];

$skillwa = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Woodcutting' ") or die('Error');
$skillw = mysql_fetch_array($skillwa);
$wc = $skillw['level'];

$skillfa = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Fishing' ") or die('Error');
$skillf = mysql_fetch_array($skillfa);
$fishing = $skillf['level'];

if(isset($_POST['t'])) { $type = $_POST['t']; } else { $type = $_GET['t']; }
if($type == $town_id){

switch($town_id)
{

// ==== VALENCIA ISLE  ==== //

// Verne Peninsula
case  6 :
?>  
    <center><span class="town" onclick="update_main(6)"><b>Verne Peninsula</b></span></center><br>
	<span class="action">Shops</span><br><br>
	

	
	<span class="action" onclick="moveLocaion(13)">Sail to St Penwith Pier</span>
	
	<br><br><span class="action" onclick="startfishing('133')">Fish Black Bass</span> <?php // Level 1 ?>
	<?php
	if ($fishing >= 5) {
	?>
	<br><span class="action" onclick="startfishing('134');" style="cursor: pointer;">Fish Herring</span><?php // Level 5 ?>
	<?php
	}
	if ($fishing >= 7) {
	?>
	<br><span class="action" onclick="startfishing('135');" style="cursor: pointer;">Fish Mackerel</span><?php // Level 7 ?>
	<?php
	}


break;

// Benadalid
case  11 :
?>
	<center><span class="town" onclick="update_main(11)"><b>Benadalid</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
 
	<span class="action" onclick="startmining('157');" style="cursor: pointer;">Mine Copper</span><?php // Level 1 ?>
	
	<br><span class="action" onclick="startmining('158')">Mine Tin</span> <?php // Level 1 ?>
	<?php 
	if ($mining >= 5) {
	?>
	<br><span class="action" onclick="startmining('159')">Mine Granite</span> <?php // Level 5 ?>
	<?php 
	}
	if ($mining >= 8) {
	?>
	<br><span class="action" onclick="startmining('160');" style="cursor: pointer;">Mine Iron</span><?php // Level 8 ?>
	<?php
	}
	?>
	<br><br><span class="action">Gather Lemons/Limes/Oranges</span><br> <?php // Level 7 (Lemons/Limes/Organges) ?>
	
<?php	
break;

// Frigiliana
case  10 :
?>
	<center><span class="town" onclick="update_main(10)"><b>Frigiliana</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>

<?php
if($wc >= 7) {
?>
	<span class="action" onclick="startwoodcutting(172)">Chop Chesnut Logs</span><br> <?php // Level 7?>
<?php	
}
if($wc >= 10) {
?>
	<span class="action" onclick="startwoodcutting(173)">Chop Cedar Logs</span><br> <?php // Level 10?>
<?php	
}	
break;

// Carratraca
case  9 :
?>
	<center><span class="town" onclick="update_main(9)"><b>Carratraca</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>

	
	
	<?php
	if ($fishing >= 10) {
	?>
	<span class="action" onclick="startfishing('136');" style="cursor: pointer;">Fish Pike</span><?php // Level 10 ?>
	<?php
	}
	
break;

// Maqueda
case  8 :
?>
	<center><span class="town" onclick="update_main(8)"><b>Maqueda</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
	
<span class="action" onclick="startwoodcutting(170)">Chop Walnut Logs</span> <?php // Level 1 ?>
<?php 
if($wc >= 5) {
?>
	<br><span class="action" onclick="startwoodcutting(171)">Chop Elm Logs</span><br> <?php // Level 5  ?>
<?php	
}
	
break;

// Domecelle 
case  7 :
?>
	<center><span class="town" onclick="update_main(7)"><b>Domecelle</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php	
break;

// ==== PANCASHIRE  ==== //

// St Penwith Pier
case  12 :
?>
	<center><span class="town" onclick="update_main(12)"><b>St Penwith Pier</b></span></center><br>
	<span class="action">Shops</span><br><br>
	
	
<span class="action" onclick="moveLocaion(14)">Sail to Verne Peninsula</span><br>
<span class="action" onclick="moveLocaion(15)">Sail to Broken Hill</span><br><br>

<?php
	if ($fishing >= 15) {
	?>
	<span class="action" onclick="startfishing('137');" style="cursor: pointer;">Fish Arowana</span><?php // Level 15 ?>
	<?php
	}

	if ($fishing >= 20) {
	?>
	<br><span class="action" onclick="startfishing('138');" style="cursor: pointer;">Fish Salmon</span><?php // Level 20 ?>
	<?php
	}

break;

// Padstow
case  17 :
?>
	<center><span class="town" onclick="update_main(17)"><b>Padstow</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php	
if($wc >= 15) {
?>
	<span class="action" onclick="startwoodcutting(174)">Chop Sycamore Logs</span><br> <?php // Level 15 ?>
<?php	
}
if($wc >= 20) {
?>
	<span class="action" onclick="startwoodcutting(175)">Chop Birch Logs</span><br> <?php // Level 20 ?>
<?php	
}
break;

// Loscoe
case  16 :
?>
	<center><span class="town" onclick="update_main(16)"><b>Loscoe</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
	<?php
	if ($fishing >= 24) {
	?>
	<span class="action" onclick="startfishing('139');" style="cursor: pointer;">Fish Barbed Mascara</span><?php // Level 24 ?>
	<?php
	}
	if ($fishing >= 30) {
	?>
	<br><span class="action" onclick="startfishing('140');" style="cursor: pointer;">Fish Guntheri</span><?php // Level 30 ?>
	<?php
	}
break;

// Beckenham
case  15 :
?>
	<center><span class="town" onclick="update_main(15)"><b>Beckenham</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
	
	<?php
	if ($mining >= 21) {
	?>
	<span class="action" onclick="startmining('164');" style="cursor: pointer;">Mine Jaspillite Ore</span><?php // Level 21 ?>
	<?php
	}

break;

// Finchley
case  14 :
?>
	<center><span class="town" onclick="update_main(14)"><b>Finchley</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php	
if($wc >= 24) {
?>
	<br><span class="action" onclick="startwoodcutting(176)">Chop Hawthorn Logs</span><br> <?php // Level 24 ?>
<?php	
}
if($wc >= 30) {
?>
	<br><span class="action" onclick="startwoodcutting(177)">Chop Hickory Logs</span><br> <?php // Level 30 ?>
<?php	
}
break;

// Ammesbury
case  13 :
?>
	<center><span class="town" onclick="update_main(13)"><b>Ammesbury</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
	
	<?php
	if ($mining >= 10) {
	?>
	<span class="action" onclick="startmining('161');" style="cursor: pointer;">Mine Sandstone Blocks</span><?php // Level 10 ?>
	<?php
	}
	
	if ($mining >= 15) {
	?>
	<br><span class="action" onclick="startmining('163');" style="cursor: pointer;">Mine Travertine Ore</span><?php // Level 15 ?>
	<?php
	}
	
	if ($mining >= 17) {
	?>
	<br><span class="action" onclick="startmining('162');" style="cursor: pointer;">Mine Salt Rocks</span><?php // Level 17 ?>
	<?php
	}
	
	if ($mining >= 28) {
	?>
	<br><span class="action" onclick="startmining('165');" style="cursor: pointer;">Mine Hyaloclastite Ore</span><?php // Level 28 ?>
	<?php
	}
break;

// ==== ERATIA ISLE  ==== //

// Broken Hill
case  18 :
?>
	<center><span class="town" onclick="update_main(18)"><b>Broken Hill</b></span></center><br>
	<span class="action">Shops</span><br><br>

<span class="action" onclick="moveLocaion(16)">Sail to St Penwith Pier</span>
<?php
break;

// Randwick
case  19 :
?>
	<center><span class="town" onclick="update_main(19)"><b>Randwick</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php
	if ($fishing >= 36) {
	?>
	<span class="action" onclick="startfishing('141');" style="cursor: pointer;">Fish Catfish</span><?php // Level 36 ?>
	<?php
	}
	if ($fishing >= 41) {
	?>
	<br><span class="action" onclick="startfishing('142');" style="cursor: pointer;">Fish Piranha</span><?php // Level 41 ?>
	<?php
	}	
break;

// Cessnock
case  20 :
?>
	<center><span class="town" onclick="update_main(20)"><b>Cessnock</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php	
	if ($fishing >= 47) {
	?>
	<span class="action" onclick="startfishing('143');" style="cursor: pointer;">Fish Koi</span><?php // Level 47 ?>
	<?php
	}
	if ($fishing >= 55) {
	?>
	<br><span class="action" onclick="startfishing('144');" style="cursor: pointer;">Fish Ruby Shark</span><?php // Level 55 ?>
	<?php
	}
break;

// Cantebury
case  21 :
?>
	<center><span class="town" onclick="update_main(21)"><b>Cantebury</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php	
if($wc >= 40) {
?>
	<br><span class="action" onclick="startwoodcutting(179)">Chop Mahogany Logs</span><br> <?php // Level 40 ?>
<?php	
}
if($wc >= 45) {
?>
	<br><span class="action" onclick="startwoodcutting(180)">Chop Aspen Logs</span><br> <?php // Level 45 ?>
<?php	
}
break;

// Willoughby
case  22 :
?>
	<center><span class="town" onclick="update_main(22)"><b>Willoughby</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php
if($wc >= 36) {
?>
	<br><span class="action" onclick="startwoodcutting(178)">Chop Ashwood Logs</span><br> <?php // Level 36 ?>
<?php	
}
if($wc >= 50) {
?>
	<br><span class="action" onclick="startwoodcutting(181)">Chop Willow Logs</span><br> <?php // Level 50 ?>
<?php	
}
if($wc >= 58) {
?>
	<br><span class="action" onclick="startwoodcutting(182)">Chop Yew Logs</span><br> <?php // Level 58 ?>
<?php	
}	
break;

// Litgow
case  23 :
?>
	<center><span class="town" onclick="update_main(23)"><b>Lithgow</b></span></center><br>
	<span class="action">Houses</span><br>
	<span class="action">Shops</span><br>
	<span class="action">Guild Storages</span><br><br>
<?php
	if ($mining >= 35) {
	?>
	<span class="action" onclick="startmining('166');" style="cursor: pointer;">Mine Kimberlite Ore</span><?php // Level 35 ?>
	<?php
	}
	if ($mining >= 42) {
	?>
	<br><span class="action" onclick="startmining('167');" style="cursor: pointer;">Mine Nickel Ore</span><?php // Level 42 ?>
	<?php
	}
	if ($mining >= 49) {
	?>
	<br><span class="action" onclick="startmining('168');" style="cursor: pointer;">Mine Obsidian Ore</span><?php // Level 49 ?>
	<?php
	}
	if ($mining >= 56) {
	?>
	<br><span class="action" onclick="startmining('169');" style="cursor: pointer;">Mine Alluere Ore</span><?php // Level 56 ?>
	<?php
	}
break;

// ==== Tutorial  ==== //

// Falionra
case  1 :
?>
	<center><span class="town" onclick="update_main(1)"><b>Falionra</b></span></center><br>
<?php
break;

// Astelio
case  2 :
?>
	<center><span class="town" onclick="update_main(2)"><b>Astelio</b></span></center><br>
<?php
break;

// Ivory City
case  3 :
?>
	<center><span class="town" onclick="update_main(3)"><b>Ivory City</b></span></center><br>
<?php
break;

// Kamellott
case  4 :
?>
	<center><span class="town" onclick="update_main(4)"><b>Kamellot</b></span></center><br>
<?php
break;

// Marintiqua
case  5 :
?>
	<center><span class="town" onclick="update_main(5)"><b>Marintiqua</b></span></center><br><br>
	<span class="action" onclick="moveLocaion(51)">Sail to Verne Peninsula</span>
<?php
break;

}
}
}
?>