<?php
	//load common files
	include("design/conn.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Grading System | Register</title>
<link rel="stylesheet" type="text/css" href="styles/lay.css"/>

</head>

<body>
	<div id="eis_all">
    	<div id="eis_header" class="ahome">
        	<?php include('design/header.php'); ?>
        </div>
        
        <div id="eis_logview">
        	<?php include('design/logview.php'); ?>
        </div>
        
        <div id="eis_contents">
        	<div id="eis_banner">
            	<?php include('design/banner.php'); ?>
            </div>
            
            <div>
            	<div id="eis_home">
                	<div id="eih_left">
                        <div style="font-size:xx-large; color:#036; margin:10px 0px;">Lecturer Registration >></div>
                        <b><u>PLEASE REGISTER HERE</u></b><br /><br />
						<?php include('logics/lregister.php'); ?>
                        <form action="lregister.php" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td colspan="2">If you are a Student, please <a href="register.php">Click Here</a> to Register</td>
                                </tr>
                                <tr>
                                    <td><b>Username:</b></td>
                                    <td>
                                        <input type="text" name="r_user" style="width:50%;" placeholder="Username..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Password:</b></td>
                                    <td>
                                        <input type="password" name="r_pass" style="width:50%;" placeholder="Password..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Confirm Password:</b></td>
                                    <td>
                                        <input type="password" name="r_cpass" style="width:50%;" placeholder="Confirm Password..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Staff Number:</b></td>
                                    <td>
                                        <input type="text" name="r_num" style="width:40%;" placeholder="Staff Number..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Title:</b></td>
                                    <td>
                                        <select name="r_title">
                                            <option value="">Title...</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Miss.">Miss.</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Full Name:</b></td>
                                    <td>
                                        <input type="text" name="r_fullname" style="width:80%;" placeholder="Surname First..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Address:</b></td>
                                    <td>
                                        <textarea name="r_address" style="width:90%;" placeholder="Address..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Email Address:</b></td>
                                    <td>
                                        <input type="text" name="r_email" style="width:60%;" placeholder="Email Address..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Phone Number:</b></td>
                                    <td>
                                        <input type="text" name="r_phone" style="width:40%;" placeholder="Phone Number..." />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Date of Birth:</b></td>
                                    <td>
                                        <input type="text" name="r_dob" style="width:40%;" placeholder="Date of Birth..." />&nbsp;<i>(i.e. dd/mm/yyyy)</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Sex:</b></td>
                                    <td>
                                        <select name="r_sex">
                                            <option value="">Sex...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Marital Status:</b></td>
                                    <td>
                                        <select name="r_status">
                                            <option value="">Marital Status...</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                            			<input type="submit" name="btnRegister" value="Register Now !" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="eih_right">
                    
                    </div>
                </div>
            </div>
        </div>
        
        <div id="eis_footer">
        	<?php include('design/footer.php'); ?>
        </div>
    </div>
</body>
</html>