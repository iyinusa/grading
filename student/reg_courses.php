<?php
	//load common files
	include("../design/conn.php");
	
	if(isset($_SESSION['g_role']))
	{
		$g_role = $_SESSION['g_role'];
	} else
	{
		header("location: ../index.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registered Courses/Check Results</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="arp">
        	<?php include('../design/header.php'); ?>
        </div>
        
        <div id="eis_logview">
        	<?php include('../design/logview.php'); ?>
        </div>
        
        <div id="eis_contents">
        	<!--<div id="eis_banner">
            	<?php include('../design/banner.php'); ?>
            </div>-->
            
            <div>
            	<div id="eis_home">
                	<br />
                    <fieldset>
                        <legend style="padding:1px 20px; border:1px solid #ccc;">
                        	<div style="font-size:xx-large; color:#036; margin:10px 0px;">Courses Lists</div>
                       	</legend>
                        <?php include('../logics/course_list.php'); ?>
                    </fieldset>
                    <br /><br />
                    <fieldset>
                       	<legend style="padding:1px 20px; border:1px solid #ccc;">
                        	<div style="font-size:xx-large; color:#036; margin:10px 0px;">My Registered Courses/Results</div>
                      	</legend>
                      	<?php include('../logics/my_course_list.php'); ?>
                    </fieldset>
             	</div>
            </div>
        </div>
        
        <div id="eis_footer">
        	<?php include('../design/footer.php'); ?>
        </div>
    </div>
</body>
</html>