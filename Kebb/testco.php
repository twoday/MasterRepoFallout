<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CoFrisson</title>
</head>
<style>
/*html5 semantics tags */
article, aside, figure, footer, header, hgroup, menu, nav, section 
{ display: block; }

/* light css reset */
* { margin : 0; padding : 0; }
h2, h3, h4, h5, p, ul, ol  { margin : 0 20px; padding : .5em 0; }
img { border: 0px;}

/* =page level container */
#pageContainer {
    margin: 0px auto 0px auto;
	width: 960px;
	background:#141414;
}

#pageHeader {
    margin:0px auto 0px auto;
    width:960px;
    height:82px;
    position:relative;
}

#contentContainer {
    margin: 0px;
    padding-top: 10px;
    padding-bottom: 20px;
    min-height: 500px;
}
#pageFooter {
    margin: 0px auto;
    padding-bottom: 20px;
	width: 960px;
	position: relative;
}

/* Clear Floated Elements */
.clearfix:before, .clearfix:after {content: "\0020"; 
display: block; height: 0; visibility: hidden;}
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }
</style>
<body>
	<div id="pageContainer">
		<header id="pageHeader"></header>
	 	<div id="contentContainer" class="clearfix">
			<nav id="pageNav"></nav>

  		<section id="pageSection">
				<header class="sectionHeader"></header>
				<article class="sectionArticle"></article>
				<footer class="sectionFooter"></footer>
			</section>

 			<aside id="pageAside"></aside>
		</div>
		<footer id="pageFooter" style="background-image:url(test/CoFrisson/cl-footer.png);"></footer>
	</div>
</body>
</html>