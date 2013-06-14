<?php

ini_set('session.cookie_httponly', true);
session_start();
if(isset($_SESSION['last_ip']) === false) {
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
}
if($_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']) {
	session_unset();
	session_destroy();
}
include 'core/database/connect.php';
$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or
	die('Error');
$player = mysql_fetch_array($check);
$username = $player['username'];
$location = $player['location_id'];
$access_type = $player['access_level'];
$user_id = $player['user_id'];
$theme = $player['theme'];
if(mysql_num_rows($check) == 0) {
	header('Location: index.php');
	exit();
}
$query = mysql_query("SELECT `id` FROM `chat` ORDER BY `id` ASC");
if(mysql_num_rows($query) != 0) {
	while ($row = mysql_fetch_assoc($query)) {
		$last = $row['id'];
	}
} else {
	$last = 0;
}
$_SESSION['last_chat_line'] = $last;
$sql33 = "SELECT count(*) AS tnew2 FROM `new_messages` WHERE `status` = '0' AND `to` = '$username' || `to` = '$user_id'";
$res33 = mysql_query($sql33) or die(mysql_error());
$row23 = mysql_fetch_assoc($res33);
?>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
			<title>
				Fallout Chronicle
			</title>
			<link rel="shortcut icon" href="favicon.png" />
			<link rel="stylesheet" type="text/css" href="betacss.css" />
			<script type="text/javascript" src="javascript/jquery.js">
			</script>
			<script type="text/javascript" src="javascript/functions.js">
			</script>
			<script type="text/javascript" src="javascript/tie_basic.js">
			</script>
		</head>
		<body class="c5">
			<div id="inventory_popup">
			</div>
			<div id="outer-box">
				<table id="innerhold">
					<tr>
						<td id="iconlisthold">
							<table>
								<tr>
									<td>
										<a href="#" title="Character Panel"><img src="fc-charinfo.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<span id="clickme2" class="c1">
											<img src="fc-inventory.png" border="0" />
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<a title="Map" onclick="map()"><span id="map2" class="c1"><img src="fc-map.png" border="0" /></span></a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#" title="Messages"><img src="message-new.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a class="c2" id="innerlinks" onclick="guild(1);" title="Guild"><img src="fc-guild.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="/manual" target="_blank" title="Manual"><img src="fc-manual.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#" title="Quests"><img src="fc-quest.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#" title="System Notifications"><img src="fc-notification-icon.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="/forum" target="_blank" title="Forum"><img src="fc-forum.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a class="c2" onclick="settings();" title="Game Settings"><img src="fc-settings-icon.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a class="c2" onclick="admin_panel();" title="Administration Panel"><img src="fc-admin.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="logout.php" title="Logout"><img src="fc-logout.png" border="0" /></a>
									</td>
								</tr>
								<tr>
									<td id="clock">
										<span id="clockDisplay" class="clock">
										</span>
									</td>
								</tr>
								<tr>
									<td>
										<img src="../CoFrisson-Game.png" border="0" width="50" />
									</td>
								</tr>
							</table>
						</td>
						<td id="userinfo">
							<table width="100%" height="100%">
								<tr>
									<td id="interaction">
										<div id="interhead">
											<img src="newsfeed-fc.png" border="0" />
										</div>
										<div id="interact">
											<div id="news_feed">
												<script type="text/javascript">
													//<![CDATA[
													open_newsfeeds();
													//]]>
													
												</script>
											</div>
										</div>
									</td>
									<td id="townactivity">
										<div id="townhead">
											<img src="townactivity-fc.png" border="0" />
										</div>
										<div id="townactions">
											<div id="usermenu">
												<script type="text/javascript">
													//<![CDATA[
													update_menu( <?php echo $location; ?> );
													//]]>
													
												</script>
											</div>
										</div>
									</td>
									<td id="actiontimer" valign="top">
										<div class="c3" id="timer2">
											<script type="text/javascript">
												//<![CDATA[
												update_main( <?php echo $location; ?> );
												//]]>
												
											</script>
										</div>
									</td>
								</tr>
								<tr>
									<td id="players" rowspan="3">
										<div id="playhead">
											<img src="onlineplayers-fc.png" border="0" />
										</div>
										<div id="playlist">
										</div>
									</td>
									<td id="chatback" colspan="3">
										<table width="100%" height="100%">
											<tr>
												<td height="90%">
													<div class="back" id="chatlog">
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="back" id="channels">
														<input type="submit" class="c4" value="Send" id="Submit" onclick="Tie.writeChat();" />
														<span class="other">
