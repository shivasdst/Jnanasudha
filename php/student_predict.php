<?php

function first_pu()
{
	$opt = "<option></option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			<option selected=\"selected\">1ನೇ ಪಿ.ಯು.ಸಿ</option>
			<option>2ನೇ ಪಿ.ಯು.ಸಿ</option>
			<option>11</option>
			<option>12</option>";
	return $opt;
}

function second_pu()
{
	$opt = "<option></option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			<option>1ನೇ ಪಿ.ಯು.ಸಿ</option>
			<option selected=\"selected\">2ನೇ ಪಿ.ಯು.ಸಿ</option>
			<option>11</option>
			<option>12</option>";
	return $opt;
}

$ans_no = $_GET['ansno'];
if(isset($_GET['single']))
	$single = $_GET['single'];
else
	$single = 0;
include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

//~ if(($ans_no[0] == 'a') || ($ans_no[0] == 'A'))
//~ {
	//~ if($ans_no[0] == 'A')
		//~ $ans_no[0] = 'a';
	//~ $qur = "select schoolid from cata where no='$ans_no'";
//~ }
//~ if(($ans_no[0] == 'b') || ($ans_no[0] == 'B'))
//~ {
	//~ if($ans_no[0] == 'B')
		//~ $ans_no[0] = 'b';
	//~ $qur = "select schoolid from catb where no='$ans_no'";
//~ }
//~ if(($ans_no[0] == 'c') || ($ans_no[0] == 'C'))
//~ {
	//~ if($ans_no[0] == 'C')
		//~ $ans_no[0] = 'c';
	//~ $qur = "select schoolid from catc where no='$ans_no'";
//~ }
//~ $res = mysql_query($qur);
//~ $schoolid = mysql_result($res,0);
$schoolid = $ans_no;

