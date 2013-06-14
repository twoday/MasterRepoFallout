Tie = function() {}; // Just defining the object.
Tie.id = function(what) {
	// E.G: Tie.id("mainDiv").innerHTML = "Content";
	return document.getElementById(what);
}
Tie.enc = function(what) {
	// Basic URL encoding, use for all user inputs and use PHP's urldecode() to decode.
	return encodeURIComponent(what);
}
Tie.deco = function(what) {
	// Decodes PHP's urlencode() and Tie.enc();
	return decodeURIComponent(what);
}
Tie.alterDiv = function(where, what) {
	if (Tie.id(where)) {
		// Changes the inner html of a div/span/font/something with in ID tag.
		Tie.id(where).innerHTML = what;
	}
}
Tie.loadDiv = function(where, url, data) {
	// You don't need to know what it does only how to use it.
	// E.G: Tie.loadDiv("content", "content.php", "page: 5, paragraph: 12");
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else { // Crap IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			Tie.id(where).innerHTML = xmlhttp.responseText;
		} else {
			return false;
		}
	}
	if (!data) {
		data = "";
	}
	data = data.replace(/: /gi, "=");
	data = data.replace(/:/gi, "=");
	data = data.replace(/, /gi, "&");
	data = data.replace(/,/gi, "&");
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}
Tie.request = function(url, data) {
	// Sends an ajax request.  Very awesome
	// E.G: Tie.request("action.php", "action: 12, timer: 160");
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else { // Crap IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			data = xmlhttp.responseText.split("|");
			for (i = 0; i < data.length; i++) {
				var one = Tie.deco(data[parseInt(i)]);
				var two = Tie.deco(data[parseInt(i) + 1]);
				var three = Tie.deco(data[parseInt(i) + 2]);
				var four = Tie.deco(data[parseInt(i) + 3]);
				var five = Tie.deco(data[parseInt(i) + 4]);
				if (window.Tie[one]) {
					window.Tie[one](two, three, four, five);
				}
			}
		} else {
			return false;
		}
	}
	if (!data) {
		data = "";
	}
	data = data.replace(/: /gi, "=");
	data = data.replace(/:/gi, "=");
	data = data.replace(/, /gi, "&");
	data = data.replace(/,/gi, "&");
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}
Tie.func = function(what) {
	if (what == "refresh") {
		// Simple function to use JS to refresh the page.  Tie.func() can be expanded upon loads.
		window.location = "";
	}
}
Tie.time = function() { // Same as php time();
	return Math.floor(new Date().getTime() / 1000);
}
Tie.rand = function(high) { // Returns a number between 1 and X
	return Math.floor((Math.random() * high) + 1);
}
Tie.whisperPlayer = function(name) {
	Tie.id("chatmsg").value = name + "@";
	setTimeout(function() {
		Tie.id("chatmsg").focus();
	}, 100);
}
var worktimerC;
Tie.action = function(id, seconds) {
	clearTimeout(worktimerC);
	if (id) {
		if (!seconds) {
			if (!Tie.id("worktimer")) {
				Tie.loadDiv("timer2", "workscreen.php");
			}

			function w() {
				if (!Tie.id('worktimer')) {
					setTimeout(function() {
						w();
					}, 100);
				} else {
					Tie.alterDiv('worktimer', '');
					Tie.request("action.php", "i: " + id);
				}
			}
			setTimeout(function() {
				w();
			}, 100);
		} else {
			if (!Tie.id("worktimer")) {
				Tie.loadDiv("timer2", "workscreen.php");

				function wait() {
					Tie.action(id, seconds);
				}
				setTimeout(wait, 500);
				return;
			}
			Tie.id('worktimer').innerHTML = seconds;
			if (seconds >= 2) {
				seconds -= 1;
				worktimerC = setTimeout(function() {
					Tie.action(id, seconds);
				}, 1000);
			} else {
				Tie.id('worktimer').innerHTML = "0";
				Tie.request("action.php", "i: " + id + ", x: x");
			}
		}
	} else {
		alert("There was an error with your request.\n Please try again.");
	}
}
Tie.botcheck = function(action, ble) {
	if (action == "show") {
		Tie.stopWork(ble);
		Tie.loadDiv("timer2", "botcheck.php", "p: 1");
        $('#captcha').focus();
	} else if (action == "send") {
		var guess = Tie.id("captcha").value;
		if (guess.length >= 1) {
			Tie.request("botcheck.php", "p: 2, g: " + guess);
		}
	} else if (action == "fail") {
		Tie.id("captcha").value = "";
		Tie.id("captcha").style.border = "1px solid red";
		Tie.id("captcha").focus();
	} else if (action == "home") {
		Tie.loadDiv("timer2", "game_includes/main.php", "t: " + ble);
	} else if (action == "new") {
		Tie.request("botcheck.php", "p: 3");
	} else if (action == "update") {
		Tie.id("botimg").src = "generate.php";
		Tie.id("captcha").value = "";
		Tie.id("captcha").focus();
	}
}
Tie.updateSkill = function(skill, exp, level, rem) {
	Tie.id(skill + "_level").innerHTML = level;
	Tie.id(skill + "_exp2").innerHTML = "Exp " + exp;
	Tie.id(skill + "_exp3").innerHTML = rem + " Remaining Exp";
}
Tie.stopWork = function(t) {
	clearTimeout(worktimerC);
    if(t){
	   Tie.loadDiv("timer2", "game_includes/main.php", "t: " + t);
    }
}