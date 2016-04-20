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
	<link href=\"style/receipt.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/receipt.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	</head>

	<body>";

	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$today = getdate();

	$day = $today['mday'];

	if(($day == 1) || ($day == 21) || ($day == 31))
	{
		$day = $day . "<sup>st</sup>";
	}
	elseif(($day == 2) || ($day == 22))
	{
		$day = $day . "<sup>nd</sup>";
	}
	elseif(($day == 3) || ($day == 23))
	{
		$day = $day . "<sup>rd</sup>";
	}
	else
	{
		$day = $day . "<sup>th</sup>";
	}


	$date = $day . " " . $today['month'] . " " . $today['year'];

	if(isset($_GET['schoolid']))
	{
		$schoolid[0] = $_GET['schoolid'];
		$num = 1;
		$query = "select batch from payment where schoolid='$schoolid[0]'";
		$res = mysql_query($query);
		$row=mysql_fetch_assoc($res);
		$bno = explode(";", $row['batch']);
		$flag = 0;
	}
	elseif(isset($_GET['bn']))
	{
		$bno = $_GET['bn'];
		$query = "select * from payment where batch='$bno' or batch like '$bno;%' or batch like '%;$bno'";
		$res = mysql_query($query);
		$num = mysql_num_rows($res);
		for($i=0;$i<mysql_num_rows($res);$i++)
		{
			$row=mysql_fetch_assoc($res);
			$schoolid[$i] = $row['schoolid'];
		}
		$flag = 1;
	}

	for($i=0;$i<$num;$i++)
	{
		$res = mysql_query("select * from payment where schoolid='$schoolid[$i]'");
		$row = mysql_fetch_assoc($res);

		$res1 = mysql_query("select head, address, taluk, district, institute from institution where institution_id='$schoolid[$i]'");
		$row1 = mysql_fetch_assoc($res1);
		$head = $row1['head'];
		$address = $row1['address'];
		$taluk = $row1['taluk'];
		$district = $row1['district'];
		$institute = $row1['institute'];

		$head = $head . ", " . $institute;

		if($address != '')
		{
			$head = $head . ", " . $address;
		}
		if($taluk != '')
		{
			$head = $head . ", " . $taluk;
		}
		if($district != '')
		{
			$head = $head . ", " . $district;
		}

		$head = preg_replace("/\./", ". ", $head);
		$head = ucwords(strtolower($head));
		$head = preg_replace("/ Pu /", " PU ", $head);
		
		$head = "<span class=\"bld udl\">$head</span>";

		$t_1_1 = $row['t_1_1'];
		$t1_3_2 = $row['t_3_2'];
		$t1_3_3 = $row['t_3_3'];
		$t11_3_4 = $row['t1_3_4'];
		$t11_3_5 = $row['t1_3_5'];
		$t12_3_4 = $row['t2_3_4'];
		$t12_3_5 = $row['t2_3_5'];
		$t13_3_5 = $row['t3_3_5'];
		$t14_3_5 = $row['t4_3_5'];
		$rno = $row['rno'];

		$t1_3_2 = explode(";", $t1_3_2);
		$t1_3_3 = explode(";", $t1_3_3);
		$t11_3_4 = explode(";",$t11_3_4);
		$t11_3_5 = explode(";",$t11_3_5);
		$t12_3_4 = explode(";",$t12_3_4);
		$t12_3_5 = explode(";",$t12_3_5);
		$t13_3_5 = explode(";",$t13_3_5);
		$t14_3_5 = explode(";",$t14_3_5);
		$recno = explode(";", $rno);
		$bn = explode(";", $row['batch']);

		$cnt = count($recno);

		for($j=0;$j<$cnt;$j++)
		{
			if($flag == 1)
			{
				if($bn[$j] != $bno)
					continue;
			}
			$t_3_2 = $t1_3_2[$j];
			$t_3_3 = $t1_3_3[$j];
			$t1_3_4 = $t11_3_4[$j];
			$t1_3_5 = $t11_3_5[$j];
			$t2_3_4 = $t12_3_4[$j];
			$t2_3_5 = $t12_3_5[$j];
			$t3_3_5 = $t13_3_5[$j];
			$t4_3_5 = $t14_3_5[$j];
			$rno = $recno[$j];
			
			$t_3_2w = rs_to_words($t_3_2);
			$t_3_2w = trim(ucwords(strtolower($t_3_2w)));
			$t_3_2w = preg_replace("/\&$/", "", $t_3_2w);
			
			echo "<div class=\"page\">";
			
			echo "<div class=\"form1\">
					<table>
						<tr class=\"r1\">
							<td class=\"c1\"><img src=\"images/logo.png\" alt=\"RK Logo\" /></td>
							<td class=\"c2\">
								<span class=\"big\">Sri Ramakrishna Ashrama</span><br />
								Yadavagiri, Mysore - 570 020<br />
								<span class=\"bld\">Sri Sharada Jnanasudha</span><br />
							</td>
							<td class=\"c3\">Customer Copy<div class=\"black\">id: $schoolid[$i]</div></td>
						</tr>
						<tr class=\"r2\">
							<td class=\"c1\">No.:&nbsp;$rno</td>
							<td class=\"c2\">Receipt</td>
							<td class=\"c3\">Date:&nbsp;$date</td>
						</tr>
					</table>
					<p>Received with thanks from $head, a sum of <span class=\"bld udl\">Rs. $t_3_2 (Rupees $t_3_2w only)</span> towards fee for participating in <span class=\"itl\">Sri Sharada Jnanasudha</span> Quiz Competition, through ";
					
					if($t_3_3 == 'Demand Draft')
					{
						echo "a <span class=\"bld udl\">Demand Draft</span>";
						if($t1_3_4 != '')
						{
							echo " bearing number $t1_3_4";
						}
						if($t1_3_5 != '')
						{
							echo " dated $t1_3_5";
						}
					}
					elseif($t_3_3 == 'Cheque')
					{
						echo "a <span class=\"bld udl\">Cheque</span>";
						if($t2_3_4 != '')
						{
							echo " bearing number $t2_3_4";
						}
						if($t2_3_5 != '')
						{
							echo " dated $t2_3_5";
						}
					}
					elseif($t_3_3 == 'MoneyOrder')
					{
						echo "a <span class=\"bld udl\">money order</span>";
						if($t3_3_5 != '')
						{
							echo " dated $t3_3_5";
						}
					}
					elseif($t_3_3 == 'Cash')
					{
						echo "<span class=\"bld udl\">Cash</span>";
					}
					
					echo ".</p>";
					
					echo "<div class=\"rec\">Receiver&apos;s Signature</div>
					<img class=\"sign_img\" src=\"images/mukti_sign.png\" alt=\"Swami Muktidananda Fascimile\" />
					<div class=\"sign\">Adhyaksha</div>
				</div>";
				
			echo "<div class=\"form2\">
					<table>
						<tr class=\"r1\">
							<td class=\"c1\"><img src=\"images/logo.png\" alt=\"RK Logo\" /></td>
							<td class=\"c2\">
								<span class=\"big\">Sri Ramakrishna Ashrama</span><br />
								Yadavagiri, Mysore - 570 020<br />
								<span class=\"bld\">Sri Sharada Jnanasudha</span><br />
							</td>
							<td class=\"c3\">Accounts Section Copy<div class=\"black\">id: $schoolid[$i]</div></td>
						</tr>
						<tr class=\"r2\">
							<td class=\"c1\">No.:&nbsp;$rno</td>
							<td class=\"c2\">Receipt</td>
							<td class=\"c3\">Date:&nbsp;$date</td>
						</tr>
					</table>
					<p>Received with thanks from $head, a sum of <span class=\"bld udl\">Rs. $t_3_2 (Rupees $t_3_2w only)</span> towards fee for participating in <span class=\"itl\">Sri Sharada Jnanasudha</span> Quiz Competition, through ";
					
					if($t_3_3 == 'Demand Draft')
					{
						echo "a <span class=\"bld udl\">Demand Draft</span>";
						if($t1_3_4 != '')
						{
							echo " bearing number $t1_3_4";
						}
						if($t1_3_5 != '')
						{
							echo " dated $t1_3_5";
						}
					}
					elseif($t_3_3 == 'Cheque')
					{
						echo "a <span class=\"bld udl\">Cheque</span>";
						if($t2_3_4 != '')
						{
							echo " bearing number $t2_3_4";
						}
						if($t2_3_5 != '')
						{
							echo " dated $t2_3_5";
						}
					}
					elseif($t_3_3 == 'MoneyOrder')
					{
						echo "a <span class=\"bld udl\">money order</span>";
						if($t3_3_5 != '')
						{
							echo " dated $t3_3_5";
						}
					}
					elseif($t_3_3 == 'Cash')
					{
						echo "<span class=\"bld udl\">Cash</span>";
					}
					
					echo ".</p>";
					
					echo "<div class=\"rec\">Receiver&apos;s Signature</div>
					<img class=\"sign_img\" src=\"images/mukti_sign.png\" alt=\"Swami Muktidananda Fascimile\" />
					<div class=\"sign\">Adhyaksha</div>
				</div>";
				
			echo "<div class=\"form3\">
					<table>
						<tr class=\"r1\">
							<td class=\"c1\"><img src=\"images/logo.png\" alt=\"RK Logo\" /></td>
							<td class=\"c2\">
								<span class=\"big\">Sri Ramakrishna Ashrama</span><br />
								Yadavagiri, Mysore - 570 020<br />
								<span class=\"bld\">Sri Sharada Jnanasudha</span><br />
							</td>
							<td class=\"c3\">File<div class=\"black\">id: $schoolid[$i]</div></td>
						</tr>
						<tr class=\"r2\">
							<td class=\"c1\">No.:&nbsp;$rno</td>
							<td class=\"c2\">Receipt</td>
							<td class=\"c3\">Date:&nbsp;$date</td>
						</tr>
					</table>
					<p>Received with thanks from $head, a sum of <span class=\"bld udl\">Rs. $t_3_2 (Rupees $t_3_2w only)</span> towards fee for participating in <span class=\"itl\">Sri Sharada Jnanasudha</span> Quiz Competition, through ";
					
					if($t_3_3 == 'Demand Draft')
					{
						echo "a <span class=\"bld udl\">Demand Draft</span>";
						if($t1_3_4 != '')
						{
							echo " bearing number $t1_3_4";
						}
						if($t1_3_5 != '')
						{
							echo " dated $t1_3_5";
						}
					}
					elseif($t_3_3 == 'Cheque')
					{
						echo "a <span class=\"bld udl\">Cheque</span>";
						if($t2_3_4 != '')
						{
							echo " bearing number $t2_3_4";
						}
						if($t2_3_5 != '')
						{
							echo " dated $t2_3_5";
						}
					}
					elseif($t_3_3 == 'MoneyOrder')
					{
						echo "a <span class=\"bld udl\">money order</span>";
						if($t3_3_5 != '')
						{
							echo " dated $t3_3_5";
						}
					}
					elseif($t_3_3 == 'Cash')
					{
						echo "<span class=\"bld udl\">Cash</span>";
					}
					
					echo ".</p>";
					
					echo "<div class=\"rec\">Receiver&apos;s Signature</div>
					<img class=\"sign_img\" src=\"images/mukti_sign.png\" alt=\"Swami Muktidananda Fascimile\" />
					<div class=\"sign\">Adhyaksha</div>
				</div>";
			echo "</div>";
		}
	}
	echo "</body>
</html>";
}
else
{
	@header('Location: login.php');
}
?>
