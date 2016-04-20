<?php

session_start();

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>JnanaSudha</title>
<link href=\"style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/indexstyle.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/indexstyle.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />

<script type=\"text/javascript\" src=\"js/kannada.js\"></script>
<script type=\"text/javascript\" src=\"js/converter.js\"></script>
<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\">
    </script>
    <script type=\"text/javascript\">

      // Load the Google Transliterate API
      google.load(\"elements\", \"1\", {
            packages: \"transliteration\"
          });

      function onLoad() {
        var options = {
            sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.KANNADA],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };

        // Create an instance on TransliterationControl with the required
        // options.
        var control =
            new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textbox with id
        // 'transliterateTextarea'.
        control.makeTransliteratable(['t_0_0','t_1_2','t_1_3']);
      }
      google.setOnLoadCallback(onLoad);
    </script>

<script type=\"text/javascript\" language=\"JavaScript\">

function load()
{
	document.getElementById(\"kt_help\").style.display = \"none\";
	document.getElementById(\"help\").style.display = \"none\";
	return;
}

function show_kthelp()
{
	document.getElementById(\"kt_help\").style.display = \"block\";
	document.getElementById(\"help\").style.display = \"none\";
	return;
}

function hide_kthelp()
{
	document.getElementById(\"kt_help\").style.display = \"none\";
	document.getElementById(\"help\").style.display = \"block\";
	document.getElementById(\"k_t_help\").checked = false;
	return;
}

function num_validate(val,cat,id)
{
	var RE = /[A-z]/gi;
	var newval = val.replace(RE,'');
	var curID = \"t_\" + cat + \"_\" + id;
	document.getElementById(curID).value = newval;
}

function sent_ans_paper(no)
{
	if((no.length < 6) || (no.length > 6))
	{
		document.getElementById(\"t_2_0\").value = '';
		document.getElementById(\"t_3_0\").value = '';
		document.getElementById(\"t_4_0\").value = '';
		return;
	}
		
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
	//alert(id);
	function UpdatePage()
	{
		if((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
		{
			var data = xmlhttp.responseText.split(\"|\");
			document.getElementById(\"t_1_1\").value = data[0];
			document.getElementById(\"t_2_0\").value = data[1];
			document.getElementById(\"t_3_0\").value = data[2];
			document.getElementById(\"t_4_0\").value = data[3];
		}
	}
	xmlhttp.open(\"GET\",\"cat_count_predict.php?no=\"+no,true);
	xmlhttp.onreadystatechange = UpdatePage;
	xmlhttp.send();
}
function compute5(no, cat)
{
	var curID = \"t_\" + cat + \"_1\";
	val = document.getElementById(curID).value;
	var RE = /[A-z]/gi;
	var newval = val.replace(RE,'');
	document.getElementById(curID).value = newval;
	val = newval;
	
	t_x_2 = \"t_\" + cat + \"_2\";
	if(val == '')
	{
		document.getElementById(t_x_2).value = '';
		return;
	}
	cnt = parseFloat(val) * 0.05;
	Fcnt = Math.ceil(cnt);
	document.getElementById(t_x_2).value = Fcnt;
}

function update(ans_no)
{
	document.getElementById(\"kt_help\").style.display = \"none\";
	if(ans_no.length < 6)
		return;
	else if(ans_no.length > 6)
	{
		newval = ans_no.substr(0,6);
		document.getElementById(\"t_0_1\").value = newval;
	}
	else
	{
		if(document.getElementById('cb').checked)
			dest = \"student_predict.php?ansno=\"+ans_no+\"&single=1\";
		else
			dest = \"student_predict.php?ansno=\"+ans_no;
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
		//alert(id);
		function UpdatePage()
		{
			if((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
			{
				data = xmlhttp.responseText;
				document.getElementById(\"details\").innerHTML = data;
				document.getElementById(\"help\").style.display = \"block\";
				if(data == '')
				{
					document.getElementById(\"help\").style.display = \"none\";
				}
			}
		}
		xmlhttp.open(\"GET\",dest,true);
		xmlhttp.onreadystatechange = UpdatePage;
		xmlhttp.send();
	}
}
</script>
</head>";
echo "<body onload=\"load()\">
<div class=\"page\">
	<div class=\"header\">
		<div class=\"title\">JnanaSudha</div>
		<div class=\"nav\">
			<ul>
				<li><a href=\"../index.php\">Home</a></li>
				<li><a href=\"login.php\">Login</a></li>
				<li><a href=\"schools.php?ed=0&ud=0\">Schools</a></li>
				<li><a href=\"despatch.php?ud=0\">Despatch</a></li>
				<li><a href=\"edit.php\">Edit</a></li>
				<li><a href=\"status.php\">Status</a></li>
				<li><a class=\"active\" href=\"valuation.php\">Valuation</a></li>
				<li><a href=\"logout.php\">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class=\"mainpage\">";

/*
if(isset($_SESSION['userid']))
{
*/
	if(isset($_GET['evl']))
		$evl = $_GET['evl'];
	else
		$evl = 0;

	include("connect.php");

	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$today = getdate();
	$mday = $today['mday'];
	$mday = str_pad($mday,2,"0",STR_PAD_LEFT);
	$mon = $today['mon'];
	$mon = str_pad($mon,2,"0",STR_PAD_LEFT);
	$date = $mday . "/" . $mon . "/" . $today['year'];
	
	if($evl == 0)
	{
		$errmsg = "";
		if(isset($_GET['ins']))
			$ins = $_GET['ins'];
		else
			$ins = 0;
		$add = 0;
		
		if($ins == 0)
		{
			$t_0_1 = '';
			$t_1_1 = '';
			$t_2_0 = '';
			$t_2_1 = 0;
			$t_2_2 = 0;
			$t_2_3 = '';
			$t_3_0 = '';
			$t_3_1 = 0;
			$t_3_2 = 0;
			$t_3_3 = '';
			$t_4_0 = '';
			$t_4_1 = 0;
			$t_4_2 = 0;
			$t_4_3 = '';
		}
		elseif($ins == 1)
		{
			$t_0_1 = $_POST['t_0_1'];
			$t_1_1 = $_POST['t_1_1'];
			$t_2_0 = $_POST['t_2_0'];
			$t_2_1 = $_POST['t_2_1'];
			$t_2_2 = $_POST['t_2_2'];
			$t_2_3 = $_POST['t_2_3'];
			$t_3_0 = $_POST['t_3_0'];
			$t_3_1 = $_POST['t_3_1'];
			$t_3_2 = $_POST['t_3_2'];
			$t_3_3 = $_POST['t_3_3'];
			$t_4_0 = $_POST['t_4_0'];
			$t_4_1 = $_POST['t_4_1'];
			$t_4_2 = $_POST['t_4_2'];
			$t_4_3 = $_POST['t_4_3'];
			if($t_0_1 == "")
			{}
			else
			{
				if($t_1_1 == "")
					$errmsg = $errmsg . "Invalid Answer Paper No.<br/>";
				else
				{
					if($t_2_1 == "")
						$errmsg = $errmsg . "Category A 'No. of answer papers Recieved' should not be left blank<br/>";
					elseif($t_2_1 > $t_2_0)
						$errmsg = $errmsg . "Category A 'No. of answer papers Recieved' should be lesser than 'No. of answer papers Sent'<br/>";
					if($t_3_1 == "")
						$errmsg = $errmsg . "Category B 'No. of answer papers Recieved' should not be left blank<br/>";
					elseif($t_3_1 > $t_3_0)
						$errmsg = $errmsg . "Category B 'No. of answer papers Recieved' should be lesser than 'No. of answer papers Sent'<br/>";
					if($t_4_1 == "")
						$errmsg = $errmsg . "Category C 'No. of answer papers Recieved' should not be left blank<br/>";
					elseif($t_4_1 > $t_4_0)
						$errmsg = $errmsg . "Category C 'No. of answer papers Recieved' should be lesser than 'No. of answer papers Sent'<br/>";
					if($t_2_2 == "")
						$errmsg = $errmsg . "Category A '5% of No. of answer papers Recieved' should not be left blank<br/>";
					elseif($t_2_2 > $t_2_1)
						$errmsg = $errmsg . "Category A '5% of No. of answer papers Recieved' should be lesser than 'No. of answer papers Received'<br/>";
					if($t_3_2 == "")
						$errmsg = $errmsg . "Category B '5% of No. of answer papers Recieved' should not be left blank<br/>";
					elseif($t_3_2 > $t_3_1)
						$errmsg = $errmsg . "Category B '5% of No. of answer papers Recieved' should be lesser than 'No. of answer papers Received'<br/>";
					if($t_4_2 == "")
						$errmsg = $errmsg . "Category C '5% of No. of answer papers Recieved' should not be left blank<br/>";
					elseif($t_4_2 > $t_4_1)
						$errmsg = $errmsg . "Category C '5% of No. of answer papers Recieved' should be lesser than 'No. of answer papers Received'<br/>";
					if((($t_2_1 != "") && ($t_3_1 != "") && ($t_4_1 != "")) && (($t_2_1 == 0) && ($t_3_1 == 0) && ($t_4_1 == 0)))
						$errmsg = $errmsg . "Number of answer papers received should not be Zero for all categories<br/>";
				}
			}
				
			if($errmsg == "")
				$add = 1;
		}
		$catA = mysql_query("select evaluatorID, t_2_1 from evaluator where t_1_1=1");
		$catB = mysql_query("select evaluatorID, t_2_1 from evaluator where t_1_2=1");
		$catC = mysql_query("select evaluatorID, t_2_1 from evaluator where t_1_3=1");
		
		if($add == 0)
		{
			$t0_2_3 = preg_replace("/\(/", "\(", $t_2_3);
			$t0_2_3 = preg_replace("/\)/", "\)", $t0_2_3);
			$t0_3_3 = preg_replace("/\(/", "\(", $t_3_3);
			$t0_3_3 = preg_replace("/\)/", "\)", $t0_3_3);
			$t0_4_3 = preg_replace("/\(/", "\(", $t_4_3);
			$t0_4_3 = preg_replace("/\)/", "\)", $t0_4_3);
			
			echo "<form action=\"valuation.php?evl=0&ins=1\" method=\"POST\">
				<table class=\"maintable\">";
/*
				if($_SESSION['userid'] != 'sjs@math')
				{
*/
					echo "<tr>
						<td colspan=\"2\" class=\"left\">To Enter Evaluator details <a href=\"valuation.php?evl=2\">click here</a><br />
						To Enter Student Details who got selected after evalution <a href=\"valuation.php?evl=1\">click here</a>
						</td>
					</tr>";
/*
				}
*/
					
				echo"<tr>
						<td colspan=\"2\" class=\"left\">";
					if($errmsg != "")
						echo "<span class=\"mand1\">Error!<br/>$errmsg</span>";
					else
						echo "Enter Valuation Details<br/>
							  <span class=\"mand\">Fields marked with * are mandatory</span>";
					echo "</td>
					</tr>
					<tr>
						<td class=\"left\">Institution ID</td>
						<td class=\"right\"><input type=\"text\" id=\"t_1_1\" name=\"t_1_1\" size=\"20\" onkeyup=\"sent_ans_paper(this.value)\" value=\"$t_1_1\" /></td>
					</tr>
					<tr>
						<td class=\"left\">Category A</td>
						<td class=\"right\">
							<table class=\"inner_table\">
								<tr>
									<td class=\"left\">No. of answer Paper Sent</td>
									<td class=\"right\"><input type=\"text\" id=\"t_2_0\" name=\"t_2_0\" size=\"20\" readonly=\"readonly\" value=\"$t_2_0\" /></td>
								</tr>
								<tr>
									<td class=\"left\">No. of answer Paper Received</td>
									<td class=\"right\"><input type=\"text\" id=\"t_2_1\" name=\"t_2_1\" size=\"20\" onkeyup=\"compute5(this.value, '2')\" value=\"$t_2_1\" /></td>
								</tr>
								<tr>
									<td class=\"left\">5% of the Total No of Answer Papers</td>
									<td class=\"right\"><input type=\"text\" id=\"t_2_2\" name=\"t_2_2\" size=\"20\" value=\"$t_2_2\" onkeyup=\"num_validate(this.value, '2', '2')\" /></td>
								</tr>
								<tr>
									<td class=\"left\">Evaluator Name for whom answer papers needs to be assigned</td>
									<td class=\"right\"><select id=\"t_2_3\" name=\"t_2_3\">";
									$subject = "";
									for($i=0;$i<mysql_num_rows($catA);$i++)
									{
										$rowA = mysql_fetch_assoc($catA);
										$id = $rowA['evaluatorID'];
										
										$sum = 0;
										$res = mysql_query("select sum(cata) from valuation where ((eaid='$id') and (aret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(cata)'];
										$res = mysql_query("select sum(catb) from valuation where ((ebid='$id') and (bret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(catb)'];
										$res = mysql_query("select sum(catc) from valuation where ((ecid='$id') and (cret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(catc)'];
										
										$subject = $subject . "<option>" . $rowA['t_2_1'] . " (" . $sum . ")</option>";
									}
									$pattern = "/<option>" . $t0_2_3 . "<\/option>/";
									$replacement = "<option selected=\"selected\">" . $t_2_3 . "</option>";
									$selection = preg_replace($pattern, $replacement, $subject);
									echo $selection;
									echo"</select></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Category B</td>
						<td class=\"right\">
							<table class=\"inner_table\">
								<tr>
									<td class=\"left\">No. of answer Paper Sent</td>
									<td class=\"right\"><input type=\"text\" id=\"t_3_0\" name=\"t_3_0\" size=\"20\" readonly=\"readonly\" value=\"$t_3_0\" /></td>
								</tr>
								<tr>
									<td class=\"left\">No. of answer Paper Received</td>
									<td class=\"right\"><input type=\"text\" id=\"t_3_1\" name=\"t_3_1\" size=\"20\" onkeyup=\"compute5(this.value, '3')\" value=\"$t_3_1\" /></td>
								</tr>
								<tr>
									<td class=\"left\">5% of the Total No of Answer Papers</td>
									<td class=\"right\"><input type=\"text\" id=\"t_3_2\" name=\"t_3_2\" size=\"20\" value=\"$t_3_2\" onkeyup=\"num_validate(this.value, '3', '2')\" /></td>
								</tr>
								<tr>
									<td class=\"left\">Evaluator Name for whom answer papers needs to be assigned</td>
									<td class=\"right\"><select id=\"t_3_3\" name=\"t_3_3\">";
									$subject = "";
									for($i=0;$i<mysql_num_rows($catB);$i++)
									{
										$rowB = mysql_fetch_assoc($catB);
										$id = $rowB['evaluatorID'];
										
										$sum = 0;
										$res = mysql_query("select sum(cata) from valuation where ((eaid='$id') and (aret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(cata)'];
										$res = mysql_query("select sum(catb) from valuation where ((ebid='$id') and (bret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(catb)'];
										$res = mysql_query("select sum(catc) from valuation where ((ecid='$id') and (cret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(catc)'];
										
										$subject = $subject . "<option>" . $rowB['t_2_1'] . " (" . $sum . ")</option>";
									}
									$pattern = "/<option>" . $t0_3_3 . "<\/option>/";
									$replacement = "<option selected=\"selected\">" . $t_3_3 . "</option>";
									$selection = preg_replace($pattern, $replacement, $subject);
									echo $selection;
									echo"</select></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\">Category C</td>
						<td class=\"right\">
							<table class=\"inner_table\">
								<tr>
									<td class=\"left\">No. of answer Paper Sent</td>
									<td class=\"right\"><input type=\"text\" id=\"t_4_0\" name=\"t_4_0\" size=\"20\" readonly=\"readonly\" value=\"$t_4_0\" /></td>
								</tr>
								<tr>
									<td class=\"left\">No. of answer Paper Received</td>
									<td class=\"right\"><input type=\"text\" id=\"t_4_1\" name=\"t_4_1\" size=\"20\" onkeyup=\"compute5(this.value, '4')\" value=\"$t_4_1\" /></td>
								</tr>
								<tr>
									<td class=\"left\">5% of the Total No of Answer Papers</td>
									<td class=\"right\"><input type=\"text\" id=\"t_4_2\" name=\"t_4_2\" size=\"20\" value=\"$t_4_2\" onkeyup=\"num_validate(this.value, '4', '2')\" /></td>
								</tr>
								<tr>
									<td class=\"left\">Evaluator Name for whom answer papers needs to be assigned</td>
									<td class=\"right\"><select id=\"t_4_3\" name=\"t_4_3\">";
									$subject = "<option>" . "" . "</option>";
									for($i=0;$i<mysql_num_rows($catC);$i++)
									{
										$rowC = mysql_fetch_assoc($catC);
										$id = $rowC['evaluatorID'];
										
										$sum = 0;
										$res = mysql_query("select sum(cata) from valuation where ((eaid='$id') and (aret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(cata)'];
										$res = mysql_query("select sum(catb) from valuation where ((ebid='$id') and (bret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(catb)'];
										$res = mysql_query("select sum(catc) from valuation where ((ecid='$id') and (cret='0'))");
										$row = mysql_fetch_assoc($res);
										$sum = $sum + $row['sum(catc)'];
										
										$subject = $subject . "<option>" . $rowC['t_2_1'] . " (" . $sum . ")</option>";
									}
									$pattern = "/<option>" . $t0_4_3 . "<\/option>/";
									$replacement = "<option selected=\"selected\">" . $t_4_3 . "</option>";
									$selection = preg_replace($pattern, $replacement, $subject);
									echo $selection;
									echo"</select></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=\"left\" colspan=\"2\"><input type=\"submit\" value=\"Submit\" /></td>
					</tr>
				</table>
			</form>";
		}
		if($add == 1)
		{
			if($t_2_1 != 0)
			{
				$t_2_3 = substr($t_2_3,0,strpos($t_2_3,"(")-1);
				$E1res = mysql_query("select evaluatorID from evaluator where t_2_1='$t_2_3'");
				$E1row = mysql_fetch_assoc($E1res);
				$E1id = $E1row['evaluatorID'];
				$retA = '0';
			}
			else
			{
				$E1id = '';
				$retA = '';
			}
			if($t_3_1 != 0)
			{
				$t_3_3 = substr($t_3_3,0,strpos($t_3_3,"(")-1);
				$E2res = mysql_query("select evaluatorID from evaluator where t_2_1='$t_3_3'");
				$E2row = mysql_fetch_assoc($E2res);
				$E2id = $E2row['evaluatorID'];
				$retB = '0';
			}
			else
			{
				$E2id = '';
				$retB = '';
			}
			if(($t_4_1 != 0) && ($t_4_3 != ""))
			{
				$t_4_3 = substr($t_4_3,0,strpos($t_4_3,"(")-1);
				$E3res = mysql_query("select evaluatorID from evaluator where t_2_1='$t_4_3'");
				$E3row = mysql_fetch_assoc($E3res);
				$E3id = $E3row['evaluatorID'];
				$retC = '0';
			}
			else
			{
				$E3id = '';
				$retC = '';
			}
				
			$qur = "insert into valuation values('$t_1_1','$t_2_1','$t_2_2','$E1id','$retA','$t_3_1','$t_3_2','$E2id','$retB','$t_4_1','$t_4_2','$E3id','$retC')";
			$res = mysql_query($qur);
			echo "<table class=\"maintable\">
					<tr><td class=\"left\">";
			if($res)
			{
				echo "Details of Valuation Successfuly Enterd into the Database";
			}
			else
			{
				echo "Failed to Enter Details of Valuation into the Database <br/> $qur";
			}
			echo "</td></tr>
				  </table>";
		}
	}
	
	elseif($evl == 1)
	{
/*
		if($_SESSION['userid'] != 'sjs@math')
		{
*/
			$errmsg = "";
			if(isset($_GET['ins']))
				$ins = $_GET['ins'];
			else
				$ins = 0;
			$add = 0;
			if($ins == 0)
			{
				echo "<table class=\"maintable\">
						<tr>
							<td class=\"left\" colspan=\"2\"><a href=\"valuation.php?evl=1&ins=2\">Generate Report</a> for the Student Details Entered</td>
						</tr>
						<tr>
							<td class=\"left\">Institution ID</td>
							<td class=\"right\">
								<input type=\"text\" name=\"t_0_1\" id=\"t_0_1\" size=\"5\" onkeyup=\"update(this.value)\"/>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name=\"cb\" id=\"cb\" onclick=\"update(document.getElementById('t_0_1').value);\">&nbsp;Enter Single Student Detail
							</td>
						</tr>
						<tr>
							<td class=\"left\"><b>ಕನ್ನಡದಲ್ಲಿ ಟಂಕಿಸಿ</b></td>
							<td class=\"right\"><input type=\"text\" name=\"t_0_0\" id=\"t_0_0\" size=\"40\"/></td>
						</tr>
					  </table>
					  <div class=\"help\" id=\"help\">
						<input type=\"radio\" id=\"k_t_help\" name=\"k_t_help\" onclick=\"show_kthelp()\" />&nbsp;&nbsp;ಕನ್ನಡ ಲಿಪ್ಯಂತರೀಕರಣ ಸಹಾಯ
					  </div>";
				echo "<div id=\"kt_help\" class=\"kt_help\">
						<div class=\"help_head\">
							ಲಿಪ್ಯಂತರ ಕೋಷ್ಟಕ
							<span class=\"right_span\"><input type=\"button\" value=\"X\" onclick=\"hide_kthelp()\" /></span>
						</div>
						<div class=\"kannada_help\">
							<table class=\"lipitable\">
								<tr> <td>a</td>	<td>A/aa</td>	<td>i</td>	<td>I/ee</td>	<td>u</td>	<td>U/oo</td>	<td>q</td>	<td>e</td>	<td>E</td>	<td>ai</td>	<td>o</td>	<td>O</td>	<td>au</td>	<td>aM</td>	<td>aH</td> </tr>
								<tr> <td>ಅ</td>	<td>ಆ</td>		<td>ಇ</td>	<td>ಈ</td>		<td>ಉ</td>	<td>ಊ</td>		<td>ಋ</td>	<td>ಎ</td>	<td>ಏ</td> <td>ಐ</td>	<td>ಒ</td>	<td>ಓ</td>	<td>ಔ</td>	<td>ಅಂ</td>	<td>ಅಃ </td> </tr>
							</table>
							<table class=\"lipitable\">
								<tr> <td>ka</td>	<td>Ka</td>	<td>ga</td>	<td>Ga</td>	<td>nGa</td>	</tr>
								<tr> <td>ಕ</td>		<td>ಖ</td>	<td>ಗ</td>	<td>ಘ</td>	<td>ಙ</td>		</tr>
								<tr> <td>ca</td>	<td>Ca</td>	<td>ja</td>	<td>Ja/jha</td>	<td>nY</td>	</tr>
								<tr> <td>ಚ</td>		<td>ಛ</td>	<td>ಜ</td>	<td>ಝ</td>		<td>ಞ</td>	</tr>
								<tr> <td>Ta</td>	<td>Tha</td>	<td>Da</td>	<td>Dha</td>	<td>Na</td>	</tr>
								<tr> <td>ಟ</td>		<td>ಠ</td>		<td>ಡ</td>	<td>ಢ</td>		<td>ಣ</td>	</tr>
								<tr> <td>ta</td>	<td>tha</td>	<td>da</td>	<td>dha</td>	<td>na</td>	</tr>
								<tr> <td>ತ</td>		<td>ಥ</td>		<td>ದ</td>	<td>ಧ</td>		<td>ನ</td>	</tr>
								<tr> <td>pa</td>	<td>Pa</td>		<td>ba</td>	<td>bha/Ba</td>	<td>ma</td>	</tr>
								<tr> <td>ಪ</td>		<td>ಫ</td>		<td>ಬ</td>	<td>ಭ</td>		<td>ಮ</td>	</tr>
							</table>
							<table class=\"lipitable\">
								<tr> <td>ya</td>	<td>ra</td>		<td>la</td>	<td>va/wa</td>	<td>sha</td>	<td>Sa</td>	<td>sa</td>	<td>ha</td>	<td>La</td>	</tr>
								<tr> <td>ಯ</td>	<td>ರ</td>		<td>ಲ</td>	<td>ವ</td>		<td>ಶ</td>		<td>ಷ</td>	<td>ಸ</td>	<td>ಹ</td>	<td>ಳ</td>	</tr>
							</table>
							<table class=\"lipitable\">
								<tr> <td>ka</td>	<td>kA</td>	<td>ki</td>	<td>kI</td>	<td>ku</td>	<td>kU</td>	<td>kq</td>	<td>ke</td>	<td>kE</td>	<td>kai</td>	<td>ko</td>	<td>kO</td>	<td>kau</td>	<td>kaM</td>	<td>kaH</td></tr>
								<tr> <td>ಕ</td>		<td>ಕಾ</td>	<td>ಕಿ</td>	<td>ಕೀ</td>	<td>ಕು</td>	<td>ಕೂ</td>	<td>ಕೃ</td>	<td>ಕೆ</td>	<td>ಕೇ</td>	<td>ಕೈ</td>		<td>ಕೊ</td>	<td>ಕೋ</td>	<td>ಕೌ</td>		<td>ಕಂ</td>		<td>ಕಃ</td> </tr>
							</table>
						</div>
					</div>
					<form action=\"valuation.php?evl=1&ins=1\" method=\"POST\">
						<div id=\"details\">
						</div>
					</form>";
			}
			elseif($ins == 1)
			{
				echo "<table class=\"maintable\">
						<tr><td class=\"left\" colspan=\"2\">";
				$err_flag = 1;
				$catA_flag = 1;
				$catB_flag = 1;
				$catC_flag = 1;
				
				$count = $_POST['count'];
				$count = preg_split("/;/",$count);
				if(sizeof($count) > 3)
				{
					$update = 1;
					$ct_A = $count[0];
					$ct_B = $count[1];
				}
				else
					$update = 0;
				//print_r($count);
				$schoolid = $_POST['t_1_1'];
				$schoolname = $_POST['t_1_2'];
				$schoolname_eg = $_POST['t0_1_2'];
				
				if($update)
					$qur = "update institution_kan set name='$schoolname',name_eg='$schoolname_eg' where institution_id='$schoolid'";
				else
					$qur = "insert into institution_kan values('$schoolid','$schoolname','$schoolname_eg','$date')";
				$res = mysql_query($qur);
				if(!$res)
				{
					if($update)
						"Updation Failed for Query : $qur <br/>";
					else
						"Insertion Failed for Query : $qur <br/>";
					$err_flag = 0;
				}
				for($i=0;$i<$count[0];$i++)
				{
					$j = $i + 1;
					$t0_2_1 = "t" . $j . "_2_1";
					$t0_2_2 = "t" . $j . "_2_2";
					$t0_2_3 = "t" . $j . "_2_3";
					$t0_2_4 = "t" . $j . "_2_4";
					$inp_1 = "inp1" . $j;
					$t_2_1 = $_POST[$t0_2_1];
					$t_2_2 = $_POST[$t0_2_2];
					$inp1 = $_POST[$inp_1];
					$t_2_3 = $_POST[$t0_2_3];
					$t_2_4 = $_POST[$t0_2_4];
					if(($t_2_2 != "") && ($t_2_4 != ""))
					{
						if($update && ($count[3 + $i] != ''))
						{
							$id = $count[3 + $i];
							$qur = "update student set t_1_1='$t_2_1',t_1_2='$t_2_2',t_1_2_eg='$inp1',t_1_3='$t_2_3',t_1_4='$t_2_4' where student_id='$id'";
							//echo '<br/>' . $qur . '<br/>';
						}
						else
						{
							$qur = "select count(*) as cnt from student";
							$res = mysql_query($qur);
							$cnt = mysql_result($res,0) + 1;
							$id = "S" . str_pad(($cnt),5,"0",STR_PAD_LEFT);
							$qur = "insert into student values('$id','$schoolid','$t_2_1','$t_2_2','$inp1','$t_2_3','$t_2_4')";
						}
						$res = mysql_query($qur);
						if(!$res)
						{
							if($update)
								"Updation Failed for Query : $qur <br/>";
							else
								"Insertion Failed for Query : $qur <br/>";
							$err_flag = 0;
						}
					}
					else
						$catA_flag = 0;
				}
				for($i=0;$i<$count[1];$i++)
				{
					$j = $i + 1;
					$t0_3_1 = "t" . $j . "_3_1";
					$t0_3_2 = "t" . $j . "_3_2";
					$t0_3_3 = "t" . $j . "_3_3";
					$t0_3_4 = "t" . $j . "_3_4";
					$inp_3 = "inp3" . $j;
					$t_3_1 = $_POST[$t0_3_1];
					$t_3_2 = $_POST[$t0_3_2];
					$inp3 = $_POST[$inp_3];
					$t_3_3 = $_POST[$t0_3_3];
					$t_3_4 = $_POST[$t0_3_4];
					
					if(($t_3_2 != "") && ($t_3_4 != ""))
					{
						if($update && ($count[3 + $i + $ct_A] != ''))
						{
							$id = $count[3 + $i + $ct_A];
							$qur = "update student set t_1_1='$t_3_1',t_1_2='$t_3_2',t_1_2_eg='$inp3',t_1_3='$t_3_3',t_1_4='$t_3_4' where student_id='$id'";
							//echo '<br/>' . $qur . '<br/>';
						}
						else
						{
							$qur = "select count(*) as cnt from student";
							$res = mysql_query($qur);
							$cnt = mysql_result($res,0) + 1;
							$id = "S" . str_pad(($cnt),5,"0",STR_PAD_LEFT);
							$qur = "insert into student values('$id','$schoolid','$t_3_1','$t_3_2','$inp3','$t_3_3','$t_3_4')";
						}
						$res = mysql_query($qur);
						if(!$res)
						{
							if($update)
								"Updation Failed for Query : $qur <br/>";
							else
								"Insertion Failed for Query : $qur <br/>";
							$err_flag = 0;
						}
					}
					else
						$catB_flag = 0;
				}
				for($i=0;$i<$count[2];$i++)
				{
					$j = $i + 1;
					$t0_4_1 = "t" . $j . "_4_1";
					$t0_4_2 = "t" . $j . "_4_2";
					$t0_4_3 = "t" . $j . "_4_3";
					$t0_4_4 = "t" . $j . "_4_4";
					$inp_5 = "inp5" . $j;
					$t_4_1 = $_POST[$t0_4_1];
					$t_4_2 = $_POST[$t0_4_2];
					$inp5 = $_POST[$inp_5];
					$t_4_3 = $_POST[$t0_4_3];
					$t_4_4 = $_POST[$t0_4_4];
					
					if(($t_4_2 != "") && ($t_4_4 != ""))
					{
						if($update && ($count[3 + $i + $ct_A + $ct_B] != ''))
						{
							$id = $count[3 + $i + $ct_A + $ct_B];
							$qur = "update student set t_1_1='$t_4_1',t_1_2='$t_4_2',t_1_2_eg='$inp5',t_1_3='$t_4_3',t_1_4='$t_4_4' where student_id='$id'";
							//echo '<br/>' . $qur . '<br/>';
						}
						else
						{
							$qur = "select count(*) as cnt from student";
							$res = mysql_query($qur);
							$cnt = mysql_result($res,0) + 1;
							$id = "S" . str_pad(($cnt),5,"0",STR_PAD_LEFT);
							$qur = "insert into student values('$id','$schoolid','$t_4_1','$t_4_2','$inp5','$t_4_3','$t_4_4')";
						}
						$res = mysql_query($qur);
						if(!$res)
						{
							if($update)
								"Updation Failed for Query : $qur <br/>";
							else
								"Insertion Failed for Query : $qur <br/>";
							$err_flag = 0;
						}
					}
					else
						$catC_flag = 0;
				}
				if($count[0])
				{
					$qur = "update valuation set aret='1' where institutionid='$schoolid'";
					$res = mysql_query($qur);
					if(!$res)
						"Updation of valuation table Failed for Query : $qur <br/>";
				}
				if($count[1])
				{
					$qur = "update valuation set bret='1' where institutionid='$schoolid'";
					$res = mysql_query($qur);
					if(!$res)
						"Updation of valuation table Failed for Query : $qur <br/>";
				}
				if($count[2])
				{
					$qur = "update valuation set cret='1' where institutionid='$schoolid'";
					$res = mysql_query($qur);
					if(!$res)
						"Updation of valuation table Failed for Query : $qur <br/>";
				}
				if($err_flag == 1)
				{
					if($update)
						echo "Student Details Successfully Updated into the Database<br/>";
					else
						echo "Student Details Successfully Inserted into the Database<br/>";
					echo "To Enter or Update Other Student Details <a href=\"valuation.php?evl=1\">click here</a>";
				}
				echo "</td></tr>
					  </table>";
			}
			elseif($ins == 2)
			{
				echo "<table class=\"maintable\">
						  <tr>
							  <td class=\"left\" colspan=\"2\">Select Student Details(Based on Date on which Student Details Entered) to Generate Report </td>
						  </tr>
					  </table>
				<table class=\"updatetable\">
					<tr>
						<td style=\"width:7%\">Sl. No.</td>
						<td style=\"width:8%\">Select</td>
						<td style=\"width:13%\">Date of Entry</td>
						<td style=\"width:50%\">List of Institution IDs</td>
						<td style=\"width:22%\" colspan=\"2\">Generate</td>
					</tr>";
				$qur = "select distinct date from institution_kan order by date";
				$res = mysql_query($qur);
				$num_Of_date = mysql_num_rows($res);
				for($i=0;$i<$num_Of_date;$i++)
				{
					$dat = mysql_result($res,$i);
					$j = $i + 1;
					echo "<tr>
							<td>$j.</td>
							<td><input type=\"checkbox\" name=\"cb$j\"/></td>
							<td>$dat</td>";
					$qur1 = "select institution_id from institution_kan where date='$dat'";
					$res1 = mysql_query($qur1);
					$num_Of_insti = mysql_num_rows($res1);
					$id = mysql_result($res1,0);
					for($k=1;$k<$num_Of_insti;$k++)
					{
						$id = $id . ", " . mysql_result($res1,$k);
					}
						echo"<td >$id</td>
							<td style=\"width:11%\"><a href=\"student_details.php?date=$dat\" target=\"_blank\">Report</a></td>
							<td style=\"width:11%\" ><a href=\"certificate.php?date=$dat\" target=\"_blank\">Certificate</a></td>
						</tr>";
				}
				echo "</table>";
			}
/*
		}
*/
	}
	
	elseif($evl == 2)
	{
/*
		if($_SESSION['userid'] != 'sjs@math')
		{
*/
			echo "<form action=\"valuation.php?evl=3\" method=\"POST\">
					<table class=\"maintable\">
						<tr>
							<td colspan=\"2\" class=\"left\">Enter Evaluator Details</td>
						</tr>
						<tr>
							<td class=\"left\">Category</td>
							<td class=\"right\">
								<input type=\"checkbox\" name=\"t1_1_1\" id=\"t1_1_1\" value=\"E1\"/>&nbsp;E1&nbsp;&nbsp;&nbsp;
								<input type=\"checkbox\" name=\"t2_1_1\" id=\"t2_1_1\" value=\"E2\"/>&nbsp;E2&nbsp;&nbsp;&nbsp;
								<input type=\"checkbox\" name=\"t3_1_1\" id=\"t3_1_1\" value=\"E3\"/>&nbsp;E3
							</td>
						</tr>
						<tr>
							<td class=\"left\">Name</td>
							<td class=\"right\"><input type=\"text\" name=\"t_2_1\" id=\"t_2_1\" size=\"38\"/></td>
						</tr>
						<tr>
							<td class=\"left\">Age</td>
							<td class=\"right\"><input type=\"text\" name=\"t_3_1\" id=\"t_3_1\" size=\"38\"/></td>
						</tr>
						<tr>
							<td class=\"left\">Address</td>
							<td class=\"right\"><textarea type=\"text\" name=\"t_4_1\" id=\"t_4_1\" rows=\"3\" cols=\"36\"></textarea></td>
						</tr>
						<tr>
							<td class=\"left\">Contact Number</td>
							<td class=\"right\"><input type=\"text\" name=\"t_5_1\" id=\"t_5_1\" size=\"38\"/></td>
						</tr>
						<tr>
							<td class=\"left\">Email ID</td>
							<td class=\"right\"><input type=\"text\" name=\"t_6_1\" id=\"t_6_1\" size=\"38\"/></td>
						</tr>
						<tr>
							<td class=\"left\" colspan=\"2\"><input type=\"submit\" value=\"Submit\"></td>
						</tr>
					</table>
				 </form>";
/*
			}
*/
	}
	elseif($evl == 3)
	{
/*
		if($_SESSION['userid'] != 'sjs@math')
		{
*/
			$cat = "";
			if(isset($_POST['t1_1_1']))
				$t_1_1 = 1;
			else
				$t_1_1 = 0;
			if(isset($_POST['t2_1_1']))
				$t_1_2 = 1;
			else
				$t_1_2 = 0;
			if(isset($_POST['t3_1_1']))
				$t_1_3 = 1;
			else
				$t_1_3 = 0;
			$t_2_1 = $_POST['t_2_1'];
			$t_3_1 = $_POST['t_3_1'];
			$t_4_1 = $_POST['t_4_1'];
			$t_5_1 = $_POST['t_5_1'];
			$t_6_1 = $_POST['t_6_1'];
		
			$t_4_1 = preg_replace("/\'/","\&apos;",$t_4_1);
		
			$qur = "select count(*) from evaluator";
			$res = mysql_query($qur);
			$row = mysql_fetch_assoc($res);
			$no = $row['count(*)'];
				
			$evaluatorID = "E" . str_pad(($no+1),4,"0",STR_PAD_LEFT);
			$qur = "insert into evaluator values('$evaluatorID','$t_1_1','$t_1_2','$t_1_3','$t_2_1','$t_3_1','$t_4_1','$t_5_1','$t_6_1')";
			$res = mysql_query($qur);
			
			echo "<table class=\"maintable\">";
			if($res)
			{
				echo "<tr>
						<td class=\"left\">Details of Agent Successfuly Enterd into the Database</td>
					  </tr>";
			}
			else
			{
				echo "<tr>
						<td class=\"left\">Failed to enter Details of Agent into the Database <br/> $qur</td>
					  </tr>";
			}
			echo "</table>";
/*
		}
*/
	}
/*
}
*/
	
echo "</div>
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

</html>
";
?>
