<?php

session_start();
include 'mysql.php';
include 'core/init.php';


if(empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter a username and password in to continue.';
	} elseif(user_exists($username) === false) {
		$errors[] = 'We can\'t find that username. Have you registered?';
	} 
}if(empty($errors) === false) {
?>
        <h2>We tried to log you in, but our evil chicken is saying...</h2>
<?php

	echo output_errors($errors);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fallout Chronicle</title>
</head>
<link rel="stylesheet" href="log.css" type="text/css">
<link rel="shortcut icon" href="newfc-favicon.png" />
<body>
		<div class="Contemp">
        	<table id="Intemp">
            	<td id="inHeader">
                <img src="FC.png" class="image" />
                </td>
                	<tr>
                    	<td id="logDet">
                        	<table>
                            	<td id="text">
                                 <form action="access.php" method="post">
			<ul id="login">
				<li>
				    Username
				    <input class="input" type="text" name="username">
				</li>
				<li>
				    Password
				    <input class="input" type="password" name="password">
				</li>
				<li>
					<input class="submit" type="submit" value="force(Enter);">
				</li>
			</ul>
		</form>
                                        </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
            </table>
        </div>
</body>
</html>