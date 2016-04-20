<?php

include("connect.php");
$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$inst = $_GET['inst'];

$res = mysql_query("select count(*) from institution");
if($res)
{
	$row=mysql_fetch_assoc($res);
	$cnt = $row['count(*)'];

	$cnt = $cnt + 1;
	$newid = $inst . strval($cnt);
	echo $newid;
}
else
	echo "error";
return;
?>
