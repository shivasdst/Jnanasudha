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
</script>
</head>";

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
				<li><a href=\"edit.php\">Edit</a></li>
				<li><a class=\"active\" href=\"status.php\">Status</a></li>
				<li><a href=\"valuation.php\">Valuation</a></li>
				<li><a href=\"logout.php\">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class=\"mainpage\">";

if(isset($_SESSION['userid']))
{
	include('connect.php');
	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	
	$res1 = mysql_query("select * from cata where (schoolid not like 'AGT%') and (schoolid is not null)");
	$cat1 = mysql_num_rows($res1);
	$res2 = mysql_query("select * from catb where (schoolid not like 'AGT%') and (schoolid is not null)");
	$cat2 = mysql_num_rows($res2);
	$res3 = mysql_query("select * from catc where (schoolid not like 'AGT%') and (schoolid is not null)");
	$cat3 = mysql_num_rows($res3);
	
	$res4 = mysql_query("select schoolid, t_3_2 from payment");
	$tot = mysql_num_rows($res4);
	
	$total_am = 0;
	
	for($i1=0;$i1<$tot;$i1++)
	{
		$row4=mysql_fetch_assoc($res4);
		$am = $row4['t_3_2'];
		$am = preg_split("/;/", $am);
		for($j1=0;$j1<sizeof($am);$j1++)
		{
			$total_am = $total_am + intval($am[$j1]);
		}
	}
	
	$res6 = mysql_query("select t_3_2 from sjspayment where updation=0");
	
	for($i2=0;$i2<mysql_num_rows($res6);$i2++)
	{
		$row6=mysql_fetch_assoc($res6);
		$am = $row6['t_3_2'];
		$total_am = $total_am + intval($am);
	}
	
	$res5 = mysql_query("select distinct schoolid from sjspayment where updation=0");
	$tot = $tot + mysql_num_rows($res5);
	
	$today = getdate();
	$date = $today['mday'] . " " . $today['month'] . " " . $today['year'] . ", " . $today['hours'] . " Hrs " . $today['minutes'] . " mins";
	
	echo "<table class=\"maintable\">
		<tr>
			<td colspan=\"2\" class=\"left\">Current Status (as on $date)</td>
		</tr>
		<tr>
			<td class=\"left\">Total no. of Students and Teachers enrolled</td>
			<td class=\"right\"><input type=\"text\" value=\"".($cat1 + $cat2 + $cat3)."\" size=\"10\" readonly=\"readonly\" /></td>
		</tr>
		<tr>
			<td class=\"left\">Category A</td>
			<td class=\"right\"><input type=\"text\" value=\"$cat1\" size=\"10\" readonly=\"readonly\" /></td>
		</tr>
		<tr>
			<td class=\"left\">Category B</td>
			<td class=\"right\"><input type=\"text\" value=\"$cat2\" size=\"10\" readonly=\"readonly\" /></td>
		</tr>
		<tr>
			<td class=\"left\">Category C</td>
			<td class=\"right\"><input type=\"text\" value=\"$cat3\" size=\"10\" readonly=\"readonly\" /></td>
		</tr>
		<tr>
			<td class=\"left\">Total no. Schools Enrolled</td>
			<td class=\"right\"><input type=\"text\" value=\"$tot\" size=\"10\" readonly=\"readonly\" /></td>
		</tr>
		<tr>
			<td class=\"left\">Total amount collected</td>
			<td class=\"right\">Rs. <input type=\"text\" value=\"$total_am\" size=\"10\" readonly=\"readonly\" /></td>
		</tr>";
		
	$res1 = mysql_query("select * from cata where schoolid is null");
	$cat1 = mysql_num_rows($res1);
	$res2 = mysql_query("select * from catb where schoolid is null");
	$cat2 = mysql_num_rows($res2);
	$res3 = mysql_query("select * from catc where schoolid is null");
	$cat3 = mysql_num_rows($res3);
	
	echo "<tr>
			<td class=\"left\">Question Papers Remaining</td>
			<td class=\"right\">
				<br/>Category A: <input type=\"text\" value=\"$cat1\" size=\"10\" readonly=\"readonly\" /><br/><br/>
				Category B: <input type=\"text\" value=\"$cat2\" size=\"10\" readonly=\"readonly\" /><br/><br/>
				Category C: <input type=\"text\" value=\"$cat3\" size=\"10\" readonly=\"readonly\" /><br/><br/>
			</td>
		</tr>
	</table>";
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
