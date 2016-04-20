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

function load(MoPfl, cnt)
{
	var MoP = new Array();
	MoP = MoPfl.split(":");
	for(i=0;i<cnt;i++)
		modeofpay(MoP[i],i);
	document.getElementById('schoolid').focus();
}

function payment(no)
{
	/*if(isNaN(no))
	{
		alert("Please enter a valid number");
		return;
	}*/
	t_2_1 = "t_2_1" + "[" + no + "]";
	t_2_2 = "t_2_2" + "[" + no + "]";
	t_2_3 = "t_2_3" + "[" + no + "]";
	t_3_1 = "t_3_1" + "[" + no + "]";
	c1 =document.getElementById(t_2_1).value;
	c2 =document.getElementById(t_2_2).value;
	c3 =document.getElementById(t_2_3).value;
	totalpay = c1 * 10 + c2 * 10 + c3 * 10;
	//alert(totalpay);
	document.getElementById(t_3_1).value = totalpay;
}

function modeofpay(option, no)
{
	t1_3_4 = "t1_3_4" + "[" + no + "]";
	t1_3_5 = "t1_3_5" + "[" + no + "]";
	t1_3_6 = "t1_3_6" + "[" + no + "]";
	t2_3_4 = "t2_3_4" + "[" + no + "]";
	t2_3_5 = "t2_3_5" + "[" + no + "]";
	t3_3_4 = "t3_3_4" + "[" + no + "]";
	t3_3_5 = "t3_3_5" + "[" + no + "]";
	t4_3_4 = "t4_3_4" + "[" + no + "]";
	t4_3_5 = "t4_3_5" + "[" + no + "]";
	DD = "DD" + no;
	CQ = "CQ" + no;
	MO = "MO" + no;
	CS = "CS" + no;
	
	if(option == "edit0")
	{
		document.getElementById(DD).style.display = "block";
		document.getElementById(CQ).style.display = "none";
		document.getElementById(MO).style.display = "none";
		document.getElementById(CS).style.display = "none";
	}
	else if(option=="Demand Draft")
	{
		document.getElementById(t2_3_4).value = "";
		document.getElementById(t2_3_5).value = "";
		document.getElementById(t3_3_4).value = "";
		document.getElementById(t3_3_5).value = "";
		document.getElementById(t4_3_4).value = "";
		document.getElementById(t4_3_5).value = "";
		document.getElementById(DD).style.display = "block";
		document.getElementById(CQ).style.display = "none";
		document.getElementById(MO).style.display = "none";
		document.getElementById(CS).style.display = "none";
	}
	else if(option=="Cheque")
	{
		document.getElementById(t1_3_4).value = "";
		document.getElementById(t1_3_5).value = "";
		document.getElementById(t1_3_6).value = "";
		document.getElementById(t3_3_4).value = "";
		document.getElementById(t3_3_5).value = "";
		document.getElementById(t4_3_4).value = "";
		document.getElementById(t4_3_5).value = "";
		document.getElementById(DD).style.display = "none";
		document.getElementById(CQ).style.display = "block";
		document.getElementById(MO).style.display = "none";
		document.getElementById(CS).style.display = "none";
	}
	else if(option=="MoneyOrder")
	{
		document.getElementById(t1_3_4).value = "";
		document.getElementById(t1_3_5).value = "";
		document.getElementById(t1_3_6).value = "";
		document.getElementById(t2_3_4).value = "";
		document.getElementById(t2_3_5).value = "";
		document.getElementById(t4_3_4).value = "";
		document.getElementById(t4_3_5).value = "";
		document.getElementById(DD).style.display = "none";
		document.getElementById(CQ).style.display = "none";
		document.getElementById(MO).style.display = "block";
		document.getElementById(CS).style.display = "none";
	}
	else if(option=="Cash")
	{
		document.getElementById(t1_3_4).value = "";
		document.getElementById(t1_3_5).value = "";
		document.getElementById(t1_3_6).value = "";
		document.getElementById(t2_3_4).value = "";
		document.getElementById(t2_3_5).value = "";
		document.getElementById(t3_3_4).value = "";
		document.getElementById(t3_3_5).value = "";
		document.getElementById(DD).style.display = "none";
		document.getElementById(CQ).style.display = "none";
		document.getElementById(MO).style.display = "none";
		document.getElementById(CS).style.display = "block";
	}
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

function addtrans()
{
	loc = window.location.href;
	cnt = loc.substr(loc.indexOf(";")+1,1);
	cnt = parseInt(cnt);
	cnt = cnt + 1;
	dest = loc.substr(0,loc.indexOf(";")+1) + cnt.toString();
	window.location = dest; 
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

$result = mysql_query("select * from sjspayment where updation=0 order by rno");
$num_ud = mysql_num_rows($result);

$edit = $_GET['ed'];
$update = $_GET['ud'];
$formfl = 0;
$errmsg="";
$add=0;
$cnt = 1;
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
	$t_2_1[] = 0;
	$t_2_2[] = 0;
	$t_2_3[] = 0;
	$t_3_1[] = 0;
	$t_3_2[] = '';
	$t_3_3[] = '';
	$t1_3_4[] = '';
	$t1_3_5[] = '';
	$t1_3_6[] = '';
	$t2_3_4[] = '';
	$t2_3_5[] = '';
	$t3_3_4[] = '';
	$t3_3_5[] = '';
	$t4_3_4[] = '';
	$t4_3_5[] = '';
	$MoPfl[0] = "edit0";
	$formfl = 1;
	$BATCH[] = 0;
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
	$t_2_3 = $_POST['t_2_3'];
	$t_3_1 = $_POST['t_3_1'];
	$t_3_2 = $_POST['t_3_2'];
	$t_3_3 = $_POST['t_3_3'];
	$t1_3_4 = $_POST['t1_3_4'];
	$t1_3_5 = $_POST['t1_3_5'];
	$t1_3_6 = $_POST['t1_3_6'];
	$t2_3_4 = $_POST['t2_3_4'];
	$t2_3_5 = $_POST['t2_3_5'];
	$t3_3_4 = $_POST['t3_3_4'];
	$t3_3_5 = $_POST['t3_3_5'];
	$t4_3_4 = $_POST['t4_3_4'];
	$t4_3_5 = $_POST['t4_3_5'];
	for($i=0;$i<count($t_3_3);$i++)
	{
		if($t_3_3[$i] == "Demand Draft")
			$MoPfl[$i] = "Demand Draft";
		if($t_3_3[$i] == "Cheque")
			$MoPfl[$i] = "Cheque";
		if($t_3_3[$i] == "MoneyOrder")
			$MoPfl[$i] = "MoneyOrder";
		if($t_3_3[$i] == "Cash")
			$MoPfl[$i] = "Cash";
	}
	
	if($_SESSION['userid'] != 'sjs@math')
	{
		if($schoolid == "" || $t_1_1 == "" || $t_1_2 == "" || $t_3_2 == "")
			$errmsg = "Fields marked with * are mandatory <br/>";
	}
	elseif($_SESSION['userid'] == 'sjs@math')
	{
		if($t_1_1 == "" || $t_1_2 == "" || $t_3_2 == "")
			$errmsg = "Fields marked with * are mandatory <br/>";
	}
	if(($schoolid == "") && ($_SESSION['userid'] != 'sjs@math'))
		$errmsg = $errmsg . "SchoolID cannot be left blank<br/>";
	if($t_1_1 == "")
		$errmsg = $errmsg . "School name cannot be left blank<br/>";
	if($t_1_2 == "")
		$errmsg = $errmsg . "Address cannot be left blank<br/>";
	if(count($t_3_3) == 1)
	{
		if($t_2_1[0] == "")
			$errmsg = $errmsg . "Category A cannot be left blank<br/>";
		elseif(!is_numeric($t_2_1[0]))
			$errmsg = $errmsg . "Category A should have a numerical value<br/>";

		if($t_2_2[0] == "")
			$errmsg = $errmsg . "Category B cannot be left blank<br/>";
		elseif(!is_numeric($t_2_2[0]))
			$errmsg = $errmsg . "Category B should have a numerical value<br/>";

		if($t_2_3[0] == "")
			$errmsg = $errmsg . "Category C cannot be left blank<br/>";
		elseif(!is_numeric($t_2_3[0]))
			$errmsg = $errmsg . "Category C should have a numerical value<br/>";

		if($t_3_2[0] == "")
			$errmsg = $errmsg . "Amount paid cannot be left blank<br/>";
		elseif(!is_numeric($t_2_3[0]))
			$errmsg = $errmsg . "Amount paid should have a numerical value<br/>";
	}
		
	if(count($t_3_3) > 1)
	{
		$cnt = count($t_3_3);
		for($i=0;$i<count($t_3_3);$i++)
		{
			$j = $i + 1;
			if($t_2_1[$i] == "")
				$errmsg = $errmsg . "Category A cannot be left blank in Transaction $j<br/>";
			elseif(!is_numeric($t_2_1[$i]))
				$errmsg = $errmsg . "Category A should have a numerical value in Transaction $j<br/>";

			if($t_2_2[$i] == "")
				$errmsg = $errmsg . "Category B cannot be left blank in Transaction $j<br/>";
			elseif(!is_numeric($t_2_2[$i]))
				$errmsg = $errmsg . "Category B should have a numerical value in Transaction $j<br/>";

			if($t_2_3[$i] == "")
				$errmsg = $errmsg . "Category C cannot be left blank in Transaction $j<br/>";
			elseif(!is_numeric($t_2_3[$i]))
				$errmsg = $errmsg . "Category C should have a numerical value in Transaction $j<br/>";

			if($t_3_2[$i] == "")
				$errmsg = $errmsg . "Amount paid cannot be left blank in Transaction $j<br/>";
			elseif(!is_numeric($t_2_3[$i]))
				$errmsg = $errmsg . "Amount paid should have a numerical value in Transaction $j<br/>";
		}
	}
	if($_SESSION['updating'] == 0)
		$BATCH[] = 0;
	else
	{
		$RES = mysql_query("select batch from payment where schoolid='$schoolid'");
		$ROW = mysql_fetch_assoc($RES);
		$BATCH = explode(";", $ROW['batch']);
		for($i=count($BATCH);$i<count($t_3_3);$i++)
			$BATCH[] = 0;
	}
	
	if($errmsg != "")
		$formfl = 1;
	else
		$add = 1;
}
if($update == 1)
{
	$_SESSION['updating'] = 1;
	$id1 = $_GET['schoolid'];
	$id = substr($id1,0,strpos($id1,";"));
	$cnt = substr($id1,strpos($id1,";")+1);
	$cnt = intval($cnt);
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
		$t_2_1 = explode(";", $rows['t_2_1']);
		$t_2_2 = explode(";", $rows['t_2_2']);
		$t_2_3 = explode(";", $rows['t_2_3']);
		$t_3_1 = explode(";", $rows['t_3_1']);
		$t_3_2 = explode(";", $rows['t_3_2']);
		$_SESSION['t_3_2T'] = $t_3_2;
		$t_3_3 = explode(";", $rows['t_3_3']);
		$t1_3_4 = explode(";", $rows['t1_3_4']);
		$t1_3_5 = explode(";", $rows['t1_3_5']);
		$t1_3_6 = explode(";", $rows['t1_3_6']);
		$t2_3_4 = explode(";", $rows['t2_3_4']);
		$t2_3_5 = explode(";", $rows['t2_3_5']);
		$t3_3_4 = explode(";", $rows['t3_3_4']);
		$t3_3_5 = explode(";", $rows['t3_3_5']);
		$t4_3_4 = explode(";", $rows['t4_3_4']);
		$t4_3_5 = explode(";", $rows['t4_3_5']);
		$_SESSION['dateT'] = explode(";", $rows['date']);
		$_SESSION['batchT'] = explode(";", $rows['batch']);
		$BATCH = explode(";", $rows['batch']);
		$_SESSION['rno'] = $rows['rno'];
		$_SESSION['Count'] = count($t_3_3);
		for($i=0;$i<count($t_3_3);$i++)
		{
			if($t_3_3[$i] == "Demand Draft")
				$MoPfl[$i] = "Demand Draft";
			if($t_3_3[$i] == "Cheque")
				$MoPfl[$i] = "Cheque";
			if($t_3_3[$i] == "MoneyOrder")
				$MoPfl[$i] = "MoneyOrder";
			if($t_3_3[$i] == "Cash")
				$MoPfl[$i] = "Cash";
		}
		$cnt = $cnt + count($t_3_3) - 1;
		for($i;$i<$cnt;$i++)
		{
			$MoPfl[$i] = "edit0";
			
			$t_2_1[] = 0;
			$t_2_2[] = 0;
			$t_2_3[] = 0;
			$t_3_1[] = 0;
			$t_3_2[] = '';
			$t_3_3[] = '';
			$t1_3_4[] = '';
			$t1_3_5[] = '';
			$t1_3_6[] = '';
			$t2_3_4[] = '';
			$t2_3_5[] = '';
			$t3_3_4[] = '';
			$t3_3_5[] = '';
			$t4_3_4[] = '';
			$t4_3_5[] = '';
			$BATCH[] = 0;
		}
	}
	else
		echo "could not retrieve data to update for rno=$rn<br/>";
	$formfl=1;
}
$MoPfl = implode(":", $MoPfl);

