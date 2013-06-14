// ==== Chat ==== //
channel = function(channel) {
	var input = document.getElementById("chatmsg");
	var chat = document.getElementById("change");
	if (channel == "1") {
		document.getElementById("change").innerHTML = "World";
		chat.style.color = '#d9e1f8';
		input.style.color = '#d9e1f8';
		input.focus();
	} else if (channel == "2") {
		document.getElementById("change").innerHTML = "Guild";
		chat.style.color = '#4CC417';
		input.style.color = '#4CC417';
		input.focus();
	} else if (channel == "3") {
		document.getElementById("change").innerHTML = "Help";
		chat.style.color = '#FFF380';
		input.style.color = '#FFF380';
		input.focus();
	} else if (channel == "4") {
		document.getElementById("change").innerHTML = "Trade";
		chat.style.color = '#8D38C9';
		input.style.color = '#8D38C9';
		input.focus();
	} else if (channel == "5") {
		document.getElementById("change").innerHTML = "Tutorial";
		chat.style.color = '#43BFC7';
		input.style.color = '#43BFC7';
		input.focus();
	} else if (channel == "6") {
		document.getElementById("change").innerHTML = "Admin";
		chat.style.color = '#ea0606';
		input.style.color = '#ea0606';
		input.focus();
	} else if (channel == "7") {
		document.getElementById("change").innerHTML = "Mod";
		chat.style.color = '#065cea';
		input.style.color = '#065cea';
		input.focus();
	} else if (channel == "8") {
		document.getElementById("change").innerHTML = "Server";
		chat.style.color = 'yellow';
		input.style.color = 'yellow';
		input.focus();
	} else if (channel == "9") {
		document.getElementById("change").innerHTML = "Staff";
		chat.style.color = '#ADA96E';
		input.style.color = '#ADA96E';
		input.focus();
	} else if (channel == "10") {
		document.getElementById("change").innerHTML = "Punishment";
		chat.style.color = '#C35817';
		input.style.color = '#C35817';
		input.focus();
	}
}
loadDiv = function(place, url, data) {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else { // Crap IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			id(place).innerHTML = xmlhttp.responseText;
		} else {
			return false;
		}
	}
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}
id = function(what) {
	return document.getElementById(what);
}
// ==== In Game Pop Ups ==== //

function closedoll() {
	$('#doll').empty();
    $('#doll').hide();
}

function paperdoll() {
	$('#doll').load("game_includes/doll.php");
	document.getElementById("doll").style.display = "block";
	closeguild();
	closemap();
	closemessages();
	closeadmin();
	closemod();
	closesettings();
	closeinventory();
}

function closeguild() {
	$('#guild').empty();
    $('#guild').hide();
}

function guild(id) {
	$('#guild').load("game_includes/guild.php", {
		id: id
	});
	document.getElementById("guild").style.display = "block";
	closedoll();
	closemap();
	closemessages();
	closeadmin();
	closemod();
	closesettings();
	closeinventory();
}

function closemap() {
	$('#map').empty();
    $('#map').hide();
}

function map() {
	$('#map').load("game_includes/map.php");
	document.getElementById("map").style.display = "block";
	closedoll();
	closeguild();
	closemessages();
	closeadmin();
	closemod();
	closesettings();
	closeinventory();
}

function closemessages() {
	$('#message').empty();
    $('#message').hide();
}

function messages(id) {
	$('#message').load("messages.php", {
		id: id
	});
	document.getElementById("message").style.display = "block";
	closedoll();
	closeguild();
	closemap();
	closeadmin();
	closemod();
	closesettings();
	closeinventory();
}

function closeadmin() {
	$('#admin').empty();
    $('#admin').hide();
}

function admin_panel(id) {
	$('#admin').load("game_includes/admin_panel.php", {
		id: id
	});
	document.getElementById("admin").style.display = "block";
	closedoll();
	closeguild();
	closemap();
	closemessages();
	closemod();
	closesettings();
	closeinventory();
}

function closemod() {
	$('#mod').empty();
    $('#mod').hide();
}

function mod_panel(id) {
	$('#mod').load("game_includes/mod_panel.php", {
		id: id
	});
	document.getElementById("mod").style.display = "block";
	closedoll();
	closeguild();
	closemap();
	closemessages();
	closeadmin();
	closesettings();
	closeinventory();
}

function closesettings() {
	$('#settings').empty();
    $('#settings').hide();
}

