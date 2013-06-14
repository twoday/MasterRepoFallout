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

	if(isset($_POST['submit_topic'])) {
		$title = trim(addslashes(strip_tags($_POST['title'])));
		$content = trim(addslashes(strip_tags(nl2br(toHTML($_POST['content'])),
			"<b><u><i><blockquote>")));
		$user_id = $_SESSION['user_id'];
		$time = date("Y-m-d H:i:s");

		$check_for_copies = mysqli_query($link,
			"SELECT * FROM `topics` WHERE `sub_forum_id` = " . $sub_forum_id .
			" AND `title` = \"" . $title . "\"");
		if(mysqli_num_rows($check_for_copies) == 0) {
			if($content != "") {
				$insert_topic = "INSERT INTO `topics` (`sub_forum_id`, `user_id`, `title`, `last_poster`, `update_time`) VALUES (" .
					$sub_forum_id . ", " . $user_id . ", \"" . $title . "\", " . $user_id . ", \"" .
					$time . "\")";
				if(mysqli_query($link, $insert_topic)) {
					$select_topic_id = "SELECT `id` FROM `topics` WHERE `user_id` = \"" . $user_id .
						"\" AND `update_time` = \"" . $time . "\"";
					if($row = $row = mysqli_fetch_assoc(mysqli_query($link, $select_topic_id))) {
						$topic_id = $row['id'];
						$insert_post = "INSERT INTO `posts` (`topic_id`, `user_id`, `start`, `content`, `post_time`) VALUES (" .
							$topic_id . ", " . $user_id . ", " . FIRST_POST . ", \"" . $content . "\", \"" .
							$time . "\")";
                            
						$select_sub_forum_name = mysqli_query($link,
							"SELECT `name`, `forum_id` FROM `sub_forums` WHERE `id`=" . $sub_forum_id);
						$sub_forum_name = mysqli_fetch_assoc($select_sub_forum_name);

						$select_forum_name = mysqli_query($link,
							"SELECT `name` FROM `forums` WHERE `id`=" . $sub_forum_name['forum_id']);
						$forum_name = mysqli_fetch_assoc($select_forum_name);
                        
						if($sub_forum_name['forum_id'] == "4") {
							mysqli_query($link, "INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`) VALUES ('" .
								$user_id . "', 'has created a topic: <a class=\"chatlink\" href=\"http://www.falloutchronicle.com/forum/index.php?f=" .
								$sub_forum_id . "&t=" . $topic_id . "\" target=\"_blank\">" . $forum_name['name'] .
								" &gt; " . $sub_forum_name['name'] . " &gt; " . $title .
								" </a>', 'Staff Forum', '" . time() . "', 'All')");
						} else {
							mysqli_query($link, "INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`) VALUES ('" .
								$user_id . "', 'has created a topic: <a class=\"chatlink\" href=\"http://www.falloutchronicle.com/forum/index.php?f=" .
								$sub_forum_id . "&t=" . $topic_id . "\" target=\"_blank\">" . $forum_name['name'] .
								" &gt; " . $sub_forum_name['name'] . " &gt; " . $title . " </a>', 'Forum', '" .
								time() . "', 'All')");
						}

						if(mysqli_query($link, $insert_post)) {
							header("Refresh:0; url=\"index.php?f=" . $sub_forum_id . "&t=" . $topic_id . "\"");
						} else {
							$error = "Your topic was created but the contents of the first post could not be added. Reason: " .
								mysqli_error($link);
						}
					} else {
						$error = "Your topic could not be created at this time. Reason: " . mysqli_error($link);
					}
				} else {
					$error = "Your topic could not be created at this time. Reason: " . mysqli_error($link);
				}
			} else {
				$error = "You cannot create a new topic with no content";
			}
		} else {
			$error = "There is already a topic with that name in this category";
		}
	}
	if(isset($error)) {
		echo "<div class=\"error\">" . $error . "</div>";
	}
?>

                    <table class="entry-inside">
                        <form action="<?php

	echo "newtopic.php?f=" . $_GET['f'];
?>" method="post">
                            <tr>
                                <td>Title <input class="input" type="text" name="title" maxlength="100" <?php

	if(isset($_POST['title'])) {
		echo "value=\"" . $_POST['title'] . "\"";
	}
?> /></td>
                            </tr>

                            <tr>
                                <td>
                                <textarea class="input" name="content"><?php

	if(isset($_POST['content']) && isset($error)) {
		echo stripslashes(toBBCode($_POST['content']));
	}
?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td><input class="button" type="submit" name="submit_topic" value="Create Topic" /></td>
                            </tr>
                        </form>
                    </table>
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