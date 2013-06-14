<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$player_location = $userinfo['location_id'];

$select = "SELECT * FROM `actions`";
$select_resutlts = mysql_query($select) or die(mysql_error());
while($row = mysql_fetch_assoc($select_resutlts)){
$id = $row['id'];
$base_time = $row['base_timer'];
$gained_exp = $row['success_exp'];
$fail_exp = $row['fail_exp'];
$req_level = $row['level'];
$location_id = $row['location_id'];

$skillwa = mysql_query("SELECT `level`,`exp` FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]' && `skill_name` = 'Woodcutting' ") or die('Error');
$skillw = mysql_fetch_array($skillwa);
$level = $skillw['level'];
$exp = $skillw['exp'];

if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == $id){
if($player_location == $location_id){
if($level >= $req_level){

mysql_query("UPDATE `users` SET `action_id` = '$id' WHERE `user_id` = '$userid'");
mysql_query("UPDATE `users` SET `action_skill` = 'Woodcutting' WHERE `user_id` = '$userid'");

$query1 = mysql_query("SELECT * FROM `action_drops` WHERE `action_id` = '$id' LIMIT 0,1");	
	$row1 = mysql_fetch_assoc($query1);
		$item = $row1['item_id'];
		$min_amount = $row1['min_amount'];
		$max_amount = $row1['max_amount'];

$query2 = mysql_query("SELECT * FROM `items` WHERE `id` = '$item' LIMIT 0,1");	
	$row2 = mysql_fetch_assoc($query2);
		$item_name = $row2['name'];
		$gained_plural = $row2['plural'];
			
$query3 = mysql_query("SELECT * FROM `item_drop` WHERE `action_id` = '$id' LIMIT 0,1");	
	$row3 = mysql_fetch_assoc($query3);
	$gcount2 = mysql_num_rows($query3);
		$dropped_item = $row3['item_drop'];
		$drop_min_amount = $row3['min_amount'];
		$drop_max_amount = $row3['max_amount'];

$query4 = mysql_query("SELECT * FROM `items` WHERE `id` = '$dropped_item' LIMIT 0,1");	
	$row4 = mysql_fetch_assoc($query4);
		$drop_item_name = $row4['name'];
		$gained_plural2 = $row4['plural'];

$item3 = mysql_query("SELECT * FROM `inventory` WHERE `itemid` = '$item' AND `userid` = '$userid'") or die('Error');
$item3 = mysql_fetch_array($item3);


$selec = "SELECT * FROM `inventory` WHERE `itemid` = '$item' AND `userid` = '$userid'";
$select_res = mysql_query($selec) or die(mysql_error());
$gcount = mysql_num_rows($select_res);
$row5 = mysql_fetch_assoc($select_res);
$item_count = $row5['count'];

$theamount = "1";


$thexp1 = floor( ($level/2) * pow( floor(($level*5)) , 2)) - $exp;

if($thexp1 <= 0){
$thexp1 = "0";
}

$remaining = $thexp1;
$skill_name = "woodcutting";
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
$("#action_players").load("everything.php", { p:29, id:<?php echo "$id"; ?>, skill:<?php echo "$skill_name"; ?> });
}
else
	{
		document.getElementById('txt').value = timer;
		time = setTimeout(countTime,500);
		
	}
}

function success_fail(req,cur){
var n = Math.random();
var sub = cur - req;
var dec = "0.6";
var sub2 = dec + sub;

if(n <= sub2){
getRandomInt(<?php echo $min_amount; ?>, <?php echo $max_amount; ?>);

<?php
if($gcount2 != 0){
?>
droppedItems(<?php echo $drop_min_amount; ?>, <?php echo $drop_max_amount; ?>);
<?php
}
?>

}else{
var gained = "<b>You failed to chop any <?php echo $item_name; ?>.</b><br>";
document.getElementById('gained_item').innerHTML = gained;

other2(<?php echo $id; ?>,<?php echo $fail_exp; ?>);
addsomeExp(<?php echo $fail_exp; ?>);
}

}

function getRandomInt(min, max) {

var number = Math.floor(Math.random() * (max - min + 1)) + min;

if(number == "1"){
var gained = "<b>You chopped one <?php echo $item_name; ?>.</b><br>";
}else if(number == "2"){
var gained = "<b>You chopped two <?php echo $item_name; ?>s.</b><br>";
}
  
document.getElementById('gained_item').innerHTML = gained;
addTotal(number);
other(<?php echo $id; ?>,number);
addsomeExp(<?php echo $gained_exp; ?>);
 
}



function droppedItems(min, max) {
var number = Math.floor(Math.random() * (max - min + 1)) + min;
if(number == "0"){
var gained = "";
}else if(number == "1"){
var gained = "<i>One <?php echo $drop_item_name; ?> has fell from the branches of the tree you chopped down.</i><br>";
dropped(<?php echo $id; ?>,number);
}else if(number == "2"){
var gained = "<i>Two <?php echo $drop_item_name; ?>s has fell from the branches of the tree you chopped down.</i><br>";
dropped(<?php echo $id; ?>,number);
}
document.getElementById('dropped_item').innerHTML = gained;

}

function dropped(id,drop){
        $.post("everything.php", { p:23, aid:id, drop:drop },
			function(data) {
				eval(data);
			});
}

function other2(id,fail_exp){

        $.post("everything.php", { p:25, aid:id, exp:fail_exp },
			function(data) {
				eval(data);
			});

}

function other(id,num_logs){

        $.post("everything.php", { p:22, aid:id },
			function(data) {
				eval(data);
			});
	$.post("everything.php", { p:12, aid:id, num:num_logs },
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
document.getElementById("woodcutting_exp2").innerHTML = total2;

var total7 = atotal + " Remaining Exp";
document.getElementById("woodcutting_exp3").innerHTML = total7;

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
document.getElementById("woodcutting_level").innerHTML = exc;
update_menu(<?php echo $player_location; ?>);
subExp2(exc,exp_b);

var message = "You have advanced a Woodcutting level (" + exc + ").";
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
document.getElementById("woodcutting_exp3").innerHTML = total2;


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

<span class="other" style="color:orange;" id="dropped_item"></span>
<span class="other" id="gained_item"><b>You start chopping at the tree.</b><br></span>

<span class="other">
You have <b>
<span><span id="item_suchs"><?php 


if($gcount != 0){
echo "$item3[count]";
}else{
echo "0";
}


?></span></span>
<?php 


if($item_count == 1){
echo "$item_name"; 
}else{
echo "$item_name";
echo "s";
}


?></b>.
</span>

<br> 

<span class="other">Woodcutting Level: <span id="level"><?php echo "$level"; ?></span> [ <span id="exp"><?php echo "$exp"; ?></span> Exp / <span id="remaining"><?php echo "$remaining"; ?></span> Remaining Exp ]

</span>

<span class="other">
<?php
$sql33 = "SELECT count(action_id) AS tnew2 FROM `users` WHERE `action_id` = '$id'";
$res33 = mysql_query($sql33) or die(mysql_error());
$row23 = mysql_fetch_assoc($res33);

$players_number = $row23['tnew2'] - 1;

if($players_number == 0){
echo "<br>You are woodcutting alone today.";
}else{
echo "<br>You are woodcutting along with $players_number others.";
}
?>
</span>

<?php

}else{
echo "<span style=\"color:Orange;\"><b>You do not have the required level to complete this action.</b></span>";
}
}else{
echo "<span style=\"color:Orange;\"><b>You need to be at the correct location for this action.</b></span>";
}
}
}
?>