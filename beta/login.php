<?php

session_start();
include 'mysql.php';
include 'core/init.php';


if(empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password in to continue.';
	} elseif(user_exists($username) === false) {
		$errors[] = 'We can\'t find that username. Have you registered?';
	} elseif(user_active($username) === false) {
		$errors[] = 'You haven\'t activated your account!';
	} elseif(banned($username) == 1) {
		$errors[] = 'You may not log in, we are down for maintenance. Please try back later.';
	} else {
		$login = login($username, $password);
		if($login === false) {
			$errors[] = 'That username/password combination is incorrect!';
		} else {
			if($login <= USER_LIMIT) {
				$_SESSION['user_id'] = $login;
				$_SESSION['username'] = $username;
				$_SESSION['access_level'] = mysql_result(mysql_query("SELECT `access_level` FROM `users` WHERE `user_id` = " .
					$_SESSION['user_id']), 0, 'access_level');
                    $_SESSION['admin_mode'] = 0;
				$check_login = mysql_query("SELECT `custom_login` FROM `perks` WHERE `userid`=" .
					$login);
				$custom_login = mysql_fetch_assoc($check_login);
				if($custom_login['custom_login'] == null) {
					mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
    VALUES ('" . $_SESSION['user_id'] . "', 'has logged in.', 'Login', '" . time
						() . "', 'All')");
				} else {
					mysql_query("INSERT INTO `chat` (`userid`, `message`, `channel`, `posttime`, `to`)
    VALUES ('" . $_SESSION['user_id'] . "', '" . $custom_login['custom_login'] .
						"', 'Login', '" . time() . "', 'All')");
				}
				header('Location: game.php'); // redirect user to game page
				mysql_query("UPDATE `users` SET `logged_in` = 1 WHERE `user_id` = " . $_SESSION['user_id']);
				exit();
			} else {
				$errors[] = "You are currently waiting on the dropship to Halloran, once we confirm there is a safe place to land we will let you join in on the story but you are currently still in the queue.";
			}
		}
	}
}

include 'includes/overall/header.php';
if(empty($errors) === false) {
?>
            <h2>We tried to log you in, but our evil chicken is saying...</h2>
    <?php

	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>