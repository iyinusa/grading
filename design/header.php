<?php
	$g_menu = '';
	
	if(isset($_SESSION['g_role']))
	{
		$g_role = $_SESSION['g_role'];
		
		if($g_role == "Lecturer")
		{
			$g_menu .= '
				<li><a class="ahome" href="'.$eroot.'">Home</a></li>
				<li><a class="aps" href="'.$eroot.'/staff/courses.php">Courses</a></li>
				<li><a class="" href="'.$eroot.'/staff/prepare_result.php">Prepare Result</a></li>
			';
		} else if($g_role == "Admin")
		{
			$g_menu .= '
				<li><a class="ahome" href="'.$eroot.'">Home</a></li>
				<li><a class="arp" href="'.$eroot.'/admin/users.php">Registered Users</a></li>
				<li><a class="amr" href="'.$eroot.'/staff/courses.php">Courses</a></li>
				<li><a class="aps" href="'.$eroot.'/staff/prepare_result.php">Prepare Result</a></li>
				<li><a class="aup" href="'.$eroot.'/staff/reports.php">Reports</a></li>
			';
		}  else if($g_role == "Student")
		{
			$g_menu .= '
				<li><a class="ahome" href="'.$eroot.'">Home</a></li>
				<li><a class="arp" href="'.$eroot.'/student/reg_courses.php">Register Courses</a></li>
				<li><a class="amr" href="'.$eroot.'/student/results.php">Results</a></li>
			';
		} else
		{
			$g_menu .= '
				<li><a class="ahome" href="'.$eroot.'">Home</a></li>
			';		
		}
	} else 
	{
		$g_menu .= '
			<li><a class="ahome" href="'.$eroot.'">Home</a></li>
		';	
	}
	
	echo '
		<div id="eh_left">
			<img src="'.$eroot.'/images/laspo.png" />
		</div>
		<div id="eh_right">
			<div id="ehr_top">
				<div id="ehrt_left">
					COMPUTER BASED RESULT MANAGEMENT INFORMATION SYSTEM
				</div>
				<!--<div id="ehrt_right">
					<table width="100%" style="text-align:right;">
						<tr>
							<td>
								<img src="'.$eroot.'/images/call.jpg" alt="CALL US:" />
							</td>
							<td>
								<b style="color:Maroon;">
									<span style="font-size:36px;">
										01-1234567
									</span>
								</b>
							</td>
							<td>
								<b><u>Online Grading System:</u></b><br />
								<span style="font-size:x-small;">
									Register For Courses<br />
									Check Results Online
								</span>
							</td>
						</tr>
					</table>
				</div>-->
			</div>
			<div id="ehr_btm">
				<ul>
					'.$g_menu.'
				</ul>
			</div>
		</div>
	';
?>