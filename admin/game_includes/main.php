<?php
session_start();
include("../core/database/connect.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];

$result = mysql_query("SELECT * FROM `locations`");
while($row = mysql_fetch_array($result)){

$location = $row['id'];

if(isset($_POST['t'])) { $type = $_POST['t']; } else { $type = $_GET['t']; }
if($type == $location){

$query = mysql_query("SELECT * FROM `locations` WHERE `id` = '$location'");	
	$row2 = mysql_fetch_assoc($query);
		$desc = $row2['description'];
		$name = $row2['name'];
		
mysql_query("UPDATE `users` SET `action_id` = '0' WHERE `user_id` = '$userid'");
mysql_query("UPDATE `users` SET `action_skill` = 'None' WHERE `user_id` = '$userid'");
	
$selec = "SELECT * FROM `explore_locations` WHERE `user_id` = '$userid' AND `location_id` = '$location'";
$select_res = mysql_query($selec) or die(mysql_error());
$gcount = mysql_num_rows($select_res);

if($gcount == 0) {
?>
<script type="text/javascript">
var message = "<?php echo $name; ?> has been discovered.";
        $.post("everything.php", { p:26, message:message },
			function(data) {
				eval(data);


});
</script>
<?php
mysql_query("INSERT INTO `explore_locations` (`user_id`,`location_id`,`unlocked`) VALUES
 ('" . $userid . "','" . $location . "','1')") or die('Error: Cannot insert.');

}else{
mysql_query("UPDATE `explore_locations` SET `unlocked` = '1' WHERE `user_id` = '$userid' AND `location_id` = '$location'");
}

			
echo "<div align=\"left\">";

?>
 
    <span class="town"><b><?php echo "$name"; ?></b></span><br>
	<span class="town_desc"><i><?php echo "$desc"; ?></i></span><br><br>
	

<?php
$mult == 15 * 60;
$time == time()+$mult;

$sql33 = "SELECT count(action_id) AS tnew2 FROM `users` WHERE `check_time` >= '$time' AND `location_id` = '$location' AND `check_time` != 0 AND `logged_in` = 1";
$res33 = mysql_query($sql33) or die(mysql_error());
$row23 = mysql_fetch_assoc($res33);

$players_number = $row23['tnew2'] - 1;

echo "<span class=\"action\">You are among $players_number explorers</span><br>";

$result5 = mysql_query("SELECT * FROM `users` WHERE `location_id` = '$location' AND `check_time` != 0 AND `logged_in` = 1");	
while($row5 = mysql_fetch_array($result5)){
$users = $row5['username'];

$last_entered_time = $row5['check_time'];
$mult == 15 * 60;
$time == time()+$mult;
if($last_entered_time >= $time){
echo "$users<br />";
} 

}

}
}
?>