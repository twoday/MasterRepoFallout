<?php
include '../core/database/connect.php';
session_start();

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);
$userid = $userinfo['user_id'];
$player_location = $userinfo['location_id'];

$select7 = "SELECT * FROM `moving_actions`";
$select_resutlts7 = mysql_query($select7) or die(mysql_error());
while($row1 = mysql_fetch_assoc($select_resutlts7)){
$id = $row1['id'];
$id2 = $row1['move_too'];
$location_id = $row1['from'];

if(isset($_POST['id'])) { $type = $_POST['id']; } else { $type = $_GET['id']; }

if($type == $id){

if($player_location == $location_id){



	$query = mysql_query("SELECT * FROM `player_skill` WHERE `player_id` = '$userid' AND `skill_name` = 'Speed'");	
		$row = mysql_fetch_assoc($query);
			$level = $row['level'];
			$exp = $row['exp'];
			
	$query2 = mysql_query("SELECT * FROM `moving_actions` WHERE `id` = '$id'");	
		$row2 = mysql_fetch_assoc($query2);
			$gained_exp = $row2['exp'];
			$location = $row2['Location'];
			
	$thexp1 = floor( ($level/2) * pow( floor(($level*5)) , 2)) - $exp;

		if($thexp1 <= 0){
			$thexp1 = "0";
		}		
	$remaining = $thexp1;

$time = $row1['base_timer'];
?>


<script type="text/javascript">

window.onload = startTimer(<?php echo "$time"; ?>);

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
         update_menu(<?php echo "$id2"; ?>);
		 update_main(<?php echo "$id2"; ?>);
		 other(<?php echo "$id"; ?>);
		 addsomeExp(<?php echo $gained_exp; ?>);
		
	}
	else
	{
		document.getElementById('txt').value = timer;
		time = setTimeout(countTime,500);
	}
}

function other(id){
$.post("game_includes/update_speed.php", { id: id} );
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
document.getElementById("speed_exp2").innerHTML = total2;

var total7 = atotal + " Remaining Exp";
document.getElementById("speed_exp3").innerHTML = total7;

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
document.getElementById("speed_level").innerHTML = exc;
subExp2(exc,exp_b);

var message = "You have advanced a Speed level.";
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
document.getElementById("speed_exp3").innerHTML = total2;


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
	


</script>

<?php




?>

<div id="cencontent"></div><br>

<?php

echo "<span class=\"speed\">You are currently travelling to <b>$location</b> and will gain <b>$gained_exp</b> exp.</span>";
?>
<br> <span class="other">Speed Level: <span id="level"><?php echo "$level"; ?></span> [ <span id="exp"><?php echo "$exp"; ?></span> Exp / <span id="remaining"><?php echo "$remaining"; ?></span> Remaining Exp ]

<br><br><a class="link" onclick="update_main(<?php echo "$userinfo[location_id]"; ?>);">Turn Around</a>
<?php

}else{
echo "<span style=\"color:Orange;\"><b>You need to be at the correct location for this action.</b></span>";
}
}
}
?>
