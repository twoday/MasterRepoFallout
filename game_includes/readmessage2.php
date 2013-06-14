<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$t_location = $userinfo['location_id'];


$select7 = "SELECT * FROM `sent_messages`";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row1 = mysql_fetch_assoc($select_resutlts7)){
$id = $row1['id'];

if(isset($_POST['id2'])) { $type = $_POST['id2']; } else { $type = $_GET['id2']; }

if($type == $id){
	?>
<table id="main_tables" width="100%">
<tr class="other"><td width="75px">To </td><td><?php echo "$row1[to]"; ?></td></tr>
<tr class="other"><td>Sent </td><td><?php echo "$row1[date]"; ?></td></tr>
<tr class="other"><td>Topic </td><td><?php echo "$row1[title]"; ?></td></tr>
<tr class="other"><td colspan="2"></td></tr>
<tr class="other"><td colspan="2"><?php echo $row1["message"]; ?></td></tr>
</table>
<?php	
}

}
?>

