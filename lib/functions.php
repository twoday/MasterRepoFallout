<?php
	function calculateWeight($ounces) {
		$pounds = floor($ounces / 16);
		$ounces = $ounces - ($pounds * 16);
		
		return array($pounds, $ounces);
	}
?>