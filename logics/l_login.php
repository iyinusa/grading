<?php
	$log_msg = '';
	
	if(isset($_POST['btnLogin']))
	{
		$r_name = $_POST['l_name'];
		$r_pass = $_POST['l_pass'];
		
		if(!$r_name || !$r_pass)
		{
			$log_msg = '<div class="msg">All fields are required</div>';	
		} else
		{
			//hash password here
			$r_pass = md5($r_pass);
			
			$lq = mysql_query("SELECT * FROM g_lecturer WHERE username='$r_name' AND password='$r_pass'");
			$lq_chk = mysql_num_rows($lq);
			
			if($lq_chk <= 0)
			{
				$log_msg = '<div class="msg">Failed Authentication! - Supply correct Username and Password</div>';
			} else
			{
				while($lqr = mysql_fetch_assoc($lq))
				{
					$g_user = $lqr['username'];
					$g_email = $lqr['email'];
					$g_phone = $lqr['phone'];
					$g_reg = $lqr['reg_date'];
					$g_role = $lqr['role'];
				}
				
				session_register("g_mem");
				session_register("g_role");
				session_register("g_reg");
				session_register("g_phone");
				session_register("g_email");
				
				$_SESSION['g_mem'] = $g_user;
				$_SESSION['g_role'] = $g_role;
				$_SESSION['g_reg'] = $g_reg;
				$_SESSION['g_phone'] = $g_phone;
				$_SESSION['g_email'] = $g_email;
				
				//redirect to profile page
				header("location: staff/profile.php");
			}
		} ob_flush();
	}
	
	echo $log_msg;
?>