<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];

?>

<div align="center">
<table width="100%"><tr>

<td align="right"><span class="link" onclick="closemap();">Close</span></td></tr></table>


</div>
<div id="special1" style="margin-left:10px;" align="center"><br />
<?php
$select7 = "SELECT `location_id` FROM `users` WHERE `user_id` = '$userid'";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row = mysql_fetch_assoc($select_resutlts7)){

$town_id = $row['location_id'];

switch($town_id)
{

// ==== VALENCIA ISLE  ==== //

// Verne Peninsula
case  6 :
?>
<img src ="images/valencia_isle.png" alt="Planets" usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="144,73,10,80" shape="circle" style="cursor:pointer;" alt="Domecelle" href="javascript:moveLocaion(1);"/>
<area coords ="202,203,10,80" shape="circle" style="cursor:pointer;" alt="Frigiliana" href="javascript:moveLocaion(2);"/>
</map>


<?php
break;

// Benadalid
case  11 :
?>
<img src ="images/valencia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="202,203,10,80" shape="circle" style="cursor:pointer;" alt="Frigiliana" href="javascript:moveLocaion(3);"/>
</map>

<?php
break;

// Frigiliana
case  10 :
?>
<img src ="images/valencia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="163,143,10,80" shape="circle" style="cursor:pointer;" alt="Banadalid" href="javascript:moveLocaion(4);"/>
<area coords ="72,225,10,80" shape="circle" style="cursor:pointer;" alt="Verne Peninsula" href="javascript:moveLocaion(5);"/>
<area coords ="325,174,10,80" shape="circle" style="cursor:pointer;" alt="Carratraca" href="javascript:moveLocaion(6);"/>
</map>

<?php
break;

// Carratraca
case  9 :
?>
<img src ="images/valencia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="202,203,10,80" shape="circle" style="cursor:pointer;" alt="Frigiliana" href="javascript:moveLocaion(7);"/>
<area coords ="272,74,10,80" shape="circle" style="cursor:pointer;" alt="Maqueda" href="javascript:moveLocaion(8);"/>
</map>

<?php
break;

// Maqueda
case  8 :
?>
<img src ="images/valencia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="325,174,10,80" shape="circle" style="cursor:pointer;" alt="Carratraca" href="javascript:moveLocaion(9);"/>
<area coords ="144,73,10,80" shape="circle" style="cursor:pointer;" alt="Domecelle" href="javascript:moveLocaion(10);"/>
</map>

<?php
break;

// Domecelle 
case  7 :
?>
<img src ="images/valencia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="272,74,10,80" shape="circle" style="cursor:pointer;" alt="Maqueda" href="javascript:moveLocaion(11);"/>
<area coords ="72,225,10,80" shape="circle" style="cursor:pointer;" alt="Verne Peninsula" href="javascript:moveLocaion(12);"/>
</map>

<?php
break;

// ==== PANCASHIRE  ==== //

// St Penwith Pier
case  12 :
?>
<img src ="images/pancashire.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="124,61,10,80" shape="circle" style="cursor:pointer;" alt="Ammesbury" href="javascript:moveLocaion(18);"/>
<area coords ="210,134,10,80" shape="circle" style="cursor:pointer;" alt="Padstow" href="javascript:moveLocaion(17);"/>
</map>

<?php
break;

// Padstow
case  17 :
?>
<img src ="images/pancashire.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="98,139,10,80" shape="circle" style="cursor:pointer;" alt="St Penwith Pier" href="javascript:moveLocaion(19);"/>
<area coords ="210,235,10,80" shape="circle" style="cursor:pointer;" alt="Loscoe" href="javascript:moveLocaion(20);"/>
</map>

<?php
break;

// Loscoe
case  16 :
?>
<img src ="images/pancashire.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="210,134,10,80" shape="circle" style="cursor:pointer;" alt="Padstow" href="javascript:moveLocaion(27);"/>
<area coords ="314,169,10,80" shape="circle" style="cursor:pointer;" alt="Beckenham" href="javascript:moveLocaion(28);"/>
</map>

<?php
break;

// Beckenham
case  15 :
?>
<img src ="images/pancashire.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="210,235,10,80" shape="circle" style="cursor:pointer;" alt="Loscoe" href="javascript:moveLocaion(25);"/>
<area coords ="284,73,10,80" shape="circle" style="cursor:pointer;" alt="Finchley" href="javascript:moveLocaion(26);"/>
</map>

<?php
break;

// Finchley
case  14 :
?>
<img src ="images/pancashire.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="314,169,10,80" shape="circle" style="cursor:pointer;" alt="Beckenham" href="javascript:moveLocaion(23);"/>
<area coords ="124,61,10,80" shape="circle" style="cursor:pointer;" alt="Ammesbury" href="javascript:moveLocaion(24);"/>
</map>

<?php
break;

// Ammesbury
case  13 :
?>
<img src ="images/pancashire.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="98,139,10,80" shape="circle" style="cursor:pointer;" alt="St Penwith Pier" href="javascript:moveLocaion(21);"/>
<area coords ="284,73,10,80" shape="circle" style="cursor:pointer;" alt="Finchley" href="javascript:moveLocaion(22);"/>
</map>

<?php
break;

// ==== ERATIA ISLE  ==== //

// Broken Hill
case  18 :
?>
<img src ="images/eratia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="121,210,10,80" shape="circle" style="cursor:pointer;" alt="Willoughby" href="javascript:moveLocaion(29);"/>
<area coords ="298,85,10,80" shape="circle" style="cursor:pointer;" alt="Randwick" href="javascript:moveLocaion(30);"/>
</map>

<?php
break;

// Randwick
case  19 :
?>
<img src ="images/eratia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="268,228,10,80" shape="circle" style="cursor:pointer;" alt="Broken Hill" href="javascript:moveLocaion(31);"/>
<area coords ="192,49,10,80" shape="circle" style="cursor:pointer;" alt="Cessnock" href="javascript:moveLocaion(32);"/>
</map>

<?php
break;

// Cessnock
case  20 :
?>
<img src ="images/eratia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="298,85,10,80" shape="circle" style="cursor:pointer;" alt="Randwick" href="javascript:moveLocaion(33);"/>
<area coords ="172,133,10,80" shape="circle" style="cursor:pointer;" alt="Cantebury" href="javascript:moveLocaion(34);"/>
<area coords ="78,119,10,80" shape="circle" style="cursor:pointer;" alt="Lithgow" href="javascript:moveLocaion(35);"/>
</map>

<?php
break;

// Cantebury
case  21 :
?>
<img src ="images/eratia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="192,49,10,80" shape="circle" style="cursor:pointer;" alt="Cessnock" href="javascript:moveLocaion(36);"/>
<area coords ="121,210,10,80" shape="circle" style="cursor:pointer;" alt="Willoughby" href="javascript:moveLocaion(37);"/>
</map>

<?php
break;

// Willoughby
case  22 :
?>
<img src ="images/eratia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="268,228,10,80" shape="circle" style="cursor:pointer;" alt="Broken Hill" href="javascript:moveLocaion(38);"/>
<area coords ="78,119,10,80" shape="circle" style="cursor:pointer;" alt="Lithgow" href="javascript:moveLocaion(39);"/>
<area coords ="172,133,10,80" shape="circle" style="cursor:pointer;" alt="Cantebury" href="javascript:moveLocaion(40);"/>
</map>

<?php
break;

// Lithgow
case  23 :
?>
<img src ="images/eratia_isle.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="192,49,10,80" shape="circle" style="cursor:pointer;" alt="Cessnock" href="javascript:moveLocaion(41);"/>
<area coords ="121,210,10,80" shape="circle" style="cursor:pointer;" alt="Willoughby" href="javascript:moveLocaion(42);"/>
</map>

<?php
break;

// ==== Tutorial  ==== //

// Falionra
case  1 :
?>
<img src ="images/tutorial.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="101,117,10,80" shape="circle" style="cursor:pointer;" alt="Astelio" href="javascript:moveLocaion(43);"/>
</map>

<?php
break;

// Astelio
case  2 :
?>
<img src ="images/tutorial.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="113,233,10,80" shape="circle" style="cursor:pointer;" alt="Falionra" href="javascript:moveLocaion(44);"/>
<area coords ="184,54,10,80" shape="circle" style="cursor:pointer;" alt="Ivory City" href="javascript:moveLocaion(45);"/>
</map>

<?php
break;

// Ivory City
case  3 :
?>
<img src ="images/tutorial.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="101,117,10,80" shape="circle" style="cursor:pointer;" alt="Astelio" href="javascript:moveLocaion(46);"/>
<area coords ="283,70,10,80" shape="circle" style="cursor:pointer;" alt="Kamellott" href="javascript:moveLocaion(47);"/>
</map>

<?php
break;

// Kamellott
case  4 :
?>
<img src ="images/tutorial.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="184,54,10,80" shape="circle" style="cursor:pointer;" alt="Ivory City" href="javascript:moveLocaion(48);"/>
<area coords ="305,197,10,80" shape="circle" style="cursor:pointer;" alt="Marintiqua" href="javascript:moveLocaion(49);"/>
</map>

<?php
break;

// Marintiqua
case  5 :
?>
<img src ="images/tutorial.png"  usemap="#planetmap" style="border:1px solid Black;"/>

<map name="planetmap">
<area coords ="283,70,10,80" shape="circle" style="cursor:pointer;" alt="Kamellott" href="javascript:moveLocaion(50);"/>
</map>

<?php
break;

}
}
?>
</div>