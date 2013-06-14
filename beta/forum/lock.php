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

	$select_topic_info = mysqli_query($link, "SELECT * FROM `topics` WHERE `id` = " .
		$_GET['t']);
	if($row = mysqli_fetch_assoc($select_topic_info)) {
		if($_SESSION['user_id'] == $row['user_id'] || $_SESSION['access_level'] ==
			ADMIN_LEVEL || $_SESSION['access_level'] == MOD_LEVEL || $_SESSION['access_level'] ==
			FORUM_ADMIN_LEVEL || $_SESSION['access_level'] == FORUM_MOD_LEVEL) {
			if($row['status'] == OPEN) {
				$lock_topic = "UPDATE `topics` SET `status` = " . LOCKED . " WHERE `id` = " . $_GET['t'];
				if(mysqli_query($link, $lock_topic)) {
					header("Refresh: 0; url=\"" . $_SERVER["HTTP_REFERER"] . "\"");
				} else {
					$error = "There was a problem locking the thread. Error: " . mysqli_error($link);
				}
			} else {
				$unlock_topic = "UPDATE `topics` SET `status` = " . OPEN . " WHERE `id` = " . $_GET['t'];
				if(mysqli_query($link, $unlock_topic)) {
					header("Refresh: 0; url=\"" . $_SERVER["HTTP_REFERER"] . "\"");
				} else {
					$error = "There was a problem unlocking the thread. Error: " . mysqli_error($link);
				}
			}
		} else {
			$error = "You do not have permission to lock this topic.";
			header("Refresh: 1; url=\"index.php?f=" . $row['sub_forum_id'] . "&t=" . $_GET['t'] .
				"\"");
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