<?php

session_start();

include("connect.php");

$userid = $_SESSION['userid'];

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query02 = "update login set status='0' where userid='".$userid."'";
$result02 = mysql_query($query02);

session_destroy();

@header('Location: login.php');

?>
