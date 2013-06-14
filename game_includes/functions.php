<?php

function hasDonated($userid) {
	/* Do a query to see if they have donated, if not return false */

	return true; // Only since I dont know your donation table.
}

function chatEmote($msg, $userid) {

	$extra_emotes = hasDonated($userid); // Donation emotes

	if($user_id < 3 && $msg == "/adminmode") {
		$_SESSION['admin_mode'] = 1;
	}
	// Normal Emotes for all //
	$msg = str_replace(":)",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/HappyEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace("B)",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/GlassesEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":S",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/ConfuseEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":o",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/OhEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":|",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/StraightFaceEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":(",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/SaddenEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":D",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/SurprisedEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":)",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/HappyEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":P",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/TongueEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":@",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/MadEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace("D:",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/ShockedEmote.gif 'width='16px' height='16px'>", $msg);
	$msg = str_replace("XD",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/SquintEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(";)",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/WinkEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":no:",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/NoEmote.gif 'width='16px' height='16px'>", $msg);
	$msg = str_replace(":%",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/SickEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":yes:",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/YesEmote.gif' width='16px' height='16px'>", $msg);
       $msg = str_replace(":wave:",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/waves.gif' width='16px' height='16px'>", $msg);
        $msg = str_replace(":woot:",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/woot.gif' width='24px' height='16px'>", $msg);
       $msg = str_replace(":pumpkin:",
		"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/pumpkin-h.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace("@vote",
		"<a href='manual/vote' target='_blank' style='text-decoration:none;color:#2276f4'>@vote</a>",
		$msg);
	$msg = str_replace("/random",
		"<a href='random' target='_blank' style='text-decoration:none;color:#2276f4'>/random</a>",
		$msg);
	$msg = str_replace("/player",
		"<a href='player' target='_blank' style='text-decoration:none;color:#2276f4'>/player</a>",
		$msg);
	$msg = str_ireplace("/falionra",
		"<a href='manual/locations/location.php?id=1' target='_blank' style='text-decoration:none;color:#2276f4'>Falionra</a>",
		$msg);
	$msg = str_ireplace("/astelio",
		"<a href='manual/locations/location.php?id=2' target='_blank' style='text-decoration:none;color:#2276f4'>Astelio</a>",
		$msg);
	$msg = str_ireplace("/ivory city",
		"<a href='manual/locations/location.php?id=3' target='_blank' style='text-decoration:none;color:#2276f4'>Ivory City</a>",
		$msg);
	$msg = str_ireplace("/kamellot",
		"<a href='manual/locations/location.php?id=4' target='_blank' style='text-decoration:none;color:#2276f4'>Kammellot</a>",
		$msg);
	$msg = str_ireplace("/marintiqua",
		"<a href='manual/locations/location.php?id=5' target='_blank' style='text-decoration:none;color:#2276f4'>Marintiqua</a>",
		$msg);
	$msg = str_ireplace("/verne peninsula",
		"<a href='manual/locations/location.php?id=6' target='_blank' style='text-decoration:none;color:#2276f4'>Verne Peninsula</a>",
		$msg);
	$msg = str_ireplace("/domecelle",
		"<a href='manual/locations/location.php?id=7' target='_blank' style='text-decoration:none;color:#2276f4'>Domecelle</a>",
		$msg);
	$msg = str_ireplace("/maqueda",
		"<a href='manual/locations/location.php?id=8' target='_blank' style='text-decoration:none;color:#2276f4'>Maqueda</a>",
		$msg);
	$msg = str_ireplace("/carratraca",
		"<a href='manual/locations/location.php?id=9' target='_blank' style='text-decoration:none;color:#2276f4'>Carratraca</a>",
		$msg);

	$msg = str_ireplace("/frigiliana",
		"<a href='manual/locations/location.php?id=10' target='_blank' style='text-decoration:none;color:#2276f4'>Frigiliana</a>",
		$msg);

	$msg = str_ireplace("/benadalid",
		"<a href='manual/locations/location.php?id=11' target='_blank' style='text-decoration:none;color:#2276f4'>Benadalid</a>",
		$msg);

	$msg = str_ireplace("/st penwith pier",
		"<a href='manual/locations/location.php?id=12' target='_blank' style='text-decoration:none;color:#2276f4'>St Penwith Pier</a>",
		$msg);

	$msg = str_ireplace("/ammesbury",
		"<a href='manual/locations/location.php?id=13' target='_blank' style='text-decoration:none;color:#2276f4'>Ammesbury</a>",
		$msg);

	$msg = str_ireplace("/finchley",
		"<a href='manual/locations/location.php?id=14' target='_blank' style='text-decoration:none;color:#2276f4'>Finchley</a>",
		$msg);
	$msg = str_ireplace("/beckenham",
		"<a href='manual/locations/location.php?id=15' target='_blank' style='text-decoration:none;color:#2276f4'>Beckenham</a>",
		$msg);

	$msg = str_ireplace("/loscoe",
		"<a href='manual/locations/location.php?id=16' target='_blank' style='text-decoration:none;color:#2276f4'>Loscoe</a>",
		$msg);

	$msg = str_ireplace("/padstow",
		"<a href='manual/locations/location.php?id=17' target='_blank' style='text-decoration:none;color:#2276f4'>Padstow</a>",
		$msg);

	$msg = str_ireplace("/broken hill",
		"<a href='manual/locations/location.php?id=18' target='_blank' style='text-decoration:none;color:#2276f4'>Eratia Hill</a>",
		$msg);

	$msg = str_ireplace("/randwick",
		"<a href='manual/locations/location.php?id=19' target='_blank' style='text-decoration:none;color:#2276f4'>Randwick</a>",
		$msg);

	$msg = str_ireplace("/cessnock",
		"<a href='manual/locations/location.php?id=20' target='_blank' style='text-decoration:none;color:#2276f4'>Cessnock</a>",
		$msg);

	$msg = str_ireplace("/cantebury",
		"<a href='manual/locations/location.php?id=21' target='_blank' style='text-decoration:none;color:#2276f4'>Cantebury</a>",
		$msg);

	$msg = str_ireplace("/willoughby",
		"<a href='manual/locations/location.php?id=22' target='_blank' style='text-decoration:none;color:#2276f4'>Willoughby</a>",
		$msg);

	$msg = str_ireplace("/lithgow",
		"<a href='manual/locations/location.php?id=23' target='_blank' style='text-decoration:none;color:#2276f4'>Lithgow</a>",
		$msg);


	/* Donated Emotes */
	if($extra_emotes == true) {

		$msg = str_replace(":boy:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/BoyEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":fish:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/FishEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":girl:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/GirlEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":jump:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/JumpEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":rise:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/SunriseEmote-D.gif' width='16px' height='16px'>",
			$msg);
		$msg = str_replace(":set:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/SunsetEmote-D.gif' width='16px' height='16px'>",
			$msg);
		$msg = str_replace(":pumpkin:",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/pumpkin-h.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace("[cloon]",
			"<img src='http://" . $_SERVER['HTTP_HOST'] . "/manual/img/Emoticons/clooney.png' width='16px' height='16px'>", $msg);
	}
	return $msg;
}

function isMuted($userid) {
	$query = mysql_query("SELECT `length`, `date` FROM `punishments` WHERE `player`=" .
		$userid . " AND `type`=\"Mute\" OR `type`=\"Time Out\"");
	if(mysql_num_rows($query) > 0) {
		$row = mysql_fetch_assoc($query);
		if(time() < ($row['date'] + ($row['length'] * 60))) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function auto_link_text($text) {
	$pattern = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
	return preg_replace_callback($pattern, 'auto_link_text_callback', $text);
}

function auto_link_text_callback($matches) {
	$url_full = $matches[0];
	$url_short = '';

	$parts = parse_url($url_full);
	$url_short = preg_replace('/^www\./', '', $parts['host']);
	$url_bits = explode(".", $url_short);
	$url_name = ucfirst($url_bits[0]);

	return "<a class=\"chatlink\" href=\"$url_full\" target=\"_blank\">[$url_name]</a>";
}

function sanitize($text) {
	$curses = array(
		'/\bbitch\b/i',
		'/\bfuck\b/i',
		'/\bcunt\b/i',
		'/\basshole\b/i',
		'/\bdumbfuck\b/i',
		'/\bpussy\b/i',
		'/\bpoon\b/i',
		'/\bpoontang\b/i',
		'/\bprozzie\b/i',
		'/\bprostitute\b/i',
		'/\bskank\b/i',
		'/\bslut\b/i',
		'/\bnigger\b/i',
		'/\bnigra\b/i',
		'/\bnigga\b/i',
		'/\bniggah\b/i',
		'/\bnigguh\b/i',
		'/\bniglet\b/i',
		'/\bporchmonkey\b/i',
		'/\bporch monkey\b/i',
		'/\bspook\b/i',
		'/\bchink\b/i',
		'/\bjap\b/i',
		'/\bgook\b/i',
		'/\bnip\b/i',
		'/\bchee-chee\b/i',
		'/\bchee chee\b/i',
		'/\bcheechee\b/i',
		'/\bmuzzie\b/i',
		'/\bhonky\b/i',
		'/\bpeckerwood\b/i',
		'/\bwigger\b/i',
		'/\bspic\b/i',
		'/\byank\b/i',
		'/\bgreaseball\b/i',
		'/\basshat\b/i',
		'/\bdickhead\b/i',
		'/\bshit\b/i',
		'/\bbastard\b/i',
		'/\bfucknut\b/i',
		'/\bbellend\b/i',
		'/\bretard\b/i',
		'/\bspaz\b/i',
		'/\bdick\b/i',
		'/\bwanker\b/i',
		'/\bfuk\b/i',
		'/\bshite\b/i',
		'/\bshitter\b/i',
		'/\bcockwash\b/i',
		'/\bporn\b/i',
		'/\bnobhead\b/i',
		'/\bcum\b/i',
		'/\bknob\b/i',
		'/\bpaki\b/i',
		'/\bfag\b/i',
		'/\bfaggot\b/i',
		'/\bfagget\b/i',
		'/\bpenis\b/i',
		'/\bpenishead\b/i',
		'/\bjerk\b/i',
		'/\bjerkoff\b/i',
		'/\bjackoff\b/i',
		'/\bfucking\b/i',
		'/\bfucked\b/i',
		'/\bfucker\b/i',
		'/\bbollocks\b/i',
		'/\bmother fucker\b/i',
		'/\bcock\b/i',
		'/\btitties\b/i',
		'/\btits\b/i',
		'/\bboobies\b/i',
		'/\bboobs\b/i',
		'/\bboob\b/i',
		'/\bvagina\b/i',
		'/\bvag\b/i');

	$text = preg_replace($curses, '[censored]', $text);
	return $text;

}
function countItem($userid, $itemid) {
	$q = mysql_query("SELECT `count` FROM `inventory` WHERE `itemid` = '$itemid' AND `userid` = '$userid' LIMIT 0,1") or
		die(mysql_error());
	if(mysql_num_rows($q) == 0) {
		return 0;
	} else {
		$row = mysql_fetch_assoc($q);
		return $row['count'];
	}
}

function getItemname($itemid, $count) { // If count = 1 then return singlular, else plural
	$q = mysql_query("SELECT `name`,`plural` FROM `items` WHERE `id` = '$itemid' LIMIT 0,1") or
		die(mysql_error());
	$row = mysql_fetch_assoc($q);
	if($count == 1) {
		return $row['name'];
	} else {
		return $row['plural'];
	}
}
function remainingExp($level, $exp) {
	$c = floor((($level + 1) / 2) * pow(floor((($level + 1) * 5)), 2)) - $exp;
	if($c < 0) {
		$c = 0;
		// add code to increment level in DB
	}
	return $c;
}

function calculateLevel($exp) {
	$dev = 4.25;
	$level = floor(pow($exp, (1 / $dev)));
	if($level < 1) {
		$level = 1;
	}

	return $level;
}

function calculateNextLevel($level, $exp) {
	$dev = 4.25; // This can be changed to whatever gap you want.
	$next = round(pow(($level + 1), $dev) - $exp);
	if($next < 1) {
		$next = 1;
	}
	return $next;
}

function addtoinv($userid, $itemid, $count) {
	if(countItem($userid, $itemid) == 0) {
		mysql_query("INSERT INTO `inventory` (`userid`,`itemid`,`count`) VALUES
                                ('" . $userid . "','" . $itemid . "','" . $count .
			"')") or die(mysql_error());
	} else {
		mysql_query("UPDATE `inventory` SET `count` = `count` + '" . $count .
			"' WHERE `itemid` = '" . $itemid . "' AND `userid` = '" . $userid . "'") or die(mysql_error
			());
	}
}
?>