<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];

$select7 = "SELECT * FROM `inventory` WHERE `userid` = '$userid'";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row1 = mysql_fetch_assoc($select_resutlts7)){
$id = $row1['itemid'];
$item_count = $row1['count'];

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
				
echo "$item_name<br>";
echo "You have: $row1[count] $item_name<br>";
echo "Weight: $tons Tons, $poundals Poundals, $ouncels Ouncels<br />";
echo "Per: $row[poundals] Poundals, $row[ouncels] Ouncels<br>";


}
}
}
?>
