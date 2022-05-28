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
	//register course
	if(isset($_POST['btnAdd']))
	{
		$msg = '';
	
		//declare variables
		$add = $_POST['add'];
		
		if (count($_POST['add']) <= 1)
		{
			$msg = '<div class="msg">You have not selected any course(s) above</div>';
		} else
		{
			if (!empty($add))
			{
				foreach($_POST['add'] as $add)
				{
					//check redundancy
					if(mysql_num_rows(mysql_query("SELECT * FROM p_mycourse WHERE user_id='$user_id'  AND course_id='$add' LIMIT 1")) > 0)
					{
						
					} else
					{
						if($add != 0)
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
		}
	}
	
	echo $msg;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//load respective courses
	$load_c = '';
	$rs = mysql_query("SELECT * FROM p_course WHERE course_level='$level' ORDER BY course_title ASC");
	if(mysql_num_rows($rs) > 0)
	{
		$lcc = 1;
		$load_c = '
			<tr>
				<td width="70px" align="center" style="border:1px solid #333;"><b>S/N</b></td>
				<td style="border:1px solid #333;"><b>SEMESTER</b></td>
				<td style="border:1px solid #333;"><b>COURSE TITLE</b></td>
				<td width="100px" align="center" style="border:1px solid #333;"><b>COURSE CODE</b></td>
				<td width="80px" align="center" style="border:1px solid #333;"><b>COURSE UNIT</b></td>
				<td width="70px" align="center" style="border:1px solid #333;">
					<input type="checkbox" id="add[]" name="add[]" value="None" checked="checked" style="display:none;" />
					<input type="checkbox" name="addall" id="addall" onclick="check();" />
					<script type="text/javascript">
						function check(){
							var all = document.getElementById("addall");
							var boxes = document.getElementsByTagName("input");
							if(all.checked == true)
							{
								if(boxes.type="Checkbox"){
									for (var i = 0; i < boxes.length; i++) {
										if (boxes[i].name == "add[]" ) {
											boxes[i].checked = true;
										}
									}
								}
							} else
							{
								if(boxes.type="Checkbox"){
									for (var i = 0; i < boxes.length; i++) {
										if (boxes[i].name == "add[]" ) {
											boxes[i].checked = false;
										}
									}
								}
							}
						}
					</script>
				</td>
			</tr>
		';
		while($rsr = mysql_fetch_assoc($rs))
		{
			$course_id = $rsr['course_id'];
			$course_semester = $rsr['course_semester'];
			$course_title = $rsr['course_title'];
			$course_code = $rsr['course_code'];
			$course_unit = $rsr['course_unit'];
			
			if(($lcc%2) > 0)
			{
				$load_c .= '
					<tr>
						<td width="70px" align="center">'.$lcc.'</td>
						<td width="100px;"><b>'.$course_semester.'</b></td>
						<td><b>'.$course_title.'</b></td>
						<td width="100px" align="center">'.$course_code.'</td>
						<td width="80px" align="center">'.$course_unit.'</td>
						<td width="70px" align="center">
							<input type="checkbox" id="add[]" name="add[]" value="'.$course_id.'" />
						</td>
					</tr>
				';
			} else
			{
				$load_c .= '
					<tr style="background-color:#eee;">
						<td width="70px" align="center">'.$lcc.'</td>
						<td width="100px;"><b>'.$course_semester.'</b></td>
						<td><b>'.$course_title.'</b></td>
						<td width="100px" align="center">'.$course_code.'</td>
						<td width="40px" align="center">'.$course_unit.'</td>
						<td width="70px" align="center">
							<input type="checkbox" id="add[]" name="add[]" value="'.$course_id.'" />
						</td>
					</tr>
				';
			}
			
			$lcc += 1;
		}
	} else
	{
		$load_c = '<h3 style="text-align:center;">There are no <b>'.$level.'</b> courses yet. Please contact your staff advisor.</h3>';
	}
	
	echo '
		<div class="each_c">
			<div class="ec_level"><b>'.$level.'</b></div>
			<div class="ec_list">
				<form action="reg_courses.php" method="post" enctype="multipart/form-data">
					<div style="text-align:right; padding-right:20px;">
						<input type="submit" name="btnAdd" value="ADD" onclick="add_course();" />
					</div>
					<table class="stable">
						'.$load_c.'
					</table>
					<div style="text-align:right; padding-right:20px;">
						<input type="submit" name="btnAdd" value="ADD" onclick="add_course();" />
					</div>
				</form>
			</div>
		</div>
	';
?>