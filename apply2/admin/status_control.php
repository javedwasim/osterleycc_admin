<?php
include("include/db_config.php");
include("include/session_timeout.php");


$ID = $_GET['Id'];
if($ID)
{
		$q = mysql_query("SELECT status FROM `occ_registrant` WHERE `Id` = '$ID'");
		$row = mysql_fetch_array($q);
		$status = $row['status'];
	    if($status == 1)
		{
			$status = 2;
		}
		else
		{
			$status = 1;
		}
	$update_query = mysql_query("update `occ_registrant` set `status` ='$status' where `Id` = '$ID'");
		if($update_query)
		{
			echo $status;
		}
	
}

?>