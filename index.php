<?php
	//load common files
	include("design/conn.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grading System | Computer Science</title>
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
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">Computer Based Result Management Information System</div>
                        This is an automated system to Prepare, Update, Retrieve, and Monitory Results, Lagos State Polytechnic Students Grading.<br /><br />
                        <div style="overflow:auto; border-top:1px solid #eee;">
                        	<div style="float:left; width:310px; height:260px;">
                            	<div style="padding:10px;">
                                    <div style="font-size:xx-large; color:#036; margin-bottom:10px;">Course Registration</div>
                                    <img alt="" src="images/registration.jpg" style="width:100%; height:145px;" /><br /><br />
                                    Courses are carefully prepared for students to register for their respective course
                                </div>
                            </div>
                            <div style="float:left; width:310px; border-left:1px solid #eee; height:260px;">
                            	<div style="padding:10px;">
                                	<div style="font-size:xx-large; color:#036; margin-bottom:10px;">Online Grading</div>
                                    <img alt="" src="images/result.jpg" style="width:100%; height:145px;" /><br /><br />
                                    Students results are prepared online for students to promptly check results updates
                                </div>
                            </div>
                        </div>
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