Channel:

<span class="change" id="change"><script type="text/javascript">channel('1');</script></span>

&mdash;
<?php

echo "<span class=\"world\" onclick=\"channel(1)\">World </span>";
echo " - ";
echo "<span class=\"guild\" onclick=\"channel(2)\">Guild </span>";
echo " - ";
echo "<span class=\"help\" onclick=\"channel(3)\">Help </span>";
echo " - ";
echo "<span class=\"trade\" onclick=\"channel(4)\">Trade </span>";
if($_SESSION['access_level'] == 100 || $_SESSION['access_level'] == 5) {
echo " - ";
echo "<span class=\"guide\" onclick=\"channel(5)\">Guide</span>";
}
if ($access_type == "100") {
echo " - ";
echo "<span class=\"admin\" onclick=\"channel(6)\">Admin</span>";
echo " - ";
echo "<span class=\"mod\" onclick=\"channel(7)\">Mod</span>";
}
if ($user_id == "1") {
echo " - ";
echo "<span class=\"server\" onclick=\"channel(8)\">Server</span>";
}
if ($user_id == "2") {
echo " - ";
echo "<span class=\"server\" onclick=\"channel(8)\">Server</span>";
}
if ($access_type == "50") {
echo " - ";
echo "<span class=\"mod\" onclick=\"channel(7)\">Mod</span>";
}
if ($access_type == "99") {
echo " - ";
echo "<span class=\"server\" onclick=\"channel(8)\">Server</span>";
}
if ($access_type == "100") {
echo " - ";
echo "<span class=\"StaffChat\" onclick=\"channel(9)\">Staff</span>";
}
if ($access_type == "50") {
echo " - ";
echo "<span class=\"StaffChat\" onclick=\"channel(9)\">Staff Chat</span>";
}
echo " - ";
echo "<a class=\"world\" target=\"_blank\" href=\"manual/commands\">Commands</a>";
echo " - ";
echo "<a class=\"world\" target=\"_blank\" href=\"manual/chathistory\">History</a>";
?>
</center>
</span>	   
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="chatinput">
														<input type="text" id="chatmsg" class="chatmsg" onkeyup="Tie.filterChat(event.keyCode);" maxlength="255" />
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<script type="text/javascript" language="javascript">
				//<![CDATA[

				function renderTime() {

					var currentTime = new Date();
					var h = currentTime.getUTCHours();
					var m = currentTime.getUTCMinutes();
					var s = currentTime.getUTCSeconds();
					if (h < 10) {
						h = "0" + h;
					}

					if (m < 10) {
						m = "0" + m;
					}
					if (s < 10) {
						s = "0" + s;
					}
					var myClock = document.getElementById('clockDisplay');
					myClock.textContent = h + ":" + m + ":" + s;
					myClock.innerText = h + ":" + m + ":" + s;
					setTimeout('renderTime()', 1000);
				}
				renderTime();

				$('#clickme2').click(function() {
					$('#inventory_popup').fadeIn('slow', function() {
						inventory(1);
					});
				});
				//]]>
				
			</script>
			<script type="text/javascript">
				//<![CDATA[
				var cref;
				var ctiming = 6000;

				Tie.writeChat = function() {
					var msg = Tie.enc(Tie.id("chatmsg").value);
					var c = Tie.id("change").innerHTML;

					if (msg != "") {
						Tie.request("write.php", "msg: " + msg + ", c: " + c);
						Tie.id("chatmsg").value = "";
					}
				}

				Tie.updateChat = function() {
					clearTimeout(cref);
					Tie.request("chat.php");
					cref = setTimeout(function() {
						Tie.updateChat();
					}, ctiming);
				}

				Tie.chatLog = function(msg) {
					Tie.id("chatlog").innerHTML = Tie.id("chatlog").innerHTML + msg;
					Tie.scrollChat();
				}

				Tie.filterChat = function(key) {
					if (key == 13) { // Sending chat
						Tie.writeChat();
					}
				}

				Tie.scrollChat = function() {
					var objDiv = Tie.id("chatlog");
					objDiv.scrollTop = objDiv.scrollHeight;
				}


				Tie.updateChat();
				//]]>
				
			</script>
		</body>
	
	</html>