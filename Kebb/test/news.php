<?php
/**
 * @author Alasdair Ross
 * @copyright 2009
 */
include("dbconnect.php");
$getnews = mysql_query("SELECT * FROM `news` ORDER BY id DESC");
while($r=mysql_fetch_array($getnews)){
extract($r);
echo("<b>$title</b><i><font size=\"-1\"> - Posted on ".date("l jS F Y",$date)." at $time</font></i><br /><br />$news<hr />");
}
if (mysql_num_rows($getnews) == 0){
	echo "There is no news.";
}
?>