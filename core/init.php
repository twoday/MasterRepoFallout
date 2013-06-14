<?php
session_start();

require_once 'database/connect.php';
require_once 'functions/users.php';

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);


if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'alias', 'password', 'first_name', 'last_name', 'email', 'join_date', 'password_recover', 'type');
	if (user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit();
	}
	if ($current_file !== 'changepassword.php' && $current_file !== 'logout.php' && $user_data['password_recover'] == 1) {
		header('Location: changepassword.php?force');
		exit();
	}
 }
 
$errors = array();

?>
