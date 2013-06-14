<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);

?>

<div align="center">
<table width="100%"><tr><td align="center"><b>Paperdoll</b></td>

<td align="right"><span class="link" onclick="closedoll();">Close</span></td></tr></table>


</div>
<div id="special1" style="margin-left:10px;" align="left"><br />

<table border="0" width="100%">
<tr><td><span class="doll_heading">Head</span></td><td><span class="doll_other">Item</span></td><td><span class="doll_other">Effects</span></td></tr>
<tr><td><span class="doll_heading">Neck</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Torso</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Legs</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Feet</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Left Hand</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Right Hand</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Gloves</span></td><td></td><td></td></tr>
<tr><td><span class="doll_heading">Ring</span></td><td></td><td></td></tr>
</table>

</div>