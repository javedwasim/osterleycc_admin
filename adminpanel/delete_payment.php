<?php
session_start();
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator'){redirect_to("home.php"); die(); }


if(isset($_GET['social_id']))
{
	$id = $_GET['social_id'];
	$delete_query = mysql_query("DELETE FROM `occ_registrant` WHERE `Id` = '$id'");
	if($delete_query)
	{
		$_SESSION['message'] = "Record Deleted Successfully!";
		header("Location:social_info.php");
	}
}

if($_GET['pid'])
{
	$pid = $_GET['pid'];
	$delete_query = mysql_query("DELETE FROM `payment_recieved` WHERE `payment_id` = '$pid'");
	if($delete_query)
	{
		$_SESSION['message'] = "Record Deleted Successfully!";
		header("Location:payin_info.php?action= DELETED Successfully");
	}
}

if($_GET['id'])
{
	$id = $_GET['id'];
	$delete_query = mysql_query("DELETE FROM `occ_registrant` WHERE `Id` = '$id'");
	if($delete_query)
	{
		$_SESSION['message'] = "Record Deleted Successfully!";
		header("Location:adutls_info.php");
	}
}


if($_GET['cid'])
{
	$id = $_GET['cid'];
	$delete_query = mysql_query("DELETE FROM `occ_registrant` WHERE `Id` = '$id'");
	if($delete_query)
	{
		$_SESSION['message'] = "Record Deleted Successfully!";
		header("Location:colts_info.php");
	}
}

