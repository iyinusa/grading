<?php
	//load common files
	include("../design/conn.php");
	
	if(isset($_SESSION['g_role']))
	{
		$g_role = $_SESSION['g_role'];
		if($g_role == "Admin")
		{
			
		} else 
		{
			header("location: profile.php");	
		}
	} else
	{
		header("location: ../index.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registered Students/Staff</title>
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
        	<div id="eis_banner">
            	<?php include('../design/banner.php'); ?>
            </div>
            
            <div>
            	<div id="eis_home">
                	<div style="font-size:xx-large; color:#036; margin:10px 0px;">Registered Students</div>
					<?php include('../logics/reg_student.php'); ?>
                    <div id="eih_left">
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">Registered Staff</div>
                        <?php include('../logics/reg_staff.php'); ?>
                    </div>
                    <div id="eih_right">
                    	<div style="font-size:xx-large; color:#036; margin:10px 0px;">Manage Role</div>
                        <?php echo $role_form ?>
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