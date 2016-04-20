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

<script type="text/javascript" language="JavaScript">

function focus()
{
	document.getElementById('schoolid').focus();
}
function autofill(id)
{
	if(id=='')
		return;
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	function updatePage()
	{
		if (xmlhttp.readyState==4)
		{
			if (xmlhttp.status==200)
			{
				var data = xmlhttp.responseText.split("|");
				if(data[0]==1)
				{
					alert("SchoolID is not there in schools database");
					data[0] = "";
				}
				document.getElementById("t_1_1").value = data[0];
				document.getElementById("t_1_2").value = data[1];
				document.getElementById("t_1_3").value = data[2];
				document.getElementById("t_1_4").value = data[3];
				document.getElementById("t_1_5").value = data[4];
				document.getElementById("t_1_6").value = data[5];
				document.getElementById("t_1_7").value = data[6];
				document.getElementById("t_1_8").value = data[7];
			}
		}
	}
	xmlhttp.open("GET","inputpredict.php?id="+id,true);
	xmlhttp.onreadystatechange=updatePage;
	xmlhttp.send();
}

function generate(inst)
{
	if(inst=='')
		return;
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	function update_Page()
	{
		if (xmlhttp.readyState==4)
		{
			if (xmlhttp.status==200)
			{
				var data = xmlhttp.responseText;
				if(data == "error")
				{
					alert("error in generating new Institution Id");
					data = "";
				}
				else
					document.getElementById("schoolid").value = data;
			}
		}
	}
	xmlhttp.open("GET","generate_new_schoolid.php?inst="+inst,true);
	xmlhttp.onreadystatechange=update_Page;
	xmlhttp.send();
}
</script>
</head>

<?php

include("connect.php");
$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$edit = $_GET['ed'];
$update = $_GET['ud'];
$errmsg="";
$add=0;
$formfl = 0;
$t = '';
if(!isset($_SESSION['updating']) || ($edit == 0 && $update == 0))
	$_SESSION['updating'] = 0;
