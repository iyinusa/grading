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
<title>Available Results</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="amr">
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
                	<div style="font-size:xx-large; color:#036; margin:10px 0px;">Available Results</div>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
						<?php include('../logics/student_results.php'); ?>
                        <table>
                        	<tr>
                            	<!--<td>
                                	Session:&nbsp;
                                    <select name="r_session">
                                    	<option value="">Session...</option>
                                        <option value="2012/2013">2012/2013</option>
                                        <option value="2013/2014">2013/2014</option>
                                        <option value="2014/2015">2014/2015</option>
                                        <option value="2015/2016">2015/2016</option>
                                        <option value="2016/2017">2016/2017</option>
                                        <option value="2017/2018">2017/2018</option>
                                        <option value="2018/2019">2018/2019</option>
                                        <option value="2019/2020">2019/2020</option>
                                    </select>
                                </td>-->
                                <td>
                                	Level:&nbsp;
                                    <select name="r_level">
                                        <option value="">Level...</option>
                                        <option value="ND I">ND I</option>
                                        <option value="ND II">ND II</option>
                                        <option value="ND III">ND III</option>
                                        <option value="HND I">HND I</option>
                                        <option value="HND II">HND II</option>
                                        <option value="HND III">HND III</option>
                                    </select>
                                </td>
                                <td>
                                	Semester:&nbsp;
                                    <select name="r_semester">
                                        <option value="">Semester...</option>
                                        <option value="First Semester">First Semester</option>
                                        <option value="Second Semester">Second Semester</option>
                                    </select>
                                </td>
                                <td>
                                	<input type="submit" name="btnLoad" value="Load Results" />
                                </td>
                            </tr>
                        </table>
						
						<?php echo $prepare; ?>
                    </form>
             	</div>
            </div>
        </div>
        
        <div id="eis_footer">
        	<?php include('../design/footer.php'); ?>
        </div>
    </div>
</body>
</html>