function settings() {
	$('#settings').load("game_includes/change_theme.php");
	document.getElementById("settings").style.display = "block";
	closedoll();
	closeguild();
	closemap();
	closemessages();
	closeadmin();
	closemod();
	closeinventory();
}

function closeinventory() {
	$('#inventory_popup').empty();
    $('#inventory_popup').hide();
}

function inventory(id) {
	$('#inventory_popup').load("game_includes/inventory.php", {
		id: id
	});
	document.getElementById("inventory_popup").style.display = "block";
	closedoll();
	closeguild();
	closemap();
	closemessages();
	closeadmin();
	closemod();
	closesettings();
}

function online() {
	$("#online").load("online/index.php");
}
moveLocaion = function(id) {
	$("#timer2").load("timer/speed.php", {
		id: id
	});
	closemap();
}
startmining = function(id) {
	$("#timer2").load("timer/mining_timer.php", {
		id: id
	});
}
startwoodcutting = function(id) {
	$("#timer2").load("timer/woodcutting.php", {
		id: id
	});
}
startfishing = function(id) {
	$("#timer2").load("timer/fishing.php", {
		id: id
	});
}
update_main = function(town) {
	$("#timer2").load("game_includes/main.php", {
		t: town
	});
    Tie.stopWork();
}
update_menu = function(town) {
	$("#usermenu").load("game_includes/town.php", {
		t: town
	});
}
update_character = function() {
	$("#character").load("game_includes/character.php");
}
open_newsfeeds = function() {
	$("#news_feed").load("game_includes/news_feeds.php");
}

update_skills = function() {
	$("#skills").load("game_includes/skills.php");
}

function reply(id) {
	$('#message_area').load("game_includes/reply.php", {
		id: id
	});
}

function error_message(a) {
	if (a == 1) {
		document.getElementById("error_mess").innerHTML = "Player is already banned!"
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
	} else if (a == 2) {
		document.getElementById("error_mess").innerHTML = "This player has been banned twice, you may not unban them!"
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
	} else if (a == 3) {
		document.getElementById("error_mess").innerHTML = "This player has not been banned!"
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
	} else if (a == 4) {
		document.getElementById("error_mess").innerHTML = "That player does not exist!";
		var error = document.getElementById("error_mess");
		error.style.color = 'Red';
	} else if (a == 5) {
		document.getElementById("error_mess2").innerHTML = "That player does not exist!";
		var error = document.getElementById("error_mess2");
		error.style.color = 'Red';
	}
}

function settime() {
	var set = setTimeout(function() {
		refreshfunction();
	}, 10000);
}

function refreshfunction() {
	$.post("everything.php", {
		p: 10
	}, function(data) {
		eval(data);
	});
}

function show_message(message) {
	if (message == 0) {
		document.getElementById("new_messages").innerHTML = "";
		settime();
	} else {
		document.getElementById("new_messages").innerHTML = "( " + message + " )";
		settime();
	}
}

function error_name() {
	document.getElementById("error_mess").innerHTML = "The Guild Name you chose is already in use."
	var error = document.getElementById("error_mess");
	error.style.color = 'Red';
}

function error_tag() {
	document.getElementById("error_mess").innerHTML = "The Guild Tag you chose is already in use."
	var error = document.getElementById("error_mess");
	error.style.color = 'Red';
}

function error_guild() {
	document.getElementById("error_mess").innerHTML = "You must delete your Guild Request before you can create a Guild."
	var error = document.getElementById("error_mess");
	error.style.color = 'Red';
}

function error_joined() {
	document.getElementById("error_mess2").innerHTML = "You have already applied to a guild."
	var error = document.getElementById("error_mess2");
	error.style.color = 'Red';
}

function skill_ppl(skill, ppl) {
	if (ppl == 0) {
		document.getElementById("action_players").innerHTML = "<br>You are " + skill + " alone";
		var error = document.getElementById("action_players");
		error.style.color = 'white';
	} else {
		document.getElementById("action_players").innerHTML = "<br>You are " + skill + " with " + ppl + " others.";
		var error = document.getElementById("action_players");
		error.style.color = 'white';
	}
}
botcheck = function(id) {
	$("#timer2").load("botcheck.php", {
		id: id
	});
}

function settime2() {
	var set = setTimeout(function() {
		refreshfunction2();
	}, 300000);
}

function refreshfunction2() {
	$("#news_feed").load("game_includes/news_feeds.php");
	settime2();
}