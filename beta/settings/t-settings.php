<?php

/**
 * The database stuff ($link and the line after it) might need changed before they can be used
 * More validation should be done on the form inputs before you put this into use
 * The queries might need changed to match your table/column names
 * I think I did everything you asked but it's quite possible I missed something
 */ 
if(isset($_SESSION['id'])){
    if(isset($_POST)){
        $link = mysqli_connect("localhost", "falloutc", "7IuBW61VEh2");
        mysqli_select_db($link, "users");
        
        if(isset($_POST['submit_username'])){            
            $new_username = trim($_POST['username']);
            $length = strlen($new_username);
            
            if($length < 3){
                $error = "Username was too short, it must be at least 3 characters long";
            }else if($length >= 20){
                $error = "Username was too long, it must be less than 20 characters long";
            }else {
                $update_sql = "UPDATE `users` SET `username`=\"".$new_username."\" WHERE `id`=\"".$_SESSION['id']."\"";
                if(mysqli_query($link, $update_sql)){
                    echo "Username updated";
                    header("Refresh: 2; url='settings.php'");
                }else {
                    die("Your username could not be changed. Error: ".mysqli_error($link));
                }
            }
        }else if(isset($_POST['submit_password'])){
            $new_password = trim($_POST['password']);
            $length = strlen($new_password);
            
            if($length < 5){
                $error = "Password was too short, it must be at least 5 characters long";
            }else {
                $new_password_enc = md5($new_password);
                $update_sql = "UPDATE `users` SET `password`=\"".$new_password_enc."\" WHERE `id`=\"".$_SESSION['id']."\"";
            
                if(mysqli_query($link, $update_sql)){
                    echo "Password updated";
                    header("Refresh: 2; url='settings.php'");
                }else {
                    die("Your password could not be changed. Error: ".mysqli_error($link));
                }                
            }
        }else {
            echo "Not implemented yet.";
        }
    }    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta name="title" content="Fallout Chronicle" />
        <meta name="description" content="Fallout Chronicle is a browser text based game, with 12 skills, over hundreds of resources to collect, guilds to build, and quests to complete." />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        
        <title>Fallout Chronicle</title>
        
        <link rel="stylesheet" href="screen.css" />
        <link rel="shortcut icon" href="favicon.png" />
    </head>     
    <body>
        <header>
            <center><img src="FC.png" border="0" /></center> 
            <div class="clear"></div>
        </header>        
        <div id="container">
            <div class="conall">
                <div class="concenter">
                    <form action="settings.php" method="post">
                        <table class="dtab">
                            <tr>
                                <td colspan="4"><font size="3em"><b>Account Settings</b></font></td>
                            </tr>
                            <?php
                                if(isset($error)){
                                    echo "<tr><td><font color=\"red\">".$error."</font></td></tr>";
                                }
                            ?>
                            <tr>
                                <td width="24%">Rename Character</td>
                                <td><input class="fdi" name="Username" size="22" title="Username" value="<?php if(isset($_POST['submit_username'])){ echo $_POST['username']; } ?>" /></td>
                                <td>Costs $3 (Per)</td>
                                <td><input class="fdi" type="submit" value="Rename Character" name="submit_username" title="Change Username" /></td>
                            </tr>
                            <tr>
                                <td width="30px">Change Password</td>
                                <td><input type="password" class="fdi" name="Password" size="22" title="Password" value="<?php if(isset($_POST['submit_password'])){ echo $_POST['password']; } ?>" /></td>
                                <td><input class="fdi" type="submit"  name="submit_password" value="Change Password" title="Change Password" /></td>
                            </tr>
                            <tr>
                                <td width="30px">Rename Alias</td>
                                <td><input type="text" class="fdi" size="22" /></td>
                                <td>Costs $5 (Per)</td>
                                <td><input class="fdi" type="submit" value="Rename Alias" title="Change Alias" /></td>
                            </tr>
                            <tr>
                                <td colspan="4">When you reset your password, it will be e-mailed. The Fallout Chronicle Administration recommends you change your password every 72 days.</td>
                            </tr>
                        </table>
                        <br />
                        <table class="dtab" width="100%">
                            <tr>
                            <td colspan="3"><font size="3em"><b>Communication Settings</b></font></td>
                            </tr>
                            <tr>
                                <td><b>Chat</b></td>
                            </tr>
                            <tr>
                                <td><font color="#d9e1f8">World</font></td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable World" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable World" /></td>
                                <td>This will Enable / Disable World Channel. Administration and Whispers will still be visible.</td>
                            </tr>
                            <tr>
                                <td><font color="#4cc417">Guild</font></td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable Guild" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable Guild" /></td>
                                <td>This will Enable / Disable Guild Channel.</td>
                            </tr>
                            <tr>
                                <td><font color="#fff380">Help</font></td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable Help" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable Help" /><td>
                                <td>This will Enable / Disable Help Channel.</td>
                            </tr>
                            <tr>
                                <td><font color="#8d38c9">Trade</font></td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable Trade" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable Trade" /><td>
                                <td>This will Enable / Disable Trade Channel.</td>
                            </tr>
                            <tr>
                                <td><font color="#6da6bc">Whispers</font></td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable Whispers" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable Whispers" /><td>
                                <td>This will Enable / Disable Whispers. If you have the Whispers to Message Perk, you will not receive them.</td>
                            </tr>
                            <tr>
                                <td><b>Perks</b></td>
                            </tr>
                            <tr>
                                <td>Whispers to Messages</td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable Whispers to Messages" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable Whispers to Messages" /></td>
                                <td>This will allow your inactive (offline) whispers to be transferred to your messages once purchased.</td>
                            </tr>
                            <tr>
                                <td>Forum Avatar</td>
                                <td><input type="submit" value="Enable" class="fdi" title="Enable Forum Avatar" /></td>
                                <td><input type="submit" value="Disable" class="fdi" title="Disable Forum Avatar" /></td>
                                <td><input type="submit" value="Upload" class="fdi" title="Upload" /></td>
                            </tr>
                            <tr>
                                <td colspan="3">Avatar Size (75 x 75 Pixels) 2mb Max.</td>
                            </tr>
                            <tr>
                                <td>Forum Signature</td>
                                <td colspan="2"><input type="text" class="fdi" size="30" title="Forum Signature" /></td>
                                <td><input type="submit" class="fdi" title="Submit" value="Sumbit" /></td>
                            </tr>
                            <tr>
                                <td>Forum Signature</td>
                                <td colspan="2"><input type="text" class="fdi" size="30" title="Forum Signature" /></td>
                                <td><input type="submit" class="fdi" title="Submit" value="Sumbit" /></td>
                            </tr>
                            <tr>
                                <td>Custom Sign-in</td>
                                <td colspan="2"><input type="text" class="fdi" size="30" title="Sign-In Message" /></td>
                                <td><input type="submit" class="fdi" title="Submit" value="Sumbit" /></td>
                            </tr>
                            <tr>
                                <td>Extend Botcheck</td>
                                <td>
                                <select name="Extend" class="fdi">
                                    <option>Extend</option>
                                    <option value="1 Hour">1 Hour</option>
                                    <option value="2 Hours">2 Hours</option>             
                                </select>
                                </td>
                                <td><input type="submit" class="fdi" title="Extend" value="Extend" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <a href="/settings" class="manlinks">Settings</a>
        </div>
        <footer>
            <br />
            <center>&copy; Fallout Chronicle 2012. All rights reserved.</center>
        </footer>
    </body>
</html>
<?php
}else {
    echo "You are not logged in.";
    header("Refresh: 2; url='./game.php'");
}
?>