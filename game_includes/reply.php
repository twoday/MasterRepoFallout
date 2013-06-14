<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];


$select7 = "SELECT * FROM `new_messages`";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row1 = mysql_fetch_assoc($select_resutlts7)){
$id = $row1['id'];
$player = $row1['from'];
$sub = $row1['title'];

if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == $id){


?>
<table style="width:700px; border:0px;">
<tr><td class="message_send" width="100px">Player</td><td><input class="input" value="<?php echo $player; ?>" type="text" id="play"></td></tr>
<tr><td class="message_send">Topic</td><td><input class="input" type="text" value="Re: <?php echo $sub; ?>" id="subject"></td></tr>

<tr><td align="center" colspan="2">

<textarea class="input" style="width:650px; height:200px;" id="player_message">

</textarea>

</td></tr>
<tr><td colspan="2"><input class="input" type="submit" value="Send Message" onclick="sendMessage();"></td></tr>

</table>



<div id="error_mess" style="font-size:14px;"></div>
<?php

}
}
?>