echo "<body onload=\"load('$MoPfl','$cnt')\">
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
	if($formfl == 1)
	{
	
		echo"<form method=\"POST\" action=\"schools.php?ed=1&ud=0\">
			<table class=\"maintable\">";
				if($_SESSION['userid'] != 'sjs@math')
					echo "<tr><td class=\"left\" colspan=\"2\">";
				if(($_SESSION['userid'] != 'sjs@math') && ($num_ud != 0))
				echo "<a href=\"sjs_schools_updation.php?ed=0&ud=0\" target=\"_blank\">Update</a> payment information for the schools entered at Math<br/>";
				if($_SESSION['userid'] != 'sjs@math')
					echo "<a href=\"schools_by_agents.php?ed=0&ud=0\" target=\"_blank\">Enter</a> school details given by agents</td><tr>";
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
							if(($_SESSION['userid'] != 'sjs@math') && ($_SESSION['updating'] == 0))
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
								if($_SESSION['userid'] != 'sjs@math')
									echo "onChange=\"autofill(this.value)\"/> *</td>"; 
								else
									echo "onChange=\"autofill(this.value)\"/></td>";
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
				</tr>";
				if($cnt > 1)
				{
					echo "<tr>
						<td colspan=\"2\" class=\"left\">
						<b>Transaction 1 :</b>
						</td>
						</tr>";
				}
				echo "<tr>
					<td class=\"left\">No. of Participants</td>
					<td class=\"right\">
						<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Category A</td>
								<td class=\"right\"><input name=\"t_2_1[0]\" type=\"text\" id=\"t_2_1[0]\" size=\"20\" value=\"$t_2_1[0]\" onKeyUp=\"payment(0)\" ";
							if($BATCH[0] != 0)
								echo "readonly=\"readonly\" ";
							echo "/>&nbsp;*</td></tr>
							<tr>
								<td class=\"left\">Category B</td>
								<td class=\"right\"><input name=\"t_2_2[0]\" type=\"text\" id=\"t_2_2[0]\" size=\"20\" value=\"$t_2_2[0]\" onKeyUp=\"payment(0)\" ";
							if($BATCH[0] != 0)
								echo "readonly=\"readonly\" ";
							echo "/>&nbsp;*</td>
							</tr>
							<tr>
								<td class=\"left\">Category C</td>
								<td class=\"right\"><input name=\"t_2_3[0]\" type=\"text\" id=\"t_2_3[0]\" size=\"20\" value=\"$t_2_3[0]\" onKeyUp=\"payment(0)\" ";
							if($BATCH[0] != 0)
								echo "readonly=\"readonly\" ";
							echo "/>&nbsp;*</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class=\"left\">Payment Information</td>
					<td class=\"right\">
						<table class=\"inner_table\">
							<tr>
								<td class=\"left\">Total Amount to be paid</td>
								<td class=\"right\"><input name=\"t_3_1[0]\" type=\"text\" id=\"t_3_1[0]\" size=\"20\" value=\"$t_3_1[0]\" readonly=\"readonly\" /></td>
							</tr>
							<tr>
								<td class=\"left\">Total Amount paid</td>
								<td class=\"right\"><input name=\"t_3_2[0]\" type=\"text\" id=\"t_3_2[0]\" value=\"$t_3_2[0]\" size=\"20\" ";
							if($BATCH[0] != 0)
								echo "readonly=\"readonly\" ";
							echo "/> *</td>
							</tr>
							<tr>
								<td class=\"left\">Mode of Payment</td>
								<td class=\"right\"><select name=\"t_3_3[0]\" id=\"t_3_3[0]\" onchange=\"modeofpay(this.value, 0)\" />";
								$pattern = "/<option>$t_3_3[0]<\/option>/";
								$replacement = "<option selected=\"selected\">$t_3_3[0]</option>";
								$subject = "<option>Demand Draft</option>
										    <option>Cheque</option>
										    <option>MoneyOrder</option>
										    <option>Cash</option>";
								$selct = preg_replace($pattern, $replacement, $subject);
								echo $selct;
								echo "</select>
								</td>
							</tr>
						</table>
						
							<div id=\"DD0\">
								<table class=\"inner_table\">
								<tr>
									<td class=\"left\">DD Number</td>
									<td class=\"right\"><input name=\"t1_3_4[0]\" type=\"text\" id=\"t1_3_4[0]\" value=\"$t1_3_4[0]\" size=\"20\"/></td>
								</tr>
								<tr>
									<td class=\"left\">DD drawn Date(DD/MM/YYYY)</td>
									<td class=\"right\"><input name=\"t1_3_5[0]\" type=\"text\" id=\"t1_3_5[0]\" value=\"$t1_3_5[0]\" size=\"20\"/></td>
								</tr>
								<tr>
									<td class=\"left\">DD drawn on Bank</td>
									<td class=\"right\"><input name=\"t1_3_6[0]\" type=\"text\" id=\"t1_3_6[0]\" value=\"$t1_3_6[0]\" size=\"20\"/></td>
								</tr>
								</table>
							</div>
							
							<div id=\"CQ0\">
								<table class=\"inner_table\">
								<tr>
									<td class=\"left\">Cheque Number</td>
									<td class=\"right\"><input name=\"t2_3_4[0]\" type=\"text\" id=\"t2_3_4[0]\" value=\"$t2_3_4[0]\" size=\"20\"/></td>
								</tr>
								<tr>
									<td class=\"left\">Cheque signed Date(DD/MM/YYYY)</td>
									<td class=\"right\"><input name=\"t2_3_5[0]\" type=\"text\" id=\"t2_3_5[0]\" value=\"$t2_3_5[0]\" size=\"20\"/></td>
								</tr>
								</table>
							</div>
							
							<div id=\"MO0\">
								<table class=\"inner_table\">
								<tr>
									<td class=\"left\">MO Details</td>
									<td class=\"right\"><input name=\"t3_3_4[0]\" type=\"text\" id=\"t3_3_4[0]\" value=\"$t3_3_4[0]\" size=\"20\"/></td>
								</tr>
								<tr>
									<td class=\"left\">MO sent on Date(DD/MM/YYYY)</td>
									<td class=\"right\"><input name=\"t3_3_5[0]\" type=\"text\" id=\"t3_3_5[0]\" value=\"$t3_3_5[0]\" size=\"20\"/></td>
								</tr>
								</table>
							</div>
							
							<div id=\"CS0\">
								<table class=\"inner_table\">
								<tr>
									<td class=\"left\">Cash Payment Details</td>
									<td class=\"right\"><input name=\"t4_3_4[0]\" type=\"text\" id=\"t4_3_4[0]\" value=\"$t4_3_4[0]\" size=\"20\"/></td>
								</tr>
								<tr>
									<td class=\"left\">Cash paid Date(DD/MM/YYYY)</td>
									<td class=\"right\"><input name=\"t4_3_5[0]\" type=\"text\" id=\"t4_3_5[0]\" value=\"$t4_3_5[0]\" size=\"20\"/></td>
								</tr>
								</table>
							</div>
					</td>
				</tr>";
				if($cnt > 1)
				{
					for($i=1;$i<$cnt;$i++)
					{
						$j = $i + 1;
						echo "<tr>
							<td colspan=\"2\" class=\"left\">
							<b>Transaction $j :</b>
							</td>
							</tr>";
						
						echo "<tr>
							<td class=\"left\">No. of Participants</td>
							<td class=\"right\">
								<table class=\"inner_table\">
									<tr>
										<td class=\"left\">Category A</td>
										<td class=\"right\"><input name=\"t_2_1[$i]\" type=\"text\" id=\"t_2_1[$i]\" size=\"20\" value=\"$t_2_1[$i]\" onKeyUp=\"payment($i)\" ";
							if($BATCH[$i] != 0)
								echo "readonly=\"readonly\" ";
							echo "/>&nbsp;*</td>
									</tr>
									<tr>
										<td class=\"left\">Category B</td>
										<td class=\"right\"><input name=\"t_2_2[$i]\" type=\"text\" id=\"t_2_2[$i]\" size=\"20\" value=\"$t_2_2[$i]\" onKeyUp=\"payment($i)\" ";
							if($BATCH[$i] != 0)
								echo "readonly=\"readonly\" ";
							echo "/>&nbsp;*</td>
									</tr>
									<tr>
										<td class=\"left\">Category C</td>
										<td class=\"right\"><input name=\"t_2_3[$i]\" type=\"text\" id=\"t_2_3[$i]\" size=\"20\" value=\"$t_2_3[$i]\" onKeyUp=\"payment($i)\" ";
							if($BATCH[$i] != 0)
								echo "readonly=\"readonly\" ";
							echo "/>&nbsp;*</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class=\"left\">Payment Information</td>
							<td class=\"right\">
								<table class=\"inner_table\">
									<tr>
										<td class=\"left\">Total Amount to be paid</td>
										<td class=\"right\"><input name=\"t_3_1[$i]\" type=\"text\" id=\"t_3_1[$i]\" size=\"20\" value=\"$t_3_1[$i]\" readonly=\"readonly\"/></td>
									</tr>
									<tr>
										<td class=\"left\">Total Amount paid</td>
										<td class=\"right\"><input name=\"t_3_2[$i]\" type=\"text\" id=\"t_3_2[$i]\" value=\"$t_3_2[$i]\" size=\"20\" ";
							if($BATCH[$i] != 0)
								echo "readonly=\"readonly\" ";
							echo "/> *</td>
									</tr>
									<tr>
										<td class=\"left\">Mode of Payment</td>
										<td class=\"right\"><select name=\"t_3_3[$i]\" id=\"t_3_3[$i]\" onchange=\"modeofpay(this.value, $i)\"/>";
										$pattern = "/<option>$t_3_3[$i]<\/option>/";
										$replacement = "<option selected=\"selected\">$t_3_3[$i]</option>";
										$subject = "<option>Demand Draft</option>
													<option>Cheque</option>
													<option>MoneyOrder</option>
													<option>Cash</option>";
										$selct = preg_replace($pattern, $replacement, $subject);
										echo $selct;
										echo "</select>
										</td>
									</tr>
								</table>
								
									<div id=\"DD$i\">
										<table class=\"inner_table\">
										<tr>
											<td class=\"left\">DD Number</td>
											<td class=\"right\"><input name=\"t1_3_4[$i]\" type=\"text\" id=\"t1_3_4[$i]\" value=\"$t1_3_4[$i]\" size=\"20\"/></td>
										</tr>
										<tr>
											<td class=\"left\">DD drawn Date(DD/MM/YYYY)</td>
											<td class=\"right\"><input name=\"t1_3_5[$i]\" type=\"text\" id=\"t1_3_5[$i]\" value=\"$t1_3_5[$i]\" size=\"20\"/></td>
										</tr>
										<tr>
											<td class=\"left\">DD drawn on Bank</td>
											<td class=\"right\"><input name=\"t1_3_6[$i]\" type=\"text\" id=\"t1_3_6[$i]\" value=\"$t1_3_6[$i]\" size=\"20\"/></td>
										</tr>
										</table>
									</div>
									
									<div id=\"CQ$i\">
										<table class=\"inner_table\">
										<tr>
											<td class=\"left\">Cheque Number</td>
											<td class=\"right\"><input name=\"t2_3_4[$i]\" type=\"text\" id=\"t2_3_4[$i]\" value=\"$t2_3_4[$i]\" size=\"20\"/></td>
										</tr>
										<tr>
											<td class=\"left\">Cheque signed Date(DD/MM/YYYY)</td>
											<td class=\"right\"><input name=\"t2_3_5[$i]\" type=\"text\" id=\"t2_3_5[$i]\" value=\"$t2_3_5[$i]\" size=\"20\"/></td>
										</tr>
										</table>
									</div>
									
									<div id=\"MO$i\">
										<table class=\"inner_table\">
										<tr>
											<td class=\"left\">MO Details</td>
											<td class=\"right\"><input name=\"t3_3_4[$i]\" type=\"text\" id=\"t3_3_4[$i]\" value=\"$t3_3_4[$i]\" size=\"20\"/></td>
										</tr>
										<tr>
											<td class=\"left\">MO sent on Date(DD/MM/YYYY)</td>
											<td class=\"right\"><input name=\"t3_3_5[$i]\" type=\"text\" id=\"t3_3_5[$i]\" value=\"$t3_3_5[$i]\" size=\"20\"/></td>
										</tr>
										</table>
									</div>
									
									<div id=\"CS$i\">
										<table class=\"inner_table\">
										<tr>
											<td class=\"left\">Cash Payment Details</td>
											<td class=\"right\"><input name=\"t4_3_4[$i]\" type=\"text\" id=\"t4_3_4[$i]\" value=\"$t4_3_4[$i]\" size=\"20\"/></td>
										</tr>
										<tr>
											<td class=\"left\">Cash paid Date(DD/MM/YYYY)</td>
											<td class=\"right\"><input name=\"t4_3_5[$i]\" type=\"text\" id=\"t4_3_5[$i]\" value=\"$t4_3_5[$i]\" size=\"20\"/></td>
										</tr>
										</table>
									</div>
							</td>
						</tr>";
					}
				}
				if($update == 1)
				{
					echo "<tr>
						<td colspan=\"2\" class=\"left\">
							<input name=\"t_4_2\" type=\"radio\" id=\"t_4_2\" onclick=\"addtrans()\"/> Add Another Transaction
						</td>
					</tr>
					<tr>
					<td colspan=\"2\" class=\"left\">
						<input name=\"t_4_1\" type=\"submit\" class=\"sub_button\" id=\"t_4_1\" value=\"Update\"/>
					</td>
					</tr>";
				}
				else
				{
					echo "<tr>
						<td colspan=\"2\" class=\"left\">
							<input name=\"t_4_1\" type=\"submit\" class=\"sub_button\" id=\"t_4_1\" value=\"Submit\"/>
						</td>
						</tr>";
				}
			echo "</table>
		</form>";
	}	
	if(($add == 1) && ($_SESSION['userid'] != 'sjs@math'))
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
		
		$res = mysql_query("select rno from receipt");
		$num_row = mysql_num_rows($res);
		if($num_row)
		{
			$row = mysql_fetch_assoc($res);
			$rec = $row['rno'];
			$recno = $rec+1;
			$RNO = $recno;
		}
		else
		{
			$recno = 10001;
			$RNO = 10001;
		}
		if($_SESSION['updating'] == 1)
		{
			$date = "";
			$rcno = $_SESSION['rno'];
			for($i=$_SESSION['Count'];$i<count($t_3_3);$i++)
			{
				$rcno = $rcno . ";" . $recno;
				$RNO = $recno;
				$recno++;
			}
			if($_SESSION['Count'] >= count($t_3_3))
				$RNO--;
				
			$t_3_2T = $_SESSION['t_3_2T'];
			$dateT = $_SESSION['dateT'];
			$batchT = $_SESSION['batchT'];
			for($i=0;$i<count($t_3_3);$i++)
			{
				if($i < $_SESSION['Count'])
				{
					if($t_3_2T[$i] == $t_3_2[$i])
					{
						$date[$i] = $dateT[$i];
						$batch[$i] = $batchT[$i]; 
					}
					else
					{
						$date[$i] = '';
						$batch[$i] = '0';
					}
				}
				else
				{
					$date[$i] = '';
					$batch[$i] = 0;
				}
			}
			$id = $_SESSION['id'];
			$t_2_1 = implode(";", $t_2_1);
			$t_2_2 = implode(";", $t_2_2);
			$t_2_3 = implode(";", $t_2_3);
			$t_3_1 = implode(";", $t_3_1);
			$t_3_2 = implode(";", $t_3_2);
			$t_3_3 = implode(";", $t_3_3);
			$t1_3_4 = implode(";", $t1_3_4);
			$t1_3_5 = implode(";", $t1_3_5);
			$t1_3_6 = implode(";", $t1_3_6);
			$t2_3_4 = implode(";", $t2_3_4);
			$t2_3_5 = implode(";", $t2_3_5);
			$t3_3_4 = implode(";", $t3_3_4);
			$t3_3_5 = implode(";", $t3_3_5);
			$t4_3_4 = implode(";", $t4_3_4);
			$t4_3_5 = implode(";", $t4_3_5);
			$date = implode(";", $date);
			$batch = implode(";", $batch);
			
			$updat = "update payment set 
						t_1_1 = '$t_1_1',
						t_1_2 = '$t_1_2',
						t_1_3 = '$t_1_3',
						t_1_4 = '$t_1_4',
						t_1_5 = '$t_1_5',
						t_1_6 = '$t_1_6',
						t_1_7 = '$t_1_7',
						t_1_8 = '$t_1_8',
						t_2_1 = '$t_2_1',
						t_2_2 = '$t_2_2',
						t_2_3 = '$t_2_3',
						t_3_1 = '$t_3_1',
						t_3_2 = '$t_3_2',
						t_3_3 = '$t_3_3',
						t1_3_4 = '$t1_3_4',
						t1_3_5 = '$t1_3_5',
						t1_3_6 = '$t1_3_6',
						t2_3_4 = '$t2_3_4',
						t2_3_5 = '$t2_3_5',
						t3_3_4 = '$t3_3_4',
						t3_3_5 = '$t3_3_5',
						t4_3_4 = '$t4_3_4',
						t4_3_5 = '$t4_3_5',
						rno = '$rcno',
						date = '$date',
						batch = '$batch'
					  where schoolid='$id'";
			$update_data = mysql_query($updat);
			if($update_data)
			{
				mysql_query("update receipt set rno=$RNO");
				echo "Data successfuly Updated to the database<br/>";
				
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
					$q2 = "insert into institution values ('$head','$type','$t_1_1','$t_1_2','$t_1_3','$t_1_4','$t_1_5','$t_1_6','$t_1_7','$t_1_8','$schoolid')";
					$res2 = mysql_query($q2);
				}
				else
				{
					echo "Error";
				}
				system("perl gen_xml.pl");
				
			}
			else
				echo "$updat <br/> Could't Update the values to the database</br>";
			echo "<span class=\"updatespan\"><a href=\"receipt.php?schoolid=$id\" target=\"_blank\">Generate Reciept</a></span>";
			unset($_SESSION['updating']);
			unset($_SESSION['id']);
			unset($_SESSION['rno']);
			unset($_SESSION['Count']);
			unset($_SESSION['t_3_2T']);
			unset($_SESSION['dateT']);
			unset($_SESSION['batchT']);
		}
		else
		{
			$insert = "insert into payment values(
						'$schoolid',
						'$t_1_1',
						'$t_1_2',
						'$t_1_3',
						'$t_1_4',
						'$t_1_5',
						'$t_1_6',
						'$t_1_7',
						'$t_1_8',
						'$t_2_1[0]',
						'$t_2_2[0]',
						'$t_2_3[0]',
						'$t_3_1[0]',
						'$t_3_2[0]',
						'$t_3_3[0]',
						'$t1_3_4[0]',
						'$t1_3_5[0]',
						'$t1_3_6[0]',
						'$t2_3_4[0]',
						'$t2_3_5[0]',
						'$t3_3_4[0]',
						'$t3_3_5[0]',
						'$t4_3_4[0]',
						'$t4_3_5[0]',
						'$recno',
						'',
						'0')";
			$insert_data = mysql_query($insert);
			if($insert_data)
			{
				mysql_query("update receipt set rno=$RNO");
				echo "Data successfuly entered to the database<br/>";
				echo "<span class=\"updatespan\"><a href=\"receipt.php?schoolid=$schoolid\" target=\"_blank\">Generate Reciept</a></span>";
				
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
			}
			else
				echo "$insert <br/> Could't enter the values to the database";
		}
		
		echo "</td></tr></table>";
	}
	
	elseif(($add == 1) && ($_SESSION['userid'] == 'sjs@math'))
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
		
		$res = mysql_query("select rno from receipt");
		$num_row = mysql_num_rows($res);
		if($num_row)
		{
			$row = mysql_fetch_assoc($res);
			$rec = $row['rno'];
			$recno = $rec+1;
			$RNO = $recno;
		}
		else
			$recno = 10001;
		if($_SESSION['updating'] == 1)
		{
			unset($_SESSION['updating']);
			unset($_SESSION['id']);
			unset($_SESSION['rno']);
			unset($_SESSION['Count']);
			unset($_SESSION['t_3_2T']);
			unset($_SESSION['dateT']);
			unset($_SESSION['batchT']);
			echo "</td></tr></table>";
		}
		else
		{
			$A = mysql_query("select * from cata where schoolid IS NULL");
			$ca = mysql_num_rows($A);
			$B = mysql_query("select * from catb where schoolid IS NULL");
			$cb = mysql_num_rows($B);
			$C = mysql_query("select * from catc where schoolid IS NULL");
			$cc = mysql_num_rows($C);
			if(($ca < $t_2_1[0]) || ($cb < $t_2_2[0]) || ($cc < $t_2_3[0]))
			{
				echo "Fatal Error : You Dont have sufficient question paper in the stock for despatching books</br>";
				return;
			}
			
			$insert = "insert into sjspayment values(
						'$schoolid',
						'$t_1_1',
						'$t_1_2',
						'$t_1_3',
						'$t_1_4',
						'$t_1_5',
						'$t_1_6',
						'$t_1_7',
						'$t_1_8',
						'$t_2_1[0]',
						'$t_2_2[0]',
						'$t_2_3[0]',
						'$t_3_1[0]',
						'$t_3_2[0]',
						'$t_3_3[0]',
						'$t1_3_4[0]',
						'$t1_3_5[0]',
						'$t1_3_6[0]',
						'$t2_3_4[0]',
						'$t2_3_5[0]',
						'$t3_3_4[0]',
						'$t3_3_5[0]',
						'$t4_3_4[0]',
						'$t4_3_5[0]',
						'$recno',
						'$date1',
						'0',
						'0')";
			$insert_data = mysql_query($insert);
			if($insert_data)
			{
				$catA = $t_2_1[0];
				$catB = $t_2_2[0];
				$catC = $t_2_3[0];
				$fromA = 0;
				$toA = 0;
				$fromB = 0;
				$toB = 0;
				$fromC = 0;
				$toC = 0;
				mysql_query("update receipt set rno=$RNO");
				echo "Data successfuly entered to the database<br/>";
				echo "<span class=\"updatespan\"><a href=\"receipt1.php?rno=$recno\" target=\"_blank\">Generate Reciept</a></span></td></tr></table><br/>";
				
				$rsA = mysql_query("update cata set schoolid='$recno', date='$date1', batch='0' where schoolid is NULL order by no limit $catA");
				if($rsA)
					;
				else
				{
					echo "Updation Failed for cat-A";
					return;
				}
				
				$rsB = mysql_query("update catb set schoolid='$recno', date='$date1', batch='0' where schoolid is NULL order by no limit $catB");
				if($rsB)
					;
				else
				{
					echo "Updation Failed for cat-B";
					return;
				}
				
				$rsC = mysql_query("update catc set schoolid='$recno', date='$date1', batch='0' where schoolid is NULL order by no limit $catC");
				if($rsC)
					;
				else
				{
					echo "Updation Failed for cat-C";
					return;
				}
				
				$resA = mysql_query("select no from cata where schoolid='$recno' order by no limit 1");
				$rowA = mysql_fetch_assoc($resA);
				$fromA = strtoupper($rowA['no']);
				if($fromA == '')
					$fromA = '--';
				$resA = mysql_query("select no from cata where schoolid='$recno' order by no desc limit 1");
				$rowA = mysql_fetch_assoc($resA);
				$toA = strtoupper($rowA['no']);
				if($toA == '')
					$toA = '--';
				
				$resB = mysql_query("select no from catb where schoolid='$recno' order by no limit 1");
				$rowB = mysql_fetch_assoc($resB);
				$fromB = strtoupper($rowB['no']);
				if($fromB == '')
					$fromB = '--';
				$resB = mysql_query("select no from catb where schoolid='$recno' order by no desc limit 1");
				$rowB = mysql_fetch_assoc($resB);
				$toB = strtoupper($rowB['no']);
				if($toB == '')
					$toB = '--';
				
				$resC = mysql_query("select no from catc where schoolid='$recno' order by no limit 1");
				$rowC = mysql_fetch_assoc($resC);
				$fromC = strtoupper($rowC['no']);
				if($fromC == '')
					$fromC = '--';
				$resC = mysql_query("select no from catc where schoolid='$recno' order by no desc limit 1");
				$rowC = mysql_fetch_assoc($resC);
				$toC = strtoupper($rowC['no']);
				if($toC == '')
					$toC = '--';
			
				echo "<table class=\"sjsupdatetable\"><tr><td colspan=\"6\" style=\"text-align: right; font-weight: bold; font-size: 1em;\">Despatch Information</td>
					</tr>
					<tr>
						<td style=\"width: 23%\">Category <span class=\"bld\">A</span></td>
						<td style=\"width: 11%\"><span class=\"bld\">" . $t_2_1[0] . "</span></td>
						<td style=\"width: 6%\">From</td>
						<td style=\"width: 27%\">$fromA</td>
						<td style=\"width: 6%\">To</td>
						<td style=\"width: 27%\">$toA</td>
					</tr>
					<tr>
						<td style=\"width: 23%\">Category <span class=\"bld\">B</span></td>
						<td style=\"width: 11%\"><span class=\"bld\">" . $t_2_2[0] . "</span></td>
						<td style=\"width: 6%\">From</td>
						<td style=\"width: 27%\">$fromB</td>
						<td style=\"width: 6%\">To</td>
						<td style=\"width: 27%\">$toB</td>
					</tr>
					<tr>
						<td style=\"width: 23%\">Category <span class=\"bld\">C</span></td>
						<td style=\"width: 11%\"><span class=\"bld\">" . $t_2_3[0] . "</span></td>
						<td style=\"width: 6%\">From</td>
						<td style=\"width: 27%\">$fromC</td>
						<td style=\"width: 6%\">To</td>
						<td style=\"width: 27%\">$toC</td>
					</tr></table>";
			}
			else
				echo "$insert <br/> Could't enter the values to the database</td></tr></table>";
		}
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
