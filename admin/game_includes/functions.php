<?php

function hasDonated($userid) {
	/* Do a query to see if they have donated, if not return false */

	return true; // Only since I dont know your donation table.
}

function chatEmote($msg, $userid) {

	$extra_emotes = hasDonated($userid); // Donation emotes

	// Normal Emotes for all //
	$msg = str_replace(":)",
		"<img src='manual/img/Emoticons/HappyEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace("B)",
		"<img src='manual/img/Emoticons/GlassesEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":S",
		"<img src='manual/img/Emoticons/ConfuseEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":o",
		"<img src='manual/img/Emoticons/OhEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":|",
		"<img src='manual/img/Emoticons/StraightFaceEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":(",
		"<img src='manual/img/Emoticons/SaddenEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":D",
		"<img src='manual/img/Emoticons/SurprisedEmote.gif' width='16px' height='16px'>",
		$msg);
	$msg = str_replace(":)",
		"<img src='manual/img/Emoticons/HappyEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":P",
		"<img src='manual/img/Emoticons/TongueEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":@",
		"<img src='manual/img/Emoticons/MadEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace("D:",
		"<img src='manual/img/Emoticons/ShockedEmote.gif'width='16px' height='16px'>", $msg);
	$msg = str_replace("XD",
		"<img src='manual/img/Emoticons/SquintEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(";)",
		"<img src='manual/img/Emoticons/WinkEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":no:",
		"<img src='manual/img/Emoticons/NoEmote.gif'width='16px' height='16px'>", $msg);
	$msg = str_replace(":%",
		"<img src='manual/img/Emoticons/SickEmote.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace(":yes:",
		"<img src='manual/img/Emoticons/YesEmote.gif' width='16px' height='16px'>", $msg);
       $msg = str_replace(":coffee:",
		"<img src='manual/img/Emoticons/coffee.gif' width='16px' height='16px'>", $msg);
	$msg = str_replace("@vote",
		"<a href='manual/vote' target='_blank' style='text-decoration:none;color:#2276f4'>@vote</a>",
		$msg);
	$msg = str_replace("/random",
		"<a href='random' target='_blank' style='text-decoration:none;color:#2276f4'>/random</a>",
		$msg);
	$msg = str_replace("/player",
		"<a href='player' target='_blank' style='text-decoration:none;color:#2276f4'>/player</a>",
		$msg);
	$msg = str_replace("/falionra",
		"<a href='manual/locations/location.php?id=1' target='_blank' style='text-decoration:none;color:#2276f4'>Falionra</a>",
		$msg);
	$msg = str_replace("/astelio",
		"<a href='manual/locations/location.php?id=2' target='_blank' style='text-decoration:none;color:#2276f4'>Astelio</a>",
		$msg);
	$msg = str_replace("/ivory city",
		"<a href='manual/locations/location.php?id=3' target='_blank' style='text-decoration:none;color:#2276f4'>Ivory City</a>",
		$msg);
	$msg = str_replace("/kamellot",
		"<a href='manual/locations/location.php?id=4' target='_blank' style='text-decoration:none;color:#2276f4'>Kammellot</a>",
		$msg);
	$msg = str_replace("/marintiqua",
		"<a href='manual/locations/location.php?id=5' target='_blank' style='text-decoration:none;color:#2276f4'>Marintiqua</a>",
		$msg);
	$msg = str_replace("/verne peninsula",
		"<a href='manual/locations/location.php?id=6' target='_blank' style='text-decoration:none;color:#2276f4'>Verne Peninsula</a>",
		$msg);
	$msg = str_replace("/domecelle",
		"<a href='manual/locations/location.php?id=7' target='_blank' style='text-decoration:none;color:#2276f4'>Domecelle</a>",
		$msg);
	$msg = str_replace("/maqueda",
		"<a href='manual/locations/location.php?id=8' target='_blank' style='text-decoration:none;color:#2276f4'>Maqueda</a>",
		$msg);
	$msg = str_replace("/carratraca",
		"<a href='manual/locations/location.php?id=9' target='_blank' style='text-decoration:none;color:#2276f4'>Carratraca</a>",
		$msg);

	$msg = str_replace("/frigiliana",
		"<a href='manual/locations/location.php?id=10' target='_blank' style='text-decoration:none;color:#2276f4'>Frigiliana</a>",
		$msg);

	$msg = str_replace("/benadalid",
		"<a href='manual/locations/location.php?id=11' target='_blank' style='text-decoration:none;color:#2276f4'>Benadalid</a>",
		$msg);

	$msg = str_replace("/st penwith pier",
		"<a href='manual/locations/location.php?id=12' target='_blank' style='text-decoration:none;color:#2276f4'>St Penwith Pier</a>",
		$msg);

	$msg = str_replace("/ammesbury",
		"<a href='manual/locations/location.php?id=13' target='_blank' style='text-decoration:none;color:#2276f4'>Ammesbury</a>",
		$msg);

	$msg = str_replace("/finchley",
		"<a href='manual/locations/location.php?id=14' target='_blank' style='text-decoration:none;color:#2276f4'>Finchley</a>",
		$msg);
	$msg = str_replace("/beckenham",
		"<a href='manual/locations/location.php?id=15' target='_blank' style='text-decoration:none;color:#2276f4'>Beckenham</a>",
		$msg);

	$msg = str_replace("/loscoe",
		"<a href='manual/locations/location.php?id=16' target='_blank' style='text-decoration:none;color:#2276f4'>Loscoe</a>",
		$msg);

	$msg = str_replace("/padstow",
		"<a href='manual/locations/location.php?id=17' target='_blank' style='text-decoration:none;color:#2276f4'>Padstow</a>",
		$msg);

	$msg = str_replace("/broken hill",
		"<a href='manual/locations/location.php?id=18' target='_blank' style='text-decoration:none;color:#2276f4'>Eratia Hill</a>",
		$msg);

	$msg = str_replace("/randwick",
		"<a href='manual/locations/location.php?id=19' target='_blank' style='text-decoration:none;color:#2276f4'>Randwick</a>",
		$msg);

	$msg = str_replace("/cessnock",
		"<a href='manual/locations/location.php?id=20' target='_blank' style='text-decoration:none;color:#2276f4'>Cessnock</a>",
		$msg);

	$msg = str_replace("/cantebury",
		"<a href='manual/locations/location.php?id=21' target='_blank' style='text-decoration:none;color:#2276f4'>Cantebury</a>",
		$msg);

	$msg = str_replace("/willoughby",
		"<a href='manual/locations/location.php?id=22' target='_blank' style='text-decoration:none;color:#2276f4'>Willoughby</a>",
		$msg);

	$msg = str_replace("/lithgow",
		"<a href='manual/locations/location.php?id=23' target='_blank' style='text-decoration:none;color:#2276f4'>Lithgow</a>",
		$msg);


	/* Donated Emotes */
	if($extra_emotes == true) {

		$msg = str_replace(":boy:",
			"<img src='manual/img/Emoticons/BoyEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":fish:",
			"<img src='manual/img/Emoticons/FishEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":girl:",
			"<img src='manual/img/Emoticons/GirlEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":jump:",
			"<img src='manual/img/Emoticons/JumpEmote-D.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace(":rise:",
			"<img src='manual/img/Emoticons/SunriseEmote-D.gif' width='16px' height='16px'>",
			$msg);
		$msg = str_replace(":set:",
			"<img src='manual/img/Emoticons/SunsetEmote-D.gif' width='16px' height='16px'>",
			$msg);
		$msg = str_replace(":pumpkin:",
			"<img src='manual/img/Emoticons/pumpkin-h.gif' width='16px' height='16px'>", $msg);
		$msg = str_replace("[cloon]",
			"<img src='manual/img/Emoticons/clooney.png' width='16px' height='16px'>", $msg);
	}
	return $msg;
}