if($edit == 0 && $update == 0)
{
	$schoolid = '';
	$t_1_1 = '';
	$t_1_2 = '';
	$t_1_3 = '';
	$t_1_4 = '';
	$t_1_5 = '';
	$t_1_6 = '';
	$t_1_7 = '';
	$t_1_8 = '';
	$t_2_1 = 0;
	$t_2_2 = '';
	$t_3_1 = 0;
	$t_3_2 = '';
	$t_4_1 = 0;
	$t_4_2 = '';
	$t_5_1 = '';
	$formfl = 1;
	$BATCH = 0;
}
if($edit == 1)
{
	$schoolid = $_POST['schoolid'];
	$t_1_1 = $_POST['t_1_1'];
	$t_1_2 = $_POST['t_1_2'];
	$t_1_3 = $_POST['t_1_3'];
	$t_1_4 = $_POST['t_1_4'];
	$t_1_5 = $_POST['t_1_5'];
	$t_1_6 = $_POST['t_1_6'];
	$t_1_7 = $_POST['t_1_7'];
	$t_1_8 = $_POST['t_1_8'];
	$t_2_1 = $_POST['t_2_1'];
	$t_2_2 = $_POST['t_2_2'];
	$t_3_1 = $_POST['t_3_1'];
	$t_3_2 = $_POST['t_3_2'];
	$t_4_1 = $_POST['t_4_1'];
	$t_4_2 = $_POST['t_4_2'];
	$t_5_1 = $_POST['t_5_1'];
	if($_SESSION['updating'] == 1)
		$BATCH = $_SESSION['batch'];
	else
		$BATCH = 0;
	if($schoolid == "" || $t_1_1 == "" || $t_1_2 == "" || $t_4_1 == "")
		$errmsg = "Fields marked with * are mandatory <br/>";
	if($schoolid == "")
		$errmsg = $errmsg . "SchoolID cannot be left blank<br/>";
	if($t_1_1 == "")
		$errmsg = $errmsg . "School name cannot be left blank<br/>";
	if($t_1_2 == "")
		$errmsg = $errmsg . "Address cannot be left blank<br/>";
	if($t_2_1 == "")
		$errmsg = $errmsg . "Category A cannot be left blank<br/>";
	elseif(!is_numeric($t_2_1))
		$errmsg = $errmsg . "Category A should have a numerical value<br/>";
	if($t_3_1 == "")
		$errmsg = $errmsg . "Category B cannot be left blank<br/>";
	elseif(!is_numeric($t_3_1))
		$errmsg = $errmsg . "Category B should have a numerical value<br/>";
	if($t_4_1 == "")
		$errmsg = $errmsg . "Category C cannot be left blank<br/>";
	elseif(!is_numeric($t_4_1))
		$errmsg = $errmsg . "Category C should have a numerical value<br/>";
	if($t_2_1 != '0')
	{
		$CNT = 0;
		$eFlag1 = 0;
		$eFlag2 = 0;
		$eFlag3 = 0;
		$From = 0;
		$To = 0;
		$tmp = preg_split("/;/",$t_2_2);
		if($t_2_2 == "")
		{
			$tmp = array();
			$errmsg = $errmsg . "Category A question paper range should not be left blank<br/>";
		}
		for($i=0;$i<count($tmp);$i++)
		{
			$tmp1 = preg_split("/-/",$tmp[$i]);
			for($j=0;$j<count($tmp1);$j++)
			{
				if(strlen($tmp1[$j]) != 6)
					$eFlag1 = 1;
				if($tmp1[$j][0] != 'A')
					$eFlag2 = 1;
				if(!is_numeric(substr($tmp1[$j],1)))
					$eFlag3 = 1;
				else
				{
					if($j == 0)
						$From = intval(substr($tmp1[$j],1));
					elseif($j == 1)
						$To = intval(substr($tmp1[$j],1));
				}
			}
			if(count($tmp1) == 1)
				$CNT++;
			else
				$CNT = $CNT + $To - $From + 1;
		}
		if($eFlag1 == 1)
			$errmsg = $errmsg . "Length of Category A question paper number should be 6<br/>";
		if($eFlag2 == 1)
			$errmsg = $errmsg . "Category A question paper number should start with character 'A'<br/>";
		if($eFlag3 == 1)
			$errmsg = $errmsg . "Category A question paper number should start with character 'A' followed by 5 decimal digits<br/>";
		if($CNT != $t_2_1)
			$errmsg = $errmsg . "Category A number of participants should match with total number question papers<br/>";
		if(($eFlag1 == 0) && ($eFlag2 == 0) && ($eFlag3 == 0) && ($CNT == $t_2_1))
		{
			$DB_Count = 0;
			$tmp = preg_replace("/A/", "a", $t_2_2);
			$tmp = preg_split("/;/",$tmp);
			for($i=0;$i<count($tmp);$i++)
			{
				$tmp1 = preg_split("/-/",$tmp[$i]);
				if(count($tmp1) == 1)
				{
					$qurC = "select count(*) from cata where ((schoolid='$t_5_1') and (no='" . $tmp1[0] . "'))";
					$rsC = mysql_query($qurC);
					$rowC = mysql_fetch_assoc($rsC);
					$DB_Count = $DB_Count + $rowC['count(*)'];
				}
				else
				{
					$qurC = "select count(*) from cata where ((schoolid='$t_5_1') and (no between '" . $tmp1[0] . "' and '" . $tmp1[1] . "'))";
					$rsC = mysql_query($qurC);
					$rowC = mysql_fetch_assoc($rsC);
					$DB_Count = $DB_Count + $rowC['count(*)'];
				}
			}
			if($DB_Count != $t_2_1)
				$errmsg = $errmsg . "Range entered for Category A is not available in the Database<br/>";
		}
	}
	if($t_3_1 != '0')
	{
		$eFlag1 = 0;
		$eFlag2 = 0;
		$eFlag3 = 0;
		$From = 0;
		$To = 0;
		$CNT = 0;
		$tmp = preg_split("/;/",$t_3_2);
		if($t_3_2 == "")
		{
			$tmp = array();
			$errmsg = $errmsg . "Category B question paper range should not be left blank<br/>";
		}
		for($i=0;$i<count($tmp);$i++)
		{
			$tmp1 = preg_split("/-/",$tmp[$i]);
			for($j=0;$j<count($tmp1);$j++)
			{
				if(strlen($tmp1[$j]) != 6)
					$eFlag1 = 1;
				if($tmp1[$j][0] != 'B')
					$eFlag2 = 1;
				if(!is_numeric(substr($tmp1[$j],1)))
					$eFlag3 = 1;
				else
				{
					if($j == 0)
						$From = intval(substr($tmp1[$j],1));
					elseif($j == 1)
						$To = intval(substr($tmp1[$j],1));
				}
			}
			if(count($tmp1) == 1)
				$CNT++;
			else
				$CNT = $CNT + $To - $From + 1;
		}
		if($eFlag1 == 1)
			$errmsg = $errmsg . "Length of Category B question paper number should be 6<br/>";
		if($eFlag2 == 1)
			$errmsg = $errmsg . "Category B question paper number should start with character 'B'<br/>";
		if($eFlag3 == 1)
			$errmsg = $errmsg . "Category B question paper number should start with character 'B' followed by 5 decimal digits<br/>";
		if($CNT != $t_3_1)
			$errmsg = $errmsg . "Category B number of participants should match with total number question papers<br/>";
		if(($eFlag1 == 0) && ($eFlag2 == 0) && ($eFlag3 == 0) && ($CNT == $t_3_1))
		{
			$DB_Count = 0;
			$tmp = preg_replace("/B/", "b", $t_3_2);
			$tmp = preg_split("/;/",$tmp);
			for($i=0;$i<count($tmp);$i++)
			{
				$tmp1 = preg_split("/-/",$tmp[$i]);
				if(count($tmp1) == 1)
				{
					$qurC = "select count(*) from catb where ((schoolid='$t_5_1') and (no='" . $tmp1[0] . "'))";
					$rsC = mysql_query($qurC);
					$rowC = mysql_fetch_assoc($rsC);
					$DB_Count = $DB_Count + $rowC['count(*)'];
				}
				else
				{
					$qurC = "select count(*) from catb where ((schoolid='$t_5_1') and (no between '" . $tmp1[0] . "' and '" . $tmp1[1] . "'))";
					$rsC = mysql_query($qurC);
					$rowC = mysql_fetch_assoc($rsC);
					$DB_Count = $DB_Count + $rowC['count(*)'];
				}
			}
			if($DB_Count != $t_3_1)
				$errmsg = $errmsg . "Range entered for Category B is not available in the Database<br/>";
		}
	}
	if($t_4_1 != '0')
	{
		$eFlag1 = 0;
		$eFlag2 = 0;
		$eFlag3 = 0;
		$From = 0;
		$To = 0;
		$CNT = 0;
		$tmp = preg_split("/;/",$t_4_2);
		if($t_4_2 == "")
		{
			$tmp = array();
			$errmsg = $errmsg . "Category C question paper range should not be left blank<br/>";
		}
		for($i=0;$i<count($tmp);$i++)
		{
			$tmp1 = preg_split("/-/",$tmp[$i]);
			for($j=0;$j<count($tmp1);$j++)
			{
				if(strlen($temp1[$j]) != 6)
					$eFlag1 = 1;
				if($tmp1[$j][0] != 'C')
					$eFlag2 = 1;
				if(!is_numeric(substr($temp1[$j],1)))
					$eFlag3 = 1;
				else
				{
					if($j == 0)
						$From = intval(substr($tmp1[$j],1));
					elseif($j == 1)
						$To = intval(substr($tmp1[$j],1));
				}
			}
			if(count($tmp1) == 1)
				$CNT++;
			else
				$CNT = $CNT + $To - $From + 1;
		}
		if($eFlag1 == 1)
			$errmsg = $errmsg . "Length of Category C question paper number should be 6<br/>";
		if($eFlag2 == 1)
			$errmsg = $errmsg . "Category C question paper number should start with character 'C'<br/>";
		if($eFlag3 == 1)
			$errmsg = $errmsg . "Category C question paper number should start with character 'C' followed by 5 decimal digits<br/>";
		if($CNT != $t_4_1)
			$errmsg = $errmsg . "Category C number of participants should match with total number question papers<br/>";
		if(($eFlag1 == 0) && ($eFlag2 == 0) && ($eFlag3 == 0) && ($CNT == $t_4_1))
		{
			$DB_Count = 0;
			$tmp = preg_replace("/C/", "c", $t_4_2);
			$tmp = preg_split("/;/",$tmp);
			for($i=0;$i<count($tmp);$i++)
			{
				$tmp1 = preg_split("/-/",$tmp[$i]);
				if(count($tmp1) == 1)
				{
					$qurC = "select count(*) from catc where ((schoolid='$t_5_1') and (no='" . $tmp1[0] . "'))";
					$rsC = mysql_query($qurC);
					$rowC = mysql_fetch_assoc($rsC);
					$DB_Count = $DB_Count + $rowC['count(*)'];
				}
				else
				{
					$qurC = "select count(*) from catc where ((schoolid='$t_5_1') and (no between '" . $tmp1[0] . "' and '" . $tmp1[1] . "'))";
					$rsC = mysql_query($qurC);
					$rowC = mysql_fetch_assoc($rsC);
					$DB_Count = $DB_Count + $rowC['count(*)'];
				}
			}
			if($DB_Count != $t_4_1)
				$errmsg = $errmsg . "Range entered for Category C is not available in the Database<br/>";
		}
	}
	if($t_5_1 == "")
		$errmsg = $errmsg . "Agent ID cannot be left blank<br/>";
	if($errmsg == "")
		$add = 1;
	else
		$formfl = 1;
}
if($update == 1)
{
	$_SESSION['updating'] = 1;
	$id = $_GET['schoolid'];
	$_SESSION['id'] = $id;

	$qur = "select * from payment where schoolid='$id'";
	$result = mysql_query($qur);
	$no_rows = mysql_num_rows($result);
	$rows = mysql_fetch_assoc($result);
	
	if($no_rows)
	{
		$schoolid = $rows['schoolid'];
		$t_1_1 = $rows['t_1_1'];
		$t_1_2 = $rows['t_1_2'];
		$t_1_3 = $rows['t_1_3'];
		$t_1_4 = $rows['t_1_4'];
		$t_1_5 = $rows['t_1_5'];
		$t_1_6 = $rows['t_1_6'];
		$t_1_7 = $rows['t_1_7'];
		$t_1_8 = $rows['t_1_8'];
		$t_2_1 = $rows['t_2_1'];
		$t_2_2 = $rows['t2_3_5'];
		$t_3_1 = $rows['t_2_2'];
		$t_3_2 = $rows['t3_3_4'];
		$t_4_1 = $rows['t_2_3'];
		$t_4_2 = $rows['t3_3_5'];
		$t_5_1 = $rows['rno'];
		$formfl = 1;
		$BATCH = $rows['batch'];
		$_SESSION['batch'] = $rows['batch'];
	}
	else
		echo "could not retrieve data to update for schoolid=$id<br/>";
}

