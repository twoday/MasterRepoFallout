<?php

session_start();
include 'core/database/connect.php';


$check = mysql_query("SELECT `user_id`,`username`,`location_id`,`botcheck_number`,`botcheck`,`check_time`,`action_id`,`action_skill` FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or
	die('Error1');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$location = $userinfo['location_id'];
$action_skill = $userinfo['action_skill'];
$action_id = $userinfo['action_id'];
$current_number = $userinfo['botcheck_number'];

$p = $_POST['p']; // sanitize() this.


if($p == 1) {
	// Loading the Botcheck

?>
                                            <div align="center">
                                                    <b>Please fill in the correct variation of <u>numbers</u>.</b><br />
                                                    <img style="border:1px solid #660000;" src="generate.php?<?php

	echo time();
?>" id="botimg"/><br /><br />
     
                                                    <input name="captcha" id="captcha" size="6" type="text" style="border:1px solid #660000;background-color:black;color:white;" onkeydown="if (event.keyCode == 13) { Tie.botcheck('send'); }"/>
                                                    <input value="Submit" id="btnSearch" onclick="Tie.botcheck('send');" style="border:1px solid #660000;background-color:black;color:white;" type="submit"/><br />
                                                    <input value="New Code"  onclick="Tie.botcheck('new');" style="border:1px solid #660000;background-color:black;color:white;" type="submit"/><br />
                                            </div>
                                    <?php

} else
	if($p == 2) {
		// Submitted, check if it's correct.
		$guess = $_POST['g']; // sanitize() this.

		if($guess == $current_number) {
			$gap = time() + 3600;
			$rand = rand(1000, 9999);
			mysql_query("UPDATE `users` SET `check_time` = '$gap', `botcheck_number` = '$rand' WHERE `user_id` = '$userid'");
			echo "action|$action_id|";
			//echo "botcheck|home|$location|";

		} else {
			// Failed the Botcheck
			echo "botcheck|fail|";
		}


	} else
		if($p == 3) {
			// Need a new code
			$rand = rand(1000, 9999);
			mysql_query("UPDATE `users` SET `botcheck_number` = '$rand' WHERE `user_id` = '$userid'");

			echo "botcheck|show|";
		}
?>