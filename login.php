<?php
	//load common files
	include("design/conn.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grading System | Log In</title>
<link rel="stylesheet" type="text/css" href="styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="ahome">
        	<?php include('design/header.php'); ?>
        </div>
        
        <div id="eis_logview">
        	<?php include('design/logview.php'); ?>
        </div>
        
        <div id="eis_contents">
        	<div id="eis_banner">
            	<?php include('design/banner.php'); ?>
            </div>
            
            <div>
            	<div id="eis_home">
                	<div id="eih_left">
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">Student Log In >></div>
                        <b><u>PLEASE LOGIN HERE</u></b><br /><br />  
						<?php include('logics/login.php'); ?> 
                         <form action="login.php" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td colspan="2">If you are a Lecturer, please <a href="l_login.php">Click Here</a> to Login</td>
                                </tr>
                                <tr>
                                    <td><b>Username:</b></td>
                                    <td>
                                        <input type="text" name="l_name" style="width:50%;" placeholder="Username..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Password:</b></td>
                                    <td>
                                        <input type="password" name="l_pass" style="width:50%;" placeholder="Password..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="btnLogin" value="Login Here >>" />
                                    </td>
                                </tr>
                          	</table>
                        </form>
                    </div>
                    <div id="eih_right">
                    
                    </div>
                </div>
            </div>
        </div>
        
        <div id="eis_footer">
        	<?php include('design/footer.php'); ?>
        </div>
    </div>
</body>
</html>