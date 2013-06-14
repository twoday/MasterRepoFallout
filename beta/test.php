<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fallout Chronicle</title>
<link rel="shortcut icon" href="../favicon.png" />
</head>
<style type="text/css">
html, body {
	height:98%;
	margin:0;
	padding:0;
	}	
body{
	background-color:#111;
	background-image:url(../fc-background.png);
	height:100%;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#d9e1f8;
}
#outer-box{
	border:none;
	width:99%;
	height:100%;
	padding:4px;
	
}
#iconlisthold{
	height:100%;
	vertical-align:top;
}
#innerhold{
	height:100%;
	width:100%;
}
#userinfo{
	height:100%;
	width:99%;
	border:none;
	vertical-align:top;
}
.iconlist{
	width:100%;
	height:100%;
	border:1px solid #333;
	background-color:#111;
}
#interaction{
	border:1px solid #333;
	width:16%;
	height:45%;
	vertical-align:top;
}
#townactivity{
	border:1px solid #333;
	width:16%;
	height:45%;
	vertical-align:top;
}
#actiontimer{
	border:1px solid #333;
	width:100%;
	height:45%;
}
#players{
	border:1px solid #333;
	height:50%;
	vertical-align:top;
}
#chatback{
	border:1px solid #333;
	height:52%;
	width:100%;
}
#chatlog{
	overflow:auto;
	height:320px;
	width:100%;
	min-height:100%;
}
#channels{
	height:20px;
	width:100%;
	float:inherit;
	text-align:center;
}
.chatmsg{
	  width:99%;
	  background-color:#0a0909;
	  border:1px solid #333;
	  height:25px;
	  padding-top:1px;
          padding-left:4px;
          padding-bottom:4px;
          vertical-align:top;
          margin-top:4px;
		  margin-left:2px;
  }
#chatmsg{
	width:99%;
background-color:#0a0909;
border:1px solid #333;
color:#d9e1f8;

}
#Submit{
	  background-color:#111;
	  font-weight:bold;
	  font-family:Arial, Helvetica, sans-serif;
	  font-size:13px;
	  color:#2276f4;
	  margin-top:5px;
	  margin-right:2px;
	  border:none;
  }
