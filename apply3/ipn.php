<?php include("class/db_config.php");

function readTemplateFile($FileName) 
  {
  $fp = fopen($FileName,"r") or exit("Unable to open File ".$FileName);
  $str = "";
  while(!feof($fp)) {
   $str .= fread($fp,1024);
  } 
  return $str;
  }


if($_GET['first_name'] && $_GET['last_name'] && $_GET['custom'] && $_GET['amount'] && $_GET['currency_code'] && $_GET['method'])
{
	$firstName = $_GET['first_name'];
	$lastName = $_GET['last_name'];
	$customNumber = $_GET['custom'];
	$amount = $_GET['amount'];
	$currencyCode = $_GET['currency_code'];
	$date = date('m/d/Y h:i:s a', time());
	$uqdateQuery = mysql_query("update `occ_registrant` set `status` = 2  where `occ_firstname` = '$firstName' and `occ_lastname` = '$lastName' and `sid` = '$customNumber'");
	$uqdatePayRecieve = mysql_query("INSERT INTO `payment_recieved`(`payment_id`, `uid`, `amount`, `description`, `note`, `status`, `method`, `date_created`, `date_recieved`) VALUES ('','$customNumber','$amount','Annual subs','Customer request to pay in person','2','Paypal','$date','$date')");

		if($uqdateQuery)
		{
			$fetchQuery = mysql_query("select * from `occ_registrant` where `occ_firstname` = '$firstName' and `occ_lastname` = '$lastName' and `sid` = '$customNumber'");
			$fetch = mysql_fetch_array($fetchQuery);
				$NameofPerson       = $fetch['occ_firstname'].'&nbsp;'.$fetch['occ_lastname'];
				$address 			= $fetch['occ_sec2_address'];
				$city   			= $fetch['occ_sec2_city'];
				$county  			= $fetch['occ_sec2_county'];
				$postcode 			= $fetch['occ_sec2_postcode'];
				$dateofbirth		= $fetch['occ_birthday'];
				$email 				= $fetch['occ_sec2_emailaddress'];
				$homtel 			= $fetch['occ_sec2_daytimetel'];
				$mobtel 			= $fetch['occ_sec2_eventimetel'];
				$prname 			= $fetch['occ_sec2_guardian_name'];
				$gender 			= $fetch['occ_gender'];
				$totalprice			= $fetch['occ_total_price'];
				$paymenthistory = '<strong>Payment(achievement) Recieved</strong> <span style=" color:#587e0d; font-weight:bold; font-size:16px;">'.$totalprice.'</span>';
				$body 				= readTemplateFile("registration_successfull.html");
		   		$headers 			= "From: omer@osterleycc.com";
				$headers 			.= "\r\nContent-Type: text/html; charset=iso-8859-1";
    			$body = str_replace("#name#",$NameofPerson,$body);
				$body = str_replace("#address#",$address,$body);
				$body = str_replace("#city#",$city,$body);
				$body = str_replace("#county#",$county,$body);
				$body = str_replace("#postcode#",$postcode,$body);
				$body = str_replace("#dateofbirth#",$dateofbirth,$body);
				$body = str_replace("#email#",$email,$body);
				$body = str_replace("#gender#",$gender,$body);
				$body = str_replace("#prname#",$prname,$body);
				$body = str_replace("#homtel#",$homtel,$body);
				$body = str_replace("#mobtel#",$mobtel,$body);
				$body = str_replace("#paymenthistory#",$paymenthistory,$body);
					
				
				
				
				
				$estatus = mail("omer@osterleycc.com", " Registration Successful ", $body, $headers);
//				$estatus2 = mail($email, "Osterley Cricket Club - Registration Successful ", $newemail, $headers);
//				$estatus3 = mail('info@thetechmates.com', "Osterley Cricket Club - Registration Successful ", $newemail, $headers);			
					header("Location:thankyou.html");
					session_destroy();
				}
}
else
{
	header("Location:abort.html");
}
?>