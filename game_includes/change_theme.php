<?php
include '../core/database/connect.php';
session_start();
$check = mysql_query("SELECT * FROM `users` WHERE `username` = '$_SESSION[username]' LIMIT 1") or die('Error1');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['userid'];
?>

<div align="center">
<table width="100%"><tr>

<td align="right"><span class="link" onclick="closesettings();">Close</span></td></tr></table>


</div>

Theme: 
<select class="style-change" name="colors2" id="theme5" style="font-family:verdana;color:white; border:1px solid #660000; background-color:Black">
<option value="">Select a Theme</option> 
<option value="css/game">Game</option> 
<option value="css/violet">Violet</option>
<option value="css/royal">Royal</option>
<option value="css/maroon">Maroon</option>
<option value="css/forest">Forest</option>
</select>


<script type="text/javascript">
$(function(){
$('.style-change').change(function(){
var style = $(this).val();	
$.post("everything.php", { p:13, type:style });

$('body').fadeOut("slow", function(){
$('link[rel="stylesheet"]').attr("href", style + ".css");
closesettings();	
$('body').fadeIn("slow");
});
});	
});
</script>