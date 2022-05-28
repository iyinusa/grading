<?php
	//load common files
	include("../design/conn.php");
	
	if(isset($_SESSION['g_role']))
	{
		$g_role = $_SESSION['g_role'];
		if($g_role == "Admin" || $g_role == "Lecturer")
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
<title>Grading System | Manage Results</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="aps">
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
                	<div id="eih_left">
                    	<div style="font-size:xx-large; color:#036; margin:10px 0px;">Manage Result</div>
						<?php include('../logics/load_results.php'); ?>
                        <fieldset>
                            <legend style="font-size:24px;">Make Selection</legend>
                            <br />
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                <table class="stable">
                                    <tr>
                                        <td>
                                            Session:<br />
                                            <select id="r_session" name="r_session">
                                                <option value=""></option>
                                                <option value="2012/2013">2012/2013</option>
                                                <option value="2013/2014">2013/2014</option>
                                                <option value="2014/2015">2014/2015</option>
                                                <option value="2015/2016">2015/2016</option>
                                                <option value="2016/2017">2016/2017</option>
                                                <option value="2017/2018">2017/2018</option>
                                                <option value="2018/2019">2018/2019</option>
                                                <option value="2019/2020">2019/2020</option>
                                            </select>
                                        </td>
                                        <td>
                                            Semester:<br />
                                            <select id="r_semester" name="r_semester">
                                                <option value=""></option>
                                                <option value="First Semester">First</option>
                                                <option value="Second Semester">Second</option>
                                            </select>
                                        </td>
                                        <td>
                                            Level:<br />
                                            <select id="r_level" name="r_level">
                                                <option value=""></option>
                                                <option value="ND I">ND I</option>
                                                <option value="ND II">ND II</option>
                                                <option value="ND III">ND III</option>
                                                <option value="HND I">HND I</option>
                                                <option value="HND II">HND II</option>
                                                <option value="HND III">HND III</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" name="btnLoad" value="Load All Courses" style="padding:10px 20px;" />
                                        </td>
                                    </tr>
                                </table>
                        	</form>
                        </fieldset>
                        <br />
                        <div id="load_course">
                            <?php echo $each_c; ?>
                        </div>
                    </div>
                    <div id="eih_right">
                    	<div style="font-size:xx-large; color:#036; margin:10px 0px;">== Results ==</div>
                        <div style="overflow:auto; min-height:600px;">
							<?php echo $prepare; ?>
                        </div>
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