echo "<body onload=\"focus()\">
<div class=\"page\">
	<div class=\"header\">
		<div class=\"title\">JnanaSudha</div>
		<div class=\"nav\">
			<ul>
				<li><a href=\"../index.php\">Home</a></li>
				<li><a href=\"login.php\">Login</a></li>
				<li><a class=\"active\" href=\"schools.php?ed=0&ud=0\">Schools</a></li>
				<li><a href=\"despatch.php?ud=0\">Despatch</a></li>
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
	if($_SESSION['userid'] == 'sjs@math')
	{
		@header('Location: deny.php');
	}

	if($formfl == 1)
	{
		echo"<form method=\"POST\" action=\"schools_by_agents.php?ed=1&ud=0\">
			<table class=\"maintable\">";
				echo "<tr>
					<td class=\"left\" colspan=\"2\">";
				if($errmsg != "")
					echo "<span class=\"mand1\">Error!<br/>$errmsg</span>";
				else
					echo "<span class=\"mand\">Fields marked with * are mandatory</span>";
				echo "</td>
				</tr>
				<tr>
					<td class=\"left\">Details of the School</td>
					<td class=\"right\">
						<table class=\"inner_table\">";
							if(($edit == 0) && ($_SESSION['updating'] == 0))
								echo "<tr>
								      <td colspan=\"2\" class=\"left\">Generate Institution ID for &nbsp;&nbsp;<input type=\"radio\" name=\"Generate\" onclick=\"generate('p')\"> PU&nbsp;&nbsp;or &nbsp;&nbsp;
								      <input type=\"radio\" name=\"Generate\" onclick=\"generate('h')\"> HighSchool
								      </td>
								      </tr>";
							echo "<tr>
								<td class=\"left\">Institution_ID</td>
								<td class=\"right\"><input name=\"schoolid\" type=\"text\" id=\"schoolid\" size=\"18\" value=\"$schoolid\"";
								if($_SESSION['updating'] == 1)
									echo " readonly=\"readonly\"";
						echo "onChange=\"autofill(this.value)\"/> *</td>"; 
						echo"</tr>
							<tr>
								<td class=\"left\">Name of the School</td>
								<td class=\"right\"><input name=\"t_1_1\" type=\"text\" id=\"t_1_1\" value=\"$t_1_1\" size=\"38\"/> *</td>
							</tr>
							<tr>
								<td class=\"left\">Address</td>
								<td class=\"right\"><textarea name=\"t_1_2\" type=\"text\" id=\"t_1_2\" rows=\"3\" cols=\"36\">$t_1_2</textarea> *</td>
							</tr>
							<tr>
								<td class=\"left\">Taluk</td>
								<td class=\"right\"><input name=\"t_1_3\" type=\"text\" id=\"t_1_3\" value=\"$t_1_3\" size=\"40\"/></td>
							</tr>
							<tr>
								<td class=\"left\">District</td>
								<td class=\"right\"><input name=\"t_1_4\" type=\"text\" id=\"t_1_4\" value=\"$t_1_4\" size=\"40\"/></td>
							</tr>
							<tr>
								<td class=\"left\">PIN Code</td>
								<td class=\"right\"><input name=\"t_1_5\" type=\"text\" id=\"t_1_5\" value=\"$t_1_5\" size=\"40\"/></td>
							</tr>
							<tr>
								<td class=\"left\">Contact Person</td>
								<td class=\"right\"><input name=\"t_1_6\" type=\"text\" id=\"t_1_6\" value=\"$t_1_6\" size=\"40\"/></td>
							</tr>
							<tr>
								<td class=\"left\">Phone Number</td>
								<td class=\"right\"><input name=\"t_1_7\" type=\"text\" id=\"t_1_7\" value=\"$t_1_7\" size=\"40\"/></td>
							</tr>
							<tr>
								<td class=\"left\">EmailID</td>
								<td class=\"right\"><input name=\"t_1_8\" type=\"text\" id=\"t_1_7\" value=\"$t_1_8\" size=\"40\"/></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"left\">Category A</td>
					<td class=\"right\">
						<table class=\"inner_table\">
							<tr>
								<td class=\"left\">No of Participants</td>
								<td class=\"right\"><input name=\"t_2_1\" type=\"text\" id=\"t_2_1\" size=\"20\" value=\"$t_2_1\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " />&nbsp;*</td>
							</tr>
							<tr>
								<td class=\"left\">Question Paper Range</td>
								<td class=\"right\"><input name=\"t_2_2\" type=\"text\" id=\"t_2_2\" size=\"40\" value=\"$t_2_2\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " />&nbsp;*</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"left\">Category B</td>
					<td class=\"right\">
						<table class=\"inner_table\">
							<tr>
								<td class=\"left\">No of Participants</td>
								<td class=\"right\"><input name=\"t_3_1\" type=\"text\" id=\"t_3_1\" size=\"20\" value=\"$t_3_1\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " />&nbsp;*</td>
							</tr>
							<tr>
								<td class=\"left\">Question Paper Range</td>
								<td class=\"right\"><input name=\"t_3_2\" type=\"text\" id=\"t_3_2\" size=\"40\" value=\"$t_3_2\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " />&nbsp;*</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"left\">Category C</td>
					<td class=\"right\">
						<table class=\"inner_table\">
							<tr>
								<td class=\"left\">No of Participants</td>
								<td class=\"right\"><input name=\"t_4_1\" type=\"text\" id=\"t_4_1\" size=\"20\" value=\"$t_4_1\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " />&nbsp;*</td>
							</tr>
							<tr>
								<td class=\"left\">Question Paper Range</td>
								<td class=\"right\"><input name=\"t_4_2\" type=\"text\" id=\"t_4_2\" size=\"40\" value=\"$t_4_2\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " />&nbsp;*</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"left\">Agent ID</td>
					<td class=\"right\"><input name=\"t_5_1\" type=\"text\" id=\"t_5_1\" size=\"20\" value=\"$t_5_1\"";
						if($BATCH != 0)
							echo " readonly=\"readonly\"";
						echo " >&nbsp;*</td>
				</tr>
				<tr>
						<td colspan=\"2\" class=\"left\">
							<input name=\"t_6_1\" type=\"submit\" class=\"sub_button\" id=\"t_6_1\" value=\"Submit\"/>
						</td>
				</tr>
			</table>
		</form>";
	}	
	if($add == 1)
	{
		$t_1_1 = preg_replace("/\'/","\&apos;",$t_1_1);
		$t_1_2 = preg_replace("/\'/","\&apos;",$t_1_2);
		
		$today = getdate();
		$mday = $today['mday'];
		$mday = str_pad($mday,2,"0",STR_PAD_LEFT);
		$mon = $today['mon'];
		$mon = str_pad($mon,2,"0",STR_PAD_LEFT);
		$date1 = $mday . "/" . $mon . "/" . $today['year'];
		
		echo "<table class=\"maintable\">
				<tr>
					<td class=\"left\" colspan=\"2\">";
		
		if($_SESSION['updating'] == 1)
		{
			$updat = "update payment set 
						t_1_1 = '$t_1_1',
						t_1_2 = '$t_1_2',
						t_1_3 = '$t_1_3',
						t_1_4 = '$t_1_4',
						t_1_5 = '$t_1_5',
						t_1_6 = '$t_1_6',
						t_1_7 = '$t_1_7',
						t_1_8 = '$t_1_8',
					  where schoolid='$schoolid'";
			$update_data = mysql_query($updat);
			if($update_data)
			{
				$q2 = "update institution set institute='$t_1_1',address='$t_1_2',taluk='$t_1_3',district='$t_1_4',pin='$t_1_5',cperson='$t_1_6',phone='$t_1_7',email='$t_1_8' where institution_id='$schoolid'";
				$res2 = mysql_query($q2);
				system("perl gen_xml.pl");
			}
			else
				echo "$updat <br/> Could't Update the values to the database</br>";
			echo "<span class=\"updatespan\"><a href=\"receipt.php?schoolid=$id\" target=\"_blank\">Generate Reciept</a></span>";
			unset($_SESSION['updating']);
		}
		else
		{
			$QUR = "select batch from payment where rno='$t_5_1'";
			$RES = mysql_query($QUR);
			$NUM_ROWS = mysql_num_rows($RES);
			if($NUM_ROWS > 0)
			{
				$ROW = mysql_fetch_assoc($RES);
				$bNo = $ROW['batch'];
			}
			elseif($NUM_ROWS == 0)
			{
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
			}
			
			$insert = "insert into payment (schoolid, t_1_1, t_1_2, t_1_3, t_1_4, t_1_5, t_1_6, t_1_7, t_1_8, t_2_1, t_2_2, t_2_3, t2_3_5, t3_3_4, t3_3_5, rno, date, batch) 
					   values('$schoolid','$t_1_1','$t_1_2','$t_1_3','$t_1_4','$t_1_5','$t_1_6','$t_1_7','$t_1_8','$t_2_1','$t_3_1','$t_4_1','$t_2_2','$t_3_2','$t_4_2','$t_5_1','$date1','$bNo')";
			$insert_data = mysql_query($insert);
			if($insert_data)
			{
				echo "Data successfuly entered to the database<br/>";
				
				$q1 = "select count(*) from institution where institution_id='$schoolid'";
				$res1 = mysql_query($q1);
				$row1=mysql_fetch_assoc($res1);
				$cnt = $row1['count(*)'];

				if($cnt == 1)
				{
					$q2 = "update institution set institute='$t_1_1',address='$t_1_2',taluk='$t_1_3',district='$t_1_4',pin='$t_1_5',cperson='$t_1_6',phone='$t_1_7',email='$t_1_8' where institution_id='$schoolid'";
					$res2 = mysql_query($q2);
				}
				elseif($cnt == 0)
				{
						if(preg_match("/p/i", $schoolid))
						{
							$head = "The Principal";
							$type = "puc";
						}
						else
						{
							$head = "The Head Master";
							$type = "hs";
						}
					$q2 = "insert into institution values ('$type','$head','$t_1_1','$t_1_2','$t_1_3','$t_1_4','$t_1_5','$t_1_6','$t_1_7','$t_1_8','$schoolid')";
					$res2 = mysql_query($q2);
				}
				else
				{
					echo "Error";
				}
				system("perl gen_xml.pl");
				
				
				if($t_2_1 != '0')
				{
					$tmp = preg_split("/;/",$t_2_2);
					for($i=0;$i<count($tmp);$i++)
					{
						$tmp1 = preg_split("/-/",$tmp[$i]);
						if(count($tmp1) == 1)
						{
							$qurA = "update cata set schoolid='$schoolid', date='$date1', batch='$bNo' where ((schoolid='$t_5_1') and (no='" . $tmp1[0] . "'))";
							$rsA = mysql_query($qurA);
						}
						else
						{
							$qurA = "update cata set schoolid='$schoolid', date='$date1', batch='$bNo' where ((schoolid='$t_5_1') and (no between '" . $tmp1[0] . "' and '" . $tmp1[1] . "'))";
							$rsA = mysql_query($qurA);
						}
						
						if($rsA)
							;
						else
						{
							echo "Updation Failed for Category-A<br />$qurA";
							return;
						}
					}
				}
				if($t_3_1 != '0')
				{
					$tmp = preg_split("/;/",$t_3_2);
					for($i=0;$i<count($tmp);$i++)
					{
						$tmp1 = preg_split("/-/",$tmp[$i]);
						if(count($tmp1) == 1)
						{
							$qurB = "update catb set schoolid='$schoolid', date='$date1', batch='$bNo' where ((schoolid='$t_5_1') and (no='" . $tmp1[0] . "'))";
							$rsB = mysql_query($qurB);
						}
						else
						{
							$qurB = "update catb set schoolid='$schoolid', date='$date1', batch='$bNo' where ((schoolid='$t_5_1') and (no between '" . $tmp1[0] . "' and '" . $tmp1[1] . "'))";
							$rsB = mysql_query($qurB);
						}
						
						if($rsB)
							;
						else
						{
							echo "Updation Failed for Category-B<br />$qurB";
							return;
						}
					}
				}
				if($t_4_1 != '0')
				{
					$tmp = preg_split("/;/",$t_4_2);
					for($i=0;$i<count($tmp);$i++)
					{
						$tmp1 = preg_split("/-/",$tmp[$i]);
						if(count($tmp1) == 1)
						{
							$qurC = "update catc set schoolid='$schoolid', date='$date1', batch='$bNo' where ((schoolid='$t_5_1') and (no='" . $tmp1[0] . "'))";
							$rsC = mysql_query($qurC);
						}
						else
						{
							$qurC = "update catc set schoolid='$schoolid', date='$date1', batch='$bNo' where ((schoolid='$t_5_1') and (no between '" . $tmp1[0] . "' and '" . $tmp1[1] . "'))";
							$rsC = mysql_query($qurC);
						}
						
						if($rsC)
							;
						else
						{
							echo "Updation Failed for Category-C<br />$qurC";
							return;
						}
					}
				}
			}
			else
				echo "$insert <br/> Could't enter the values to the database";
		}
		
		echo "</td></tr></table>";
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
