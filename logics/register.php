<?php
	$reg_msg = '';
	
	if(isset($_POST['btnRegister']))
	{
		$r_user = $_POST['r_user'];
		$r_pass = $_POST['r_pass'];
		$r_cpass = $_POST['r_cpass'];
		$r_session = $_POST['r_session'];
		$r_level = $_POST['r_level'];
		$r_matric = $_POST['r_matric'];
		$r_title = $_POST['r_title'];
		$r_fullname = $_POST['r_fullname'];
		$r_address = $_POST['r_address'];
		$r_email = $_POST['r_email'];
		$r_phone = $_POST['r_phone'];
		$r_dob = $_POST['r_dob'];
		$r_sex = $_POST['r_sex'];
		$r_status = $_POST['r_status'];
		
		if(!$r_user || !$r_pass || !$r_cpass || !$r_session || !$r_level || !$r_matric || !$r_title || !$r_fullname || !$r_address || !$r_email || !$r_phone || !$r_dob || !$r_sex || !$r_status)
		{
			$reg_msg = '<div class="msg">All fields are required</div>';
		} else
		{
			//check password matched
			if($r_pass != $r_cpass)
			{
				$reg_msg = '<div class="msg">Password not matched</div>';
			} else
			{
				//hash password
				$r_pass = md5($r_pass);
				
				//check redundancy
				if(mysql_num_rows(mysql_query("SELECT * FROM g_student WHERE matric='$r_matric' OR username='$r_user' OR email='$r_email' LIMIT 1")) > 0)
				{
					$reg_msg = '<div class="msg">Username, Matric or Email Address has been choosen by another user, please choose another.</div>';
				} else
				{
					//save student to database
					if(mysql_query("INSERT INTO g_student (username,password,session,level,matric,title,fullname,address,email,phone,dob,sex,marital,role,reg_date) VALUES ('$r_user','$r_pass','$r_session','$r_level','$r_matric','$r_title','$r_fullname','$r_address','$r_email','$r_phone','$r_dob','$r_sex','$r_status','Student',now())"))
					{
						$reg_msg = '<div class="msg">Registration Completed</div>';	
					} else
					{
						$reg_msg = '<div class="msg">Registration Failed! - Try Again</div>';
					}
				}
			}
		}
	}
	
	echo $reg_msg;
?>