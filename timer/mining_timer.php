<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$player_location = $userinfo['location_id'];
$action_id = $userinfo['action_id'];

$select = "SELECT * FROM `actions`";
$select_resutlts = mysql_query($select) or die(mysql_error());
while($row = mysql_fetch_assoc($select_resutlts)){
$id = $row['id'];
$base_time = $row['base_timer'];
$gained_exp = $row['success_exp'];
$fail_exp = $row['fail_exp'];
$req_level = $row['level'];
$location_id = $row['location_id'];

$skillc = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Mining' ") or die('Error');
$skill = mysql_fetch_array($skillc);
$level = $skill['level'];
$exp = $skill['exp'];

if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == $id){

if($player_location == $location_id){
if($level >= $req_level){

mysql_query("UPDATE `users` SET `action_id` = '$id' WHERE `user_id` = '$userid'");
mysql_query("UPDATE `users` SET `action_skill` = 'Mining' WHERE `user_id` = '$userid'");

$query1 = mysql_query("SELECT * FROM `action_drops` WHERE `action_id` = '$id' LIMIT 0,1");	
	$row1 = mysql_fetch_assoc($query1);
		$item = $row1['item_id'];
		$min_amount = $row1['min_amount'];
		$max_amount = $row1['max_amount'];

$query2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item' LIMIT 0,1");	
	$row2 = mysql_fetch_assoc($query2);
		$item_name = $row2['name'];
		$gained_plural = $row2['plural'];
				
$item3 = mysql_query("SELECT * FROM `inventory` WHERE `itemid` = '$item' AND `userid` = '$userid'") or die('Error');
$item3 = mysql_fetch_array($item3);


$selec = "SELECT * FROM `inventory` WHERE `itemid` = '$item' AND `userid` = '$userid'";
$select_res = mysql_query($selec) or die(mysql_error());
$gcount = mysql_num_rows($select_res);


$theamount = "1";



$thexp1 = floor( ($level/2) * pow( floor(($level*5)) , 2)) - $exp;

if($thexp1 <= 0){
$thexp1 = "0";
}

$remaining = $thexp1;

if($item_name == 1){
$item_name = $item_name;
}else{
$item_name = $gained_plural;
}

$skill_name = "mining";
if($userinfo['botcheck'] == 1){
?>
<script type="text/javascript">

botcheck(1); 

</script>
<?php
}else{
?>
<script type="text/javascript">

window.onload = startTimer(<?php echo $base_time; ?>);

function startTimer(t)
{
	var d = new Date();
	curTime = d.getTime();
	finalTime = curTime + (parseInt(t)*1000);
	tcontent = '<input id="txt" type="text" title="'+finalTime+'" value="'+t+'" readonly />';

        document.getElementById("cencontent").innerHTML=tcontent;
        time = setTimeout(countTime,1000);
}


function countTime()
{
	var d = new Date();
	curTime = d.getTime();
	endTime = parseInt(document.getElementById('txt').title);
	timer = Math.round((endTime - curTime)/1000);
	if(timer <= -1)
	{

 
startTimer(<?php echo $base_time; ?>);     
success_fail(<?php echo $req_level; ?>,<?php echo $level; ?>);
check_bot(1);
       $.post("everything.php", { p:29, id:<?php echo "$id"; ?>,  skill:<?php echo "$skill_name"; ?> },
			function(data) {
				eval(data);
			});
}
else
	{
		document.getElementById('txt').value = timer;
		time = setTimeout(countTime,500);
		
	}
}
function check_bot(id){
	$.post("everything.php", { p:28, id:id },
			function(data) {
				eval(data);

			});
}

function success_fail(req,cur){
var n = Math.random();
var sub = cur - req;
var dec = "0.6";
var sub2 = dec + sub;

if(n <= sub2){
getRandomInt(<?php echo $min_amount; ?>, <?php echo $max_amount; ?>);
}else{
var gained = "<b>Sadly you failed to mine any <?php echo $item_name; ?>.</b><br>";
document.getElementById('gained_item').innerHTML = gained;

other2(<?php echo $id; ?>,<?php echo $fail_exp; ?>);
addsomeExp(<?php echo $fail_exp; ?>);
}

}

function getRandomInt(min, max) {

var number = Math.floor(Math.random() * (max - min + 1)) + min;

if(number == "1"){
var gained = "<b>You managed to mine one <?php echo $item_name; ?>.</b><br>";
}else if(number == "2"){
var gained = "<b>You managed to mine not only one but two <?php echo $item_name; ?>.</b><br>";
}else if(number == "3"){
var gained = "<b>Somehow you managed to mine three <?php echo $item_name; ?>.</b><br>";
}
  
document.getElementById('gained_item').innerHTML = gained;
addTotal(number);
other(<?php echo $id; ?>,number);
addsomeExp(<?php echo $gained_exp; ?>);
 
}
function other2(id,fail_exp){

        $.post("everything.php", { p:24, aid:id, exp:fail_exp },
			function(data) {
				eval(data);
			});

}

function other(id,num_ore){

        $.post("everything.php", { p:11, aid:id },
			function(data) {
				eval(data);
			});
	$.post("everything.php", { p:12, aid:id, num:num_ore },
			function(data) {
				eval(data);

			});
}



function addsomeExp(ama5){
var first5 = document.getElementById("exp").innerHTML;
var total5 = parseInt(first5) + parseInt(ama5);
document.getElementById("exp").innerHTML = total5;
var the_level = document.getElementById("level").innerHTML;

var atotal = Math.floor( (the_level/2) * Math.pow( Math.floor((the_level*5)) , 2)) - parseInt(total5);
if(atotal <= 0){
atotal = "0";
}

var total2 = "Exp " + total5;
document.getElementById("mining_exp2").innerHTML = total2;

var total7 = atotal + " Remaining Exp";
document.getElementById("mining_exp3").innerHTML = total7;

subExp(the_level,total5);
}


function subExp(level,expa){
var level = level;
var expa = expa;
var atotal = Math.floor( (level/2) * Math.pow( Math.floor((level*5)) , 2)) - parseInt(expa);
if(atotal <= 0){
atotal = "0";
}
document.getElementById("remaining").innerHTML = atotal;

var atotal2 = Math.floor( (level/2) * Math.pow( Math.floor((level*5)) , 2));
var level_3 = level - 1;
var atotal8 = Math.floor( (level_3/2) * Math.pow( Math.floor((level_3*5)) , 2));
var sub2 = atotal2 - atotal8

var math2 = expa - atotal8

if(expa >= atotal2){
levelUp(expa);
}
}

function levelUp(exp_a){
var exp_b = exp_a;
var level2 = document.getElementById("level").innerHTML;
var exc = parseInt(level2) + 1;
document.getElementById("level").innerHTML = exc;
document.getElementById("mining_level").innerHTML = exc;
update_menu(<?php echo $player_location; ?>);
subExp2(exc,exp_b);

var message = "You have advanced a Mining level (" + exc + ").";
        $.post("everything.php", { p:26, message:message },
			function(data) {
				eval(data);


});
}


function subExp2(level6,expa6){
var level5 = level6;
var expa5 = expa6;
var atotal_a3 = Math.floor( (level5/2) * Math.pow( Math.floor((level5*5)) , 2)) - parseInt(expa5);
if(atotal_a3 <= 0){
atotal_a3 = "0";
}
document.getElementById("remaining").innerHTML = atotal_a3;

var total2 = atotal_a3 + " Remaining Exp";
document.getElementById("mining_exp3").innerHTML = total2;


var atotal_y = Math.floor( (level5/2) * Math.pow( Math.floor((level5*5)) , 2));
var level_4 = level5 - 1
var atotal_y2 = Math.floor( (level_4/2) * Math.pow( Math.floor((level_4*5)) , 2));
var sub23 = atotal_y - atotal_y2;
var math_5 = expa5 - atotal_y2; 
}


function addSkillz(s){
	var sname_a = s;

	var location23 = sname_a + "_amount";


	var adds_a = document.getElementById(location23).innerHTML;

	var addttotal_a = parseInt(adds_a) + 1;
	
	document.getElementById(location23).innerHTML = addttotal_a;
	}
	
function addTotal(ama){
var amounta = ama;
var first2 = document.getElementById("item_suchs").innerHTML;
var total2 = parseInt(first2) + parseInt(amounta);
document.getElementById("item_suchs").innerHTML = total2;	
}



</script>


<div id="cencontent"></div><br /><br>


<span class="other" id="gained_item"><b>You start picking at the rock in search of <?php echo "$item_name"; ?>.</b><br></span>

<span class="other">
You have <b>
<span><span id="item_suchs"><?php 


if($gcount != 0){
echo "$item3[count]";
}else{
echo "0";
}


?></span></span>
<?php echo "$item_name"; ?></b>.
</span>

<br> 

<span class="other">Mining Level: <span id="level"><?php echo "$level"; ?></span> [ <span id="exp"><?php echo "$exp"; ?></span> Exp / <span id="remaining"><?php echo "$remaining"; ?></span> Remaining Exp ]


</span>

<span class="other" id="action_players">
<?php
$mult == 15 * 1;
$time == time()+$mult;

$sql33 = "SELECT count(action_id) AS tnew2 FROM `users` WHERE `action_id` = '$id' AND `check_time` >= '$time' AND `logged_in` = 1";
$res33 = mysql_query($sql33) or die(mysql_error());
$row23 = mysql_fetch_assoc($res33);

$players_number = $row23['tnew2'] - 1;

if($players_number == 0){
echo "<br>You are mining alone today.";
}else{
echo "<br>You are mining along with $players_number others.";
}
?>
</span>
<?php
}
}else{
echo "<span style=\"color:Orange;\"><b>You do not have the required level to complete this action.</b></span>";
}
}else{
echo "<span style=\"color:Orange;\"><b>You need to be at the correct location for this action.</b></span>";
}
}
}
?>