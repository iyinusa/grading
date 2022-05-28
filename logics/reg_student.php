<?php
	$v_reg_msg = '';
	
	$vreg = mysql_query("SELECT * FROM g_student ORDER BY user_id DESC");
	$vreg_chk = mysql_num_rows($vreg);
	
	if($vreg_chk <= 0)
	{
		$v_reg_msg = 'No Records was returned';
	} else
	{
		$st_c = 1;
		while($vregr = mysql_fetch_assoc($vreg))
		{
			$title = strtoupper($vregr['title']);
			$fullname = strtoupper($vregr['fullname']);
			$session = $vregr['session'];
			$level = $vregr['level'];
			$matric = $vregr['matric'];
			$date = $vregr['reg_date'];
			
			if(($st_c%2) > 0)
			{
				$v_reg_msg .= '
					<tr style="background-color:#eee;">
						<td align="center">'.$date.'</td>
						<td align="center"><b>'.$session.'</b></td>
						<td align="center"><b>'.$level.'</b></td>
						<td><b>'.$title.' '.$fullname.'</b></td>
						<td align="center">'.$matric.'</td>
					</tr>
				';
			} else
			{
				$v_reg_msg .= '
					<tr>
						<td align="center">'.$date.'</td>
						<td align="center"><b>'.$session.'</b></td>
						<td align="center"><b>'.$level.'</b></td>
						<td><b>'.$title.' '.$fullname.'</b></td>
						<td align="center">'.$matric.'</td>
					</tr>
				';	
			}
			
			$st_c += 1;
		}
	}
	
	echo '
		<table class="reg_pat">
			<tr style="background-color:#CCC; font-size:medium; font-weigth:bold; color:#900; text-shadow:1px 0px 1px #FFF;">
				<td width="80px" align="center"><b>REG. DATE</b></td>
				<td width="80px" align="center"><b>SESSION</b></td>
				<td width="80px" align="center"><b>LEVEL</b></td>
				<td align="center"><b>FULLNAME</b></td>
				<td width="120px" align="center"><b>MATRIC NO.</b></td>
			</tr>
			'.$v_reg_msg.'
		</table>
	';
?>