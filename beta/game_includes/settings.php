<script type="text/javascript">
	$(function() {
		$('.style-change').change(function() {
			var style = $(this).val();
			$.post("everything.php", {
				p: 13,
				type: style
			});

			$('body').fadeOut("slow", function() {
				$('link[rel="stylesheet"]').attr("href", style + ".css");
				closesettings();
				$('body').fadeIn("slow");
			});
		});
        $('.links').click(function(){ 
            var id = $this.attr('id');
            $.post("settings.php", p: id);
        });
	});
</script>
<span class="links" id="account">
	Account Settings
</span>
|
<span class="links" id="communication">
	Communication Settings
</span>
|
<span class="links" id="perks">
	Perks
</span>
|
<span class="links">
	Themes
</span>
<br />
<?php

include ("dbconnect.php");
if(isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	if(isset($_POST['change_username'])) {
		$new_username = trim($_POST['new_username']);
		$check_duplicates = mysqli_query($link,
			"SELECT `username` FROM `users` WHERE `username`=\" " . $new_username . "\"
			");
		if(mysqli_num_rows($check_duplicates) > 0) {
			$error = "This username is already in use . Please choose another
			";
		} else {
			if(mysqli_query($link, "UPDATE`users`SET`username` = \"" . $new_username . "\" WHERE `user_id`=" .
				$user_id)) {
				echo "Username updated";
			} else {
				$error = "There was a problem updating your username. Error: " . mysqli_error($link);
			}
		}
	} elseif(isset($_POST['change_alias'])) {
		$new_alias = trim($_POST['new_alias']);
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
	} elseif(isset($_POST['change password'])) {
		$old_password = md5(trim($_POST['current_password']));
		$new_password = trim($_POST['new_password']);
		$confirm_new_password = trim($_POST['confirm_new_password']);
		$check_pass = mysqli_query($link,
			"SELECT `password` FROM `users` WHERE `password` =\"" . $old_password . "\" AND `user_id`=" .
			$user_id);
		if(mysqli_num_rows($check_pass) > 0) {
			if($new_password == $confirm_new_password) {
				if(mysqli_query($link, "UPDATE `users` SET `password`=\"" . md5($new_password) .
					"\" WHERE `user_id`=" . $user_id)) {
					echo "Password updated";
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
?>
	<div id="container">
		<div class="conall">
			<div class="concenter">
				<?php

	if(isset($error)) {
		echo "<font color=red>" . $error . "</font>";
	}
	if(isset($_GET['p'])) {
		if($_GET['p'] == "account") {
?>
					<form action="" method="post">
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
												<input type="text" class="fdi" size="22" name="new_alias" />
											</td>
											<td>
												Costs $5 (Per)
											</td>
											<td>
												<input class="fdi" type="submit" value="Rename Alias" name="change_alias" title="Change Alias" />
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
?>
						<br />
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
						</table>
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
										Avatar Size (75 x 75 Pixels) 2mb Max.
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
								<div align="center">
									Theme:
									<select class="style-change" name="colors2" id="theme5" style="font-family:verdana;color:white; border:1px solid #660000; background-color:Black">
										<option value="">
											Select a Theme
										</option>
										<option value="css/game">
											Game
										</option>
										<option value="css/violet">
											Violet
										</option>
										<option value="css/royal">
											Royal
										</option>
										<option value="css/maroon">
											Maroon
										</option>
										<option value="css/forest">
											Forest
										</option>
									</select>
								</div>
								<?php

		}
	} else {
?>
								<div align="center">
									Theme:
									<select class="style-change" name="colors2" id="theme5" style="font-family:verdana;color:white; border:1px solid #660000; background-color:Black">
										<option value="">
											Select a Theme
										</option>
										<option value="css/game">
											Game
										</option>
										<option value="css/violet">
											Violet
										</option>
										<option value="css/royal">
											Royal
										</option>
										<option value="css/maroon">
											Maroon
										</option>
										<option value="css/forest">
											Forest
										</option>
									</select>
								</div>
								<?php

	}
?>
			</div>
		</div>
	</div>
	<?php

} else {
	die("Please log in");
}
?>