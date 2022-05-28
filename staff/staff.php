<?php
	//load common files
	include("../design/conn.php");
	
	if(isset($_SESSION['pms_role']))
	{
		$pms_role = $_SESSION['pms_role'];
		if($pms_role == "Doctor")
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
<title>PMS | Staff</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="asr">
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
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">PMS Staff</div>
                        <?php include('../logics/staff.php'); ?>
                        
                 	</div>
                    <div id="eih_right">
                   		<div style="font-size:xx-large; color:#036; margin:10px 0px;">== Registered ==</div>
                  		<?php include('../logics/v_reg_patients.php'); ?>
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