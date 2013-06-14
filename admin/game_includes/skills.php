<?php
session_start();
include("../core/database/connect.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);

$skillc4 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Fishing' ") or die('Error');
$skill4 = mysql_fetch_array($skillc4);
$fish = $skill4['level'];
$fish2 = $skill4['exp'];

$skillc = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Mining' ") or die('Error');
$skill = mysql_fetch_array($skillc);
$mining = $skill['level'];
$mining2 = $skill['exp'];

$skillc11 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Speed' ") or die('Error');
$skill11 = mysql_fetch_array($skillc11);
$speed = $skill11['level'];
$speed2 = $skill11['exp'];

$skillc12 = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Woodcutting' ") or die('Error');
$skill12 = mysql_fetch_array($skillc12);
$wc = $skill12['level'];
$wc2 = $skill12['exp'];

$skillca = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Alchemy' ") or die('Error');
$skilla = mysql_fetch_array($skillca);
$alch = $skilla['level'];
$alch2 = $skilla['exp'];

$skillcb = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Blacksmithing' ") or die('Error');
$skillb = mysql_fetch_array($skillcb);
$blacksmith = $skillb['level'];
$blacksmith2 = $skillb['exp'];

$skillcc = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Combat' ") or die('Error');
$skillc = mysql_fetch_array($skillcc);
$combat = $skillc['level'];
$combat2 = $skillc['exp'];

$skillcd = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Construction' ") or die('Error');
$skilld = mysql_fetch_array($skillcd);
$const = $skilld['level'];
$const2 = $skilld['exp'];

$skillce = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Cooking' ") or die('Error');
$skille = mysql_fetch_array($skillce);
$cook = $skille['level'];
$cook2 = $skille['exp'];

$skillcf = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Gathering' ") or die('Error');
$skillf = mysql_fetch_array($skillcf);
$gath = $skillf['level'];
$gath2 = $skillf['exp'];

$skillcg = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Hunting' ") or die('Error');
$skillg = mysql_fetch_array($skillcg);
$hunt = $skillg['level'];
$hunt2 = $skillg['exp'];

$skillch = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Magic' ") or die('Error');
$skillh = mysql_fetch_array($skillch);
$magic = $skillh['level'];
$magic2 = $skillh['exp'];

$skillci = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Tailoring' ") or die('Error');
$skilli = mysql_fetch_array($skillci);
$tail = $skilli['level'];
$tail2 = $skilli['exp'];

$thexp4 = floor( ($fish/2) * pow( floor(($fish*5)) , 2)) - $fish2;
$thexp8 = floor( ($mining/2) * pow( floor(($mining*5)) , 2)) - $mining2;
$thexp11 = floor( ($speed/2) * pow( floor(($speed*5)) , 2)) - $speed2;
$thexp12 = floor( ($wc/2) * pow( floor(($wc*5)) , 2)) - $wc2;
$thexp13 = floor( ($alch/2) * pow( floor(($alch*5)) , 2)) - $alch2;
$thexp14 = floor( ($blacksmith/2) * pow( floor(($blacksmith*5)) , 2)) - $blacksmith2;
$thexp15 = floor( ($combat/2) * pow( floor(($combat*5)) , 2)) - $combat2;
$thexp16 = floor( ($const/2) * pow( floor(($const*5)) , 2)) - $const2;
$thexp17 = floor( ($cook/2) * pow( floor(($cook*5)) , 2)) - $cook2;
$thexp18 = floor( ($gath/2) * pow( floor(($gath*5)) , 2)) - $gath2;
$thexp19 = floor( ($hunt/2) * pow( floor(($hunt*5)) , 2)) - $hunt2;
$thexp20 = floor( ($magic/2) * pow( floor(($magic*5)) , 2)) - $magic2;
$thexp21 = floor( ($tail/2) * pow( floor(($tail*5)) , 2)) - $tail2;
 
if($thexp4 <= 0){
$thexp4 = "0";
}
if($thexp8 <= 0){
$thexp8 = "0";
}
if($thexp11 <= 0){
$thexp11 = "0";
}
if($thexp12 <= 0){
$thexp12 = "0";
}
if($thexp13 <= 0){
$thexp13 = "0";
}
if($thexp14 <= 0){
$thexp14 = "0";
}
if($thexp15 <= 0){
$thexp15 = "0";
}
if($thexp16 <= 0){
$thexp16 = "0";
}
if($thexp17 <= 0){
$thexp17 = "0";
}
if($thexp18 <= 0){
$thexp18 = "0";
}
if($thexp19 <= 0){
$thexp19 = "0";
}
if($thexp20 <= 0){
$thexp20 = "0";
}
if($thexp21 <= 0){
$thexp21 = "0";
}
?>
<script>
				$(document).ready(function() {
					$('.skill').click(function() {
						var id = $(this).attr('id');
						$("#"+id+"_exp").toggle();
					});

				});
			</script>
<div id="character" style="font-family: Arial, Helvetica, sans-serif;font-size:1em;cursor:pointer;"><b>Character Skills</b></div>
<div class="skill" id="alchemy" style="cursor:pointer;">Alchemy: <?php echo $alch; ?></div>
<div class="skill" id="alchemy_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="alchemy_exp2">Exp <?php echo $alch2; ?></span> / <span id="alchemy_exp3"><?php echo $thexp13; ?> Remaining Exp</span></div>

<div class="skill" id="blacksmithing" style="cursor:pointer;">Blacksmithing: <?php echo $blacksmith; ?></div>
<div class="skill" id="blacksmithing_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="blacksmithing_exp2">Exp <?php echo $blacksmith2; ?></span> / <span id="blackmsithing_exp3"><?php echo $thexp14; ?> Remaining Exp</span></div>

<div class="skill" id="combat" style="cursor:pointer;">Combat: <?php echo $combat; ?></div>
<div class="skill" id="combat_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="combat_exp2">Exp <?php echo $combat2; ?></span> / <span id="combat_exp3"><?php echo $thexp15; ?> Remaining Exp</span></div>

<div class="skill" id="construction" style="cursor:pointer;">Construction: <?php echo $const; ?></div>
<div class="skill" id="construction_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="construction_exp2">Exp <?php echo $const2; ?></span> / <span id="construction_exp3"><?php echo $thexp16; ?> Remaining Exp</span></div>

<div class="skill" id="cooking" style="cursor:pointer;">Cooking: <?php echo $cook; ?></div>
<div class="skill" id="cooking_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="cooking_exp2">Exp <?php echo $cook2; ?></span> / <span id="cooking_exp3"><?php echo $thexp17; ?> Remaining Exp</span></div>

<div class="skill" id="fishing" style="cursor:pointer;">Fishing: <span id="fishing_level"><?php echo $fish; ?></span></div>
<div class="skill" id="fishing_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="fishing_exp2">Exp <?php echo $fish2; ?></span> / <span id="fishing_exp3"><?php echo $thexp4; ?> Remaining Exp</span></div>

<div class="skill" id="gathering" style="cursor:pointer;">Gathering: <?php echo $gath; ?></div>
<div class="skill" id="gathering_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="gathering_exp2">Exp <?php echo $gath2; ?></span> / <span id="gathering_exp3"><?php echo $thexp18; ?> Remaining Exp</span></div>

<div class="skill" id="hunting" style="cursor:pointer;">Hunting: <?php echo $hunt; ?></div>
<div class="skill" id="hunting_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="hunting_exp2">Exp <?php echo $hunt2; ?></span> / <span id="hunting_exp3"><?php echo $thexp19; ?> Remaining Exp</span></div>

<div class="skill" id="magic" style="cursor:pointer;">Magic: <?php echo $magic; ?></div>
<div class="skill" id="magic_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="magic_exp2">Exp <?php echo $magic2; ?></span> / <span id="magic_exp3"><?php echo $thexp20; ?> Remaining Exp</span></div>

<div class="skill" id="mining" style="cursor:pointer;">Mining: <span id="mining_level"><?php echo $mining; ?></span></div>
<div class="skill" id="mining_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="mining_exp2">Exp <?php echo $mining2; ?></span> / <span id="mining_exp3"><?php echo $thexp8; ?> Remaining Exp</span></div>

<div class="skill" id="speed" style="cursor:pointer;">Speed: <span id="speed_level"><?php echo $speed; ?></span></div>
<div class="skill" id="speed_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="speed_exp2">Exp <?php echo $speed2; ?></span> / <span id="speed_exp3"><?php echo $thexp11; ?> Remaining Exp</span></div>

<div class="skill" id="tailoring" style="cursor:pointer;">Tailoring: <?php echo $tail; ?></div>
<div class="skill" id="tailoring_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="tailoring_exp2">Exp <?php echo $tail2; ?></span> / <span id="tailoring_exp3"><?php echo $thexp21; ?> Remaining Exp</span></div>

<div class="skill" id="woodcutting" style="cursor:pointer;">Woodcutting: <span id="woodcutting_level"> <?php echo $wc; ?></span></div>
<div class="skill" id="woodcutting_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
<span id="woodcutting_exp2">Exp <?php echo $wc2; ?></span> / <span id="woodcutting_exp3"><?php echo $thexp12; ?> Remaining Exp</span></div>