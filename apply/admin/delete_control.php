<?php 
include("include/db_config.php");
if($_REQUEST['id'])
{
	$id = $_REQUEST['id'];
	$delete = mysql_query("DELETE FROM `app_form` WHERE id = '$id'");
	echo 'Application Has Been Deleted';
}

?>