<?php

ob_start();
/**
 * @author Alasdair Ross
 * @copyright 2013
 */

include ("dbconnect.php");

session_start();

if(!isset($_GET) || !isset($_SESSION['user_id'])) {
	echo "You should not be here!";
	header("Refresh: 1; url=\"index.php\"");
} else {
	include ("page.php");

	if(isset($_GET['p']) && $_GET['p'] != "") {
		$get_post_info = mysqli_query($link, "SELECT * FROM `posts` WHERE `id` = " . $_GET['p']);
		$post_info = mysqli_fetch_assoc($get_post_info);
		if(mysqli_num_rows($get_post_info) > 0) {
			if($_SESSION['user_id'] == $post_info['user_id'] || $_SESSION['access_level'] ==
				ADMIN_LEVEL || $_SESSION['access_level'] == FORUM_ADMIN_LEVEL) {
				$delete_post = "DELETE FROM `posts` WHERE `id` = " . $_GET['p'];
				if(mysqli_query($link, $delete_post)) {
					$get_sub_forum_info = mysqli_query($link,
						"SELECT `sub_forum_id`, `update_time` FROM `topics` WHERE `id` = " . $post_info['topic_id']);
					$sub_forum_info = mysqli_fetch_assoc($get_sub_forum_info);
					if($post_info['start'] == 1) {
						$delete_posts = "DELETE FROM `posts` WHERE `topic_id` = " . $post_info['topic_id'];
						if(mysqli_query($link, $delete_posts)) {
							$delete_topic = "DELETE FROM `topics` WHERE `id` = " . $post_info['topic_id'];
							if(mysqli_query($link, $delete_topic)) {
								header("Refresh: 0; url=\"index.php?f=" . $sub_forum_info['sub_forum_id'] . "\"");
							} else {
								$error = "The posts within the topic were successfully removed but the topic itself could not be deleted at this time. Reason: " .
									mysqli_error($link);
							}
						} else {
							$error = "The posts within the topic could not be deleted at this time. Reason: " .
								mysqli_error($link);
						}
					} else {

						$get_last_poster = mysqli_query($link,
							"SELECT `user_id`, `post_time` FROM `posts` WHERE `topic_id` = \"" . $post_info['topic_id'] .
							"\" ORDER BY `post_time` DESC LIMIT 0,1");
						if($last_poster = mysqli_fetch_assoc($get_last_poster)) {
							if($last_poster['post_time'] < $sub_forum_info['update_time']) {
								if(mysqli_query($link, "UPDATE `topics` SET `last_poster` = \"" . $last_poster['user_id'] .
									"\", `update_time` = \"" . $last_poster['post_time'] . "\" WHERE `id` = " . $post_info['topic_id'])) {
									header("Refresh: 0; url=\"index.php?f=" . $sub_forum_info['sub_forum_id'] .
										"&t=" . $post_info['topic_id'] . "\"");
								} else {
									$error = "The post was deleted but the last poster and update time could not be updated at this time. Reason: " .
										mysqli_error($link);
								}
							} else {
								header("Refresh: 0; url=\"index.php?f=" . $sub_forum_info['sub_forum_id'] .
									"&t=" . $post_info['topic_id'] . "\"");
							}
						} else {
							$error = "The post was deleted but the new last poster and update time could not be selected at this time. Reason: " .
								mysqli_error($link);
						}
					}
				} else {
					$error = "The post could not be deleted at this time. Reason: " . mysqli_error($link);
				}
			} else {
				$error = "You do not have permission to delete this post";
			}
		} else {
			$error = "This post does not exist";
		}
	}
	if(isset($error)) {
		echo "<div class=\"error\">" . $error . "</div>";
	}
?>

                </div>
            </td>
        </tr>
    </table>
    <?php

}
ob_flush();
?>
</body>
</html>