.clock{
	color:#D9E1F8;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
}
  .world {
color:#d9e1f8;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}

.guild {
color:#4CC417;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}

.help {
color:#FFF380;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}

.trade {
color:#8D38C9;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}

.tutorial {
color:#43BFC7;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
.admin{
color:#ea0606;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
.server{
color:yellow;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
.StaffChat{
color:#ADA96E;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
.mod{
color:#065cea;
cursor:pointer;
font-weight:bold;
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
}
.links{
	color:#d9e1f8;
	font-family:Arial, Helvetica, sans-serif;
	text-decoration:none;
	font-weight:bold;
	font-size:13px;
}
#playhead{
	float:top;
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	font-weight:bold;
}
#playlist{
	float:top;
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	border:1px solid #333;
	height:94%;
	overflow:auto;
}
#townhead{
	float:top;
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	font-weight:bold;	
}
#townactions{
	float:top;
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	border:1px solid #333;
	height:93%;
	overflow:auto;
}
#interhead{
	float:top;
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	font-weight:bold;
}
#interact{
	float:top;
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	border:1px solid #333;
	height:93%;
	overflow:auto;
}
</style>
<body>
<div id="outer-box">
	<table id="innerhold">
		<td id="iconlisthold">
            	<table>
                	<td>
                    	<a href="#" title="Character Panel">
                        <img src="../fc-charinfo.png" border="0" /></a>
                    </td>
                        <tr>
                			<td>
                           <a href="#" title="Inventory">
                    	<img src="../fc-inventory.png" border="0" /></a>
                   			</td>
                    	</tr>
                        <tr>
                			<td>
                         <a style="cursor:pointer;" onclick="map();" title="Map">
                    	<img src="../fc-map.png" border="0" /></a>
                    		</td>
                    	</tr>
                		<tr>
                			<td>
                         <a href="#" title="Messages">
                    	<img src="../message-new.png" border="0" /></a>
                    		</td>
                    	</tr>
                    	<tr>
                        	<td>
                         <a style="cursor:pointer;" id="innerlinks" onclick="guild(1);" title="Guild">
                        <img src="../fc-guild.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                			<td>
                         <a href="/manual" title="Manual">
                    	<img src="../fc-manual.png" border="0" /></a>
                    		</td>
                    	</tr>
                        <tr>
                        	<td>
                         <a href="#" title="Quests">
                        <img src="../fc-quest.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                          <a href="#" title="System Notifications">
                        <img src="../fc-notification-icon.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                         <a href="/forum" title="Forum">
                        <img src="../fc-forum.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                         <a style="cursor:pointer;" onclick="settings();" title="Game Settings">
                        <img src="../fc-settings-icon.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                         <a style="cursor:pointer;" onclick="admin_panel();" title="Administration Panel">
                        <img src="../fc-admin.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                        <a href="logout.php" title="Logout">
                        <img src="../fc-logout.png" border="0" /></a>
                            </td>
                        </tr>
                        <tr>
                        	<td id="clock">
                            <span id="clockDisplay" class="clock">
    </span>
                            </td>
                        </tr>
                </table>
        </td>
        <td id="userinfo">
        	<table width="100%" height="100%">
            	<td id="interaction">
                <div id="interhead">
                <img src="../newsfeed-fc.png" border="0" />
                </div>
                <div id="interact">
                </div>
                </td>
                <td id="townactivity">
                <div id="townhead">
                <img src="../townactivity-fc.png" border="0" />
                </div>
                <div id="townactions">
                </div>
                </td>
                <td id="actiontimer">
                </td>
                    <tr>
                    <td id="players" rowspan="3">
                    <div id="playhead">
                    <img src="../onlineplayers-fc.png" border="0" />
                    </div>
                    <div id="playlist">
                    </div>
                    </td>
                    	<td id="chatback" colspan="3">
                        	<table width="100%" height="100%">
                            	<td height="90%">
                        <div class="back" id="chatlog">

</div>
								</td>
                                	<tr>
                                    	<td>
						<div class="back" id="channels">
                        <input type="submit"  style="cursor:pointer;" value="Send" id="Submit" onClick="Tie.writeChat();">
                         <span class="other">
Channel:

<span class="change" id="change"><script type="text/javascript">channel('1');</script></span>

&mdash;
<span class="world" onclick="channel(1)">World </span> - <span class="guild" onclick="channel(2)">Guild </span> - <span class="help" onclick="channel(3)">Help </span> - <span class="trade" onclick="channel(4)">Trade </span> - <span class="tutorial" onclick="channel(5)">Tutorial</span> - <span class="admin" onclick="channel(6)">Admin</span> - <span class="mod" onclick="channel(7)">Mod</span> - <span class="server" onclick="channel(8)">Server</span> - <span class="StaffChat" onclick="channel(9)">Staff</span> - <a class="links" target="_blank" href="manual/commands">Commands</a> - <a class="links" target="_blank" href="manual/chathistory">History</a></center>
</span>	         
                        </div>
                        		</td>
                                	</tr>
                                    <tr>
                                <td>
                        <div class="chatinput">
                         <input type="text" id="chatmsg" class="chatmsg" onkeyup="Tie.filterChat(event.keyCode);" maxlength="255">
</div>
                        </td>
                    </tr>
                    </table>
            </table>
        </td>
	</table>
</div>
</body>
 <script type="text/javascript" language="javascript">
function renderTime() {
 
 var currentTime = new Date();
 var h = currentTime.getUTCHours();
 var m = currentTime.getUTCMinutes();
 var s = currentTime.getUTCSeconds();
 if(h < 10){
    h = "0" + h;
 }
 
 if (m < 10) {
  m = "0" + m;
 }
 if (s < 10) {
  s = "0" + s;
 }  
 var myClock = document.getElementById('clockDisplay');
 myClock.textContent = h + ":" + m + ":" + s;
 myClock.innerText = h + ":" + m + ":" + s;
 setTimeout('renderTime()',1000);
}
renderTime();
</script>
</html>