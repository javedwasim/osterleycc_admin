<?php
include("class/db_config.php");
 
	 
 
 
// STEP 1: Read POST data
 
// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}
 
 
// STEP 2: Post IPN data back to paypal to validate
 
$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
 
// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);
 
 
// STEP 3: Inspect IPN validation result and act accordingly
 
if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment
    // assign posted variables to local variables

	$cfname = $_POST['first_name'];
	$clname = $_POST['last_name'];
	$item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
	$custom1 = $_POST['custom'];
	
	$finduseraccount = mysql_query("select * from payment_recieved where payment_id = '$custom1'");
	
	while($paymentaccount = mysql_fetch_array($finduseraccount)){
		
		$payment_userid = $paymentaccount['uid'];
		
		$finduserinfo = mysql_query("select * from occ_registrant where sid = '$payment_userid'");
		
		while($userdetail = mysql_fetch_array($finduserinfo)){
		
		$cfname = $userdetail['occ_firstname']." ".$userdetail['occ_lastname'];
		$payer_email = $userdetail['occ_sec2_emailaddress'];
	
		$newemail = "
	
	
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<!-- If you delete this tag, the sky will fall on your head -->
<meta name=\"viewport\" content=\"width=device-width\" />

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>PayPal Payment Follow up</title>
	
<link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.osterleycc.com/apply/css/email.css\" />

</head>
 
<body bgcolor=\"#FFFFFF\">

<!-- HEADER -->
<table class=\"head-wrap\">
	<tr>
		<td></td>
		<td class=\"header container\">
			
				<div class=\"content\">
					<table>
					<tr>
						<td><img src=\"http://www.osterleycc.com/apply/images/welcomeHeader.jpg\" alt=\"Welcome to OCC\" /></td>
						<td align=\"right\"><h6 class=\"collapse\">&nbsp;</h6></td>
					</tr>
				</table>
				</div>
				
		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class=\"body-wrap\">
	<tr>
		<td></td>
		<td class=\"container\" bgcolor=\"#FFFFFF\">

			<div class=\"content\">
			<table>
				<tr>
					<td>
						
		              <h1>Dear $cfname </h1>
					  <p>On behalf of Osterley Cricket Club I would like to welcome you to Osterley Cricket Club and provide you with some information about the cricket activities we offer. Osterley Cricket Club provides opportunities for Adults of all age groups over 18 and young people between the ages of 5 and 18 to receive coaching and competition in Middlesex Cricket Leagues. We participate in the following competitions:</p>
					<ul>
                          <li>Middlesex Championship League – Division 1 (1st and 2nd XI)</li>
                          <li>Middlesex 1987 League – Division 3 (3rd XI) and Division 4 (4th XI)</li>
                          <li>Middlesex County Cup</li>
                          <li>ECB National Cup </li>
                          <li>Bertie Joel Cup</li>
                          <li>Middlesex Development League</li>
                    </ul>
                        <p>Cup Competitions run parallel to the regular league season. We also provide coaching through ex-Frist Class Cricketers who are also ECB Level 2 Qualified Coaches. All coaches have been screened for their suitability for working with our members.</p>
                        <p>Osterley Cricket Club has achieved its Club Mark Status on 2nd November 2009 (No:01474) and is now working towards its renewal for the 2013-14 season. ECB Clubmark is the ECB’s club accreditation scheme for clubs with junior sections. ECB Clubmark sets out required standards across four areas: </p>
                        <ul>
                          <li>Duty of Care and Safeguarding Children</li>
                          <li>The Cricket Programme we offer</li>
                          <li>Knowing your club and its Community \– One Game </li>
                          <li>Club Management. </li>
                      </ul>
                        
                        
                        <p>Achieving ECB Clubmark accreditation is an acknowledgement that we take these issues seriously and that we are striving to provide a high quality and welcoming environment for young participants in cricket. We welcome parents and carers or guardians and all adult members to all training and competitions and value your support. </p>
                        <p>Below is some information about training times and dates, and details regarding travel arrangements, kits and membership.</p>
                        <p><strong>Training Sessions</strong> take place throughout the season and during the winter months. Your team captain or club representative will be able to inform you of the timings and dates for when these are scheduled. You will be notified through email/phone or the Coach as to when you should attend your sessions. Winter nets are due to end by the first week of April every year after which we move back to the Club and outdoor training, which you will be informed about.</p>
                        <p>Arrangements should be made for your travel to and from training sessions and league or cup matches. We would appreciate it if you can arrive promptly and are collected promptly at the end of every session, if you are not making your own way home. </p>
<p><strong>Club Training Kits</strong> consist of a complete tracksuit with the Osterley CC Emblem and Cap along with a set of Whites for Matches. Whites have to be worn for all league games as well as cup games, as required by the Laws of the game and the relative competitions. The cost for each Kit per adult is £50 and they are available to purchase from the Clubhouse. </p>
<p><strong>Annual Membership Fee</strong> for adults is £100 per person, which has to be paid for every season you play for Osterley CC. Every season starts and ends in October of every year. If you participate in Open Age/Adult Cricket there are match fees that are covered in the Pricing Policy at the bottom of this letter.</p>
<p>We are grateful to you for submitting your membership and making the yearly subs payment (if made through Paypal at Registration). If your payment has not been made yet a member of our staff will advise you further. For safety reasons it is important that the club is informed of any medical condition or allergies that may be relevant should you fall ill or be involved in an accident at the club.</p>
<p>If you would like to talk to someone at the club about this information or your involvement with the club, please contact me on 07774573622 or e-mail me on omer@osterleycc.com.</p>
<p>Thank you for choosing Osterley Cricket Club for your prosperity and we will make every possible effort to ensure you progress and succeed at what you learn from us in a secure environment that we stride to provide.</p>
                        <p>Yours sincerely,<br />
                          Omer Butt<br />
                          Osterley Cricket Club<br />
                          Trustee &amp; Administrator                      </p>
                      <p>&nbsp;</p>
                      <table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\">
	            <tbody>
	              <tr>
	                <td align=\"left\"><h2>Key Personnel Contacts:</h2>
                      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"631\">
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Positions </strong></p></td>
                          <td width=\"142\" valign=\"top\"><p><strong>Names</strong><strong> </strong></p></td>
                          <td width=\"175\" valign=\"top\"><p><strong>E-mail Addresses</strong><strong> </strong></p></td>
                          <td width=\"102\" valign=\"top\"><p><strong>Phone</strong><strong> </strong></p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Chairman</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Shaheen    Rizvi</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:shaheen@osterleycc.com\">shaheen@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07767236109</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Administrator</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Omer Butt</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:omer@osterleycc.com\">omer@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07774573622</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Club    Secretary </strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Fawaz Qureshi </p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:fawaz@osterleycc.com\">fawaz@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07825931605 </p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Club    Captain </strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Laeeq    Ahmed </p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:laeeq@osterleycc.com\">laeeq@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07930512663 </p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Colts Manager</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Mohammad    Qaisar</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:qaisar@osterleycc.com\">qaisar@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07788891200</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Club Welfare Officer</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Joyce Clark</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:eco_bike@hotmail.com\">eco_bike@hotmail.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07867886231</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Deputy Welfare Officer</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Mohammad    Qaisar</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:qaisar@osterleycc.com\">qaisar@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07788891200</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Senior Colts Coach</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Mohammad Qaisar</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:qaisar@osterleycc.com\">qaisar@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07788891200</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Senior Colts Coach</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Manoj    Suraweera</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:manoj@osterleycc.com\">manoj@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07864218386</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Junior Colts Coach</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Omer Butt </p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:omer@osterleycc.com\">omer@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07774573622</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Junior Colts Coach</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Waseem    Khan</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:waseem@osterleycc.com\">waseem@osterleycc.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07956437426</p></td>
                        </tr>
                        <tr>
                          <td width=\"163\" valign=\"top\"><p><strong>Junior Colts Coach</strong></p></td>
                          <td width=\"142\" valign=\"top\"><p align=\"center\">Ahsan Iqbal</p></td>
                          <td width=\"175\" valign=\"top\"><p><a href=\"mailto:ahsanivora@hotmail.com\">ahsanivora@hotmail.com</a></p></td>
                          <td width=\"102\" valign=\"top\"><p>07525063955</p></td>
                        </tr>
                    </table></td>
                  </tr>
                </tbody>
	            </table>
                  <p>&nbsp;</p>
                  <p><small>You have received this email because you have registered a child in your care with Osterley Cricket Club, Tentelow Lane, Southall, UB2 4LW. </small></p>
			      <p><small>			        © Osterley Cricket Club 2012-13</small></p></td>
				</tr>
			</table>
			</div>
									
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

</body>
</html>
	
	
	
	
	
	";
				
	
				
	if($payment_status == "Completed"){
		
		
		
	

		
		
		
		
		$date = date('m/d/Y h:i:s a', time());
	$uqdateQuery = mysql_query("update `occ_registrant` set `status` = 2  where `sid` = '$payment_userid'");
		$uqdatePayRecieve = mysql_query("UPDATE payment_recieved SET description = 'Online Payment', status = '2', method = '3', date_recieved = '$date', paypal_txn = '$txn_id' where payment_id = '$custom1'");



	
	

	
	$headers = "From: omer@osterleycc.com";
	$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
    $body = str_replace("#fullname#",$NameofPerson,$body); 
	$estatus = mail('info@thetechmates.com', "Welcome to OsterleyCC Verified", $newemail, $headers);
	$estatus = mail($payer_email, "Welcome to OsterleyCC", $newemail, $headers);
	
				
							
	}
	
	
		} // end find user info

	} //end finduseraccount
	
} else if (strcmp ($res, "INVALID") == 0) {
    // log for manual investigation
	

	$cfname = $_POST['first_name'];
	$clname = $_POST['last_name'];
	$item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
	$custom1 = $_POST['custom'];
	
				
	
				
	if($payment_status == "Completed"){
		
		
		$finduseraccount = mysql_query("select * from payment_recieved where payment_id = '$custom1'");
	
	while($paymentaccount = mysql_fetch_array($finduseraccount)){
		
		$payment_userid = $paymentaccount['uid'];
		
		$finduserinfo = mysql_query("select * from occ_registrant where sid = '$payment_userid'");
		
		while($userdetail = mysql_fetch_array($finduserinfo)){
		
		$cfname = $userdetail['occ_firstname']." ".$userdetail['occ_lastname'];
		$payer_email = $userdetail['occ_sec2_emailaddress'];
	

		$newemail = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<!-- If you delete this tag, the sky will fall on your head -->
<meta name=\"viewport\" content=\"width=device-width\" />

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>PayPal Payment Follow up</title>
	
<link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.osterleycc.com/apply/css/email.css\" />

</head>
 
<body bgcolor=\"#FFFFFF\">

<!-- HEADER -->
<table class=\"head-wrap\">
	<tr>
		<td></td>
		<td class=\"header container\">
			
				<div class=\"content\">
					<table>
					<tr>
						<td><img src=\"http://www.osterleycc.com/apply/images/welcomeHeader.jpg\" alt=\"Welcome to OCC\" /></td>
						<td align=\"right\"><h6 class=\"collapse\">&nbsp;</h6></td>
					</tr>
				</table>
				</div>
				
		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class=\"body-wrap\">
	<tr>
		<td></td>
		<td class=\"container\" bgcolor=\"#FFFFFF\">

			<div class='content'>
			<table>
				<tr>
					<td>
						
		              <h3>Dear #Fullname#,</h3>
					  <p>On behalf of  Osterley Cricket Club I would like to welcome you to Osterley Cricket Club and  provide you with some information about the cricket activities we offer.  Osterley Cricket Club provides opportunities for Adults of all age groups over  18 and young people between the ages of 5 and 18 to receive coaching and  competition in Middlesex Cricket Leagues. We participate in the following  competitions:</p>
                      <ul>
                        <li>Middlesex Championship League &shy; Division 1 (1st  XI)</li>
                        <li>Middlesex County Cricket League &shy; Division 3 (2nd  XI</li>
                        <li>Middlesex 1987 League &shy; Division 2 (3rd  XI) and Division 3 (4th XI)</li>
                        <li>Middlesex County Cup</li>
                        <li>ECB National Cup </li>
                        <li>Bertie Joel Cup</li>
                        <li>Middlesex Development League</li>
                      </ul>
					  <p>Cup Competitions  run parallel to the regular league season. We also provide coaching through  ex&shy;Frist Class Cricketers who are also ECB Level 2 Qualified Coaches. All coaches  have been screened for their suitability for working with our members and children.</p>
                      <p>
Osterley Cricket  Club has achieved its Club Mark Status on 2nd November 2009  (No:01474). ECB  Clubmark is the ECB&rsquo;s club accreditation scheme for clubs with junior sections.  ECB Clubmark sets out required standards across four areas: </p>
                      <ul>
                        <li>Duty of Care and Safeguarding Children</li>
                        <li>The Cricket Programme we offer</li>
                        <li>Knowing your club and its Community &shy; One Game </li>
                        <li>Club Management. </li>
                      </ul>
                        <p>Achieving ECB  Clubmark accreditation is an acknowledgement that we take these issues  seriously and that we are striving to provide a high quality and welcoming  environment for young participants in cricket. We welcome parents and carers or  guardians and all adult members to all training and competitions and value your  support.  </p>
                      <p>Below is some  information about training times and dates, and details regarding travel  arrangements, kits and membership.</p>
                        <p><strong>Training Sessions</strong> take place throughout  the season and during the winter months. Your team captain or club  representative will be able to inform you of the timings and dates for when  these are scheduled. You will be notified through email/phone/social media or the Coach/Captain as  to when you should attend your sessions. Winter nets are due to end by the first  week of April every year after which we move back to the Club and outdoor  training, which you will be informed about.</p>
<p>Arrangements  should be made for your travel to and from training sessions and league or cup matches.  We would appreciate it if you can arrive promptly and are collected promptly at  the end of every session, if you are not making your own way home. </p>
<p><strong>Club Training Kits</strong> consist of a  complete tracksuit with the Osterley CC Emblem along with a set of  Whites for Matches. Whites have to be worn for all league games as well as cup  games, as required by the Laws of the game and the relative competitions. The  cost for each Kit per adult is &pound;60 and they are available to purchase from the  Clubhouse. </p>
<p><strong>Annual Membership Fee</strong> for adults is &pound;100  per person, which has to be paid for every season you play for Osterley CC.  Every season starts and ends in October of every year. If you participate in  Open Age/Adult Cricket there are match fees that are covered in the Pricing  Policy on the club website which is <a href='www.osterleycc.com'>www.osterleycc.com</a>.</p>
<p>  We are grateful  to you for submitting your membership and making the yearly subs payment. For safety reasons it is important  that the club is informed of any medical condition or allergies that may be  relevant should you fall ill or be involved in an accident at the club.</p>
<p>If you would  like to talk to someone at the club about this information or your involvement  with the club, please contact me on 07774573622 or e-mail me on <a href='mailto:omer@osterleycc.com'>omer@osterleycc.com</a>.</p>
<p>  Thank you for  choosing Osterley Cricket Club for your sports activities and we will make every  possible effort to ensure you progress and succeed at what you learn from us in  a secure environment that we stride to provide.</p>
<p>Yours sincerely,<br />
                          Omer Butt<br />
                          <img src='http://www.osterleycc.com/apply2/images/Signature.png' width='98' height='74' /><br />
                          Osterley Cricket Club<br />
                      Trustee &amp; Administrator                      </p>
<table width='100%' cellpadding='10' cellspacing='0'>
	            <tbody>
	              <tr>
	                <td align='left'><h3>Key Personnel Contacts:</h3>
                      <table border='0' cellspacing='0' cellpadding='0' width='631' align='left'>
                        <tr>
                          <td width='163' valign='top'><p><strong>Positions </strong></p></td>
                          <td width='142' valign='top'><p><strong>Names</strong><strong> </strong></p></td>
                          <td width='175' valign='top'><p><strong>E-mail Addresses</strong><strong> </strong></p></td>
                          <td width='102' valign='top'><p><strong>Phone</strong><strong> </strong></p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Chairman</strong></p></td>
                          <td width='142' valign='top'>Dr. Ghulam Murtaza</td>
                          <td width='175' valign='top'><p><a href='mailto:drmurtaza@osterleycc.com'>drmurtaza@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07903502566</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Administrator</strong></p></td>
                          <td width='142' valign='top'>Omer Butt</td>
                          <td width='175' valign='top'><p><a href='mailto:omer@osterleycc.com'>omer@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07774573622</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Club    Secretary </strong></p></td>
                          <td width='142' valign='top'><p align='left'>Nadeem Chowdhry</p></td>
                          <td width='175' valign='top'><p><a href='mailto:nadeem@osterleycc.com'>nadeem@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07720204700</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Club Welfare Officer</strong></p></td>
                          <td width='142' valign='top'>Joyce Clark</td>
                          <td width='175' valign='top'><p><a href='mailto:eco_bike@hotmail.com'>eco_bike@hotmail.com</a></p></td>
                          <td width='102' valign='top'><p>07867886231</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Deputy Welfare Officer</strong></p></td>
                          <td width='142' valign='top'>Mohammad    Qaisar</td>
                          <td width='175' valign='top'><p><a href='mailto:qaisar@osterleycc.com'>qaisar@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07788891200</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Senior Colts Coach</strong></p></td>
                          <td width='142' valign='top'>Mohammad Qaisar</td>
                          <td width='175' valign='top'><p><a href='mailto:qaisar@osterleycc.com'>qaisar@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07788891200</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>Senior Colts Coach</strong></p></td>
                          <td width='142' valign='top'>Manoj    Suraweera</td>
                          <td width='175' valign='top'><p><a href='mailto:manoj@osterleycc.com'>manoj@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07864218386</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>1st Team Captain</strong></p></td>
                          <td width='142' valign='top'>Laeeq Ahmed</td>
                          <td width='175' valign='top'><p><a href='mailto:mirzalaeeq@hotmail.co.uk'>mirzalaeeq@hotmail.co.uk </a></p></td>
                          <td width='102' valign='top'><p>07930512663</p></td>
                        </tr>
                        <tr>
                          <td width='163' valign='top'><p><strong>2nd Team Captain</strong></p></td>
                          <td width='142' valign='top'>Karim Khan</td>
                          <td width='175' valign='top'><p><a href='mailto:karim@osterleycc.com'>karim@osterleycc.com</a></p></td>
                          <td width='102' valign='top'><p>07939233683</p></td>
                        </tr>
                        <tr>
                          <td valign='top'><p><strong>3rd Team Captain</strong></p></td>
                          <td valign='top'>Dave Paddon</td>
                          <td valign='top'><p><a href='mailto:eco_bike@hotmail.com'>eco_bike@hotmail.com</a></p></td>
                          <td valign='top'><p>07836639579</p></td>
                        </tr>
                        <tr>
                          <td valign='top'><p><strong>4th Team Captain</strong></p></td>
                          <td valign='top'>Asim Balouch</td>
                          <td valign='top'><p><a href='mailto:asim@osterleycc.com'>asim@osterleycc.com</a></p></td>
                          <td valign='top'><p>07766226161</p></td>
                        </tr>
                    </table></td>
                  </tr>
                </tbody>
	            </table>
                  <p>&nbsp;</p>
                  <p><small>You have received this email because you have registered yourself or a child in your care with Osterley Cricket Club, Tentelow Lane, Southall, UB2 4LW. </small>If you wish to unsubscribe please send an email to <a href='mailto:info@osterleycc.com'>info@osterleycc.com</a> with your request. </p>
			      <p><small>			        &copy; Osterley Cricket Club 2013-14</small></p></td>
				</tr>
			</table>
			</div>
									
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

</body>
</html>
	
	
	
	
	
	";	
		
		
		
		$date = date('m/d/Y h:i:s a', time());
	$uqdateQuery = mysql_query("update `occ_registrant` set `status` = 2  where `sid` = '$payment_userid'");
		$uqdatePayRecieve = mysql_query("UPDATE payment_recieved SET description = 'Online Payment', status = '2', method = '3', date_recieved = '$date', paypal_txn = '$txn_id' where payment_id = '$custom1'");
	
	

	
	$headers = "From: omer@osterleycc.com";
	$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
    $body = str_replace("#fullname#",$NameofPerson,$body); 
	$estatus = mail('info@thetechmates.com', "Welcome to OsterleyCC", $newemail, $headers);
	$estatus = mail($payer_email, "Welcome to OsterleyCC", $newemail, $headers);
	
				
							
	}
	
	
	} // end find user info

	} //end finduseraccount
	

}
?>