function isMuted($userid) {
	$query = mysql_query("SELECT `length`, `date` FROM `punishments` WHERE `player`=" .
		$userid." AND `type`=\"Mute\" OR `type`=\"Time Out\"");
	if(mysql_num_rows($query) > 0) {
		$row = mysql_fetch_assoc($query);
        if(time() < ($row['date'] + ($row['length']*60))){
            return true;
        }else{
            return false;
        }
	}else{
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
		'bitch',
		'fuck',
		'cunt',
		'asshole',
		'dumbfuck',
		'pussy',
		'poon',
		'poontang',
		'prozzie',
		'prostitute',
		'skank',
		'slut',
		'nigger',
		'nigra',
		'nigga',
		'niggah',
		'nigguh',
		'niglet',
		'porchmonkey',
		'porch monkey',
		'spook',
		'chink',
		'jap',
		'gook',
		'nip',
		'chee-chee',
		'chee chee',
		'cheechee',
		'muzzie',
		'honky',
		'peckerwood',
		'wigger',
		'spic',
		'yank',
		'greaseball',
		'asshat',
		'dickhead',
		'shit',
		'bastard',
		'fucknut',
		'bellend',
		'retard',
		'spaz',
		'dick',
		'wanker',
		'fuk',
		'shite',
		'shitter',
		'cockwash',
		'porn',
		'nobhead',
		'cum',
		'knob',
		'paki',
		'fag',
		'faggot',
		'fagget',
		'penis',
		'penishead',
		'jerk',
		'jerkoff',
		'jackoff',
		'fucking',
		'fucked',
		'fucker',
		'bollocks',
		'mother fucker',
		'cock',
		'titties',
		'tits',
		'tit',
		'boobies',
		'boobs',
		'boob',
		'vagina',
		'vag');

	$text = str_ireplace($curses, '[censored]', $text);
	return $text;

}
?>