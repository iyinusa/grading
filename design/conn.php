<?php
	//start session
	session_start();
	$eroot = 'http://'.$_SERVER['HTTP_HOST'].'/grading';
	
	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "root";
	$db_name = "gradedb";
	
	mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
	mysql_select_db("$db_name") or die("Database Connection Error");
?>