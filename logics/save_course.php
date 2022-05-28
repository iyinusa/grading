<?php
	//connect database
	include('../design/conn.php');
	
	$msg = '';
	
	//declare variables
	$r_id = $_POST['r_id'];
	$r_level = $_POST['r_level'];
	$r_code = $_POST['r_code'];
	$r_semester = $_POST['r_semester'];
	$r_title = $_POST['r_title'];
	$r_unit = $_POST['r_unit'];;
	
	if(!$r_level || !$r_code || !$r_title || !$r_unit || !$r_semester)
	{
		$msg = '<div class="msg">All fields are required</div>';
	} else
	{
		//check redundancy
		if(mysql_num_rows(mysql_query("SELECT * FROM p_course WHERE course_level='$r_level'  AND course_semester='$r_semester' AND course_code='$r_code' AND course_title='$r_title' LIMIT 1")) > 0)
		{
			if($r_id)
			{
				if(mysql_query("UPDATE p_course SET course_level='$r_level',course_code='$r_code',course_semester='$r_semester',course_title='$r_title',course_unit='$r_unit' WHERE course_id='$r_id' LIMIT 1"))
				{
					$msg = '<div class="msg">Course Updated Successfully. <a href="courses.php">REFRESH</a></div>';
				} else
				{
					$msg = '<div class="msg">Course Update Failed! - Try Again</div>';
				}
			} else
			{
				$msg = '<div class="msg">Course Already Added</div>';
			}
		} else
		{
			//save student to database
			if(mysql_query("INSERT INTO p_course (course_level,course_code,course_semester,course_title,course_unit) VALUES ('$r_level','$r_code','$r_semester','$r_title','$r_unit')"))
			{
				$msg = '<div class="msg">Course Added Successfully</div>';	
			} else
			{
				$msg = '<div class="msg">Failed! - Try Again</div>';
			}
		}
	}
	
	echo $msg;
?>