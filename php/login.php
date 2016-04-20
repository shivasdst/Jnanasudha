<?php

session_start();

include("connect.php");
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>JnanaSudha</title>
<link href=\"style/reset.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/indexstyle.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/reset.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"style/indexstyle.css\" media=\"print\" rel=\"stylesheet\" type=\"text/css\" />
</head>";
echo "<body>
<div class=\"page\">
	<div class=\"header\">
		<div class=\"title\">JnanaSudha</div>
		<div class=\"nav\">
			<ul>
				<li><a href=\"../index.php\">Home</a></li>
				<li><a class=\"active\" href=\"login.php\">Login</a></li>
				<li><a href=\"schools.php?ed=0&ud=0\">Schools</a></li>
				<li><a href=\"despatch.php?ud=0\">Despatch</a></li>
				<li><a href=\"edit.php\">Edit</a></li>
				<li><a href=\"status.php\">Status</a></li>
				<li><a href=\"valuation.php\">Valuation</a></li>
				<li><a href=\"logout.php\">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class=\"mainpage\">";
if(isset($_SESSION['valid']))
{
	echo "<table class=\"maintable\">
			<tr>
				<td class=\"right\" colspan=\"2\">You are already logged in as ".$_SESSION['userid']."</td>
			</tr>
		</table>";
}
elseif(isset($_POST['p_1']) && isset($_POST['p_2']))
{
	$userid = $_POST['p_1'];
	$pwd = $_POST['p_2'];
	
	$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");

	$query = "select count(*) from login where userid='".$userid."' and password='".$pwd."'";

	$result = mysql_query($query);

	$row=mysql_fetch_assoc($result);
	$num=$row['count(*)'];

	if($num > 0)
	{
		$_SESSION['userid'] = $userid;
		$_SESSION['pwd'] = $pwd;
		$_SESSION['valid'] = 1;
		
		$query02 = "update login set status='1' where userid='".$userid."'";
		$result02 = mysql_query($query02);
		echo"<table class=\"maintable\">
				<tr>
					<td class=\"right\" colspan=\"2\">You have sucessfully logged in as ".$_SESSION['userid']."</td>
				</tr>
			</table>";
	}
	else
	{
		echo "<form method=\"POST\" action=\"login.php\">
				<table class=\"maintable\">
					<tr>
						<td class=\"right\" colspan=\"2\" style=\"color: #FF0000;\">Invlalid User ID or Password</td>
					</tr>
					<tr>
						<td class=\"left\">User ID - Error</td>
						<td class=\"right\"><input name=\"p_1\" type=\"text\" id=\"p_1\" size=\"25\" value=\"\"/></td>
					</tr>
					<tr>
						<td class=\"left\">Password</td>
						<td class=\"right\"><input name=\"p_2\" type=\"password\" id=\"p_2\" size=\"25\"/></td>
					</tr>
					<tr>
						<td></td>
						<td class=\"right\">
							<input name=\"t_13_1\" type=\"submit\" class=\"sub_button\" id=\"t_13_1\" value=\"Submit\"/>
							<input name=\"t_13_2\" type=\"reset\" class=\"sub_button\" id=\"t_13_2\" value=\"Reset\"/>
						</td>
					</tr>
				</table>
			</form>";
	}
}
else
{
	echo "<form method=\"POST\" action=\"login.php\">
			<table class=\"maintable\">
				<tr>
					<td class=\"left\">User ID</td>
					<td class=\"right\"><input name=\"p_1\" type=\"text\" id=\"p_1\" size=\"25\" value=\"\"/></td>
				</tr>
				<tr>
					<td class=\"left\">Password</td>
					<td class=\"right\"><input name=\"p_2\" type=\"password\" id=\"p_2\" size=\"25\"/></td>
				</tr>
				<tr>
					<td></td>
					<td class=\"right\">
						<input name=\"t_13_1\" type=\"submit\" class=\"sub_button\" id=\"t_13_1\" value=\"Submit\"/>
						<input name=\"t_13_2\" type=\"reset\" class=\"sub_button\" id=\"t_13_2\" value=\"Reset\"/>
					</td>
				</tr>
			</table>
		</form>";
}
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
