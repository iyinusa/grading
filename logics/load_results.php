<?php
	$msg = '';
	$each_c = '';
	$r_score = '';
	$r_grade = '';
	$r_gpa = '';
	$prepare = '';	
	
	//load courses
	if(isset($_POST['btnLoad']))
	{
		$r_session = $_POST['r_session'];
		$r_semester = $_POST['r_semester'];
		$r_level = $_POST['r_level'];
		
		if(!$r_session || !$r_semester || !$r_level)
		{
			$msg = '<div class="msg">All fields are required</div>';
		} else
		{
			$load = mysql_query("SELECT * FROM p_course WHERE course_level='$r_level' AND course_semester='$r_semester' ORDER BY course_title ASC");
			if(mysql_num_rows($load) > 0)
			{
				$ld_c = 1;
				while($loadr = mysql_fetch_assoc($load))
				{
					$cs_id = $loadr['course_id'];
					$cs_title = $loadr['course_title'];
					$cs_code = $loadr['course_code'];
					$cs_unit = $loadr['course_unit'];
					
					$each_c .= '
						<div class="r_list">
							<a href="?prepare='.$cs_id.'&amp;title='.$cs_title.'&amp;code='.$cs_code.'&amp;unit='.$cs_unit.'">
								'.$ld_c.') <b>'.$cs_title.'</b> [ '.$cs_code.' ] [ '.$cs_unit.' ]
							</a>
						</div>
					';
					$ld_c += 1;
				}
			}
		}
	} else
	{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//load result sheets
		if(isset($_GET['prepare']) && isset($_GET['title']) && isset($_GET['code']) && isset($_GET['unit']))
		{
			//register sessions
			if(!session_register("s_id")){session_register("s_id");}
			if(!session_register("s_title")){session_register("s_title");}
			if(!session_register("s_code")){session_register("s_code");}
			if(!session_register("s_unit")){session_register("s_unit");}
			$_SESSION['s_id'] = $_GET['prepare'];
			$_SESSION['s_title'] = $_GET['title'];
			$_SESSION['s_code'] = $_GET['code'];
			$_SESSION['s_unit'] = $_GET['unit'];
			//redirect back
			header("location: prepare_result.php");
		}
		
		if(isset($_SESSION['s_id']) && isset($_SESSION['s_title']) && isset($_SESSION['s_code']) && isset($_SESSION['s_unit']))
		{
			$s_id = $_SESSION['s_id'];
			$s_title = $_SESSION['s_title'];
			$s_code = $_SESSION['s_code'];
			$s_unit = $_SESSION['s_unit'];
			
			//grade result
			if(isset($_POST['btnGradeResult']))
			{
				$r_course_id = $_POST['r_course_id'];
				$r_count = $_POST['r_count'];
				
				if($r_course_id && $r_count)
				{
					for ($i=1; $i<$r_count; $i++)
					{
						$r_user_id = $_POST['r_user_id'.$i];
						$r_reg_id = $_POST['r_reg_id'.$i];
						$r_result_id = $_POST['r_result_id'.$i];
						$r_score = $_POST['r_score'.$i];
						$r_grade = $_POST['r_grade'.$i];
						$r_point = $_POST['r_point'.$i];
						
						//check if result already exists
						$cr = mysql_query("SELECT * FROM p_mycourse WHERE user_id='$r_user_id' AND course_id='$r_course_id' AND result_id='$r_result_id' LIMIT 1");
						if(mysql_num_rows($cr) > 0)
						{
							//update result
							if(mysql_query("UPDATE p_result SET r_date=now(),r_score='$r_score',r_grade='$r_grade',r_gpa='$r_point' WHERE result_id='$r_result_id' LIMIT 1"))
							{
								$msg = '<div class="msg">Result Sheet Updated Successfully</div>';
							}
						} else
						{
							//prepare new results
							if(mysql_query("INSERT INTO p_result (r_date,r_score,r_grade,r_gpa) VALUES (now(),'$r_score','$r_grade','$r_point')"))
							{
								$gid = mysql_insert_id();
								if(mysql_query("UPDATE p_mycourse SET result_id='$gid' WHERE user_id='$r_user_id' AND course_id='$r_course_id' LIMIT 1"))
								{
									$msg = '<div class="msg">Result Sheet Prepared/Updated Successfully</div>';
								}
							}
						}
					}
				}
			}
			
			//load registered students
			$ls = mysql_query("SELECT * FROM p_mycourse WHERE course_id='$s_id'");
			if(mysql_num_rows($ls) <= 0)
			{
				$each_c = '<div style="text-align:center;">No Students Registered for <b>'.$s_title.'</b> yet</div>';
			} else
			{
				$lcc = 1;
				$each_c = '
					<tr>
						<td width="30px" align="center" style="border:1px solid #333;"><b>S/N</b></td>
						<td width="60px" align="center" style="border:1px solid #333;"><b>MATRIC NO.</b></td>
						<td align="center" style="border:1px solid #333;"><b>FULL NAME</b></td>
						<td width="70px" align="center" style="border:1px solid #333;"><b>COURSE UNIT</b></td>
						<td width="50px" align="center" style="border:1px solid #333;"><b>SCORE</b></td>
						<td width="50px" align="center" style="border:1px solid #333;"><b>GRADE</b></td>
						<td width="50px" align="center" style="border:1px solid #333;"><b>GPA</b></td>
					</tr>
				';
				while($lsr = mysql_fetch_assoc($ls))
				{
					$reg_id = $lsr['reg_id'];
					$user_id = $lsr['user_id'];
					$result_id = $lsr['result_id'];
					
					//load students
					$s = mysql_query("SELECT * FROM g_student WHERE user_id='$user_id' LIMIT 1");
					if(mysql_num_rows($s) > 0)
					{
						while($sr = mysql_fetch_assoc($s))
						{
							$matric = $sr['matric'];
							$fullname = $sr['fullname'];	
						}
					}
					
					//load results
					$r = mysql_query("SELECT * FROM p_result WHERE result_id='$result_id' LIMIT 1");
					if(mysql_num_rows($r) > 0)
					{
						while($rr = mysql_fetch_assoc($r))
						{
							$r_score = $rr['r_score'];
							$r_grade = $rr['r_grade'];
							$r_gpa = $rr['r_gpa'];	
						}
					}
					
					if(($lcc%2) > 0)
					{
						$each_c .= '
							<tr>
								<td align="center">'.$lcc.'</td>
								<td align="center"><b>'.$matric.'</b></td>
								<td>'.$fullname.'</td>
								<td align="center">'.$s_unit.'</td>
								<td align="center">
									<input type="hidden" name="r_result_id'.$lcc.'" id="r_result_id'.$lcc.'" value="'.$result_id.'" />
									<input type="hidden" name="r_reg_id'.$lcc.'" id="r_reg_id'.$lcc.'" value="'.$reg_id.'" />
									<input type="hidden" name="r_user_id'.$lcc.'" id="r_user_id'.$lcc.'" value="'.$user_id.'" />
									<input type="hidden" name="r_unit'.$lcc.'" id="r_unit'.$lcc.'" value="'.$s_unit.'" />
									<input type="text" name="r_score'.$lcc.'" id="r_score'.$lcc.'" value="'.$r_score.'" style="width:50px; text-align:center;" onchange="grade'.$lcc.'();" />
								</td>
								<td align="center">
									<input type="text" name="r_grade'.$lcc.'" id="r_grade'.$lcc.'" value="'.$r_grade.'" readonly="readonly"  style="width:50px; text-align:center;" />
								</td>
								<td align="center">
									<input type="text" name="r_point'.$lcc.'" id="r_point'.$lcc.'" value="'.$r_gpa.'" readonly="readonly" style="width:50px; text-align:center;" />
								</td>
								<script type="text/javascript">
									function grade'.$lcc.'(){
										var score = document.getElementById("r_score'.$lcc.'");
										var grade = document.getElementById("r_grade'.$lcc.'");
										var point = document.getElementById("r_point'.$lcc.'");
										var unit = document.getElementById("r_unit'.$lcc.'");
										
										if(score.value >= 70)
										{
											grade.value = "A";
											point.value = unit.value * 4.0;
										} else if(score.value >= 65 && score.value < 70) {
											grade.value = "AB";
											point.value = unit.value * 3.5;
										} else if(score.value >= 60 && score.value < 65) {
											grade.value = "B";
											point.value = unit.value * 3.0;
										} else if(score.value >= 55 && score.value < 60) {
											grade.value = "BC";
											point.value = unit.value * 2.5;
										} else if(score.value >= 50 && score.value < 55) {
											grade.value = "C";
											point.value = unit.value * 2.0;
										} else if(score.value >= 45 && score.value < 50) {
											grade.value = "CD";
											point.value = unit.value * 1.5;
										} else if(score.value >= 40 && score.value < 45) {
											grade.value = "D";
											point.value = unit.value * 1.0;
										} else {
											grade.value = "F";
											point.value = unit.value * 0.0;
										}
									}
								</script>
							</tr>
						';
					} else
					{
						$each_c .= '
							<tr style="background-color:#eee;">
								<td align="center">'.$lcc.'</td>
								<td align="center"><b>'.$matric.'</b></td>
								<td>'.$fullname.'</td>
								<td align="center">'.$s_unit.'</td>
								<td align="center">
									<input type="hidden" name="r_result_id'.$lcc.'" id="r_result_id'.$lcc.'" value="'.$result_id.'" />
									<input type="hidden" name="r_reg_id'.$lcc.'" id="r_reg_id'.$lcc.'" value="'.$reg_id.'" />
									<input type="hidden" name="r_user_id'.$lcc.'" id="r_user_id'.$lcc.'" value="'.$user_id.'" />
									<input type="hidden" name="r_unit'.$lcc.'" id="r_unit'.$lcc.'" value="'.$s_unit.'" />
									<input type="text" name="r_score'.$lcc.'" id="r_score'.$lcc.'" value="'.$r_score.'" style="width:50px; text-align:center;" onchange="grade'.$lcc.'();" />
								</td>
								<td align="center">
									<input type="text" name="r_grade'.$lcc.'" id="r_grade'.$lcc.'" value="'.$r_grade.'" readonly="readonly"  style="width:50px; text-align:center;" />
								</td>
								<td align="center">
									<input type="text" name="r_point'.$lcc.'" id="r_point'.$lcc.'" value="'.$r_gpa.'" readonly="readonly" style="width:50px; text-align:center;" />
								</td>
								<script type="text/javascript">
									function grade'.$lcc.'(){
										var score = document.getElementById("r_score'.$lcc.'");
										var grade = document.getElementById("r_grade'.$lcc.'");
										var point = document.getElementById("r_point'.$lcc.'");
										var unit = document.getElementById("r_unit'.$lcc.'");
										
										if(score.value >= 70)
										{
											grade.value = "A";
											point.value = unit.value * 4.0;
										} else if(score.value >= 65 && score.value < 70) {
											grade.value = "AB";
											point.value = unit.value * 3.5;
										} else if(score.value >= 60 && score.value < 65) {
											grade.value = "B";
											point.value = unit.value * 3.0;
										} else if(score.value >= 55 && score.value < 60) {
											grade.value = "BC";
											point.value = unit.value * 2.5;
										} else if(score.value >= 50 && score.value < 55) {
											grade.value = "C";
											point.value = unit.value * 2.0;
										} else if(score.value >= 45 && score.value < 50) {
											grade.value = "CD";
											point.value = unit.value * 1.5;
										} else if(score.value >= 40 && score.value < 45) {
											grade.value = "D";
											point.value = unit.value * 1.0;
										} else {
											grade.value = "F";
											point.value = unit.value * 0.0;
										}
									}
								</script>
							</tr>
						';
					}
					
					$lcc += 1;
				}
				
				$each_c = '
					<div style="font-size:22px; color:#03d; text-align:center; padding:5px;">
						'.$s_title.' - '.$s_code.' Result Sheet
					</div>
					<form action="prepare_result.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="r_count" id="r_count" value="'.$lcc.'" />
						<input type="hidden" name="r_course_id" id="r_course_id" value="'.$s_id.'" />
						<table class="stable">
							'.$each_c.'
						</table>
						<div style="padding:5px; text-align:right;">
							<input type="submit" name="btnGradeResult" value="Grade Results" style="padding:10px 20px;" />
						</div>
					</form>
				';
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//load prepared results
	$lr = mysql_query("SELECT * FROM p_mycourse WHERE result_id!='' GROUP BY course_id");
	if(mysql_num_rows($lr) > 0)
	{
		$prepare = '
			<tr>
				<td width="60px" align="center" style="border:1px solid #333;"><b>LEVEL</b></td>
				<td width="60px" align="center" style="border:1px solid #333;"><b>SEMESTER</b></td>
				<td width="60px" align="center" style="border:1px solid #333;"><b>CODE</b></td>
				<td align="center" style="border:1px solid #333;"><b>TITLE</b></td>
			</tr>
		';
		while($lrr = mysql_fetch_assoc($lr))
		{
			$c_id = $lrr['course_id'];
			
			//load course information
			$c = mysql_query("SELECT * FROM p_course WHERE course_id='$c_id'");
			if(mysql_num_rows($c) > 0)
			{
				while($cr = mysql_fetch_assoc($c))
				{
					$c_level = $cr['course_level'];
					$c_sem = $cr['course_semester'];
					$c_code = $cr['course_code'];
					$c_title = $cr['course_title'];
					$c_unit = $cr['course_unit'];
				}
			}
			
			$prepare .= '
				<tr>
					<td align="center"">'.$c_level.'</td>
					<td align="center">'.$c_sem.'</td>
					<td align="center">'.$c_code.'</td>
					<td>
						<a href="?prepare='.$c_id.'&amp;title='.$c_title.'&amp;code='.$c_code.'&amp;unit='.$c_unit.'">'.$c_title.'</a>
					</td>
				</tr>
			';
		}
		
		$prepare = '
			<table class="stable">
				'.$prepare.'
			</table>
		';
	}
?>