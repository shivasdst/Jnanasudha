<?php

session_start(); 

if((isset($_SESSION['userid'])) && ($_SESSION['userid'] != 'sjs@math'))
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
	<link href=\"style/sjs.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"style/sjs.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
	</head>";

	$batch = $_GET['bn'];

	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$qur1 = "select date, batch from payment where batch='$batch' or batch like '$batch;%' or batch like '%;$batch'";
	$res1 = mysql_query($qur1);
	$row1=mysql_fetch_assoc($res1);
	$date1 = $row1['date'];
	$bno = $row1['batch'];
	$date1 = explode(";", $date1);
	$bno = explode(";", $bno);
	for($i=0;$i<count($date1);$i++)
	{
		if($bno[$i] == $batch)
			$date = $date1[$i];
	}
	
	
	$stno = str_pad($batch, 3, "0", STR_PAD_LEFT) . ":" . $date;
	
	echo "<body>
		<div class=\"page\">	
			<table>
				<tr style=\"border: none;height: 7em;vertical-align: top;\">
					<td colspan=\"2\" class=\"c1\" style=\"border: none;text-align: center;\"><img src=\"images/logo.png\" alt=\"RK Logo\" /></td>
					<td colspan=\"6\" class=\"c3\" style=\"border: none;text-align: center;\">
						<span class=\"big\">Sri Ramakrishna Ashrama</span><br />
						Yadavagiri, Mysore - 570 020<br />
						<span class=\"bld\">Sri Sharada Jnanasudha</span><br />
					</td>
					<td colspan=\"2\" class=\"c9\" style=\"border: none;text-align: left;padding: 1em 1em 0 0;\">No.&nbsp;&nbsp;: $stno<br />Date: $date</td>
				</tr>
				<tr style=\"border-top: 2px solid #000000;font-weight: bold;\">
					<td rowspan=\"2\" class=\"c1\">Sl.<br />No.</td>
					<td rowspan=\"2\" class=\"c2\">Receipt<br />No.</td>
					<td rowspan=\"2\" class=\"c3\">Date</td>
					<td class=\"c4\" colspan=\"2\" style=\"text-align:center;padding-right:0;\">Fee for Participation (Rs.)</td>
					<td rowspan=\"2\" class=\"c6\">DD No.</td>
					<td rowspan=\"2\" class=\"c7\">DD Date</td>
					<td rowspan=\"2\" class=\"c8\">DD Bank</td>
					<td class=\"c9\" colspan=\"2\" style=\"text-align:center;\">Office Use</td>
				</tr>
				<tr style=\"border-bottom: 2px solid #000000;font-weight: bold;text-align: center;\">
					<td class=\"c4\" style=\"text-align:center;\">Cash/MO</td>
					<td class=\"c5\" style=\"text-align:center;\">DD/Cheque</td>
					<td class=\"c9\">Voucher</td>
					<td class=\"c10\">Remarks</td>
				</tr>";

	$qur = "select * from payment where batch='$batch' or batch like '$batch;%' or batch like '%;$batch' order by rno";
	$res = mysql_query($qur);
	$num = mysql_num_rows($res);

	$sln = 1;
	$cash_total = 0;
	$dd_total = 0;
	for($i=0;$i<mysql_num_rows($res);$i++)
	{
		$row=mysql_fetch_assoc($res);
		$bno = explode(";",$row['batch']);
		$rno = explode(";", $row['rno']);
		$date = explode(";", $row['date']);
		$t_3_2 = explode(";", $row['t_3_2']);
		$t_3_3 = explode(";", $row['t_3_3']);
		$t1_3_4 = explode(";", $row['t1_3_4']);
		$t1_3_5 = explode(";", $row['t1_3_5']);
		$t1_3_6 = explode(";", $row['t1_3_6']);
		
		for($j=0;$j<sizeof($rno);$j++)
		{
			if($bno[$j] != $batch)
				continue;
			
			echo "<tr>
			<td class=\"c1\">".$sln.".</td>
			<td class=\"c2\">".$rno[$j]."</td>
			<td class=\"c3\">".$date[$j]."</td>";
			
			if(($t_3_3[$j] == 'Cash')||($t_3_3[$j] == 'MoneyOrder'))
			{
				echo "<td class=\"c4\">".$t_3_2[$j]."</td>
				<td class=\"c5\">&nbsp;</td>";
				$cash_total = $cash_total + $t_3_2[$j];
			}
			elseif(($t_3_3[$j] == 'Demand Draft')||($t_3_3[$j] == 'Cheque'))
			{
				echo "<td class=\"c4\">&nbsp;</td>
				<td class=\"c5\">".$t_3_2[$j]."</td>";
				$dd_total = $dd_total + $t_3_2[$j];
			}
			
			echo "<td class=\"c6\">".$t1_3_4[$j]."</td>
			<td class=\"c7\">".$t1_3_5[$j]."</td>
			<td class=\"c8\">".$t1_3_6[$j]."</td>
			<td class=\"c9\"></td>
			<td class=\"c10\"></td>
			</tr>";
			$sln++;
		}			
	}

	$grand_total = $cash_total + $dd_total;

	echo "<tr style=\"border-top: 2px solid #000000;border-bottom: 2px solid #000000;font-weight: bold;\">
			<td colspan=\"3\" class=\"c1\">Total</td>
			<td class=\"c4\">$cash_total</td>
			<td class=\"c5\">$dd_total</td>
			<td colspan=\"5\" class=\"c6\">&nbsp;</td>
		</tr>
		<tr style=\"border-top: 2px solid #000000;border-bottom: 2px solid #000000;font-weight: bold;\">
			<td colspan=\"3\" class=\"c1\">Grand Total</td>
			<td colspan=\"7\" class=\"c4\" style=\"text-align: left;padding-left: 0.5em;\">Rs. $grand_total (Rupees ".trim(ucwords(strtolower(rs_to_words($grand_total))))." Only)</td>
		</tr></table>
		</div>
	</body>
	</html>";
}
else
{
	@header('Location: login.php');
}
?>
