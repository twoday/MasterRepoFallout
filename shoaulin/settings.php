<?php

session_start();
include ("dbconnect.php");
?>
<!doctype html>
    <html>
<head>
    <title>Fallout Chronicle</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="screen.css">
	<link rel="shortcut icon" href="favicon.png" />
    <meta name="title" content="Fallout Chronicle" />
    <meta name="description" content="Fallout Chronicle is a browser text based game, with 12 skills, over hundreds of resources to collect, guilds to build, and quests to complete." />

</head>     
 <body>
<header>

      <center><img src="FC.png" border="0"></img></center> 
    <div class="clear"></div>
</header>  
    <div id="container">
		<div class="conall">
			<div class="concenter">
<a href="settings.php?p=account" class="manlinks">
	Account Settings
</a>
|
<a href="settings.php?p=communication" class="manlinks">
	Communication Settings
</a>
|
<a href="settings.php?p=perks" class="manlinks">
	Perks
</a>
<br />
<?php

$user_id = $_SESSION['user_id'];
if(isset($_POST['change_username'])) {
	$new_username = trim(strip_tags($_POST['new_username']));
	if(strlen($new_username) < 3 || strlen($new_username > 20)) {
		$error = "Your alias must be between 3 and 20 characters";
	} else {
		$check_duplicates = mysqli_query($link,
			"SELECT `username` FROM `users` WHERE `username`=\" " . $new_username . "\"
			");
		if(mysqli_num_rows($check_duplicates) > 0) {
			$error = "This username is already in use . Please choose another
			";
		} else {
			if(mysqli_query($link, "UPDATE `users` SET `username` = \"" . $new_username . "\" WHERE `user_id`=" .
				$user_id)) {
				echo "Username updated";
			} else {
				$error = "There was a problem updating your username. Error: " . mysqli_error($link);
			}
		}
	}
} elseif(isset($_POST['change_alias'])) {
	$new_alias = trim(strip_tags($_POST['new_alias']));
	if(strlen($new_alias) < 3 || strlen($new_alias > 20)) {
		$error = "Your alias must be between 3 and 20 characters";
	} else {
		$check_duplicates = mysqli_query($link,
			"SELECT `alias` FROM `users` WHERE `alias`=\"" . $new_alias . "\"");
		if(mysqli_num_rows($check_duplicates) > 0) {
			$error = "This alias is already in use. Please choose another";
		} else {
			if(mysqli_query($link, "UPDATE `users` SET `alias`=\"" . $new_alias . "\" WHERE `user_id`=" .
				$user_id)) {
				echo "Alias updated";
			} else {
				$error = "There was a problem updating your alias. Error:
	" . mysqli_error($link);
			}
		}
	}
} elseif(isset($_POST['change_password'])) {
	$old_password = md5(trim($_POST['current_password']));
	$new_password = trim($_POST['new_password']);
	$confirm_new_password = trim($_POST['confirm_new_password']);
	if(strlen($new_password) < 5 || strlen($confirm_new_password) < 5) {
		$error = "Your new password must be at least 5 characters long";
	} else {
		$check_pass = mysqli_query($link,
			"SELECT `email`, `password` FROM `users` WHERE `password` =\"" . $old_password .
			"\" AND `user_id`=" . $user_id);
		if(mysqli_num_rows($check_pass) > 0) {
			$pass = mysqli_fetch_assoc($check_pass);
			if($new_password == $confirm_new_password) {
				if(mysqli_query($link, "UPDATE `users` SET `password`=\"" . md5($new_password) .
					"\" WHERE `user_id`=" . $user_id)) {
					echo "Password updated";
					$to = $pass['emmail'];
					$subject = "Fallout Chronicle Account Information Changed";
					$body = "Hello, <br /><br /> We are sending you this e-mail in correspondence to your Fallout Chronicle account password.<br /><br />You have recently changed your password to:" .
						$new_password . "<br /><br />If you believe this is a mistake or your account was compromised please immediately e-mail Fallout Chronicle Administration.<br /><br />Fallout Chronicle Administration <br /> E-mail: admin@falloutchronicle.com <br /> http://www.falloutchronicle.com";
					mail($to, $subject, $body, 'From: admin@falloutchronicle.com');
				} else {
					$error = "There was a problem updated your password.
	Error: " . mysqli_error($link);
				}
			} else {
				$error = "The new passwords entered do not match";
			}
		} else {
			$error = "Incorrect current password. Please try again";
		}
	}
} elseif(isset($_POST['add_ignore'])) {
	$ignore = trim(strip_tags($_POST['ignore']));
	$check_username = mysqli_query($link,
		"SELECT `user_id` FROM `users` WHERE `username`=\"" . $ignore . "\"");
	if(mysqli_num_rows($check_username) > 0) {
		$user = mysqli_fetch_assoc($check_username);
		if(mysqli_query($link, "INSERT INTO `ignore` (`ignoring`, `ignored`) VALUES (" .
			$user_id . ", " . $user['user_id'] . ")")) {
			echo $ignore . " added to ignore list";
		} else {
			$error = "There was a problem adding " . $ignore .
				" to your ignore list. Error: " . mysqli_error($link);
		}
	} else {
		$error = $ignore . " does not exist";
	}
} elseif(isset($_GET['id'])) {
	$id = $_GET['id'];
	$check_id = mysqli_query($link,
		"SELECT `ignored` FROM `ignore` WHERE `ignoring`=" . $user_id .
		" AND `ignored`=" . $id);
	if(mysqli_num_rows($check_id) > 0) {
		if(mysqli_query($link, "DELETE FROM `ignore` WHERE `ignoring`=" . $user_id .
			" AND `ignored`=" . $id)) {
			echo "User removed from ignore list";
		} else {
			$error = "There was a problem removing the user from your ignore list. Error: " .
				mysqli_error($link);
		}
	}else {
	   $error = "That user is not on your ignore list";
	}
}
?>
				<?php

if(isset($error)) {
	echo "<font color=red>" . $error . "</font>";
}
if(isset($_GET['p'])) {
	if($_GET['p'] == "account") {
?>
					<form action="settings.php?p=account" method="post">
						<table class="dtab">
							<tr>
								<td colspan="4">
									<font size="3em">
										<b>
											Account Settings
										</b>
									</font>
								</td>
							</tr>
							<tr>
								<td>
									<table class="dtab">
										<tr>
											<td>
												<b>
													Names
												</b>
											</td>
										</tr>
										<tr>
											<td width="24%">
												<label>
													Rename Character
												</label>
											</td>
											<td>
												<input class="fdi" name="new_username" size="22" title="Username" />
											</td>
											<td>
												Costs $3 (Per)
											</td>
											<td>
												<input class="fdi" type="submit" value="Rename Character" name="change_username" title="Change Username" />
											</td>
										</tr>
										<tr>
											<td width="30px">
												Rename Alias
											</td>
											<td>
												
											</td>
											<td>
												Costs $5 (Per)
											</td>
											<td>
												
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table class="dtab">
										<td>
											<b>
												Password
											</b>
										</td>
							</tr>
							<tr>
								<td width="30px">
									Old Password
								</td>
								<td>
									<input type="password" class="fdi" name="current_password" size="22" title="Password" />
								</td>
							</tr>
							<tr>
								<td width="30px">
									New Password
								</td>
								<td>
									<input type="password" class="fdi" name="new_password" size="22" title="Password" />
								</td>
							</tr>
							<tr>
								<td width="30px">
									Confirm New Password
								</td>
								<td>
									<input type="password" class="fdi" name="confirm_new_password" size="22" title="Password" />
								</td>
							</tr>
							<tr>
								<td>
									<input class="fdi" type="submit" value="Change Password" name="change_password" title="Change Password" />
								</td>
							</tr>
							<tr>
								<td colspan="4">
									When you reset your password, it will be e-mailed. The Fallout Chronicle Administration recommends you change your password every 72 days.
								</td>
							</tr>
							</table>
							</td>
							</tr>
						</table>
					</form>
					<?php

	} elseif($_GET['p'] == "communication") {
		$select_ignored = mysqli_query($link,
			"SELECT `ignored` FROM `ignore` WHERE `ignoring`=" . $user_id);
		if(mysqli_num_rows($select_ignored) > 0) {
			while ($ignored = mysqli_fetch_assoc($select_ignored)) {
				$select_name = mysqli_query($link,
					"SELECT `username` FROM `users` WHERE `user_id`=" . $ignored['ignored']);
				if(mysqli_num_rows($select_name) > 0) {
					$name = mysqli_fetch_assoc($select_name);
					$ignore_list .= $name['username'] . " <a href=\"settings.php?p=communication&id=" .
						$ignored['ignored'] . "\" class=\"manlinks\">Remove</a><br/>";
				}
			}
		}
?>
						<br />
                        <form method="post" action="settings.php?p=communication">
						<table class="dtab" width="100%">
							<tr>
								<td colspan="4">
									<font size="3em">
										<b>
											Communication Settings
										</b>
									</font>
								</td>
							</tr>
							<tr>
								<td>
									<b>
										Chat
									</b>
								</td>
							</tr>
							<tr>
								<td>
									<font color="#d9e1f8">
										World
									</font>
								</td>
								<td>
									<input type="submit" value="Enable" class="fdi" title="Enable World" />
								</td>
								<td>
									<input type="submit" value="Disable" class="fdi" title="Disable World" />
								</td>
								<td>
									This will Enable / Disable World Channel. Administration and Whispers will still be visible.
								</td>
							</tr>
							<tr>
								<td>
									<font color="#4cc417">
										Guild
									</font>
								</td>
								<td>
									<input type="submit" value="Enable" class="fdi" title="Enable Guild">
								</td>
								<td>
									<input type="submit" value="Disable" class="fdi" title="Disable Guild">
								</td>
								<td>
									This will Enable / Disable Guild Channel.
								</td>
							</tr>
							<tr>
								<td>
									<font color="#fff380">
										Help
									</font>
								</td>
								<td>
									<input type="submit" value="Enable" class="fdi" title="Enable Help" />
								</td>
								<td>
									<input type="submit" value="Disable" class="fdi" title="Disable Help"/>
								</td>
								<td>
									This will Enable / Disable Help Channel.
								</td>
							</tr>
							<tr>
								<td>
									<font color="#8d38c9">
										Trade
									</font>
								</td>
								<td>
									<input type="submit" value="Enable" class="fdi" title="Enable Trade">
								</td>
								<td>
									<input type="submit" value="Disable" class="fdi" title="Disable Trade">
								</td>
								<td>
									This will Enable / Disable Trade Channel.
								</td>
							</tr>
							<tr>
								<td>
									<font color="#6da6bc">
										Whispers
									</font>
								</td>
								<td>
									<input type="submit" value="Enable" class="fdi" title="Enable Whispers">
								</td>
								<td>
									<input type="submit" value="Disable" class="fdi" title="Disable Whispers">
								</td>
								<td>
									This will Enable / Disable Whispers. If you have the Whispers to Message Perk, you will not receive them.
								</td>
							</tr>
                            <tr>
                            <td><b>Ignore List</b></td>
                            </tr>
                            <tr>
                            <td>
                            <input type="text" class="fdi" name="ignore" />
                            </td>
                            <td>
                            <input type="submit" class="fdi" name="add_ignore" value="Submit" />
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <?php
                            echo $ignore_list;
                            ?>
                            </td>
                            </tr>
                             <tr>
                            <td colspan="4">
                            Ignored players as of now still show up in your chat history, and also if they don't want to see your chat lines they have to ignore you as well.
                            </td>
                            </tr>
						</table>
                        </form>
						<?php

	} elseif($_GET['p'] == "perks") {
?>
							<br />
							<table class="dtab">
								<tr>
									<td>
										<font size="3em">
											<b>
												Perks
											</b>
										</font>
									</td>
								</tr>
								<tr>
									<td>
										Whispers to Messages
									</td>
									<td>
										<input type="submit" value="Enable" class="fdi" title="Enable Whispers to Messages">
									</td>
									<td>
										<input type="submit" value="Disable" class="fdi" title="Disable Whispers to Messages">
									</td>
									<td>
										This will allow your inactive (offline) whispers to be transferred to your messages once purchased.
									</td>
								</tr>
								<tr>
									<td>
										Forum Avatar
									</td>
									<td>
										<input type="submit" value="Enable" class="fdi" title="Enable Forum Avatar" />
									</td>
									<td>
										<input type="submit" value="Disable" class="fdi" title="Disable Forum Avatar" />
									</td>
									<td>
										<input type="submit" value="Upload" class="fdi" title="Upload" />
									</td>
								</tr>
								<tr>
									<td colspan="3">
										Avatar Size (125 x 125 Pixels) 2mb Max.
									</td>
								</tr>
								<tr>
									<td>
										Forum Signature
									</td>
									<td colspan="2">
										<input type="text" class="fdi" size="30" name="forum_sig" title="Forum Signature" />
									</td>
									<td>
										<input type="submit" class="fdi" title="Submit" value="Sumbit" />
									</td>
								</tr>
								<tr>
									<td>
										Custom Sign-in
									</td>
									<td colspan="2">
										<input type="text" class="fdi" size="30" title="Sign-In Message">
									</td>
									<td>
										<input type="submit" class="fdi" title="Submit" value="Sumbit">
									</td>
								</tr>
								<tr>
									<td>
										Extend Botcheck
									</td>
									<td>
										<select name="Extend" class="fdi">
											<option>
												Extend
											</option>
											<option value="1 Hour">
												1 Hour
											</option>
											<option value="2 Hours">
												2 Hours
											</option>
										</select>
									</td>
									<td>
										<input type="submit" class="fdi" title="Extend" value="Extend">
									</td>
								</tr>
								</tr>
								</tr>
							</table>
								<?php

	} elseif($_GET['p'] == "themes") {
?>
								
								<?php

	}
} else {
?>
								
								<?php

}
?>		
		
	</div>
    </div>

<a href="/manual" class="manlinks">Manual</a>
</div>
<footer>
    <br><center>&copy; Fallout Chronicle 2013. All rights reserved.</center>
</footer></body>
</html>