<?php
	$logview = '';
	
	if(isset($_SESSION['g_mem']))
	{
		$g_mem = strtoupper($_SESSION['g_mem']);
		$logview = 'Welcome <a href="'.$eroot.'/student/profile.php"><b>'.$g_mem.'</b></a> | <a href="'.$eroot.'/logout.php">LOGOUT</a>';
	} else
	{
		$logview = 'Welcome Guest! <a href="'.$eroot.'/login.php">LOGIN</a> | <a href="'.$eroot.'/register.php">REGISTER</a>';
	}
	
	echo $logview;
?>