<?php // content="text/plain; charset=utf-8"
	include('../logics/jgraph/jpgraph.php');
	include('../logics/jgraph/jpgraph_pie.php');
	include('../logics/jgraph/jpgraph_pie3d.php');
	
	$each_c = '';
	
	if(isset($_POST['btnLoad']))
	{
		$r_type = $_POST['r_type'];
		$r_level = $_POST['r_level'];
		$r_session = $_POST['r_session'];
		$r_semester = $_POST['r_semester'];
		
		if(!$r_type || !$r_level || !$r_session || !$r_semester)
		{
			$each_c = '<h3 style="text-align:center;">You must make selection in all above</h3>';
		} else
		{
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//load course statistics
			if($r_type == 'Course Statistics')
			{
				//load courses
				if($r_semester == 'All')
				{
					$lc = mysql_query("SELECT * FROM p_course WHERE course_level='$r_level' ORDER BY course_title ASC");
				} else
				{
					$lc = mysql_query("SELECT * FROM p_course WHERE course_level='$r_level' AND course_semester='$r_semester' ORDER BY course_title ASC");
				}
				
				$lc_c = mysql_num_rows($lc);
				if($lc_c <= 0)
				{
					$each_c = '<h3 style="text-align:center;">No Courses Statistics</h3>';
				} else
				{
					$ch = 1;
					while($lcr = mysql_fetch_assoc($lc))
					{
						$course_id = $lcr['course_id'];
						$course_code = $lcr['course_code'];
						$course_title = $lcr['course_title'];
						$course_unit = $lcr['course_unit'];
						
						//get total students that register course
						$total_reg = mysql_num_rows(mysql_query("SELECT * FROM p_mycourse WHERE course_id='$course_id'"));
						
						//get total number of students in that level
						$total_student = mysql_num_rows(mysql_query("SELECT * FROM g_student WHERE session='$r_session' AND level='$r_level'"));
						
						$total_un_reg = $total_student - $total_reg;
						
						//create chart here
						$data = array($total_reg,$total_un_reg);
 
						$graph = new PieGraph(400,350);
						$graph->SetShadow();
						 
						$graph->title->Set($course_title.' ('.$course_code.') - ['.$total_reg.' of '.$total_student.']'); 
						
						$p1 = new PiePlot($data);
						 
						$legends = array("Registered = ".$total_reg,"Unregistered = ".$total_un_reg);
						$p1->SetLegends($legends);
						
						$graph->Add($p1);
						@unlink("graph".$ch.".jpg");
						$graph->Stroke("graph".$ch.".jpg");
						$each_c .= '
							<div class="chart_lay_each">
								<img src="graph'.$ch.'.jpg?' .time(). '">
							</div>
						';
						
						$ch += 1;
					}
					
					//output all chart
					$each_c = '
						<div class="chart_lay">
							<div class="chart_lay_title">
								<h2>'.$r_type.' for '.$r_semester.' '.$r_level.', '.$r_session.' Session</h2>
								<div>
									<b>Please Note: </b>The BLUE Shaded means Registered While the PINK Shaded means Unregistered
								</div>
							</div>
							'.$each_c.'
						</div>
					';
				}
			} else if($r_type == 'Result Sheet')
			{
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//load result sheet	
					
			} else
			{
				$each_c = '<h3 style="text-align:center;">Please make appropriate selection</h3>';
			}
		}
	}
?>  