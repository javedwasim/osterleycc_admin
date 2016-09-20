<?php include("class/db_config.php");
if($_SESSION['sid'])
{
	$sid = $_SESSION['sid'];
	$totalprice	=  $_SESSION['total_price'];
	$date = date('m/d/Y h:i:s a', time());
	$insertQuery = mysql_query("INSERT INTO `payment_recieved` (`payment_id`, `uid`, `amount`, `description`, `note`, `status`, `method`, `date_created`, `date_recieved`, `source_type`) VALUES ('$pay','$sid','$totalprice','Annual subs','Customer request to pay in person','1','','$date','','2')");
	
		if($insertQuery)
		{
			header("Location:thankyou2.html");
			session_destroy();
			exit();
		}
		
}
else
		{
			header("Location:index.php");	
		}
?>