<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JnanaSudha</title>
<link href="style/reset.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/indexstyle.css" media="screen" rel="stylesheet" type="text/css" />
<link href="style/reset.css" media="print" rel="stylesheet" type="text/css" />
<link href="style/indexstyle.css" media="print" rel="stylesheet" type="text/css" />
</head>

<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

echo "<body>

<div class=\"page\">
	<div class=\"header\">
		<div class=\"title\">JnanaSudha</div>
		<div class=\"nav\">
			<ul>
				<li><a href=\"../index.php\">Home</a></li>
				<li><a href=\"login.php\">Login</a></li>
				<li><a href=\"schools.php?ed=0&ud=0\">Schools</a></li>
				<li><a href=\"despatch.php?ud=0\">Despatch</a></li>
				<li><a class=\"active\" href=\"edit.php\">Edit</a></li>
				<li><a href=\"status.php\">Status</a></li>
				<li><a href=\"valuation.php\">Valuation</a></li>
				<li><a href=\"logout.php\">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class=\"mainpage\">";
if(isset($_SESSION['userid']))
{
	if($_SESSION['userid'] != 'sjs@math')
	{
		if(isset($_GET['sl']))
			$sl = $_GET['sl'];
		else
			$sl = 0;
		
		if($sl == 0)
		{
			if(isset($_GET['sort']))
			{
				$sort = $_GET['sort'];
			}
			else
			{
				$sort = 'schoolid';
			}

			echo	"<table class=\"maintable\">
						<tr>
							<td class=\"left\">
								<a href=\"edit.php?sl=1\">Edit</a> Agent Details<br />
								<a href=\"edit.php?sl=4\">Edit</a> Valuation Details
							</td>
						</tr>
					</table>";

			$query = "select * from payment order by $sort";
			$res = mysql_query($query);
			$num_row = mysql_num_rows($res);

			if($num_row)
			{
				echo "<div class=\"des\">&nbsp;No of schools entered into the database = $num_row</div>";
			}
				
			echo	"<table class=\"updatetable\">
						<tr>
							<td style=\"width: 8%; font-weight: bold;\">SchoolID&nbsp;<a href=\"edit.php?sort=schoolid\">↓</a></td>
							<td style=\"width: 27%; font-weight: bold;\">School Name&nbsp;<a href=\"edit.php?sort=t_1_1\">↓</a></td>
							<td style=\"width: 9%; font-weight: bold;\">District&nbsp;<a href=\"edit.php?sort=t_1_4\">↓</a></td>
							<td style=\"width: 12%; font-weight: bold;\">Contact Person</td>
							<td style=\"width: 12%; font-weight: bold;\">Contact No</td>
							<td style=\"width: 12%; font-weight: bold;\">Receipt No&nbsp;<a href=\"edit.php?sort=rno\">↓</a></td>
							<td style=\"width: 11%; font-weight: bold;\">Generate Receipt</td>
							<td style=\"width: 9%; font-weight: bold;\">Update</td>
						</tr>";

			if($num_row)
			{
				for($i=0;$i<$num_row;$i++)
				{
					$row = mysql_fetch_assoc($res);
					
					$schoolid = $row['schoolid'];
					$t_1_1 = $row['t_1_1'];
					$t_1_4 = $row['t_1_4'];
					$t_1_6 = $row['t_1_6'];
					$t_1_7 = $row['t_1_7'];
					$rno = $row['rno'];
					
					echo "<tr>
						<td><span class=\"titlespan\">$schoolid</span></td>
						<td><span class=\"updatespan\"><a href=\"";
					if(substr($rno,0,3) == "AGT")
						echo "schools_by_agents.php?ed=0&ud=1&schoolid=$schoolid\">";
					else
						echo "schools.php?ed=0&ud=1&schoolid=$schoolid;1\">";
					echo"$t_1_1</a></span></td>
						<td><span class=\"titlespan\">$t_1_4</span></td>
						<td><span class=\"titlespan\">$t_1_6</span></td>
						<td><span class=\"titlespan\">$t_1_7</span></td>
						<td><span class=\"titlespan\">$rno</span></td>
						<td><span class=\"updatespan\">";
					if(substr($rno,0,3) == "AGT")
						echo "Generate Reciept";
					else
						echo "<a href=\"receipt.php?schoolid=$schoolid\" target=\"_blank\">Generate Reciept</a>";
					echo "</span></td>
						<td><span class=\"updatespan\"><a href=\"";
					if(substr($rno,0,3) == "AGT")
						echo "schools_by_agents.php?ed=0&ud=1&schoolid=$schoolid\">";
					else
						echo "schools.php?ed=0&ud=1&schoolid=$schoolid;1\">";
					echo "Update</a></span></td>
					</tr>";
				}
			}

				echo"</table>";
		}
		
		elseif($sl == 1)
		{
			$query = "select * from agent order by agentid";
			$res = mysql_query($query);
			$num_row = mysql_num_rows($res);

			if($num_row)
			{
				echo "<div>&nbsp;No of agents entered into the database = $num_row</div>";
			}
				
			echo	"<table class=\"updatetable\">
						<tr>
							<td style=\"width: 8%; font-weight: bold;\" rowspan=\"2\">agentID</td>
							<td style=\"width: 16%; font-weight: bold;\" rowspan=\"2\">Agent Name</td>
							<td style=\"width: 12%; font-weight: bold;\" rowspan=\"2\">Phone No.</td>
							<td style=\"width: 18%; font-weight: bold;\" colspan=\"2\">Cat A</td>
							<td style=\"width: 18%; font-weight: bold;\" colspan=\"2\">Cat B</td>
							<td style=\"width: 18%; font-weight: bold;\" colspan=\"2\">Cat C</td>
							<td style=\"width: 10%; font-weight: bold;\"  rowspan=\"2\">Update</td>
						</tr>
						<tr>
							<td style=\"width: 9%; font-weight: bold;\">From</td>
							<td style=\"width: 9%; font-weight: bold;\">To</td>
							<td style=\"width: 9%; font-weight: bold;\">From</td>
							<td style=\"width: 9%; font-weight: bold;\">To</td>
							<td style=\"width: 9%; font-weight: bold;\">From</td>
							<td style=\"width: 9%; font-weight: bold;\">To</td>
						</tr>";

			if($num_row)
			{
				for($i=0;$i<$num_row;$i++)
				{
					$row = mysql_fetch_assoc($res);
					
					$agentID = $row['agentid'];
					$t_1_1 = $row['t_1_1'];
					$t_1_3 = $row['t_1_3'];
					$t_2_2 = $row['t_2_2'];
					$t_2_3 = $row['t_2_3'];
					$t_3_2 = $row['t_3_2'];
					$t_3_3 = $row['t_3_3'];
					$t_4_2 = $row['t_4_2'];
					$t_4_3 = $row['t_4_3'];
					
					echo "<tr>
						<td><span class=\"titlespan\">$agentID</span></td>
						<td><span class=\"updatespan\"><a href=\"edit.php?sl=2&agentid=$agentID\">$t_1_1</a></span></td>
						<td><span class=\"titlespan\">$t_1_3</span></td>
						<td><span class=\"titlespan\">$t_2_2</span></td>
						<td><span class=\"titlespan\">$t_2_3</span></td>
						<td><span class=\"titlespan\">$t_3_2</span></td>
						<td><span class=\"titlespan\">$t_3_3</span></td>
						<td><span class=\"titlespan\">$t_4_2</span></td>
						<td><span class=\"titlespan\">$t_4_3</span></td>
						<td><span class=\"updatespan\"><a href=\"edit.php?sl=2&agentid=$agentID\">Update</a></span></td>
					</tr>";
				}
			}
				echo"</table>";
		}
		elseif($sl == 2)
		{
			$agentID = $_GET['agentid'];
			$res3 = mysql_query("select * from agent where agentid='$agentID'");
			$row3 = mysql_fetch_assoc($res3);
			$t_1_1 = $row3['t_1_1'];
			$t_1_2 = $row3['t_1_2'];
			$t_1_3 = $row3['t_1_3'];
			echo"<form action=\"edit.php?sl=3\" method=\"POST\">
				  <table class=\"maintable\">
					<tr>
						<td class=\"left\" colspan=\"2\">Edit Details of Agent</td>
					</tr>
					<tr>
						<td class=\"left\">AgentID</td>
						<td class=\"right\"><input type=\"text\" name=\"agentID\" id=\"agentID\" size=\"38\" readonly=\"readonly\" value=\"$agentID\"/></td>
					</tr>
					<tr>
						<td class=\"left\">Name</td>
						<td class=\"right\"><input type=\"text\" name=\"t_1_1\" id=\"t_1_1\" size=\"38\" value=\"$t_1_1\"/></td>
					</tr>
					<tr>
						<td class=\"left\">Address</td>
						<td class=\"right\"><textarea name=\"t_1_2\" type=\"text\" id=\"t_1_2\" rows=\"3\" cols=\"36\">$t_1_2</textarea></td>
					</tr>
					<tr>
						<td class=\"left\">Phone Number</td>
						<td class=\"right\"><input type=\"text\" name=\"t_1_3\" id=\"t_1_3\" size=\"38\" value=\"$t_1_3\"/></td>
					</tr>
					<tr>
						<td class=\"left\" colspan=\"2\"><input type=\"submit\" name=\"t_5_1\" id=\"t_5_1\" value=\"Update\"/></td>
					</tr>
				  </table>
				</form>";
		}
		elseif($sl == 3)
		{
			$agentID = $_POST['agentID'];
			$t_1_1 = $_POST['t_1_1'];
			$t_1_2 = $_POST['t_1_2'];
			$t_1_3 = $_POST['t_1_3'];
			
			$qur4 = "update agent set t_1_1='$t_1_1',t_1_2='$t_1_2',t_1_3='$t_1_3' where agentid='$agentID'";
			$res4 = mysql_query($qur4);
			if($res4)
			{
				echo "<table class=\"maintable\">
						<tr>
						<td class=\"left\">Details of Agent Successfuly Updated into the Database</td>
						</tr>";
			}
			else
			{
				echo "<table class=\"maintable\">
						<tr>
						<td class=\"left\">Failed to Update the Details of Agent into the Database <br/> $qur4</td>
						</tr>";
			}
			echo "</table>";
		}

		elseif($sl == 4)
		{
			$query = "select * from valuation";
			$res = mysql_query($query);
			$num_row = mysql_num_rows($res);

			if($num_row)
			{
				echo "<div>&nbsp;No of valuation details entered into the database = $num_row</div>";
			}
				
			echo	"<table class=\"updatetable\">
						<tr>
							<td style=\"width: 8%; font-weight: bold;\" rowspan=\"2\">Institution ID</td>
							<td style=\"width: 22%; font-weight: bold;\" rowspan=\"2\">Institution Name</td>
							<td style=\"width: 20%; font-weight: bold;\" colspan=\"3\">Cat A</td>
							<td style=\"width: 20%; font-weight: bold;\" colspan=\"3\">Cat B</td>
							<td style=\"width: 20%; font-weight: bold;\" colspan=\"3\">Cat C</td>
							<td style=\"width: 10%; font-weight: bold;\"  rowspan=\"2\">Update</td>
						</tr>
						<tr>
							<td style=\"width: 8%; font-weight: bold;\">No of Papers</td>
							<td style=\"width: 3%; font-weight: bold;\">5%</td>
							<td style=\"width: 8%; font-weight: bold;\">Evaluator ID</td>
							<td style=\"width: 8%; font-weight: bold;\">No of Papers</td>
							<td style=\"width: 3%; font-weight: bold;\">5%</td>
							<td style=\"width: 8%; font-weight: bold;\">Evaluator ID</td>
							<td style=\"width: 8%; font-weight: bold;\">No of Papers</td>
							<td style=\"width: 3%; font-weight: bold;\">5%</td>
							<td style=\"width: 8%; font-weight: bold;\">Evaluator ID</td>
						</tr>";

			if($num_row)
			{
				for($i=0;$i<$num_row;$i++)
				{
					$row = mysql_fetch_assoc($res);
					
					$institutionID = $row['institutionid'];
					$rs = mysql_query("select institute from institution where institution_id='$institutionID'");
					$rw = mysql_fetch_assoc($rs);
					$name = $rw['institute'];
					$cata = $row['cata'];
					$cat5a = $row['cat5a'];
					$eaid = $row['eaid'];
					$catb = $row['catb'];
					$cat5b = $row['cat5b'];
					$ebid = $row['ebid'];
					$catc = $row['catc'];
					$cat5c = $row['cat5c'];
					$ecid = $row['ecid'];
					
					echo "<tr>
						<td><span class=\"titlespan\">$institutionID</span></td>
						<td><span class=\"titlespan\">$name</span></td>
						<td><span class=\"titlespan\">$cata</span></td>
						<td><span class=\"titlespan\">$cat5a</span></td>
						<td><span class=\"titlespan\">$eaid</span></td>
						<td><span class=\"titlespan\">$catb</span></td>
						<td><span class=\"titlespan\">$cat5b</span></td>
						<td><span class=\"titlespan\">$ebid</span></td>
						<td><span class=\"titlespan\">$catc</span></td>
						<td><span class=\"titlespan\">$cat5c</span></td>
						<td><span class=\"titlespan\">$ecid</span></td>
						<td><span class=\"updatespan\"><a href=\"\">Update</a></span></td>
					</tr>";
				}
			}
				echo"</table>";
		}
	}
	elseif($_SESSION['userid'] == 'sjs@math')
	{
		if(isset($_GET['sort']))
		{
			$sort = $_GET['sort'];
		}
		else
		{
			$sort = 'rno';
		}
		$query = "select * from payment order by $sort";
		$res = mysql_query($query);
		$num_row = mysql_num_rows($res);

		if($num_row)
		{
			echo "<div class=\"des\">&nbsp;No of schools entered into the database = $num_row</div>";
		}
			
		echo	"<table class=\"updatetable\">
					<tr>
						<td style=\"width: 8%; font-weight: bold;\" rowspan=\"2\">SchoolID&nbsp;<a href=\"edit.php?sort=schoolid\">↓</a></td>
						<td style=\"width: 18%; font-weight: bold;\" rowspan=\"2\">School Name&nbsp;<a href=\"edit.php?sort=t_1_1\">↓</a></td>
						<td style=\"width: 22%; font-weight: bold;\" rowspan=\"2\">Address</td>
						<td style=\"width: 9%; font-weight: bold;\" rowspan=\"2\">District&nbsp;<a href=\"edit.php?sort=t_1_4\">↓</a></td>
						<td style=\"width: 15%; font-weight: bold;\" colspan=\"3\">No of Books Sent</td>
						<td style=\"width: 10%; font-weight: bold;\" rowspan=\"2\">Contact No</td>
						<td style=\"width: 10%; font-weight: bold;\" rowspan=\"2\">Receipt No&nbsp;<a href=\"edit.php?sort=rno\">↓</a></td>
						<td style=\"width: 8%; font-weight: bold;\" rowspan=\"2\">Date&nbsp;<a href=\"edit.php?sort=date\">↓</a></td>
					</tr>
					<tr>
						<td style=\"width: 5%; font-weight: bold;\">A</td>
						<td style=\"width: 5%; font-weight: bold;\">B</td>
						<td style=\"width: 5%; font-weight: bold;\">C</td>
					</tr>";

		if($num_row)
		{
			for($i=0;$i<$num_row;$i++)
			{
				$row = mysql_fetch_assoc($res);
				
				$schoolid = $row['schoolid'];
				$t_1_1 = $row['t_1_1'];
				$t_1_2 = $row['t_1_2'];
				$t_1_4 = $row['t_1_4'];
				$A = $row['t_2_1'];
				$A = preg_replace("/;/","<br />",$A);
				$B = $row['t_2_2'];
				$B = preg_replace("/;/","<br />",$B);
				$C = $row['t_2_3'];
				$C = preg_replace("/;/","<br />",$C);
				$t_1_7 = $row['t_1_7'];
				$t_1_7 = preg_replace("/;/","<br />",$t_1_7);
				$rno = $row['rno'];
				$rno = preg_replace("/;/","<br />",$rno);
				$date = $row['date'];
				$date = preg_replace("/;/","<br />",$date);
				echo "<tr>
					<td><span class=\"titlespan\" style=\"width: 8%\"><b>$schoolid</b></span></td>
					<td><span class=\"titlespan\" style=\"width: 18%\">$t_1_1</span></td>
					<td><span class=\"titlespan\" style=\"width: 22%\">$t_1_2</span></td>
					<td><span class=\"titlespan\" style=\"width: 9%\">$t_1_4</span></td>
					<td><span class=\"titlespan\" style=\"width: 5%\">$A</span></td>
					<td><span class=\"titlespan\" style=\"width: 5%\">$B</span></td>
					<td><span class=\"titlespan\" style=\"width: 5%\">$C</span></td>
					<td><span class=\"titlespan\" style=\"width: 10%\">$t_1_7</span></td>
					<td><span class=\"titlespan\" style=\"width: 10%\">$rno</span></td>
					<td><span class=\"titlespan\" style=\"width: 8%\">$date</span></td>
				</tr>";
			}
		}
		echo"</table>";
	}
}
else
{
	echo "<table class=\"maintable\">
		<tr>
			<td class=\"right\" colspan=\"2\">You should be <a href=\"login.php\">logged in</a> to use this feature</td>
		</tr>
	</table>";
}
echo"</div>
	<div class=\"footer\">
		<div class=\"foot_box\">
			<div class=\"left\">
				&copy;2012 All Rights Reserved
			</div>
			<div class=\"right\">
				<ul>
					<li><a href=\"terms.php\">Terms of Use</a></li>
					<li>|</li>
					<li><a href=\"policy.php\">Privacy Policy</a></li>
					<li>|</li>
					<li><a href=\"contact.php\">Contact us</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>";
?>
</html>
