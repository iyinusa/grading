<?php
	//load common files
	include("../design/conn.php");
	
	if(isset($_SESSION['g_role']))
	{
			
	} else
	{
		header("location: ../index.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grading System | Profile</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="ahome">
        	<?php include('../design/header.php'); ?>
        </div>
        
        <div id="eis_logview">
        	<?php include('../design/logview.php'); ?>
        </div>
        
        <div id="eis_contents">
        	<div id="eis_banner">
            	<?php include('../design/banner.php'); ?>
            </div>
            
            <div>
            	<div id="eis_home">
                	<div id="eih_left">
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">Profile</div>
                        <table style="width:100%;">
                        	<tr>
                            	<td width="120px">
                                	<b>Registered On:</b>
                                </td>
                                <td>
                                	<?php echo $_SESSION['g_reg']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<b>Username:</b>
                                </td>
                                <td>
                                	<?php echo $_SESSION['g_mem']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<b>Phone:</b>
                                </td>
                                <td>
                                	<?php echo $_SESSION['g_phone']; ?>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<b>Email:</b>
                                </td>
                                <td>
                                	<?php echo $_SESSION['g_email']; ?>
                                </td>
                            </tr>
                        </table>
                 	</div>
                    <div id="eih_right">
                    
                    </div>
             	</div>
            </div>
        </div>
        
        <div id="eis_footer">
        	<?php include('../design/footer.php'); ?>
        </div>
    </div>
</body>
</html>