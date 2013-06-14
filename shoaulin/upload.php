<?php

/**
 * @author NepsterJay
 * @copyright 2013
 */

$target_path = "../" . $_POST['folder'] . "/";
if($_POST['password'] == "b14_3141628") {
	$target_path = $target_path . basename($_FILES['uploadedfile']['name']);

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		echo "The file " . basename($_FILES['uploadedfile']['name']) .
			" has been uploaded";
	} else {
		echo "There was an error uploading the file, please try again!";
	}
}else {
    die("Wrong password");
}
?>