<?php
	//connect database
	include('../design/conn.php');
	
	$msg = '';
	
	//declare variables
	$add = $_POST['add'];
	$user_id = $_SESSION['g_id'];
	
	if (count($_POST['add']) <= 1)
	{
		$msg = '<div class="msg">You have not selected any course(s) above<br />'.$add.'</div>';
	} else
	{
		if (!empty($add))
		{
			foreach($_POST['add'] as $add)
			{
				//check redundancy
				if(mysql_num_rows(mysql_query("SELECT * FROM p_mycourse WHERE user_id='$user_id'  AND course_id='$add' LIMIT 1")) > 0)
				{
					//if(mysql_query("UPDATE p_mycourse SET course_level='$r_level',course_code='$r_code' WHERE course_id='$r_id' LIMIT 1"))
					//{
						//$msg = '<div class="msg">Course Updated Successfully. <a href="courses.php">REFRESH</a></div>';
					//} else
					//{
						//$msg = '<div class="msg">Course Update Failed! - Try Again</div>';
					//}
				} else
				{
					//save student to database
					if(mysql_query("INSERT INTO p_mycourse (user_id,course_id) VALUES ('$user_id','$add')"))
					{
						$msg = '<div class="msg">Course(s) Added Successfully</div>';	
					} else
					{
						$msg = '<div class="msg">Failed! - Try Again</div>';
					}
				}
			}
		}
	}
	
	echo $msg;
?>