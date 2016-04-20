<?php
session_start();

if(!isset($_SESSION['userid']))
{
	@header('Location: login.php');
}

if(isset($_SESSION['userid']))
{
	if(!isset($_GET['date']))
		return;
		
	include("connect.php");
	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	
	$dat = $_GET['date'];
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<title>$dat</title>
	<link href=\"style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/certificate.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/certificate.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	</head>
	<body>";
	
	$qur1 = "select * from institution_kan where date='$dat'";
	$res1 = mysql_query($qur1);
	$num_Of_insti = mysql_num_rows($res1);
	for($k=0;$k<$num_Of_insti;$k++)
	{
		$id = mysql_result($res1,$k,'institution_id');
		$name = mysql_result($res1,$k,'name');
		$qur = "select * from student where institution_id='$id'";
		$res = mysql_query($qur);
		$num_Of_stud = mysql_num_rows($res);
		for($i=0;$i<$num_Of_stud;$i++)
		{
			$stud_name = mysql_result($res,$i,'t_1_2');
			echo "<div class=\"stud\">";
			if(strlen($name) <= 140)
				echo "<div class=\"stud_name1\">$stud_name</div>
					  <div class=\"stud_school1\">$name</div>";
			else
				echo "<div class=\"stud_name2\">$stud_name</div>
					  <div class=\"stud_school2\">$name</div>";
			echo "</div>";
		}
	}
	
	echo"</body>
	</html>";
}
