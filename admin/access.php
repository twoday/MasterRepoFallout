<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fallout Chronicle</title>
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link rel="shortcut icon" href="newfc-favicon.png" />
  <script>
  $(document).ready(function() {
    $("#draggable").draggable();
  });
  </script>
</head>
		<style>
		    html, body {
				height:99%;
				width:99%;
				margin:3px;
				padding:0;
				}
			body{
				background-color:#111;
				height:99%;
			}
			#container{
				border:1px solid #309;
				width:99%;
				height:99%;
				padding:5px;
				color:#d9e1f8;
				margin:3px;
			}	
			#playerChat{
				height:250px;
				width:700px;
				border:1px solid #309;
				background-color:#111;
				position:absolute;
				bottom:25px;
				left:30%;
				right:35%;
			}
			 #draggable{
				  width: 600px; 
				  height: 250px; 
				  background: #111; 
				  border:1px solid #d9e1f8;
				  position:absolute;
				  right:20px;
				  }
			 .chatmsg{
	 			 width:91%;
	 			 background-color:#111;
	 			 border:1px solid #309;
	 			 height:17px;
	 			 padding-top:1px;
         		 padding-left:4px;
         		 padding-bottom:4px;
        		 vertical-align:top;
          		 margin-top:2px;
  				}
				.termmsg{
	 			 width:91%;
	 			 background-color:#111;
	 			 border:1px solid #16233b;
	 			 height:17px;
	 			 padding-top:1px;
         		 padding-left:4px;
         		 padding-bottom:4px;
        		 vertical-align:top;
          		 margin-top:2px;
  				}
  			#Submit{
	  			border:none;
	  			background-color:#111;
	  			font-family:Arial, Helvetica, sans-serif;
	  			font-size:1em;
	  			color:#d9e1f8;
  				}
  			.chatselection{
	    		border:none;
				background-color:#111;
	    		height:20px;
	  			padding:1px;
	  			width:100%;
	  			font-family:Arial, Helvetica, sans-serif;
        		font-size:17px;
  				}
 
.world {
color:#d9e1f8;
cursor:pointer;
}

.guild {
color:#4CC417;
cursor:pointer;
}

.help {
color:#FFF380;
cursor:pointer;
}

.trade {
color:#8D38C9;
cursor:pointer;
}

.tutorial {
color:#43BFC7;
cursor:pointer;
}

.admin{
color:#ea0606;
cursor:pointer;
}
.server{
color:yellow;
cursor:pointer;
}
.StaffChat{
color:#ADA96E;
cursor:pointer;
}
#innerlinks{
	font-family:Arial, Helvetica, sans-serif;
	color:#157DEC;
	text-decoration:none;
	font-size:1em;
	spacing:2px;
}
#chatmsg{
width:91%;
background-color:#0a0909;
border:1px solid #1f1f1f;
color:#d9e1f8;
}
#termmsg{
width:99%;
background-color:#0a0909;
border:1px solid #16233b;
color:#d9e1f8;
}
#chatlog{
overflow:auto;
height:187px;
width:591px;
min-height:100%;
}
#termlog{
	overflow:auto;
 	height:100%;
	width:100%;
	border:none;
}
#push{
padding-top:5px;
}
.chatlink{ 
     text-decoration:none;
     font-family:arial;
     color:#a1ff00;
     font-size:12px;

}
.chatlink:hover{
     text-decoration:underline;
}
.back{
background-color:#16233b;
width:591px;
height:100%;
padding:1px;
}
.termback{
background-color:#111;
width:591px;
height:100%;
padding:1px;
}
#terminal{
	height:96%;
	width:100%;
	border:none;
}
#terminalent{
	height:20px;
	width:100%;
	border:none;
	text-align:left;
}
		</style>
<body>
    <div id="container">
    <div id="draggable">
    	<table width="99%">
        	<td id="innercentermid" style="overflow:auto;">
                    	<div class="back" id="chatlog">

</div>
                        </td>
                    </tr>
                     <tr>
                     <td class="chatselection" style="text-align:center;">
<span class="other">
Channel:

<span class="change" id="change"><script type="text/javascript">channel('1');</script></span>

&mdash;
<?php

echo "<span class=\"world\" onclick=\"channel(1)\">World </span>";
echo " - ";
echo "<span class=\"guild\" onclick=\"channel(2)\">Guild </span>";
echo " - ";
echo "<span class=\"help\" onclick=\"channel(3)\">Help </span>";
echo " - ";
echo "<span class=\"trade\" onclick=\"channel(4)\">Trade </span>";
echo " - ";
echo "<span class=\"tutorial\" onclick=\"channel(5)\">Tutorial</span>";
if ($access_type == "100") {
echo " - ";
echo "<span class=\"admin\" onclick=\"channel(6)\">Admin</span>";
echo " - ";
echo "<span class=\"mod\" onclick=\"channel(7)\">Mod</span>";
}
if ($user_id == "1") {
echo " - ";
echo "<span class=\"server\" onclick=\"channel(8)\">Server</span>";
}
if ($user_id == "2") {
echo " - ";
echo "<span class=\"server\" onclick=\"channel(8)\">Server</span>";
}
if ($access_type == "50") {
echo " - ";
echo "<span class=\"mod\" onclick=\"channel(7)\">Mod</span>";
}
if ($access_type == "99") {
echo " - ";
echo "<span class=\"server\" onclick=\"channel(8)\">Server</span>";
}
if ($access_type == "100") {
echo " - ";
echo "<span class=\"StaffChat\" onclick=\"channel(9)\">Staff</span>";
}
if ($access_type == "50") {
echo " - ";
echo "<span class=\"StaffChat\" onclick=\"channel(9)\">Staff Chat</span>";
}
echo " - ";
echo "<a class=\"world\" target=\"_blank\" href=\"manual/commands\">Commands</a>";
echo " - ";
echo "<a class=\"world\" target=\"_blank\" href=\"manual/chathistory\">History</a>";
?>
</center>
</span>	                    </td>
                    </tr>
                    <tr>
                    	<td id="innercenterbottom">
                            <div class="chatinput">
                         <input type="text" id="chatmsg" class="chatmsg" onkeyup="Tie.filterChat(event.keyCode);" maxlength="255">
<input type="submit"  style="cursor:pointer;" value="Send" id="Submit" onClick="Tie.writeChat();">
							</div>
                        </td>
                    </tr>
       </table>
    
    </div>
    <div id="terminal">
    <div class="termback" id="termlog">

</div>
    </div>
    <div id="terminalent">
     <input type="text" id="termmsg" class="termmsg" onkeyup="Tie.filterChat(event.keyCode);" maxlength="400">
    </div>
</div>
</body>
</html>