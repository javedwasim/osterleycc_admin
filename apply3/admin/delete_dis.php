<?php
include("include/db_config.php");
include("include/session_timeout.php");
if($_REQUEST['Id'])
{
	$disId = $_REQUEST['Id'];
	$dll = mysql_query("delete from `discounted_amount` where `Id` = '$disId'");
	echo "Discount Code Has Been Deleted!";
}


?>

