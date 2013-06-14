<?php

ob_start();
session_start();

/**
 * @author Alasdair Ross
 * @copyright 2013
 */

if(isset($_GET['f'])) {
	$sub_forum_id = $_GET['f'];
	if($_GET['f'] != "") {

		if(mysqli_num_rows(mysqli_query($link,
			"SELECT * FROM `sub_forums` WHERE `id` = " . $sub_forum_id)) == 0) {
			$error = "The requested forum category does not exist";
			$valid_sub_forum = false;
		} else {
			if(isset($_GET['t'])) {
				$topic_id = $_GET['t'];
				if($_GET['t'] != "") {
					if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `topics` WHERE `id` = " .
						$topic_id)) == 0) {
						$error = "The requested topic does not exist";
						$valid_topic = false;
					} else {
						$valid_topic = true;
					}
				} else {
					header("Refresh: 0; url=\"index.php?f=" . $_GET['f'] . "\"");
				}
			}
			$valid_sub_forum = true;
		}
	} else {
		header("Refresh: 0; url=\"index.php\"");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
    <title>Fallout Chronicle Forum</title>
    <link rel="stylesheet" type="text/css" href="fo-slim.css" />
    <link rel="shortcut icon" href="favicon.png" />
</head>

<body>
    <table class="out-table">
        <tr>
            <td rowspan="6" class="side-menu">
                <table class="side-header">
                    <?php

$select_forums = mysqli_query($link, "SELECT * FROM `forums` ORDER BY `id` ASC");

while ($forums = mysqli_fetch_array($select_forums)) {
	if($_SESSION['access_level'] >= $forums['access_level']) {
		$access[$forums['id']] = 1;
		echo "<tr>";
		echo "    <td class=\"category-header\">" . $forums['name'] . "</td>";
		echo "</tr>";


		$select_sub_forums = mysqli_query($link,
			"SELECT `id`, `name` FROM `sub_forums` WHERE `forum_id` = " . $forums['id']);

		while ($sub_forums = mysqli_fetch_array($select_sub_forums)) {
			echo "<tr>";
			echo "    <td class=\"sub-category-header\"><a class=\"flink\" href=\"index.php?f=" .
				$sub_forums['id'] . "\">" . $sub_forums['name'] . "</a></td>";
			echo "</tr>";
		}
	} else {
		$access[$forums['id']] = 0;
	}
}
?>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <div class="topic-container">
                    <table class="link-spacing">
                        <tr>
                            <td class="TitlePost-TitleBorder-header">Title</td>

                            <td class="TitleBorder-header">Created By</td>

                            <td class="TitleBorder-header">Last Post By</td>

                            <td class="TitleBorder-header">Last Updated</td>
                        </tr>
                        <?php

if($valid_sub_forum) {
	$select_forum = mysqli_query($link,
		"SELECT `forum_id` FROM `sub_forums` WHERE `id`=" . $_GET['f']);
	if(mysqli_num_rows($select_forum) > 0) {
		$forum = mysqli_fetch_assoc($select_forum);

		if($access[$forum['forum_id']] == 1) {
			if(isset($valid_sub_forum)) {
				if($valid_sub_forum && $_GET['f'] != "") {
					$select_topics = mysqli_query($link,
						"SELECT * FROM `topics` WHERE `sub_forum_id` = " . $sub_forum_id .
						" ORDER BY `update_time` DESC");

					while ($topics = mysqli_fetch_assoc($select_topics)) {
						$get_creator = mysqli_query($link,
							"SELECT `username` FROM `users` WHERE `user_id`=" . $topics['user_id']);
						$creator = mysqli_fetch_assoc($get_creator);

						$get_last_poster = mysqli_query($link,
							"SELECT `username` FROM `users` WHERE `user_id`=" . $topics['last_poster']);
						$last_poster = mysqli_fetch_assoc($get_last_poster);
						echo "<tr>";
						echo "    <td class=\"TitlePost-TitleBorder\"><a class=\"flink\" href=\"index.php?f=" .
							$sub_forum_id . "&t=" . $topics['id'] . "\">";
						if($topics['status'] == LOCKED) {
							echo "[Locked] " . stripslashes($topics['title']);
						} else {
							echo stripslashes($topics['title']);
						}

						echo "</a></td>";
						echo "    <td class=\"topicpost\">" . $creator['username'] . "</td>";
						echo "    <td class=\"topicpost\">" . $last_poster['username'] . "</td>";
						echo "    <td class=\"topicpost\">" . $topics['update_time'] . "</td>";
						echo "</tr>";
					}
				}
			}
		} else {
			$error = "You do not have permission to be here";
		}
	}
}
?>
                    </table>
                </div>
            </td>
        </tr>

        <tr>
            <td class="top-links">
                <table class="link-spacing">
                    <tr>
                        <td><a class="nav-links" href="index.php">Forum</a>
                        <?php

if($access[$forum['forum_id']] == 1) {
	if(isset($valid_sub_forum)) {
		if($valid_sub_forum) {
			$select_sub_forum_info = mysqli_query($link,
				"SELECT * FROM `sub_forums` WHERE `id`=" . $_GET['f']);
			if($sub_forum_info = mysqli_fetch_assoc($select_sub_forum_info)) {
				echo " &gt; <a class=\"nav-links\" href=\"index.php?f=" . $sub_forum_id . "\">" .
					$sub_forum_info['name'] . "</a>";
				if(isset($valid_topic)) {
					if($valid_topic) {
						$select_topic_info = mysqli_query($link, "SELECT * FROM `topics` WHERE `id`=" .
							$_GET['t']);
						if($topic_info = mysqli_fetch_assoc($select_topic_info)) {
							echo " &gt; <a class=\"nav-links\" href=\"index.php?f=" . $sub_forum_id . "&t=" .
								$topic_info['id'] . "\">" . stripslashes($topic_info['title']) . "</a>";
						}
					}
				}
			}
		}
?>
                        </td>

                        <td><a class="flink" href="newtopic.php?f=<?php

		echo $sub_forum_id;
?>">Create a Topic</a></td>
                        <?php

	}
}
?>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <div class="entry-container">
                    <?php
ob_flush();
?>