Tie = function () {}; // Just defining the object.

Tie.id = function (what) {
	// E.G: Tie.id("mainDiv").innerHTML = "Content";
	return document.getElementById(what);
}

Tie.enc = function (what) {
	// Basic URL encoding, use for all user inputs and use PHP's urldecode() to decode.
	return encodeURIComponent(what);
}

Tie.deco = function (what) {
	// Decodes PHP's urlencode() and Tie.enc();
	return decodeURIComponent(what);
}

Tie.alterDiv = function(where,what) {
	if (Tie.id(where)) {
		// Changes the inner html of a div/span/font/something with in ID tag.
		Tie.id(where).innerHTML = what;
	}
}

Tie.loadDiv = function(where,url,data) {
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
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(data);
}

Tie.request = function (url, data) {
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
					for (i = 0; i < data.length; i++){
						var one = Tie.deco(data[parseInt(i)]);
						var two = Tie.deco(data[parseInt(i) + 1]);
						var three = Tie.deco(data[parseInt(i) + 2]);
						var four = Tie.deco(data[parseInt(i) + 3]);
						var five = Tie.deco(data[parseInt(i) + 4]);
						
							if (window.Tie[one]) {
								window.Tie[one](two,three,four,five);
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

		
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(data);
}

Tie.func = function (what) {
	if (what == "refresh") {
		// Simple function to use JS to refresh the page.  Tie.func() can be expanded upon loads.
		window.location = "";
	}
}

Tie.time = function () { // Same as php time();
	var d = new Date();
	var offset = +1;
		utc = (d.getTime() + (d.getTimezoneOffset() * 60000 ));
		nd = new Date(utc + (3600000*offset));
		nd /= 1000;

    return Math.floor(nd);
}

Tie.rand = function (high) { // Returns a number between 1 and X
	return Math.floor((Math.random() * high) + 1);
}

Tie.randInt =  function(min, max){
	return Math.floor(Math.random() * (max - min + 1)) + min;
}