<?php
session_start();

/*
if(isset($_SESSION['userid']))
{
*/
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<title>JnanaSudha</title>
	<link href=\"style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/receipt.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/report.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/receipt.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/report.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	</head>

	<body>
		<div class=\"page_stud\">";

	include("connect.php");
	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$dat = $_GET['date'];

	$qur1 = "select * from institution_kan where date='$dat'";
	$res1 = mysql_query($qur1);
	$num_Of_insti = mysql_num_rows($res1);
	for($k=0;$k<$num_Of_insti;$k++)
	{
		$id = mysql_result($res1,$k,'institution_id');
		$name = mysql_result($res1,$k,'name');
		
		echo "<br/><table class=\"updatetable\">
			<tr>
				<td id=\"insti\" colspan=\"4\"><b>Institution ID</b> : $id<br />
				<span class=\"kannadaspan\"><b>ವಿದ್ಯಾಸಂಸ್ಥೆಯ ಹೆಸರು ಮತ್ತು ಸ್ಥಳ</b> : $name</span><br />
			</tr>
			<tr>
				<td style=\"width: 10%\">Sl. No.</td>
				<td style=\"width: 25%\">Answer Paper No.</td>
				<td style=\"width: 65%\"><span class=\"kannadaspan\"><b>ವಿದ್ಯಾರ್ಥಿಯ ಹೆಸರು</b></span></td>
			</tr>
		";
		
		$qur = "select * from student where institution_id='$id'";
		$res = mysql_query($qur);
		$num_Of_stud = mysql_num_rows($res);
		for($i=0;$i<$num_Of_stud;$i++)
		{
			$j = $i+1;
			$qn_paper_no = mysql_result($res,$i,'t_1_1');
			$stud_name = mysql_result($res,$i,'t_1_2');
			
			$id1 = "t" . $j . "_2_2";
			$id2 = "t" . $j . "_2_3";
			echo "<tr>
				<td>" . $j . "</td>
				<td>$qn_paper_no</td>
				<td><span class=\"kannadaspan\">$stud_name</span></td>
				</tr>";
		}
		echo "</table>";
	}
	echo "</div>
	</body>
	</html>";
/*
}
*/
?>
