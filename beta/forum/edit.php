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
	$post_id = $_GET['p'];

	//$get_topic_info and $get_sub_forum_info had to be renamed because of clashes with the $select_X_info variables in page.php
	$get_topic_info = mysqli_query($link, "SELECT * FROM `posts` WHERE `id` = " . $_GET['p']);
	$topic = mysqli_fetch_assoc($get_topic_info);
	$_GET['t'] = $topic['topic_id'];

	$get_sub_forum_id = mysqli_query($link,
		"SELECT `sub_forum_id` FROM `topics` WHERE `id` = " . $_GET['t']);
	$sub_forum = mysqli_fetch_assoc($get_sub_forum_id);
	$_GET['f'] = $sub_forum['sub_forum_id'];

	include ("page.php");
	if($_SESSION['access_level'] == ADMIN_LEVEL || $_SESSION['access_level'] ==
		FORUM_ADMIN_LEVEL || $_SESSION['access_level'] == MOD_LEVEL || $_SESSION['access_level'] ==
		FORUM_MOD_LEVEL || $_SESSION['user_id'] == $topic['user_id']) {
		if(isset($_POST['edit_reply'])) {
			$content = trim(addslashes(strip_tags(nl2br(toHTML($_POST['content'])),
				"<b><u><i><blockquote>")));
			$user_id = $_SESSION['user_id'];
			$time = date("Y-m-d H:i:s");
			if($content != "") {
				if(mysqli_query($link, "UPDATE `posts` SET `content` = \"" . $content . "\", `editor_id` = \"" .
					$user_id . "\", `edit_time` = \"" . $time . "\" WHERE `id` = " . $topic['id'])) {
					header("Refresh: 0; url=\"index.php?f=" . $_GET['f'] . "&t=" . $_GET['t'] . "\"");
				} else {
					$error = "The post could not be edited at this time. Reason: " . mysqli_error($link);
				}
			}else {
			 $error = "You can't have a post with no content";
			}
		}
	} else {
		$error = "You do not have permission to edit this post.";
	}
	if(isset($error)) {
		echo "<div class=\"error\">" . $error . "</div>";
		die();
	}
?>
        <table class="entry-inside">
            <form action="<?php

	echo "edit.php?p=" . $_GET['p'];
?>" method="post">
                <tr>
                    <td>
                    <textarea class="input" name="content"><?php

	echo str_replace("<br />", "\n", stripslashes(toBBCode($topic['content'])));
?></textarea></td>
                </tr>

                <tr>
                    <td><input class="button" type="submit" name="edit_reply" value="Post Reply" /></td>
                </tr>
            </form>
        </table>
    </div>
<?php

}
ob_flush();
?>
</body>
</html>