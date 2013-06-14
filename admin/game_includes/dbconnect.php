<?php
$link = mysqli_connect("localhost", "falloutc_Kebb", "7IuBW61VEh2", "falloutc_newdb");
if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
define("ADMIN_LEVEL", 100);
define("MOD_LEVEL", 50);
define("USER_LEVEL", 0);
define("CHAT_MOD_LEVEL", 1);
define("FORUM_ADMIN_LEVEL", 2);
define("FORUM_MOD_LEVEL", 3);
define("GUILD_FORUM_ADMIN_LEVEL", 4);
define("GUILD_FORUM_MOD_LEVEL", 5);

define("OPEN", 1);
define("LOCKED", 0);

define("FIRST_POST", 1);
define("LAST_POST", 1);

function toBBCode($data) {
	$data = str_replace(array(
		'<b>',
		'</b>',
		'<u>',
		'</u>',
		'<i>',
		'</i>',
		'<blockquote>',
		'</blockquote>'), array(
		'[b]',
		'[/b]',
		'[u]',
		'[/u]',
		'[i]',
		'[/i]',
		'[quote]',
		'[/quote]'), $data);
	return $data;
}

function toHTML($data) {
	$data = str_replace(array(
		'[b]',
		'[/b]',
		'[u]',
		'[/u]',
		'[i]',
		'[/i]',
		'[quote]',
		'[/quote]'), array(
		'<b>',
		'</b>',
		'<u>',
		'</u>',
		'<i>',
		'</i>',
		'<blockquote>',
		'</blockquote>'), $data);
	return $data;
}
?>