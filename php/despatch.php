<?php session_start(); 

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>JnanaSudha</title>
<link href=\"style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/indexstyle.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/indexstyle.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />

<script type=\"text/Javascript\" language=\"JavaScript\">

function autofill1(cat)
{
	if(cat == 'A')
	{
		t_1 = \"t_2_1\";
		t_2 = \"t_2_2\";
		t_3 = \"t_2_3\";
	}
	if(cat == 'B')
	{
		t_1 = \"t_3_1\";
		t_2 = \"t_3_2\";
		t_3 = \"t_3_3\";
	}
	if(cat == 'C')
	{
		t_1 = \"t_4_1\";
		t_2 = \"t_4_2\";
		t_3 = \"t_4_3\";
	}
	cnt = document.getElementById(t_1).value;
	no = document.getElementById(t_2).value;
	num = no.substr(1);
	
	if(no.length != 6)
	{
		alert(\"Serial Number Length should be 6(Including first bit(a or b or c))\");
		return;
	}
	
	if(cnt == '')
	{
		alert(\"Please enter the value for total number of question papers printed\");
		return;
	}
	num = parseInt(num,10);
	cnt = parseInt(cnt,10);
	num = num + cnt -1;
	t_0_3 = '' + num;
	while(t_0_3.length < 5)
		t_0_3 = '0' + t_0_3;
	t_0_3 = cat + t_0_3;
	document.getElementById(t_3).value = t_0_3;
}

function autofill(no, cat)
{
	//cat = no[0];
	//alert(cat);
	num = no.substr(1);
	if(no.length != 6)
	{
		alert(\"Serial Number Length should be 6(Including first bit(a or b or c))\");
		return;
	}
	if(cat == 'a')
	{
		t_1 = \"t_1_1\";
		t_3 = \"t_1_3\";
	}
	if(cat == 'b')
	{
		t_1 = \"t_2_1\";
		t_3 = \"t_2_3\";
	}
	if(cat == 'c')
	{
		t_1 = \"t_3_1\";
		t_3 = \"t_3_3\";
	}
	cnt = document.getElementById(t_1).value;
	if(cnt == '')
	{
		alert(\"Please enter the value for total number of question papers printed\");
		return;
	}
	num = parseInt(num,10);
	cnt = parseInt(cnt,10);
	num = num + cnt -1;
	t_0_3 = '' + num;
	while(t_0_3.length < 5)
		t_0_3 = '0' + t_0_3;
	t_0_3 = cat + t_0_3;
	document.getElementById(t_3).value = t_0_3;
}
</script>

</head>
";

$ud = $_GET['ud'];

include('connect.php');
$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$qur = "select count(*) from payment where batch like '0;%' or batch like '%;0' or batch='0'";
$res = mysql_query($qur);
$row = mysql_fetch_assoc($res);
$no = $row['count(*)'];
$qur = "select count(*) from payment";
$res = mysql_query($qur);
$row = mysql_fetch_assoc($res);
$no1 = $row['count(*)'];

echo "<body>
<div class=\"page\">
	<div class=\"header\">
		<div class=\"title\">JnanaSudha</div>
		<div class=\"nav\">
			<ul>
				<li><a href=\"../index.php\">Home</a></li>
				<li><a href=\"login.php\">Login</a></li>
				<li><a href=\"schools.php?ed=0&ud=0\">Schools</a></li>
				<li><a class=\"active\" href=\"despatch.php?ud=0\">Despatch</a></li>
				<li><a href=\"edit.php\">Edit</a></li>
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
	
		if(($ud == 0) && ($no != 0))
		{	
			echo "<form action=\"\" method=\"post\">
					<table class=\"maintable\">
					<tr>
						<td class=\"left\" colspan=\"2\">To Update Booklets Stock <a href=\"despatch.php?ud=2\">click here</a>
						<br/>To add agent details <a href=\"despatch.php?ud=4\">click here</a>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Number of despatches remaining </td>
						<td class=\"right\"><input type=\"text\" id=\"t_1_2\" value=\"$no\" size=\"10\" readonly=\"readonly\"/></td>
					</tr>
					<tr>
						<td class=\"left\" colspan=\"2\"><input type=\"submit\" value=\"Finalize\" onclick=\"form.action='despatch.php?ud=1', form.target=''; return true;\"/> despatch for current batch</td>
					</tr>
				</table><br/>";
		}
		elseif($ud == 0)
		{
			echo "<form action=\"\" method=\"post\">
					<table class=\"maintable\">
					<tr>
						<td class=\"left\" colspan=\"2\">To Update Booklets Stock <a href=\"despatch.php?ud=2\">click here</a>
						<br/>To add agent details <a href=\"despatch.php?ud=4\">click here</a>
						</td>
					</tr>
					</table>";
		}
		if($ud == 1)
		{
			$cat1 = 0;
			$cat2 = 0;
			$cat3 = 0;
			$A = mysql_query("select * from cata where schoolid IS NULL");
			$ca = mysql_num_rows($A);
			$B = mysql_query("select * from catb where schoolid IS NULL");
			$cb = mysql_num_rows($B);
			$C = mysql_query("select * from catc where schoolid IS NULL");
			$cc = mysql_num_rows($C);
			
			$res2 = mysql_query("select * from payment where batch like '0;%' or batch like '%;0' or batch='0'");
			$no = mysql_num_rows($res2);
			for($i=0;$i<$no;$i++)
			{
				$row = mysql_fetch_assoc($res2);
				$b_No = explode(";",$row['batch']);
				$cata = explode(";",$row['t_2_1']);
				$catb = explode(";",$row['t_2_2']);
				$catc = explode(";",$row['t_2_3']);
				for($j=0;$j<count($b_No);$j++)
				{
					if($b_No[$j] == '0')
					{
						$cat1 = $cat1 + $cata[$j];
						$cat2 = $cat2 + $catb[$j];
						$cat3 = $cat3 + $catc[$j];
					}
				}
			}
			
			if(($ca < $cat1) || ($cb < $cat2) || ($cc < $cat3))
			{
				echo "Fatal Error : You Dont have sufficient question paper in the stock for despatching books</br>";
				return;
			}
			
			
			$today = getdate();
			$mday = $today['mday'];
			$mday = str_pad($mday,2,"0",STR_PAD_LEFT);
			$mon = $today['mon'];
			$mon = str_pad($mon,2,"0",STR_PAD_LEFT);
			$TodaysDate = $mday . "/" . $mon . "/" . $today['year'];
			
			$qur = "select distinct batch from payment";
			$res1 = mysql_query($qur);
			$no = mysql_num_rows($res1);
			$j=0;
			for($i=0;$i<$no;$i++)
			{
				$row = mysql_fetch_assoc($res1);
				$temp = $row['batch'];
				$temp = explode(";",$temp);
				for($k=0;$k<count($temp);$k++)
					$batch[$j++] = $temp[$k];
			}
			$batch = array_unique($batch);
			sort($batch,SORT_NUMERIC);
			$bNo = $batch[count($batch)-1] + 1;
			
			$res2 = mysql_query("select * from payment where batch like '0;%' or batch like '%;0' or batch='0'");
			$num = mysql_num_rows($res2);
			$res3=1;
			for($i=0;$i<$num;$i++)
			{
				$row = mysql_fetch_assoc($res2);
				$schoolid = $row['schoolid'];
				$batchNo = explode(";",$row['batch']);
				$dateT = $row['date'];
				$dateT = explode(";",$dateT);
				for($k=0;$k<count($batchNo);$k++)
					if($batchNo[$k] == '0')
						$batchNo[$k] = $bNo;
				$b_No = explode(";",$row['batch']);
				$cata = explode(";",$row['t_2_1']);
				$catb = explode(";",$row['t_2_2']);
				$catc = explode(";",$row['t_2_3']);
				$cat1 = 0;
				$cat2 = 0;
				$cat3 = 0;
				for($j=0;$j<count($dateT);$j++)
				{
					
					if($dateT[$j] == '')
						$dateT[$j] = $TodaysDate;
					if($b_No[$j] == '0')
					{
						$cat1 = $cat1 + $cata[$j];
						$cat2 = $cat2 + $catb[$j];
						$cat3 = $cat3 + $catc[$j];
					}
				}
				
				$batchNo = implode(";",$batchNo);
				if($cat1 < $ca)
				{
					$rsA = mysql_query("update cata set schoolid='$schoolid', batch='$bNo', date='$TodaysDate' where schoolid is NULL order by no limit $cat1");
					if($rsA)
						;
					else
					{
						echo "Updation Failed for cat-A";
						return;
					}
				}
				
				if($cat2 < $cb)
				{
					$rsB = mysql_query("update catb set schoolid='$schoolid', batch='$bNo', date='$TodaysDate' where schoolid is NULL order by no limit $cat2");
					if($rsB)
						;
					else
					{
						echo "Updation Failed for cat-B";
						return;
					}
				}
				
				if($cat3 < $cc)
				{
					$rsC = mysql_query("update catc set schoolid='$schoolid', batch='$bNo', date='$TodaysDate' where schoolid is NULL order by no limit $cat3");
					if($rsC)
						;
					else
					{
						echo "Updation Failed for cat-C";
						return;
					}
				}
				
				$dateF = implode(";",$dateT);
				$res3 = mysql_query("update payment set batch='$batchNo', date='$dateF' where schoolid='$schoolid'");
			}
			
			echo "<table class=\"inner_table\">
				<tr>
					<td class=\"left\" colspan=\"2\">";
			if($res1 && $res2 && $res3)
				echo "Despatch Information successfuly updated to the database";
			else
				echo "Despatch Information failed to update to the database";
			echo	"</td>
				</tr>
				</table>";
		}

		if($ud == 2)
		{
			$today = getdate();
			$mday = $today['mday'];
			$mday = str_pad($mday,2,"0",STR_PAD_LEFT);
			$mon = $today['mon'];
			$mon = str_pad($mon,2,"0",STR_PAD_LEFT);
			$date = $mday . "-" . $mon . "-" . $today['year'];
			
			echo "<form action=\"despatch.php?ud=3\" method=\"POST\">
				  <table class=\"maintable\">
					<tr>
						<td class=\"left\" colspan=\"2\">Enter Details of Question Papers Printed</td>
					</tr>
					<tr>
						<td class=\"left\">Category A</td>
						<td class=\"right\">
							<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total No of Question Papers Printed</td>
								<td class=\"right\"><input type=\"text\" name=\"t_1_1\" id=\"t_1_1\" size=\"20\"/></td>
							</tr>
							<tr>
								<td class=\"left\" rowspan=\"2\">Question Papers Serial Number</td>
								<td class=\"right\">from : <input type=\"text\" name=\"t_1_2\" id=\"t_1_2\" size=\"20\" value=\"a\" onChange=\"autofill(this.value, 'a')\"/><br/>
								to : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"t_1_3\" id=\"t_1_3\" size=\"20\" readonly=\"readonly\" />
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Category B</td>
						<td class=\"right\">
							<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total No of Question Papers Printed</td>
								<td class=\"right\"><input type=\"text\" name=\"t_2_1\" id=\"t_2_1\" size=\"20\"/></td>
							</tr>
							<tr>
								<td class=\"left\" rowspan=\"2\">Question Papers Serial Number</td>
								<td class=\"right\">from : <input type=\"text\" name=\"t_2_2\" id=\"t_2_2\" size=\"20\" value=\"b\" onChange=\"autofill(this.value, 'b')\"/><br/>
								to : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"t_2_3\" id=\"t_2_3\" size=\"20\" readonly=\"readonly\" />
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Category C</td>
						<td class=\"right\">
							<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total No of Question Papers Printed</td>
								<td class=\"right\"><input type=\"text\" name=\"t_3_1\" id=\"t_3_1\" size=\"20\"/></td>
							</tr>
							<tr>
								<td class=\"left\" rowspan=\"2\">Question Papers Serial Number</td>
								<td class=\"right\">from : <input type=\"text\" name=\"t_3_2\" id=\"t_3_2\" size=\"20\" value=\"c\" onChange=\"autofill(this.value, 'c')\"/><br/>
								to : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"t_3_3\" id=\"t_3_3\" size=\"20\"  readonly=\"readonly\" />
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\" colspan=\"2\"><input type=\"submit\" name=\"t_4_1\" id=\"t_4_1\" value=\"Submit\"/></td>
					</tr>
				 </table>
				 </form>";
		}

		if($ud == 3)
		{	
			$t_1_1 = $_POST['t_1_1'];
			$t_1_2 = $_POST['t_1_2'];
			$t_1_3 = $_POST['t_1_3'];
			$t_2_1 = $_POST['t_2_1'];
			$t_2_2 = $_POST['t_2_2'];
			$t_2_3 = $_POST['t_2_3'];
			$t_3_1 = $_POST['t_3_1'];
			$t_3_2 = $_POST['t_3_2'];
			$t_3_3 = $_POST['t_3_3'];
			
			$catA = substr($t_1_2,1);
			$catA = intval($catA,10);
			for($i=0;$i<$t_1_1;$i++)
			{
				$no = $catA + $i;
				$no = strval($no);
				$no = "a" . str_pad($no, 5, "0", STR_PAD_LEFT);
				$res = mysql_query("insert into cata (no) values ('$no')");
				if($res)
					continue;
				else
				{
					echo "Inserting to the database failed for category A at $no";
					return;
				}
			}
			
			$catB = substr($t_2_2,1);
			$catB = intval($catB,10);
			for($i=0;$i<$t_2_1;$i++)
			{
				$no = $catB + $i;
				$no = strval($no);
				$no = "b" . str_pad($no, 5, "0", STR_PAD_LEFT);
				$res = mysql_query("insert into catb (no) values ('$no')");
				if($res)
					continue;
				else
				{
					echo "Inserting to the database failed for category B at $no";
					return;
				}
			}
			
			$catC = substr($t_3_2,1);
			$catC = intval($catC,10);
			for($i=0;$i<$t_3_1;$i++)
			{
				$no = $catC + $i;
				$no = strval($no);
				$no = "c" . str_pad($no, 5, "0", STR_PAD_LEFT);
				$res = mysql_query("insert into catc (no) values ('$no')");
				if($res)
					continue;
				else
				{
					echo "Inserting to the database failed for category C at $no";
					return;
				}
			}

			if($res)
			{
				echo "<table class=\"maintable\">
						<tr>
						<td class=\"left\">Details of Question Papers Printed Successfuly Enterd into the Database</td>
						</tr>
				   </table>";
			}
		}
		if($ud == 4)
		{
			$resA = mysql_query("select no from cata where schoolid is null order by no limit 1");
			$rowA = mysql_fetch_assoc($resA);
			$catA = $rowA['no'];
			$catA = preg_replace("/a/", "A", $catA);
			
			$resB = mysql_query("select no from catb where schoolid is null order by no limit 1");
			$rowB = mysql_fetch_assoc($resB);
			$catB = $rowB['no'];
			$catB = preg_replace("/b/", "B", $catB);
			
			$resC = mysql_query("select no from catc where schoolid is null order by no limit 1");
			$rowC = mysql_fetch_assoc($resC);
			$catC = $rowC['no'];
			$catC = preg_replace("/c/", "C", $catC);
			
			//echo $catA . "  " . $catB . "  " . $catC . "<br/>";
			echo"<form action=\"despatch.php?ud=5\" method=\"POST\">
				  <table class=\"maintable\">
					<tr>
						<td class=\"left\" colspan=\"2\">Enter Details of Agent</td>
					</tr>
					<tr>
						<td class=\"left\">Agent Details</td>
						<td class=\"right\">
						<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Name</td>
								<td class=\"right\"><input type=\"text\" name=\"t_1_1\" id=\"t_1_1\" size=\"38\"/></td>
							</tr>
							<tr>
								<td class=\"left\">Address</td>
								<td class=\"right\"><textarea name=\"t_1_2\" type=\"text\" id=\"t_1_2\" rows=\"3\" cols=\"36\"></textarea></td>
							</tr>
							<tr>
								<td class=\"left\">Phone Number</td>
								<td class=\"right\"><input type=\"text\" name=\"t_1_3\" id=\"t_1_3\" size=\"38\"/></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\" colspan=\"2\">Enter Details of Question Papers given to the Agent</td>
					</tr>
					<tr>
						<td class=\"left\">Category A</td>
						<td class=\"right\">
							<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total No of Question Papers Given</td>
								<td class=\"right\"><input type=\"text\" name=\"t_2_1\" id=\"t_2_1\" size=\"20\"  onChange=\"autofill1('A')\" /></td>
							</tr>
							<tr>
								<td class=\"left\" rowspan=\"2\">Question Papers Serial Number</td>
								<td class=\"right\">from : <input type=\"text\" name=\"t_2_2\" id=\"t_2_2\" size=\"20\" value=\"$catA\" onChange=\"autofill1('A')\"/><br/>
								to : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"t_2_3\" id=\"t_2_3\" size=\"20\" readonly=\"readonly\"/>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Category B</td>
						<td class=\"right\">
							<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total No of Question Papers Given</td>
								<td class=\"right\"><input type=\"text\" name=\"t_3_1\" id=\"t_3_1\" size=\"20\"  onChange=\"autofill1('B')\" /></td>
							</tr>
							<tr>
								<td class=\"left\" rowspan=\"2\">Question Papers Serial Number</td>
								<td class=\"right\">from : <input type=\"text\" name=\"t_3_2\" id=\"t_3_2\" size=\"20\" value=\"$catB\" onChange=\"autofill1('B')\"/><br/>
								to : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"t_3_3\" id=\"t_3_3\" size=\"20\" readonly=\"readonly\"/>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Category C</td>
						<td class=\"right\">
							<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total No of Question Papers Given</td>
								<td class=\"right\"><input type=\"text\" name=\"t_4_1\" id=\"t_4_1\" size=\"20\"  onChange=\"autofill1('C')\" /></td>
							</tr>
							<tr>
								<td class=\"left\" rowspan=\"2\">Question Papers Serial Number</td>
								<td class=\"right\">from : <input type=\"text\" name=\"t_4_2\" id=\"t_4_2\" size=\"20\" value=\"$catC\" onChange=\"autofill1('C')\"/><br/>
								to : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"t_4_3\" id=\"t_4_3\" size=\"20\" readonly=\"readonly\"/>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\" colspan=\"2\"><input type=\"submit\" name=\"t_5_1\" id=\"t_5_1\" value=\"Submit\"/></td>
					</tr>
				 </table>
				 </form>";
		}
		
		if($ud == 5)
		{
			$t_1_1 = $_POST['t_1_1'];
			$t_1_2 = $_POST['t_1_2'];
			$t_1_3 = $_POST['t_1_3'];
			$t_2_1 = $_POST['t_2_1'];
			$t_2_2 = $_POST['t_2_2'];
			$t_2_3 = $_POST['t_2_3'];
			$t_3_1 = $_POST['t_3_1'];
			$t_3_2 = $_POST['t_3_2'];
			$t_3_3 = $_POST['t_3_3'];
			$t_4_1 = $_POST['t_4_1'];
			$t_4_2 = $_POST['t_4_2'];
			$t_4_3 = $_POST['t_4_3'];
			if($t_2_1 == "")
				$t_2_1 = 0;
			if($t_3_1 == "")
				$t_3_1 = 0;
			if($t_4_1 == "")
				$t_4_1 = 0;
			
			$qur2 = "select count(*) from cata where schoolid is null";
			$res2 = mysql_query($qur2);
			$row2 = mysql_fetch_assoc($res2);
			$no2 = $row2['count(*)'];
			
			$qur3 = "select count(*) from catb where schoolid is null";
			$res3 = mysql_query($qur3);
			$row3 = mysql_fetch_assoc($res3);
			$no3 = $row3['count(*)'];
			
			$qur4 = "select count(*) from catc where schoolid is null";
			$res4 = mysql_query($qur4);
			$row4 = mysql_fetch_assoc($res4);
			$no4 = $row4['count(*)'];
			
			if(($no2 < $t_2_1) || ($no3 < $t_3_1) || ($no4 < $t_4_1))
			{
				echo "Your Question Paper Database is not updated, to give the number question papers you have entered";
				
				if($no2 < $t_2_1)
					echo "<br/>Deficiency of Category A Question Papers";
				
				if($no3 < $t_3_1)
					echo "<br/>Deficiency of Category B Question Papers";
				
				if($no4 < $t_4_1)
					echo "<br/>Deficiency of Category C Question Papers $no4  $t_4_1";
				return;
			}
			
			$qur = "select count(*) from agent";
			$res = mysql_query($qur);
			$row = mysql_fetch_assoc($res);
			$no2 = $row['count(*)'];
			
			$agentID = "AGT" . str_pad(($no2+1),3,"0",STR_PAD_LEFT);
			
			$qur1 = "insert into agent values ('$agentID','$t_1_1','$t_1_2','$t_1_3','$t_2_1','$t_2_2','$t_2_3','$t_3_1','$t_3_2','$t_3_3','$t_4_1','$t_4_2','$t_4_3')";
			$res1 = mysql_query($qur1);
			
			$num1F = preg_replace("/A/","a",$t_2_2);
			$num1T = preg_replace("/A/","a",$t_2_3);
			{
				$rsA = mysql_query("update cata set schoolid='$agentID' where (no between '$num1F' and '$num1T') and (schoolid is null)");
				if($rsA)
					;
				else
				{
					echo "Updation Failed for cat-A";
					return;
				}
			}
			
			$num2F = preg_replace("/B/","b",$t_3_2);
			$num2T = preg_replace("/B/","b",$t_3_3);
			{
				$rsB = mysql_query("update catb set schoolid='$agentID' where (no between '$num2F' and '$num2T') and (schoolid is null)");
				if($rsB)
					;
				else
				{
					echo "Updation Failed for cat-B";
					return;
				}
			}
			
			$num3F = preg_replace("/C/","c",$t_4_2);
			$num3T = preg_replace("/C/","c",$t_4_3);
			{
				$rsC = mysql_query("update catc set schoolid='$agentID' where (no between '$num3F' and '$num3T') and (schoolid is null)");
				if($rsC)
					;
				else
				{
					echo "Updation Failed for cat-C";
					return;
				}
			}
			
			if($res1)
			{
				echo "<table class=\"maintable\">
						<tr>
						<td class=\"left\">Details of Agent Successfuly Enterd into the Database</td>
						</tr>";
			}
			else
			{
				echo "<table class=\"maintable\">
						<tr>
						<td class=\"left\">Failed to enter Details of Agent into the Database <br/> $qur1</td>
						</tr>";
			}
			echo "</table>";
				   

		}

		if($ud == 0)
		{
			if($no == $no1)
				return;

			$qur = "select * from payment order by batch";
			$res = mysql_query($qur);
			$no = mysql_num_rows($res);
			$j=0;
			$data[2][0] = 0;
			$data[3][0] = 0;
			$data[4][0] = 0;
			for($i=0;$i<$no;$i++)
			{
				$row = mysql_fetch_assoc($res);
				$batch = explode(";",$row['batch']);
				$date = explode(";",$row['date']);
				$catat = explode(";",$row['t_2_1']);
				$catbt = explode(";",$row['t_2_2']);
				$catct = explode(";",$row['t_2_3']);
				for($k=0;$k<count($batch);$k++)
				{
					if($batch[$k] != '0')
					{
						if($j == 0)
						{
							$data[0][$j] = $batch[$k];
							$data[1][$j] = $date[$k];
							$data[2][$j] = $catat[$k];
							$data[3][$j] = $catbt[$k];
							$data[4][$j] = $catct[$k];
							$j++;
							$data[2][$j] = 0;
							$data[3][$j] = 0;
							$data[4][$j] = 0;
						}
						elseif(array_search($batch[$k] , $data[0]) === FALSE)
						{
							$data[0][$j] = $batch[$k];
							$data[1][$j] = $date[$k];
							$data[2][$j] = $catat[$k];
							$data[3][$j] = $catbt[$k];
							$data[4][$j] = $catct[$k];
							$j++;
							$data[2][$j] = 0;
							$data[3][$j] = 0;
							$data[4][$j] = 0;
						}
						else
						{
							$j1 = array_search($batch[$k] , $data[0]);
							$data[2][$j1] = $data[2][$j1] + $catat[$k];
							$data[3][$j1] = $data[3][$j1] + $catbt[$k];
							$data[4][$j1] = $data[4][$j1] + $catct[$k];
						}
					}
				}
			}

			echo"<div class=\"des\">&nbsp;Generate address labels, despatch report, receipt and receipt report based on Batch Number</div>
					<table class=\"updatetable\">
						<tr>
							<td style=\"width: 8%; font-weight: bold;\">BatchNo</td>
							<td style=\"width: 11%; font-weight: bold;\">Date</td>
							<td style=\"width: 8%; font-weight: bold;\">Cat-A</td>
							<td style=\"width: 8%; font-weight: bold;\">Cat-B</td>
							<td style=\"width: 8%; font-weight: bold;\">Cat-C</td>
							<td style=\"width: 57%; font-weight: bold;\" colspan=\"4\">Generate</td>
						</tr>";

			for($i=0;$i<count($data[0]);$i++)
			{
				$k = $data[0][$i] - 1;
				$dataF[0][$k] = $data[0][$i];
				$dataF[1][$k] = $data[1][$i];
				$dataF[2][$k] = $data[2][$i];
				$dataF[3][$k] = $data[3][$i];
				$dataF[4][$k] = $data[4][$i];
			}
			
			for($i=0;$i<count($data[0]);$i++)
			{
				echo "<tr>
						<td style=\"width: 8%;\">" . $dataF[0][$i] . "</td>
						<td style=\"width: 11%;\">" . $dataF[1][$i] . "</td>
						<td style=\"width: 8%;\">" . $dataF[2][$i] . "</td>
						<td style=\"width: 8%;\">" . $dataF[3][$i] . "</td>
						<td style=\"width: 8%;\">" . $dataF[4][$i] . "</td>
						<td style=\"width: 14%;\"><a href=\"label.php?bn=" . $dataF[0][$i] . "\" target=\"_blank\">Label</a></td>
						<td style=\"width: 15%;\"><a href=\"despatch_report.php?bn=" . $dataF[0][$i] . "\"  target=\"_blank\">Despatch Report</a></td>
						<td style=\"width: 14%;\"><a href=\"receipt.php?bn=" . $dataF[0][$i] . "\" target=\"_blank\">Receipt</a></td>
						<td style=\"width: 14%;\"><a href=\"receipt_report.php?bn=" . $dataF[0][$i] . "\" target=\"_blank\">SJS Report</a></td>
					  </tr>";
			}
			echo"</table>";
		}
	}
	else
	{
		echo "<table class=\"maintable\">
			<tr>
				<td style=\"color: #FF0000;\" class=\"right\" colspan=\"2\">You do not have access to view this page.</td>
			</tr>
		</table>";
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
</body>
</html>";
?>
