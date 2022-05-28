<?php
	$s_reg_msg = '';
	$role_form = '';
	$role_msg = '';
	
	//verify staff
	if(isset($_GET['verify']) && isset($_GET['status']))
	{
		$verify = $_GET['verify'];
		$status = $_GET['status'];
		
		if($status == 'Not Verified')
		{
			$status_change = '<option value="Varify">Varify</option>';
		} else
		{
			$status_change = '<option value="Unvarify">Unvarify</option>';
		}
		
		if(isset($_POST['btnVerify']))
		{
			$r_id = $_POST['r_id'];
			$r_status = $_POST['r_status'];
			
			if(!$r_id || !$r_status)
			{
				
			} else
			{
				if($r_status == 'Varify'){$r_status = '1';}else{$r_status = '0';}
				
				//update status
				if(mysql_query("UPDATE g_lecturer SET staff_status='$r_status' WHERE user_id='$r_id' LIMIT 1"))
				{
					$role_form = '<div class="msg">Account Verification Changed</div>';
				}
			}
		} else
		{
			$role_form = '
				<form action="users.php?verify='.$verify.'&amp;status='.$status.'" method="post" enctype="multipart/form-data">
					<div>
						<table>
							<tr>
								<td><b>Current Status</b></td>
								<td>'.$status.'</td>
							</tr>
							<tr>
								<td><b>Change Status</b></td>
								<td>
									<input type="hidden" name="r_id" value="'.$verify.'" />
									<select name="r_status">
										'.$status_change.'
									</select>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="btnVerify" value="Change Varification" />
								</td>
							</tr>
						</table>
					</div>
				</form>
			';
		}
	}
	
	$sreg = mysql_query("SELECT * FROM g_lecturer ORDER BY user_id DESC");
	$sreg_chk = mysql_num_rows($sreg);
	
	if($sreg_chk <= 0)
	{
		$s_reg_msg = 'No Records was returned';
	} else
	{
		$stf_c = 1;
		while($sregr = mysql_fetch_assoc($sreg))
		{
			$staff_id = $sregr['user_id'];
			$stitle = strtoupper($sregr['title']);
			$sfullname = strtoupper($sregr['fullname']);
			$staff_status = $sregr['staff_status'];
			$srole = $sregr['role'];
			$sstaffno = $sregr['staffno'];
			$sdate = $sregr['reg_date'];
			
			if($staff_status == '0'){$staff_status = 'Not Verified';}else{$staff_status = 'Varified';}
			
			if(($stf_c%2) > 0)
			{
				$s_reg_msg .= '
					<tr style="background-color:#eee;">
						<td align="center">'.$sdate.'</td>
						<td align="center"><b>'.$srole.'</b></td>
						<td><b>'.$stitle.' '.$sfullname.'</b></td>
						<td align="center"><b>'.$sstaffno.'</b></td>
						<td align="center">'.$staff_status.'</td>
						<td align="center"><a href="users.php?verify='.$staff_id.'&amp;status='.$staff_status.'">Verify</a></td>
					</tr>
				';
			} else
			{
				$s_reg_msg .= '
					<tr>
						<td align="center">'.$sdate.'</td>
						<td align="center"><b>'.$srole.'</b></td>
						<td><b>'.$stitle.' '.$sfullname.'</b></td>
						<td align="center"><b>'.$sstaffno.'</b></td>
						<td align="center">'.$staff_status.'</td>
						<td align="center"><a href="users.php?verify='.$staff_id.'&amp;status='.$staff_status.'">Verify</a></td>
					</tr>
				';	
			}
			
			$stf_c += 1;
		}
	}
	
	echo '
		<table class="reg_pat">
			<tr style="background-color:#CCC; font-size:medium; font-weigth:bold; color:#900; text-shadow:1px 0px 1px #FFF;">
				<td width="80px" align="center"><b>REG. DATE</b></td>
				<td width="80px" align="center"><b>ROLE</b></td>
				<td align="center"><b>FULLNAME</b></td>
				<td width="120px" align="center"><b>STAFF NO.</b></td>
				<td width="80px" align="center"><b>STATUS</b></td>
				<td width="50px" align="center"></td>
			</tr>
			'.$s_reg_msg.'
		</table>
	';
?>