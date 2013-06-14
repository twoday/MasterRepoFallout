<?php

if(!mysql_connect("localhost", "falloutc_Kebb", "7IuBW61VEh2")) {
	printf("Connect failed: %s\n", mysql_error());
	exit();
}else {
     mysql_select_db("falloutc_cofrisson");
}
?>