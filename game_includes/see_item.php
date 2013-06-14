<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];

?>
<script type="text/javascript">

function equipItem(id,slot,number){
$.post("everything.php", { p:32, id:id, slot:slot, number:number },
	function(data) {
		eval(data);
	});
		
}

</script>
<?php

$select7 = "SELECT * FROM `inventory` WHERE `userid` = '$userid'";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row1 = mysql_fetch_assoc($select_resutlts7)){
$id = $row1['itemid'];
$item_count = $row1['count'];
$item_type = $row1['type'];


if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == $id){

$result2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$id'");
		while ($row = mysql_fetch_array($result2)) {
			$item_name = $row['name'];
			$gained_plural = $row['plural'];
			
			$extra_poundals = intval(($row['ouncels'] * $item_count) / 16);
			$ouncels = ($row['ouncels'] * $item_count) % 16;
			$poundals = ($row['poundals'] * $item_count) + $extra_poundals;
			$tons = intval($poundals / 1000);
			$poundals = $poundals % 1000;
						
if($row1['count'] == 1){
$item_name = $item_name;

}else{
$item_name = $gained_plural;
}			

$check4 = mysql_query("SELECT * FROM `player_equipment` WHERE `player_id` = '$userid' AND `head` = '$id' || `neck` = '$id' || `torso` = '$id' || `legs` = '$id' || `feet` = '$id' || `left_hand` = '$id' || `right_hand` = '$id' || `gloves` = '$id' || `rings` = '$id'") or die('Error');
$gcount = mysql_num_rows($check4);

if($gcount != 0) {

echo "$item_name <span style=\"color:red; font-size:12px;\">(Equipped) </span><br />";
}else {
echo "$item_name<br>";
}

echo "You have: <span id=\"count_item\">$row1[count]</span>";
echo " $item_name<br>";
echo "Weight: $tons Tons, $poundals Poundals, $ouncels Ouncels<br />";
echo "Per: $row[poundals] Poundals, $row[ouncels] Ouncels<br /><br />";

if($item_type == "Tool" || $item_type == "Armour" || $item_type == "Weapon" ){

$select = "SELECT * FROM `equipment` WHERE `item_id` = '$id'";
$select_resutlts = mysql_query($select) or die(mysql_error());
while($row2 = mysql_fetch_assoc($select_resutlts)){
$slot = $row2['slot'];

$check2 = mysql_query("SELECT * FROM `skills` WHERE `id` = '$row2[required_skill]'") or die('Error');
$iteminfo = mysql_fetch_array($check2);
$name = $iteminfo['name'];

$check3 = mysql_query("SELECT * FROM `player_skill` WHERE `skill_name` = '$name' AND `player_id` = '$userid'") or die('Error');
$skillinfo = mysql_fetch_array($check3);
$skill_level = $skillinfo['level'];


if($skill_level < $row2['skill_level']){
echo "<span style=\"color:red;\">Required Level: $row2[skill_level] $name</span><br />";
}else{
echo "<span style=\"color:green;\">Required Level: $row2[skill_level] $name</span><br />";
$gcount = mysql_num_rows($check4);

if($gcount == 0) {
echo "<br /><span onclick=\"equipItem('$id','$slot','$item_count')\" style=\"font-size:12px; color:red; cursor:pointer;\">Equip Item</span>";
}else{
echo "<br /><span onclick=\"unequipItem('$slot','2','$id')\" style=\"font-size:12px; color:red; cursor:pointer;\">Remove Item</span>";
}
}







}




}
}
}
}
?>
