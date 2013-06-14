<?php

ob_start();

/**
 * @author Alasdair Ross
 * @copyright 2013
 * @todo include quote functionality, quoted posts's id passed in used get['p'] 
 */

include ("dbconnect.php");

session_start();

if(!isset($_GET) || !isset($_SESSION['user_id'])) {
	echo "You should not be here!";
	header("Refresh: 1; url=\"index.php\"");
} else {
	include ("page.php");

	$valid_post = false;
	if(isset($_GET['q']) && $_GET['q'] != "") {
		$select_post = mysqli_query($link, "SELECT * FROM `posts` WHERE `id` = " . $_GET['q']);
		if(mysqli_num_rows($select_post) > 0) {
			$valid_post = true;
			$post = mysqli_fetch_assoc($select_post);
			$select_user = mysqli_query($link,
				"SELECT `username` FROM `users` WHERE `user_id` = " . $post['user_id']);
			$user = mysqli_fetch_assoc($select_user);
			$content = "[quote] \n Posted on " . $post['post_time'] . " by " . $user['username'] .
				"\n " . $post['content'] . "[/quote]\n";
		} else {
			$error = "The post your are trying to quote does not exist";
		}
	}

	if(isset($_POST['submit_reply'])) {
		$content = trim(addslashes(strip_tags(nl2br(toHTML($_POST['content'])),
			"<b><u><i><blockquote>")));
		$user_id = $_SESSION['user_id'];
		$time = date("Y-m-d H:i:s");

		$select_sub_forum_info = mysqli_query($link,
			"SELECT `sub_forum_id`, `title` FROM `topics` WHERE `id`=" . $topic_id);
		$sub_forum_info = mysqli_fetch_assoc($select_sub_forum_info);
		$select_sub_forum_name = mysqli_query($link,
			"SELECT `name`, `forum_id` FROM `sub_forums` WHERE `id`=" . $sub_forum_info['sub_forum_id']);
		$sub_forum_name = mysqli_fetch_assoc($select_sub_forum_name);

		$select_forum_name = mysqli_query($link,
			"SELECT `name` FROM `forums` WHERE `id`=" . $sub_forum_name['forum_id']);
		$forum_name = mysqli_fetch_assoc($select_forum_name);
        
		$insert_post = "INSERT INTO `posts` (`topic_id`, `user_id`, `content`, `post_time`) VALUES (" .
			$topic_id . ", " . $user_id . ", \"" . $content . "\", \"" . $time . "\")";
		if($content != "") {
			if(mysqli_query($link, $insert_post)) {
				if($sub_forum_name['forum_id'] == "4") {
					mysqli_query($link, "INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`) VALUES ('" .
						$user_id . "', 'has replied to a topic: <a class=\"chatlink\" href=\"http://www.falloutchronicle.com/forum/index.php?f=" .
						$sub_forum_info['sub_forum_id'] . "&t=" . $topic_id . "\" target=\"_blank\">" . mysqli_real_escape_string($link, $forum_name['name']) .
						" &gt; " . mysqli_real_escape_string($link, $sub_forum_name['name']) . " &gt; " . mysqli_real_escape_string($link, $sub_forum_info['title']) .
						" </a>', 'Staff Forum', '" . time() . "', 'All')");
				} else {
					mysqli_query($link, "INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`) VALUES ('" .
						$user_id . "', 'has replied to a topic: <a class=\"chatlink\" href=\"http://www.falloutchronicle.com/forum/index.php?f=" .
						$sub_forum_info['sub_forum_id'] . "&t=" . $topic_id . "\" target=\"_blank\">" . mysqli_real_escape_string($link, $forum_name['name']) .
						" &gt; " . mysqli_real_escape_string($link, $sub_forum_name['name']) . " &gt; " . mysqli_real_escape_string($link, $sub_forum_info['title']) . " </a>', 'Forum', '" .
						time() . "', 'All')");
				}

				$update_topics = "UPDATE `topics` SET `last_poster`=" . $user_id .
					", `update_time` = \"" . $time . "\" WHERE `id` = " . $topic_id;
				if(mysqli_query($link, $update_topics)) {
					header("Refresh:0 url=\"index.php?f=" . $sub_forum_info['sub_forum_id'] . "&t=" .
						$topic_id . "\"");
				} else {
					$error = "Your reply was added but the topic info could not be changed. Reason: " .
						mysqli_error($link);
				}
			} else {
				$error = "Your reply could not be added to the table at this time. Reason: " .
					mysqli_error($link);
			}
		} else {
			$error = "You can't have a post with no content";
		}
	}
	if(isset($error)) {
		echo "<div class=\"error\">" . $error . "</div>";
	}
?>
        <table class="entry-inside">
            <form action="<?php

	echo "reply.php?f=" . $_GET['f'] . "&t=" . $_GET['t'];
?>" method="post">
                <tr>
                    <td>
                    <textarea class="input" name="content"><?php

	if(isset($error) && isset($content)) {
		echo stripslashes(toBBCode($content));
	}
?></textarea></td>
                </tr>

                <tr>
                    <td><input class="button" type="submit" name="submit_reply" value="Post Reply" /></td>
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