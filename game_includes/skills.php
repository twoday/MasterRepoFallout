<?php
session_start();
include("../core/database/connect.php");
// KEBB CHANGE //
include_once("../game_includes/functions.php");

$check = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$_SESSION[user_id]' LIMIT 1") or die('Error');
$userinfo = mysql_fetch_array($check);

$q = mysql_query("SELECT * FROM `player_skill` WHERE `player_id` = '$userinfo[user_id]'") or die(mysql_error());
	while ($row = mysql_fetch_assoc($q)) {
		$uskill = $row['skill_name'];
		$uexp = $row['exp'];
		
	
		IF ($uskill == "Fishing") {
			$fishing_exp = $uexp;
			$fishing_level = calculateLevel($uexp);
			$fishing_next = calculateNextLevel($fishing_level, $uexp);
		}
		IF ($uskill == "Mining") {
			$mining_exp = $uexp;
			$mining_level = calculateLevel($uexp);
			$mining_next = calculateNextLevel($mining_level, $uexp);
		}
		IF ($uskill == "Woodcutting") {
			$woodcutting_exp = $uexp;
			$woodcutting_level = calculateLevel($uexp);
			$woodcutting_next = calculateNextLevel($woodcutting_level, $uexp);
		}	
	    IF ($uskill == "Speed") {
			$speed_exp = $uexp;
			$speed_level = calculateLevel($uexp);
			$speed_next = calculateNextLevel($speed_level, $uexp);
		}
		IF ($uskill == "Alchemy") {
			$alchemy_exp = $uexp;
			$alchemy_level = calculateLevel($uexp);
			$alchemy_next = calculateNextLevel($alchemy_level, $uexp);
		}
		IF ($uskill == "Blacksmithing") {
			$blacksmithing_exp = $uexp;
			$blacksmithing_level = calculateLevel($uexp);
			$blacksmithing_next = calculateNextLevel($blacksmithing_level, $uexp);
		}
		IF ($uskill == "Combat") {
			$combat_exp = $uexp;
			$combat_level = calculateLevel($uexp);
			$combat_next = calculateNextLevel($combat_level, $uexp);
		}
		IF ($uskill == "Construction") {
			$construction_exp = $uexp;
			$construction_level = calculateLevel($uexp);
			$constructin_next = calculateNextLevel($construction_level, $uexp);
		}
		IF ($uskill == "Gathering") {
			$gathering_exp = $uexp;
			$gathering_level = calculateLevel($uexp);
			$gathering_next = calculateNextLevel($gathering_level, $uexp);
		}
		IF ($uskill == "Hunting") {
			$hunting_exp = $uexp;
			$hunting_level = calculateLevel($uexp);
			$hunting_next = calculateNextLevel($hunting_level, $uexp);
		}
		IF ($uskill == "Cooking") {
			$cooking_exp = $uexp;
			$cooking_level = calculateLevel($uexp);
			$cooking_next = calculateNextLevel($cooking_level, $uexp);
		}
		IF ($uskill == "Magic") {
			$magic_exp = $uexp;
			$magic_level = calculateLevel($uexp);
			$magic_next = calculateNextLevel($magic_level, $uexp);
		}
		IF ($uskill == "Tailoring") {
			$tailoring_exp = $uexp;
			$tailoring_level = calculateLevel($uexp);
			$tailoring_next = calculateNextLevel($tailoring_level, $uexp);
		}
	
	}

	
	$skills_array = array("alchemy", "blacksmithing", "combat", "construction", "cooking", "fishing", "gathering", "hunting", "magic", "mining", "speed", "tailoring", "woodcutting");
	sort($skills_array);
	


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
	<?php
		for ($i = 0; $i < count($skills_array); $i++) {
			$theskill = $skills_array[$i];
			$theexp = $theskill."_exp"; $theexp = $$theexp;
			$thelevel = $theskill."_level"; $thelevel = $$thelevel;
			$rexp = $theskill."_next"; $rexp = $$rexp;
						
			
				?>
					<div class="skill" id="<?php echo $theskill; ?>" style="cursor:pointer;"><?php echo ucfirst($theskill); ?>: <span id="<?php echo $theskill; ?>_level"><?php echo $thelevel; ?></span></div>
					<div class="skill" id="<?php echo $theskill; ?>_exp" style="display: none; font-size:12px;font-weight:bold;margin-left:15px;cursor:pointer;">
					<span id="<?php echo $theskill; ?>_exp2">Exp <?php echo $theexp; ?></span> / 
					<span id="<?php echo $theskill; ?>_exp3"><?php echo $rexp; ?> Remaining Exp</span></div> 

				<?php
	
	
		}
	?>