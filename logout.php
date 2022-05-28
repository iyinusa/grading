<?php
	//load common files
	include("design/conn.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grading System | LogOut</title>
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
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">Log Out</div>
                        <?php
							session_destroy();
							
							echo '<h3>You have been logged out of the system</h3>';
						?>
                        <a href="index.php">Continue</a>
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