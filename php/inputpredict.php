<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$schoolid=$_GET['id'];

$q = "select * from institution where institution_id='".$schoolid."'";
$res = mysql_query($q);
$num_rows = mysql_num_rows($res);
if($num_rows == 0)
	echo "1|||||||";
else
{
	$row=mysql_fetch_assoc($res);
	
	$institute = $row['institute'];
	$address = $row['address'];
	$taluk = $row['taluk'];
	$district = $row['district'];
	$pin = $row['pin'];
	$cperson = $row['cperson'];
	$phone = $row['phone'];
	$email = $row['email'];
	$institution_id = $row['institution_id'];
	
	echo $institute . "|" . $address . "|" . $taluk . "|" . $district . "|" . $pin . "|" . $cperson . "|" . $phone . "|" . $email;
}
?>