$qur = "select * from valuation where institutionid='$schoolid'";
$res = mysql_query($qur);
if(!mysql_num_rows($res))
{
	return;
}
$cata_no = mysql_result($res,0,'cat5a');
$catb_no = mysql_result($res,0,'cat5b');
$catc_no = mysql_result($res,0,'cat5c');
$ecid = mysql_result($res,0,'ecid');
if(($cata_no != 0) || ($catb_no != 0) || ($catc_no != 0))
{
	$k = 0;
	$ecid = mysql_result($res,0,'ecid');
	if($ecid == "")
		$catc_no = 0;
	
	$qur = "select * from institution where institution_id='$schoolid'";
	$res = mysql_query($qur);
	$schoolname = mysql_result($res,0,'institute');
	$schooladd = mysql_result($res,0,'address') . ", " . mysql_result($res,0,'taluk') . " Taluk";
	
	$t_1_2 = '';
	$t0_1_2 = '';
	$t_1_3 = '';
	$t0_1_3 = '';
	$qur4 = "select * from institution_kan where institution_id='$schoolid'";
	$res4 = mysql_query($qur4);
	if(mysql_num_rows($res4))
	{
		$t_1_2 = mysql_result($res4,0,'name');
		$t0_1_2 = mysql_result($res4,0,'name_eg');
		$update = 1;
		$ids = "";
	}
	else
		$update = 0;
	
	echo "
		<table class=\"maintable\">
		 <tr>
			<td class=\"left\" colspan=\"2\">School Details</td>
		 </tr>
		 <tr>
			<td class=\"left\">Institution ID</td>
			<td class=\"right\"><input type=\"text\" name=\"t_1_1\" value=\"$schoolid\" readonly=\"readonly\" size=\"10\"/></td>
		 </tr>
		 <tr>
			<td class=\"left\">Institution Name</td>
			<td class=\"right\"><input type=\"text\" name=\"t_0_2\" value=\"$schoolname\" size=\"40\" /></td>
		 </tr>
		 <tr>
			<td class=\"left\">Address</td>
			<td class=\"right\"><textarea name=\"t_0_3\"  rows=\"3\" cols=\"36\">$schooladd</textarea></td>
		 </tr>
		 
		 <tr>
			<td class=\"left\"><b>ವಿದ್ಯಾಸಂಸ್ಥೆಯ ಹೆಸರು ಮತ್ತು ಸ್ಥಳ</b></td>
			<td class=\"right\"><input type=\"text\" name=\"t_1_2\" id=\"t_1_2\" size=\"40\" value=\"$t_1_2\" onfocus=\"document.getElementById('t0_1_2').type='text'; document.getElementById('t0_1_2').focus();\" />
				<div id=\"data\"><input type=\"hidden\" name=\"t0_1_2\" id=\"t0_1_2\" size=\"40\" value=\"$t0_1_2\" onkeyup=\"javascript:print_many_words('t0_1_2','t_1_2')\" onblur=\"document.getElementById('t0_1_2').type='hidden';\" onclick=\"if(mouseout) document.getElementById('t0_1_2').type='hidden';\" /></div>
			</td>
		 </tr>
	</table><br/>";
	echo "<table class=\"updatetable\">";
	
	if($single)
	{
		$cata_no = 1;
		$catb_no = 0;
		$catc_no = 0;
		if($update)
		{
			$qur1 = "select * from student where institution_id='$schoolid' and t_1_1='$ans_no'";
			$res1 = mysql_query($qur1);
			if(mysql_num_rows($res1))
			{
				$ids = ";" . mysql_result($res1,0,'student_id');
				$ans_paper_no = $ans_no;
				$stud_name = mysql_result($res1,0,'t_1_2');
				$stud_name_eg = mysql_result($res1,0,'t_1_2_eg');
				$clas = mysql_result($res1,0,'t_1_3');
				$stud_address = mysql_result($res1,0,'t_1_4');
			}
			else
			{
				$ids = ";";
				$ans_paper_no = $ans_no;
				$stud_name = '';
				$stud_name_eg = '';
				$clas = '';
				$stud_address = '';
			}
		}
		else
		{
			$ans_paper_no = $ans_no;
			$stud_name = '';
			$stud_name_eg = '';
			$clas = '';
			$stud_address = '';
		}
		echo "<tr>
				<td colspan=\"5\">Student Details</td>
			  </tr>
			  <tr>
				<td style=\"width: 5%\">Sl. No.</td>
				<td style=\"width: 8%\">Answer Paper No.</td>
				<td style=\"width: 16%\"><b>ವಿದ್ಯಾರ್ಥಿಯ ಹೆಸರು</b></td>
				<td style=\"width: 8%\"><b>ತರಗತಿ</b></td>
				<td style=\"width: 65%\">Address</td>
			  </tr>
			  <tr>
				<td>1</td>
				<td> <input type=\"text\" name=\"t1_2_1\" id=\"t1_2_1\" size=\"5\" maxlength=\"6\" value=\"$ans_paper_no\" /></td>
				<td> <input  type=\"text\" name=\"t1_2_2\" id=\"t1_2_2\" size=\"14\" value = \"$stud_name\" onfocus=\"document.getElementById('inp11').type='text'; document.getElementById('inp11').focus();\" />
					<div id=\"data\"><input type=\"hidden\" name=\"inp11\" id=\"inp11\" size=\"14\" value = \"$stud_name_eg\" onkeyup=\"javascript:print_many_words('inp11','t1_2_2')\" onblur=\"document.getElementById('inp11').type='hidden';\" onclick=\"if(mouseout) document.getElementById('inp11').type='hidden';\" /></div>
				</td>
				<td> <select name=\"t1_2_3\" id=\"t1_2_3\" style=\"width:58px; height:20px\">";
				
				$subject = "<option></option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>1ನೇ ಪಿ.ಯು.ಸಿ</option>
						<option>2ನೇ ಪಿ.ಯು.ಸಿ</option>
						<option>11</option>
						<option>12</option>";
				$selection = "/<option>$clas<\/option>/";
				$replacement = "<option selected=\"selected\">$clas</option>";
				$final = preg_replace($selection,$replacement,$subject);
				if($clas == "1ನೇ ಪಿ.ಯು.ಸಿ")
					$final = first_pu();
				if($clas == "2ನೇ ಪಿ.ಯು.ಸಿ")
					$final = second_pu();
				echo $final;
				echo "</select>
				</td>
				<td> <input  type=\"text\" name=\"t1_2_4\" id=\"t1_2_4\" size=\"65\" value=\"$stud_address\"/></td>
			  </tr>";
	}
	else
	{
		if($update)
		{
			$qur1 = "select * from student where institution_id='$schoolid' and t_1_1 like 'a%'";
			$res1 = mysql_query($qur1);
			$num_A = mysql_num_rows($res1);
			$cata_no = $num_A;
		}
		if($cata_no != 0)
		{
			echo "<tr>
					<td colspan=\"5\">Category A Students Details</td>
				  </tr>
				  <tr>
					<td style=\"width: 5%\">Sl. No.</td>
					<td style=\"width: 8%\">Answer Paper No.</td>
					<td style=\"width: 16%\"><b>ವಿದ್ಯಾರ್ಥಿಯ ಹೆಸರು</b></td>
					<td style=\"width: 8%\"><b>ತರಗತಿ</b></td>
					<td style=\"width: 65%\">Address</td>
				  </tr>";
			for($i=0;$i<$cata_no;$i++)
			{
				$j = $i + 1;
				$id1 = "t" . $j . "_2_2";
				$ans_paper_no = 'a';
				$stud_name = '';
				$stud_name_eg = '';
				$stud_address = '';
				$clas = '';
				if($update)
				{
					$ids = $ids . ";" . mysql_result($res1,$i,'student_id');
					$ans_paper_no = mysql_result($res1,$i,'t_1_1');
					$stud_name = mysql_result($res1,$i,'t_1_2');
					$stud_name_eg = mysql_result($res1,$i,'t_1_2_eg');
					$clas = mysql_result($res1,$i,'t_1_3');
					$stud_address = mysql_result($res1,$i,'t_1_4');
				}
				
				echo "<tr>
					<td>" . $j . "</td>
					<td> <input type=\"text\" name=\"t" . $j . "_2_1\" id=\"t" . $j . "_2_1\" size=\"5\" maxlength=\"6\" value=\"$ans_paper_no\" /></td>
					<td> <input  type=\"text\" name=\"t" . $j . "_2_2\" id=\"t" . $j . "_2_2\" size=\"14\" value = \"$stud_name\" onfocus=\"document.getElementById('inp1$j').type='text'; document.getElementById('inp1$j').focus();\" />
						<div id=\"data\"><input type=\"hidden\" name=\"inp1$j\" id=\"inp1$j\" size=\"14\" value = \"$stud_name_eg\" onkeyup=\"javascript:print_many_words('inp1$j','$id1')\" onblur=\"document.getElementById('inp1$j').type='hidden';\" onclick=\"if(mouseout) document.getElementById('inp1$j').type='hidden';\" /></div>
					</td>
					<td> <select name=\"t" . $j . "_2_3\" id=\"t" . $j . "_2_3\" style=\"width:58px; height:20px\">";
						$subject = "<option></option>
									<option>7</option>
									<option>8</option>
									<option>9</option>";
				$selection = "/<option>$clas<\/option>/";
				$replacement = "<option selected=\"selected\">$clas</option>";
				$final = preg_replace($selection,$replacement,$subject);
				echo $final;
				echo "</select>
					</td>
					<td> <input  type=\"text\" name=\"t" . $j . "_2_4\" id=\"t" . $j . "_2_4\" size=\"65\" value=\"$stud_address\"/></td>
					</tr>";
			}
		}
		if($update)
		{
			$qur2 = "select * from student where institution_id='$schoolid' and t_1_1 like 'b%'";
			$res2 = mysql_query($qur2);
			$num_B = mysql_num_rows($res2);
			$catb_no = $num_B;
		}
		if($catb_no != 0)
		{
			echo "<tr>
					<td colspan=\"5\">Category B Students Details</td>
				  </tr>
				  <tr>
					<td style=\"width: 5%\">Sl. No.</td>
					<td style=\"width: 8%\">Answer Paper No.</td>
					<td style=\"width: 16%\"><b>ವಿದ್ಯಾರ್ಥಿಯ ಹೆಸರು</b></td>
					<td style=\"width: 8%\"><b>ತರಗತಿ</b></td>
					<td style=\"width: 65%\">Address</td>
				  </tr>";
			for($i=0;$i<$catb_no;$i++)
			{
				$j = $i + 1;
				$id1 = "t" . $j . "_3_2";
				$ans_paper_no = 'b';
				$stud_name = '';
				$stud_name_eg = '';
				$stud_address = '';
				$clas = '';
				if($update)
				{
					$ids = $ids . ";" . mysql_result($res2,$i,'student_id');
					$ans_paper_no = mysql_result($res2,$i,'t_1_1');
					$stud_name = mysql_result($res2,$i,'t_1_2');
					$stud_name_eg = mysql_result($res2,$i,'t_1_2_eg');
					$clas = mysql_result($res2,$i,'t_1_3');
					$stud_address = mysql_result($res2,$i,'t_1_4');
				}
				
				echo "<tr>
					<td>" . $j . "</td>
					<td> <input type=\"text\" name=\"t" . $j . "_3_1\" id=\"t" . $j . "_3_1\"  size=\"5\" maxlength=\"6\" value=\"$ans_paper_no\" /></td>
					<td> <input  type=\"text\" name=\"t" . $j . "_3_2\" id=\"t" . $j . "_3_2\" size=\"14\" value=\"$stud_name\" onfocus=\"document.getElementById('inp3$j').type='text';  document.getElementById('inp3$j').focus();\" />
						<div id=\"data\"><input type=\"hidden\" name=\"inp3$j\" id=\"inp3$j\" size=\"14\" value=\"$stud_name_eg\" onkeyup=\"javascript:print_many_words('inp3$j','$id1')\" onblur=\"document.getElementById('inp3$j').type='hidden';\" onclick=\"if(mouseout) document.getElementById('inp3$j').type='hidden';\" /></div>
					</td>
					<td> <select name=\"t" . $j . "_3_3\" id=\"t" . $j . "_3_3\" style=\"width:58px; height:20px\">";
					
				$subject = "<option></option>
							<option>10</option>
							<option>1ನೇ ಪಿ.ಯು.ಸಿ</option>
							<option>2ನೇ ಪಿ.ಯು.ಸಿ</option>
							<option>11</option>
							<option>12</option>";
				$selection = "/<option>$clas<\/option>/";
				$replacement = "<option selected=\"selected\">$clas</option>";
				$final = preg_replace($selection,$replacement,$subject);
				if($clas == "1ನೇ ಪಿ.ಯು.ಸಿ")
					$final = first_pu();
				if($clas == "2ನೇ ಪಿ.ಯು.ಸಿ")
					$final = second_pu();
				echo $final;
					echo "</select>
					</td>
					<td> <input  type=\"text\" name=\"t" . $j . "_3_4\" id=\"t" . $j . "_3_4\"  size=\"65\" value=\"$stud_address\" /></td>
					</tr>";
			}
		}
		if($update)
		{
			$qur3 = "select * from student where institution_id='$schoolid' and t_1_1 like 'c%'";
			$res3 = mysql_query($qur3);
			$num_C = mysql_num_rows($res3);
			$catc_no = $num_C;
		}
		if($catc_no != 0)
		{
			echo "<tr>
					<td colspan=\"5\">Category C Students Details</td>
				  </tr>
				  <tr>
					<td style=\"width: 5%\">Sl. No.</td>
					<td style=\"width: 8%\">Answer Paper No.</td>
					<td style=\"width: 16%\"><b>ವಿದ್ಯಾರ್ಥಿಯ ಹೆಸರು</b></td>
					<td style=\"width: 8%\"><b>ತರಗತಿ</b></td>
					<td style=\"width: 65%\">Address</td>
				  </tr>";
			for($i=0;$i<$catc_no;$i++)
			{
				$j = $i + 1;
				$id1 = "t" . $j . "_4_2";
				$id2 = "t" . $j . "_4_3";
				
				$ans_paper_no = 'c';
				$stud_name = '';
				$stud_name_eg = '';
				$stud_address = '';
				if($update)
				{
					$ids = $ids . ";" . mysql_result($res3,$i,'student_id');
					$ans_paper_no = mysql_result($res3,$i,'t_1_1');
					$stud_name = mysql_result($res3,$i,'t_1_2');
					$stud_name_eg = mysql_result($res3,$i,'t_1_2_eg');
					$stud_address = mysql_result($res3,$i,'t_1_4');
				}
				echo "<tr>
					<td>" . $j . "</td>
					<td> <input type=\"text\" name=\"t" . $j . "_4_1\" id=\"t" . $j . "_4_1\" size=\"5\" maxlength=\"6\" value=\"$ans_paper_no\" /></td>
					<td> <input  type=\"text\" name=\"t" . $j . "_4_2\" id=\"t" . $j . "_4_2\" size=\"14\" value=\"$stud_name\" onfocus=\"document.getElementById('inp5$j').type='text';document.getElementById('inp5$j').focus(); document.getElementById('inp5$j').focus();\" />
						<div id=\"data\"><input type=\"hidden\" name=\"inp5$j\" id=\"inp5$j\" size=\"14\" value=\"$stud_name_eg\" onkeyup=\"javascript:print_many_words('inp5$j','$id1')\" onblur=\"document.getElementById('inp5$j').type='hidden';\" onclick=\"if(mouseout) document.getElementById('inp5$j').type='hidden';\" /></div>
					</td>
					<td> <select name=\"t" . $j . "_4_3\" id=\"t" . $j . "_4_3\" style=\"width:58px; height:20px\">
							<option></option>
						 </select>
					</td>
					<td> <input  type=\"text\" name=\"t" . $j . "_4_4\" id=\"t" . $j . "_4_4\" size=\"65\" value=\"$stud_address\" /></td>
					</tr>";
			}
		}
	}
	echo "</table>
		<br/>
		<table class=\"maintable\">
		  <tr>
			<td><input type=\"hidden\" name=\"count\"";
			if($update)
				echo "value=\"$cata_no;$catb_no;$catc_no" . "$ids\"";
			
			else
				echo "value=\"$cata_no;$catb_no;$catc_no\"";
			echo "\></td>
		  </tr>
		  <tr>
			<td class=\"left\" colspan=\"2\">
				<input type=\"submit\" value=\"submit\"/>
			</td>
		  </tr>
		</table>";
}
?>
