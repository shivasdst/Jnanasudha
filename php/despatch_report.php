<?php

session_start();


if(isset($_SESSION['userid']))
{
	if($_SESSION['userid'] == 'sjs@math')
	{
		@header('Location: deny.php');
	}

	include("connect.php");
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<title>JnanaSudha</title>
	<link href=\"style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/report.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/report.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	</head>

	<body>
	<div class=\"page\">
		<div class=\"mainpage\">";
		
	//$dat = $_POST['t_1_1'];
	$bno = $_GET['bn'];
	$flagGT100 = 0;
	$cnt = 0;

	$today = getdate();
	$date = $today['mday'] . "-" . $today['mon'] . "-" . $today['year'];

	echo "<br/><div class=\"report\">Despatch Report as on $date</div><br/>";

	echo "<table class=\"updatetable\">
			<tr>
				<td style=\"width: 4%; font-weight: bold;\">Sr.No.</td>
				<td style=\"width: 8%; font-weight: bold;\">Institution<br />ID</td>
				<td style=\"width: 88%; font-weight: bold;\">Details</td>
			</tr>
		 ";

	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$query = "select * from payment where batch='$bno' or batch like '$bno;%' or batch like '%;$bno'";
	$res = mysql_query($query);
	for($i=0;$i<mysql_num_rows($res);$i++)
	{
		$cnt++;
		$row=mysql_fetch_assoc($res);
		$id = $row['schoolid'];
		$name = $row['t_1_1'] . ", " . $row['t_1_2'];
		
		$name = preg_replace("/\./",". ",$name);
		$name = ucwords(strtolower($name));
		$name = preg_replace("/\bPu\b/","PU",$name);
		
		$cata = explode(";",$row['t_2_1']);
		$catb = explode(";",$row['t_2_2']);
		$catc = explode(";",$row['t_2_3']);
		$batch = explode(";",$row['batch']);
		$catA = 0;
		$catB = 0;
		$catC = 0;
		for($j=0;$j<count($batch);$j++)
		{
			if($batch[$j] == $bno)
			{
				$catA = $catA + $cata[$j];
				$catB = $catB + $catb[$j];
				$catC = $catC + $catc[$j];
			}
		}
		
		$resA = mysql_query("select no from cata where schoolid='$id' and batch='$bno' order by no limit 1");
		$rowA = mysql_fetch_assoc($resA);
		$fromA = strtoupper($rowA['no']);
		if($fromA == '')
			$fromA = '--';
		$resA = mysql_query("select no from cata where schoolid='$id' and batch='$bno' order by no desc limit 1");
		$rowA = mysql_fetch_assoc($resA);
		$toA = strtoupper($rowA['no']);
		if($toA == '')
			$toA = '--';
		
		$resB = mysql_query("select no from catb where schoolid='$id' and batch='$bno' order by no limit 1");
		$rowB = mysql_fetch_assoc($resB);
		$fromB = strtoupper($rowB['no']);
		if($fromB == '')
			$fromB = '--';
		$resB = mysql_query("select no from catb where schoolid='$id' and batch='$bno' order by no desc limit 1");
		$rowB = mysql_fetch_assoc($resB);
		$toB = strtoupper($rowB['no']);
		if($toB == '')
			$toB = '--';
		
		$resC = mysql_query("select no from catc where schoolid='$id' and batch='$bno' order by no limit 1");
		$rowC = mysql_fetch_assoc($resC);
		$fromC = strtoupper($rowC['no']);
		if($fromC == '')
			$fromC = '--';
		$resC = mysql_query("select no from catc where schoolid='$id' and batch='$bno' order by no desc limit 1");
		$rowC = mysql_fetch_assoc($resC);
		$toC = strtoupper($rowC['no']);
		if($toC == '')
			$toC = '--';
		
		echo "<tr>
				<td>$cnt</td>
				<td>$id</td>
				<td>
					<table>
					<tr>
						<td style=\"width: 18%\">Institution</td>
						<td colspan=\"5\"><span class=\"bld\">$name</span></td>
					</tr>
					<tr>
						<td style=\"width: 23%\">Category <span class=\"bld\">A</span></td>
						<td style=\"width: 11%\"><span class=\"bld\">$catA</span></td>
						<td style=\"width: 6%\">From</td>
						<td style=\"width: 27%\">$fromA</td>
						<td style=\"width: 6%\">To</td>
						<td style=\"width: 27%\">$toA</td>
					</tr>
					<tr>
						<td style=\"width: 23%\">Category <span class=\"bld\">B</span></td>
						<td style=\"width: 11%\"><span class=\"bld\">$catB</span></td>
						<td style=\"width: 6%\">From</td>
						<td style=\"width: 27%\">$fromB</td>
						<td style=\"width: 6%\">To</td>
						<td style=\"width: 27%\">$toB</td>
					</tr>
					<tr>
						<td style=\"width: 23%\">Category <span class=\"bld\">C</span></td>
						<td style=\"width: 11%\"><span class=\"bld\">$catC</span></td>
						<td style=\"width: 6%\">From</td>
						<td style=\"width: 27%\">$fromC</td>
						<td style=\"width: 6%\">To</td>
						<td style=\"width: 27%\">$toC</td>
					</tr>
					</table>
				</td>
			  </tr>";
	}
	echo "</table>
		</div>
	</div>
	</body>
	</html>";
}
else
{
	@header('Location: login.php');
}
?>

