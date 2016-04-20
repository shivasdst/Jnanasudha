<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to Databse");
$rs = mysql_select_db($database,$db) or die("No Database");

$id = $_GET['no'];
$res = mysql_query("select t_2_1, t_2_2, t_2_3 from payment where schoolid='$id'");
$num = mysql_num_rows($res);
if($num)
{
	$row = mysql_fetch_assoc($res);
	$t_2_1 = $row['t_2_1'];
	$t_2_1 = preg_split("/;/",$t_2_1);
	$t_2_1 = array_sum($t_2_1);
	$t_2_2 = $row['t_2_2'];
	$t_2_2 = preg_split("/;/",$t_2_2);
	$t_2_2 = array_sum($t_2_2);
	$t_2_3 = $row['t_2_3'];
	$t_2_3 = preg_split("/;/",$t_2_3);
	$t_2_3 = array_sum($t_2_3);
	echo $id . "|" . $t_2_1 . "|" . $t_2_2 . "|" . $t_2_3;
}
else
	echo "|||";
?>
