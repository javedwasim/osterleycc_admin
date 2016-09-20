<?php include("class/db_config.php");
if($_GET['custom'] && $_GET['amount'] && $_GET['currency_code'])
{
	$firstName = $_GET['first_name'];
	$lastName = $_GET['last_name'];
	$customNumber = $_GET['custom'];
	$amount = $_GET['amount'];
	$currencyCode = $_GET['currency_code'];
	$uqdateQuery = mysql_query("update `occ_coltregistrant` set `status` = '1' where `fullname` = '$firstName' and `guardian_name` = '$lastName'");
}
if($uqdateQuery)
{
		header("Location:thankyou.html");
}
//
?>