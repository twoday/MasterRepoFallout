<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>CoFrisson</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
       <link rel="shortcut icon" href="favicon.png" /> 
</head>
<body>
	<div id="background">
		<div id="header">
			<div>
				<div>
					<a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
					<ul>
						<li>
							<a href="index.html" id="menu1">home</a>
						</li>
						<li>
							<a href="media.html" id="menu2">media</a>
						</li>
						<li>
							<a href="games.html" id="menu3">games</a>
						</li>
						<li>
							<a href="about.html" id="menu4">about</a>
						</li>
						<li class="selected">
							<a href="blog.html" id="menu5">blog</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="body">
			<div>
				<div>
					<div class="blog">
						<div class="content">
							<?php
include("news.php");
?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<div>
				<ul>
					<li id="facebook">
						<a href="http://www.facebook.com/CoFrisson">facebook</a>
					</li>
					<li id="twitter">
						<a href="http://www.twitter.com/Kebbrokk">Kebb's Twitter</a>
					</li>
					<li id="twitter">
						<a href="http://www.twitter.com/MarkusNewhart">Markus' Twitter</a>
					</li>
				</ul>
				<p>
					@ copyright 2012. all rights reserved.
				</p>
			</div>
		</div>
	</div>
</body>
</html>