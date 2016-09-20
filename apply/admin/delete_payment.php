<?php
include("include/db_config.php");
include("include/session_timeout.php");


if($_GET['pid'])
{
	$pid = $_GET['pid'];
	$delete_query = mysql_query("DELETE FROM `payment_recieved` WHERE `payment_id` = '$pid'");
	if($delete_query)
	{
		header("Location:payin_info.php?action= DELETED Successfully");
	}
}

if($_GET['id'])
{
	$id = $_GET['id'];
	$delete_query = mysql_query("DELETE FROM `occ_registrant` WHERE `Id` = '$id'");
	if($delete_query)
	{
		header("Location:colts_info.php?action= DELETED Successfully");
	}
}
