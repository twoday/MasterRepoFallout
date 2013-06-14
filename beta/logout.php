<?php
session_start();
include("mysql.php");
session_destroy();
header("Refresh: 0; url=\"index.php\"");
?>