<?php
include("class/db_config.php");
 
	 
 


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
	
	$custom1 = "127";
	
	echo $custom1 . "<br>";
	
	$queryuser = "select * from payment_recieved where payment_id = '$custom1'";
	$finduseraccount = mysql_query($queryuser);
	
	echo $queryuser;
	
	while($paymentaccount = mysql_fetch_array($finduseraccount)){
		
		$payment_userid = $paymentaccount['uid'];
		echo "<br>3 ".$payment_userid;
		
		
		$quserinfo = "select * from occ_registrant where sid = '$payment_userid'";
		$finduserinfo = mysql_query($quserinfo);
		echo "<br> 4" . $quserinfo;
		while($userdetail = mysql_fetch_array($finduserinfo)){
		
		$cfname = $userdetail['occ_sec2_guardian_name'];
		$payer_email = $userdetail['occ_sec2_emailaddress'];
		
		echo "<br> 5 " . $cfname;
		
		
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
					  <p>On behalf of  Osterley Cricket Club I would like to welcome your child to Osterley Cricket  Club and provide you with some information about the cricket activities we  offer. Osterley Cricket Club provides opportunities for young people between  the ages of 5 and 18 to receive coaching and competition in Middlesex Cricket  Leagues for Under 11&rsquo;s, Under 13&rsquo;s, Under 15&rsquo;s and Under 17&rsquo;s. We also  participate in Middlesex Cup Competitions that run parallel to the regular  league season. From the 2012-13 Season we have also introduced Indoor Winter  Cricket Leagues officiated by Middlesex for our Colts along with a Sunday Development League with a representation of 7 Under 21's and 4 Adults in an Adult format of 45 over games.</p>
					  <p>All coaching is provided  by qualified coaches who are highly trained and have been screened for their  suitability for working with young people. Our Coaching staff is Level 2 (UKCC2) and Level 1(UKCC1) qualified through the English Cricket Board. Our Level 2 COaches are also ex-First Class Cricketers which makes an ideal cricketing academy for colts to learn from.</p>
						<p>						  Osterley Cricket  Club has achieved its Club Mark Status on 2nd November 2009  (No:01474) and is now working towards its renewal for the 2013-14 season. ECB  Clubmark is the ECB&rsquo;s club accreditation scheme for clubs with junior sections.  ECB Clubmark sets out required standards across four areas: </p>
                        <ul>
                          <li>Duty of Care and Safeguarding Children</li>
                          <li>The Cricket Programme we offer</li>
                          <li>Knowing your club and its Community – One Game </li>
                          <li>Club Management. </li>
                      </ul>
                        <p>Achieving ECB  Clubmark accreditation is an acknowledgement that we take these issues  seriously and that we are striving to provide a high quality and welcoming  environment for young participants in cricket. We welcome parents and carers or  guardians to all training and competitions and value your support.  We are keen to try and involve parents,  carers and guardians in the club and would like to invite you to an open  evening held every week on Wednesday where you can meet club members and find  out more about the club. Below is some information about training times and  dates, and details regarding travel arrangements, kits and membership.</p>
                        <p>                          Training  Sessions have been taking pace on Saturdays at 1pm to 2pm and we are now  scheduling midweek sessions after school timings on Thursdays from 6pm to 8pm.  You will be notified through email/phone/social-media by the Coach as to when you should  attend your sessions. Winter nets are due to end by the first week of April  every year after which we move back to the Club and outdoor training, which you  will be informed about.</p>
                        <p>                          Arrangements  should be made for your child to travel to and from training sessions and league  or cup matches. We would appreciate it if children can arrive promptly and are  collected promptly at the end of every session, if they are not making their  own way home. If you are going to be late picking your child up, please contact  the Welfare Officer or the Coach present on the day. Details of all personnel  are at the bottom of this letter.</p>
                        <p>                          Club training  kits consist of a complete tracksuit with the Osterley CC Emblem and Cap along  with a set of Whites for Matches. Whites have to be worn for all league games  as well as cup games, as required by the Laws of the game and the relative competitions.  The cost for each Kit per child is £35 and they are available to purchase from  the Clubhouse. The membership fee for juniors under 17 years of age is £60 per  child, which has to be paid for every season your child plays for Osterley CC.  Every season starts and ends in October of every year. If your child  participates in Open Age/Adult Cricket there are match fees that are covered in  the <a href=\"http://www.osterleycc.com/information/pricing-policy/\" target=\"new\">Pricing Policy on our Official Website</a>.</p>
                        <p>                          We are grateful  to you for submitting your child&rsquo;s membership and making the yearly subs  payment. For safety reasons it  is important that the club is informed of any medical condition or allergies  that may be relevant should your child fall ill or be involved in an accident/injury  at the club.</p>
                        <p>                          If you would  like to talk to someone at the club about this information or your child&rsquo;s  involvement with the club, please contact me on 07774573622 or e-mail me on <a href=\"mailto:omer@osterleycc.com\">omer@osterleycc.com</a>.</p>
                        <p>                          Thank you for  choosing Osterley Cricket Club for the prosperity of your child and we will  make every possible effort to ensure they progress and succeed at what they  learn from us in a secure environment that we stride to provide.</p>
                        <p>Yours sincerely,<br />
                          Omer Butt<br />
                          <img src=\"http://www.osterleycc.com/apply/images/Signature.png\" width=\"98\" height=\"74\" /><br />
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
				
	
echo $newemail;				
	if($payment_status == "Completed"){
		
		
		
	

		
		
		
		
		$date = date('m/d/Y h:i:s a', time());
//	$uqdateQuery = mysql_query("update `occ_registrant` set `status` = 2  where `sid` = '$custom1'");
//	$uqdatePayRecieve = mysql_query("INSERT INTO payment_recieved(payment_id,uid,amount,description,note,status,method,date_created,date_recieved,paypal_txn) VALUES (NULL,'$custom1','$payment_amount','Annual subs','Online Payment','2','3','$date','$date','$txn_id')");
	
	

	
	$headers = "From: omer@osterleycc.com";
	$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
    $body = str_replace("#fullname#",$NameofPerson,$body); 
	$estatus = mail('info@thetechmates.com', "Welcome to OsterleyCC Verified", $newemail, $headers);
	$estatus = mail($payer_email, "Welcome to OsterleyCC", $newemail, $headers);
	
				
							
	}
	
	
		} // end find user info

	} //end finduseraccount
	

?>