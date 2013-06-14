<?php

ob_start();

/**
 * @author Alasdair Ross
 * @copyright 2013
 */

include ("dbconnect.php");

session_start();

if(isset($_SESSION['user_id'])) {
	include ("page.php");

	if(isset($error)) {
		echo "<div class=\"error\">" . $error . "</div>";
	} else {
		if(isset($_GET['t']) && $_GET['t'] != "") {
			if($select_posts = mysqli_query($link,
				"SELECT * FROM `posts` WHERE `topic_id` =" . $_GET['t'] .
				" ORDER BY `post_time` ASC")) {

				//if($access[$forum['forum_id']] == 1) {
				$select_status = mysqli_query($link, "SELECT `status` FROM `topics` WHERE `id`=" .
					$topic_id);
				$topic = mysqli_fetch_assoc($select_status);
				while ($posts = mysqli_fetch_assoc($select_posts)) {
					$get_username = mysqli_query($link,
						"SELECT `username` FROM `users` WHERE `user_id`=" . $posts['user_id']);
					$username = mysqli_fetch_assoc($get_username);
					$check_guild = mysqli_query($link,
						"SELECT `guild_id` FROM `guild_members` WHERE `userid`=" . $posts['user_id']) or
						die(mysqli_error($link));
					if(mysqli_num_rows($check_guild) > 0) {
						$guild = mysqli_fetch_assoc($check_guild);
						$get_tag = mysqli_query($link, "SELECT `tag` FROM `guilds` WHERE `id`=" . $guild['guild_id']);
						$tag = mysqli_fetch_assoc($get_tag);
					} else {
						$tag = "";
					}
					$select_perks = mysqli_query($link,
						"SELECT `forum_avatar`, `active_avatar`, `forum_signature` FROM `perks` WHERE `userid`=" .
						$posts['user_id']);
					$perks = mysqli_fetch_assoc($select_perks);

					echo "<table class=\"entry-inside\">";
					echo "<tr>";
					echo "    <td class=\"playerinfo\">";
					echo "        <table>";
					echo "            <tr>";
					echo "                <td class=\"playername\">" . $username['username'];

					if(isset($tag) && $tag != "") {
						echo " [" . $tag['tag'] . "]</td>";
					} else {
						echo "</td>";
					}

					echo "            </tr>";

					if($perks['forum_avatar'] != "" && $perks['active_avatar'] == 1) {
						echo "<tr><td><img src=\"../player/avatar/" . $perks['forum_avatar'] . "\" width=\"125px\" height=\"125px\" /></td></tr>";
					}

					if($_SESSION['access_level'] == ADMIN_LEVEL || $_SESSION['access_level'] ==
						FORUM_ADMIN_LEVEL || $_SESSION['user_id'] == $posts['user_id']) {
						echo "        <tr>";
						echo "            <td colspan=\"2\"><a class=\"playercom\" href=\"edit.php?p=" .
							$posts['id'] . "\">[Edit]</a></br><a class = \"playercom\" href=\"remove.php?p=" .
							$posts['id'] . "\">";

						if($posts['start'] == 1) {
							echo "                [Delete Thread]</a></td>";
							echo "            </tr>";
							if($topic['status'] == OPEN) {
								echo "            <tr>";
								echo "                <td colspan=\"2\"><a class=\"admincom\" href=\"lock.php?f=" .
									$sub_forum_id . "&t=" . $topic_id . "\">[Lock Thread]</a></td>";
								echo "            </tr>";
							} else {
								echo "            <tr>";
								echo "                <td colspan=\"2\"><a class=\"admincom\" href=\"lock.php?f=" .
									$sub_forum_id . "&t=" . $topic_id . "\">[Unlock Thread]</a></td>";
								echo "            </tr>";
							}
						} else {
							echo "                [Delete]</a></td>";
							echo "            </tr>";
						}
					} elseif($_SESSION['access_level'] == MOD_LEVEL || $_SESSION['access_level'] ==
					FORUM_MOD_LEVEL) {
						echo "            <tr>";
						echo "                <td colspan=\"2\"><a class=\"playercom\" href=\"edit.php?p=" .
							$posts['id'] . "\">[Edit]</a>";
						echo "                </td>";
						echo "            </tr>";
						if($posts['start'] == 1) {
							if($topic['status'] == OPEN) {
								echo "            <tr>";
								echo "                <td colspan=\"2\"><a class=\"admincom\" href=\"lock.php?f=" .
									$sub_forum_id . "&t=" . $topic_id . "\">[Lock Thread]</a></td>";
								echo "            </tr>";
							} else {
								echo "            <tr>";
								echo "                <td colspan=\"2\"><a class=\"admincom\" href=\"lock.php?f=" .
									$sub_forum_id . "&t=" . $topic_id . "\">[Unlock Thread]</a></td>";
								echo "            </tr>";
							}
						}
					}
					echo "        </table>";
					echo "    </td>";

					echo "    <td class=\"playersubmission\">";
					echo "        <div class=\"playeractions\">";
					if($posts['start'] == 1 && $topic['status'] == OPEN) {
						echo "            <a class=\"actions\" href=\"reply.php?f=" . $sub_forum_id .
							"&t=" . $topic_id . "\">[Reply]</a>";

					}
					echo "             <a class=\"actions\" href=\"reply.php?f=" . $sub_forum_id .
						"&t=" . $topic_id . "&q=" . $posts['id'] . "\">[Quote]</a>";
					echo "        </div>";
					echo "        <br />";
					echo nl2br(stripslashes($posts['content']));
					echo "        <br />";
					echo "        <div class=\"posttime\">";

					if(!is_null($posts['editor_id'])) {
						$editor = mysqli_fetch_assoc(mysqli_query($link,
							"SELECT `username` FROM `users` WHERE `user_id` = " . $posts['editor_id']));
						echo $posts['post_time'] . " <i>(Last Edited By: " . $editor['username'] .
							" on " . $posts['edit_time'] . ")</i></span>";
					} else {
						echo $posts['post_time'];
					}
					echo "        </div>";

					if($perks['forum_signature'] != "") {
						echo "<br /><hr width=\"100%\" class=\"hrline\" />" . $perks['forum_signature'];
					}
					echo "    </td>";
					echo "</tr>";
				}
			}
			//}
		}
?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <?php

	}
} else {
	echo "<div style=\" color:#ff0000;\">You are not logged in</div>";
}
ob_flush();
?>
</body>
</html>