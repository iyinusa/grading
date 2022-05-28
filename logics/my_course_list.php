<?php
	$msg = '';
	$load_c = '';
	$each_c = '';
	
	$up_id = '';
	$up_level = '';
	$up_title = '';
	$up_code = '';
	$up_unit = '';
	
	$level = $_SESSION['g_level'];
	$user_id = $_SESSION['g_id'];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//delete course
	if(isset($_POST['btnRemove']))
	{
		$msg = '';
	
		//declare variables
		$add = $_POST['add2'];
		
		if (count($_POST['add2']) <= 1)
		{
			$msg = '<div class="msg">You have not selected any course(s) above</div>';
		} else
		{
			if (!empty($add))
			{
				foreach($_POST['add2'] as $add)
				{
					//check redundancy
					if($add != 0)
					{
						if(mysql_num_rows(mysql_query("SELECT * FROM p_mycourse WHERE user_id='$user_id' AND reg_id='$add' LIMIT 1")) > 0)
						{
							//remove registered courses to database
							if(mysql_query("DELETE FROM p_mycourse WHERE user_id='$user_id' AND reg_id='$add'"))
							{
								$msg = '<div class="msg">Course(s) Removed Successfully</div>';	
							} else
							{
								$msg = '<div class="msg">Failed! - Try Again</div>';
							}
						}
					}
				}
			}
		}
	}
	
	echo $msg;
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//load respective courses
	$load_r = '';
	$rr = mysql_query("SELECT * FROM p_mycourse WHERE user_id='$user_id'");
	if(mysql_num_rows($rr) > 0)
	{
		$lcc = 1;
		$t_unit = 0;
		$t_gpa = 0;
		$t_cgpa = 0;
		
		$load_c = '
			<tr>
				<td width="70px" align="center" style="border:1px solid #333;"><b>S/N</b></td>
				<td width="100px" align="center" style="border:1px solid #333;"><b>COURSE SEMESTER</b></td>
				<td style="border:1px solid #333;"><b>COURSE TITLE</b></td>
				<td width="100px" align="center" style="border:1px solid #333;"><b>COURSE CODE</b></td>
				<td width="80px" align="center" style="border:1px solid #333;"><b>COURSE UNIT</b></td>
				<!--<td width="80px" align="center" style="border:1px solid #333;"><b>SCORE</b></td>
				<td width="80px" align="center" style="border:1px solid #333;"><b>GRADE</b></td>
				<td width="80px" align="center" style="border:1px solid #333;"><b>GPA</b></td>-->
				<td width="70px" align="center" style="border:1px solid #333;">
					<input type="checkbox" name="add2[]" value="" checked="checked" style="display:none;" />
					<input type="checkbox" name="addall2" id="addall2" onclick="check2();" />
					<script type="text/javascript">
						function check2(){
							var all2 = document.getElementById("addall2");
							var boxes2 = document.getElementsByTagName("input");
							if(all2.checked == true)
							{
								if(boxes2.type="Checkbox"){
									for (var i = 0; i < boxes2.length; i++) {
										if (boxes2[i].name == "add2[]" ) {
											boxes2[i].checked = true;
										}
									}
								}
							} else
							{
								if(boxes2.type="Checkbox"){
									for (var i = 0; i < boxes2.length; i++) {
										if (boxes2[i].name == "add2[]" ) {
											boxes2[i].checked = false;
										}
									}
								}
							}
						}
					</script>
				</td>
			</tr>
		';
		while($rrsr = mysql_fetch_assoc($rr))
		{
			$reg_id = $rrsr['reg_id'];
			$rcourse_id = $rrsr['course_id'];
			$ruser_id = $rrsr['user_id'];
			$rresult_id = $rrsr['result_id'];
			
			//load courses information
			$ldc = mysql_query("SELECT * FROM p_course WHERE course_id='$rcourse_id' LIMIT 1");
			if(mysql_num_rows($ldc) > 0)
			{
				while($ldcr = mysql_fetch_assoc($ldc))
				{
					$rcourse_semester = $ldcr['course_semester'];
					$rcourse_title = $ldcr['course_title'];
					$rcourse_code = $ldcr['course_code'];
					$rcourse_unit = $ldcr['course_unit'];
				}
			}
			
			//load results
			$rscore = '';
			$rgrade = '';
			$rgpa = '';
			$lrc = mysql_query("SELECT * FROM p_result WHERE result_id='$rresult_id' LIMIT 1");
			if(mysql_num_rows($lrc) > 0)
			{
				while($lrcr = mysql_fetch_assoc($lrc))
				{
					$rscore = $lrcr['r_score'];
					$rgrade = $lrcr['r_grade'];
					$rgpa = $lrcr['r_gpa'];
				}
			}
			
			if(($lcc%2) > 0)
			{
				$load_c .= '
					<tr>
						<td width="70px" align="center">'.$lcc.'</td>
						<td width="100px"><b>'.$rcourse_semester.'</b></td>
						<td><b>'.$rcourse_title.'</b></td>
						<td width="100px" align="center">'.$rcourse_code.'</td>
						<td width="80px" align="center">'.$rcourse_unit.'</td>
						<!--<td width="80px" align="center">'.$rscore.'</td>
						<td width="80px" align="center">'.$rgrade.'</td>
						<td width="80px" align="center">'.$rgpa.'</td>-->
						<td width="70px" align="center">
							<input type="checkbox" name="add2[]" value="'.$reg_id.'" />
						</td>
					</tr>
				';
			} else
			{
				$load_c .= '
					<tr style="background-color:#eee;">
						<td width="70px" align="center">'.$lcc.'</td>
						<td width="100px"><b>'.$rcourse_semester.'</b></td>
						<td><b>'.$rcourse_title.'</b></td>
						<td width="100px" align="center">'.$rcourse_code.'</td>
						<td width="40px" align="center">'.$rcourse_unit.'</td>
						<!--<td width="80px" align="center">'.$rscore.'</td>
						<td width="80px" align="center">'.$rgrade.'</td>
						<td width="80px" align="center">'.$rgpa.'</td>-->
						<td width="70px" align="center">
							<input type="checkbox" name="add2[]" value="'.$reg_id.'" />
						</td>
					</tr>
				';
			}
			
			$lcc += 1;
			$t_unit += $rcourse_unit; //sum units together
			$t_gpa += $rgpa; //sum gpa together
		}
		
		//calculate cgpa
		$t_cgpa = $t_gpa / $t_unit;
		$t_cgpa = round($t_cgpa,2);
		
		$load_c .= '
			<!--<tr>
				<td colspan="3" align="right"><b>TOTAL UNITS</b></td>
				<td align="center"><b>'.$t_unit.'</b></td>
				<td colspan="2" align="right"><b>TOTAL GPA</b></td>
				<td align="center"><b>'.$t_gpa.'</b></td>
				<td></td>
			</tr>-->
			<!--<tr>
				<td colspan="8" align="right" style="font-size:18px; color:#090;"><b>CGPA = <span style="color:#666;">'.$t_cgpa.'</span></b></td>
			</tr>-->
		';
	} else
	{
		$load_c = '<h3 style="text-align:center;">You have not registered for any courses yet. Please register above</h3>';
	}
	
	echo '
		<div class="each_c">
			<div class="ec_level"><b>'.$level.'</b></div>
			<div class="ec_list">
				<form action="reg_courses.php" method="post" enctype="multipart/form-data">
					<div style="text-align:right; padding-right:10px;">
						<input type="submit" name="btnRemove" value="REMOVE" />
					</div>
					<table class="stable">
						'.$load_c.'
					</table>
					<div style="text-align:right; padding-right:10px;">
						<input type="submit" name="btnRemove" value="REMOVE" />
					</div>
				</form>
			</div>
		</div>
	';
?>