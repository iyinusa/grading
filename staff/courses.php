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
<title>Grading System | Manage Courses</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>

<script type="text/javascript">
	function add_course(){
		// Create our XMLHttpRequest object
		var hr = new XMLHttpRequest();
		// Create some variables we need to send to our PHP file
		var r_id = document.getElementById("r_id").value;
		var r_level = document.getElementById("r_level").value;
		var r_code = document.getElementById("r_code").value;
		var r_semester = document.getElementById("r_semester").value;
		var r_title = document.getElementById("r_title").value;
		var r_unit = document.getElementById("r_unit").value;
		var r_vars = "r_level="+r_level+"&r_code="+r_code+"&r_semester="+r_semester+"&r_title="+r_title+"&r_unit="+r_unit+"&r_id="+r_id;
		hr.open("POST", "../logics/save_course.php", true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
				document.getElementById("course_status").innerHTML = return_data;
		   }
		}
		// Send the data to PHP now... and wait for response to update the status div
		hr.send(r_vars); // Actually execute the request
		document.getElementById("course_status").innerHTML = "processing...";
		//referesh
		$("#load_course").load("courses.php #load_course");
		document.getElementById("r_id").value = '';
		document.getElementById("r_level").value = '';
		document.getElementById("r_semester").value = '';
		document.getElementById("r_code").value = '';
		document.getElementById("r_title").value = '';
		document.getElementById("r_unit").value = '';
	}
</script>

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
                	<div style="font-size:xx-large; color:#036; margin:10px 0px;">Manage Courses</div>
					<?php include('../logics/load_course.php'); ?>
                    <fieldset>
                        <legend>Add New Course</legend>
                        <br />
                        <table class="stable">
                            <tr>
                                <td>
                                    <input type="hidden" id="r_id" name="r_id" value="<?php echo $up_id; ?>" />
                                    Level:<br />
                                    <select id="r_level" name="r_level">
                                        <option value="<?php echo $up_level; ?>"><?php echo $up_level; ?></option>
                                        <option value="ND I">ND I</option>
                                        <option value="ND II">ND II</option>
                                        <option value="ND III">ND III</option>
                                        <option value="HND I">HND I</option>
                                        <option value="HND II">HND II</option>
                                        <option value="HND III">HND III</option>
                                    </select>
                                </td>
                                <td>
                                    Course Code:<br />
                                    <input type="text" id="r_code" name="r_code" value="<?php echo $up_code; ?>" style="width:50px;" />
                                </td>
                                <td>
                                	Semester:<br />
                                    <select id="r_semester" name="r_semester">
                                        <option value="<?php echo $up_semester; ?>"><?php echo $up_semester; ?></option>
                                        <option value="First Semester">First</option>
                                        <option value="Second Semester">Second</option>
                                    </select>
                                </td>
                                <td>
                                    Course Title:<br />
                                    <input type="text" id="r_title" name="r_title" value="<?php echo $up_title; ?>" style="width:200px;" />
                                </td>
                                <td>
                                    Course Unit:<br />
                                    <input type="text" id="r_unit" name="r_unit" value="<?php echo $up_unit; ?>" style="width:50px;" />
                                </td>
                                <td>
                                    <input type="submit" name="btnAdd" value="Add/Update Course" onclick="add_course();" style="height:50px;" />
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <br />
                    <div id="course_status"></div>
                    <div id="load_course">
                        <?php echo $each_c; ?>
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