<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];


$select7 = "SELECT * FROM `moving_actions`";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row1 = mysql_fetch_assoc($select_resutlts7)){
$id = $row1['id'];
$id2 = $row1['move_too'];
$exp = $row1['exp'];

if(isset($_POST['id'])) { $type1 = $_POST['id']; } else { $type1 = $_GET['id']; }

if($type1 == $id){


mysql_query("UPDATE `users` SET `location_id` = '$id2' WHERE `user_id` = '$userid'");

	$query = mysql_query("SELECT * FROM `player_skill` WHERE `player_id` = '$userid' AND `skill_name` = 'Speed'");	
		$row = mysql_fetch_assoc($query);
			$level = $row['level'];
			$texp = $row['exp'];
			
$thexp3 = floor( ($level/2) * pow( floor(($level*5)) , 2));
$amount = $texp + $exp;

mysql_query("UPDATE `player_skill` SET `exp` = '$amount' WHERE `skill_name` = 'Speed' AND `player_id` = '$userid'");

if($amount  >= $thexp3){
$levelup = $level + 1;
mysql_query("UPDATE `player_skill` SET `level` = '$levelup' WHERE `skill_name` = 'Speed' AND `player_id` = '$userid'");

}		

}
}
?>