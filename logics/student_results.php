<?php
	$user_id = $_SESSION['g_id'];
	$prepare = '';
	
	if(isset($_POST['btnLoad']))
	{
		$r_level = $_POST['r_level'];
		$r_semester = $_POST['r_semester'];
		
		if(!$r_level || !$r_semester)
		{
			$prepare = '<h3 style="text-align:center;">You must make selections</h3>';
		} else
		{
			$rr = mysql_query("SELECT * FROM p_course WHERE course_level='$r_level' AND course_semester='$r_semester'");
			if(mysql_num_rows($rr) > 0)
			{
				$lcc = 1;
				$t_unit = 0;
				$t_gpa = 0;
				$t_cgpa = 0;
				
				$load_c = '
					<tr>
						<td style="border:1px solid #333;"><b>COURSE TITLE</b></td>
						<td width="100px" align="center" style="border:1px solid #333;"><b>COURSE CODE</b></td>
						<td width="80px" align="center" style="border:1px solid #333;"><b>COURSE UNIT</b></td>
						<td width="80px" align="center" style="border:1px solid #333;"><b>SCORE</b></td>
						<td width="80px" align="center" style="border:1px solid #333;"><b>GRADE</b></td>
						<td width="80px" align="center" style="border:1px solid #333;"><b>GPA</b></td>
					</tr>
				';
				while($rrsr = mysql_fetch_assoc($rr))
				{
					$course_id = $rrsr['course_id'];
					$course_title = $rrsr['course_title'];
					$course_code = $rrsr['course_code'];
					$course_unit = $rrsr['course_unit'];
					
					//load results id
					$ldc = mysql_query("SELECT * FROM p_mycourse WHERE course_id='$course_id' AND user_id='$user_id' LIMIT 1");
					if(mysql_num_rows($ldc) > 0)
					{
						while($ldcr = mysql_fetch_assoc($ldc))
						{
							$result_id = $ldcr['result_id'];
						}
						
						//load results
						$rscore = '';
						$rgrade = '';
						$rgpa = '';
						$lrc = mysql_query("SELECT * FROM p_result WHERE result_id='$result_id' LIMIT 1");
						if(mysql_num_rows($lrc) > 0)
						{
							while($lrcr = mysql_fetch_assoc($lrc))
							{
								$rscore = $lrcr['r_score'];
								$rgrade = $lrcr['r_grade'];
								$rgpa = $lrcr['r_gpa'];
							}
							
							if(($lcc%2) > 0)
							{
								$load_c .= '
									<tr>
										<td><b>'.$course_title.'</b></td>
										<td width="100px" align="center">'.$course_code.'</td>
										<td width="80px" align="center">'.$course_unit.'</td>
										<td width="80px" align="center">'.$rscore.'</td>
										<td width="80px" align="center">'.$rgrade.'</td>
										<td width="80px" align="center">'.$rgpa.'</td>
									</tr>
								';
							} else
							{
								$load_c .= '
									<tr style="background-color:#eee;">
										<td><b>'.$course_title.'</b></td>
										<td width="100px" align="center">'.$course_code.'</td>
										<td width="40px" align="center">'.$course_unit.'</td>
										<td width="80px" align="center">'.$rscore.'</td>
										<td width="80px" align="center">'.$rgrade.'</td>
										<td width="80px" align="center">'.$rgpa.'</td>
									</tr>
								';
							}
							
							$lcc += 1;
							$t_unit += $course_unit; //sum units together
							$t_gpa += $rgpa; //sum gpa together
						}
					}
				}
				
				//calculate cgpa
				if($t_unit != 0)
				{
					$t_cgpa = $t_gpa / $t_unit;
					$t_cgpa = round($t_cgpa,2);
				}
				
				$load_c .= '
					<tr>
						<td colspan="2" align="right"><b>TOTAL UNITS</b></td>
						<td align="center"><b>'.$t_unit.'</b></td>
						<td colspan="2" align="right"><b>TOTAL GPA</b></td>
						<td align="center"><b>'.$t_gpa.'</b></td>
					</tr>
					<tr>
						<td colspan="6" align="right" style="font-size:18px; color:#090;"><b>CGPA = <span style="color:#666;">'.$t_cgpa.'</span></b></td>
					</tr>
				';
			} else
			{
				$load_c = '<h3 style="text-align:center;">You have not registered for any courses yet. Please register above</h3>';
			}
			
			$prepare = '
				<div class="each_c">
					<div class="ec_level"><b>'.$r_level.'</b></div>
					<div>'.$r_semester.' Results</div>
					<div class="ec_list">
						<form action="reg_courses.php" method="post" enctype="multipart/form-data">
							<table class="stable">
								'.$load_c.'
							</table>
						</form>
					</div>
				</div>
			';
		}
	}
?>