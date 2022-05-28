<?php
	$msg = '';
	$load_c = '';
	$each_c = '';
	
	$up_id = '';
	$up_level = '';
	$up_semester = '';
	$up_title = '';
	$up_code = '';
	$up_unit = '';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//load courses for updates
	if(isset($_GET['edit']))
	{
		$edit = $_GET['edit'];
		
		$up = mysql_query("SELECT * FROM p_course WHERE course_id='$edit' LIMIT 1");
		if(mysql_num_rows($up) > 0)
		{
			while($upr = mysql_fetch_assoc($up))
			{
				$up_id = $upr['course_id'];
				$up_level = $upr['course_level'];
				$up_semester = $upr['course_semester'];
				$up_title = $upr['course_title'];
				$up_code = $upr['course_code'];
				$up_unit = $upr['course_unit'];
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//delete course
	if(isset($_GET['rm']))
	{
		$rm = $_GET['rm'];
		
		if(isset($_POST['btnClose']))
		{
			header('location: courses.php');
		}
		
		if(isset($_POST['btnDelete']))
		{
			if(mysql_query("DELETE FROM p_course WHERE course_id='$rm' LIMIT 1"))
			{
				$msg =  '<div class="msg">Course Removed Successfully. <a href="courses.php">REFRESH</a></div>';
			} else
			{
				$msg =  '<div class="msg">Failed! - Please try again later.</div>';
			}
		} else
		{
			$msg =  '
				<div class="msg">
					<form action="courses.php?rm='.$rm.'" method="post" enctype="multipart/form-data">
						<h2>Are u sure you wants to REMOVE the Course? Once REMOVED, everyone on this portal will no longer have access to it again.<br /><br />Are you sure?<br /><br />
							<input type="submit" name="btnDelete" value="YES - REMOVE" />&nbsp;
							<input type="submit" name="btnClose" value="CLOSE" />
						</h2>
					</form>
				</div>
			';
		}
	}
	
	echo $msg;
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//load courses
	$co = mysql_query("SELECT * FROM p_course GROUP BY course_level ORDER BY course_level ASC");
	if(mysql_num_rows($co) > 0)
	{
		while($cor = mysql_fetch_assoc($co))
		{
			$course_level = $cor['course_level'];
			
			//load respective courses
			$load_c = '';
			$rs = mysql_query("SELECT * FROM p_course WHERE course_level='$course_level'  ORDER BY course_semester ASC");
			if(mysql_num_rows($rs) > 0)
			{
				$lcc = 1;
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
								<td width="70px" align="center"><a href="courses.php?rm='.$course_id.'">REMOVE</a></td>
								<td width="100px"><b>'.$course_semester.'</b></td>
								<td><b>'.$course_title.'</b></td>
								<td width="100px" align="center">'.$course_code.'</td>
								<td width="40px" align="center">'.$course_unit.'</td>
								<td width="70px" align="center"><a href="courses.php?edit='.$course_id.'">EDIT</a></td>
							</tr>
						';
					} else
					{
						$load_c .= '
							<tr style="background-color:#eee;">
								<td width="70px" align="center"><a href="courses.php?rm='.$course_id.'">REMOVE</a></td>
								<td width="100px"><b>'.$course_semester.'</b></td>
								<td><b>'.$course_title.'</b></td>
								<td width="100px" align="center">'.$course_code.'</td>
								<td width="40px" align="center">'.$course_unit.'</td>
								<td width="70px" align="center"><a href="courses.php?edit='.$course_id.'">EDIT</a></td>
							</tr>
						';
					}
					
					$lcc += 1;
				}
			}
			
			$each_c .= '
				<div class="each_c">
					<div class="ec_level"><b>'.$course_level.'</b></div>
					<div class="ec_list">
						<table class="stable">
							'.$load_c.'
						</table>
					</div>
				</div>
			';
		}
	}
?>