<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fallout Chronicle</title>
</head>
<style>
	.Contemp{
		position:absolute;
		top:125px;
		left:250px;
		right:250px;
		width:400px;
		border:none;
		vertical-align:top;
		background-color:#FFF;
		border-radius:14px;
	}
	#Intemp{
		height:100%;
		width:100%;
		border:none;
		vertical-align:top;
	}
	#inHeader{
		width:100%;
		text-align:center;
		vertical-align:top;
	}
	#logDet{
		height:50px;
		width:100%;
		vertical-align:top;
		text-align:center;
	}
	.image{
		height:175px;
		width:375px;
		border:none;
	}
	#text{
		font-family:"Courier New", Courier, monospace;
		font-size:20px;
	}
	.submit{
		height:30px;
		width:200px;
		background-color:#FFF;
		border:1px solid #000;
		font-family:"Courier New", Courier, monospace;
		font-size:20px;
	}
	.input{
		border:1px solid #000;
		background-color:#FFF;
		height:25px;
	}
	  ul {
        padding:10;
        margin:0;
        list-style:none;
	  }
	ul li {
        padding:10px 0;
    }
    ul li input[type="text"], ul li input[type="password"] {
        width:200px;
    }
	
	textarea{
		width:400px;
		height:150px;
	}
</style>
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
                                 <form action="login.php" method="post">
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