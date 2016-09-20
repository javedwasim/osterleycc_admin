<?php
session_start();
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");


$smleCode = base64_decode($_POST['smleCode']);
//print_r($smleCode);

if ($smleCode != NULL) {

    $query_source = "SELECT * FROM `occ_registrant` WHERE `Id` = {$_POST['userid']} ";
    $fetch_source = mysql_query($query_source);

    if (mysql_num_rows($fetch_source) > 0) {
		
        $src = mysql_fetch_array($fetch_source);
        $etmplid = $_POST['etmpl'];
		
		$selectQuery = "select * from email_tmpl where empl_id = $etmplid limit 1";
		$selectQuery = mysql_query($selectQuery);
		$etmplname = mysql_fetch_array($selectQuery);
		
       //echo "<pre>";    print_r($etmplname); die();

        $body = '';
        $body = str_ireplace("#fullname#", $src['occ_firstname'] . '&nbsp;' . $src['occ_lastname'], $smleCode);
        $body = str_ireplace("#dateofbirth#", $src['occ_birthday'], $body);
        $body = str_ireplace("#gender#", $src['occ_gender'], $body);
        $body = str_ireplace("#contactno#", $src['occ_sec2_daytimetel'], $body);
        $body = str_ireplace("#contactnevening#", $src['occ_sec2_eventimetel'], $body);
        $body = str_ireplace("#jobtitle#", $src['occ_job_title'], $body);
        $body = str_ireplace("#email#", $src['occ_sec2_emailaddress'], $body);
        $body = str_ireplace("#totalprice#", $src['occ_total_price'], $body);
        $body = str_ireplace("#registrationdate#", $src['date_registration'], $body);
        $body = str_ireplace("#postcode#", $src['occ_sec2_postcode'], $body);
	         
		include("imail/PHPMailer-master/PHPMailerAutoload.php");
		
		 $mail = new PHPMailer(true);

        //Send mail using gmail
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true; // enable SMTP authentication
		//$mail->SMTPSecure = "tls"; // sets the prefix to the servier
		$mail->Host = "shared7.hostwindsdns.com"; // sets GMAIL as the SMTP server
		$mail->Port = 465; // set the SMTP port for the GMAIL server
		$mail->Username = "info@osterleycc.com"; // GMAIL username
		$mail->Password = "InfO@Osdt23456"; // GMAIL password @@WELCOME@@777@@tds
		$mail->SMTPSecure = "ssl";
		
		
		//echo $src['occ_sec2_emailaddress']; die();
		$emailTo = $src['occ_sec2_emailaddress'];
        //Typical mail data
        $mail->AddReplyTo('info@osterleycc.com',"Osterley Cricket Club");
        $mail->AddAddress($emailTo);
        $mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
        $mail->Subject = $_POST['subject']; //$etmplname['empl_name'];
        //echo $_POST['subject'];
       
        $mail->MsgHTML($body);

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            message("Email Process Successfully!!");
			echo "Email Process Successfully!";
        }
				       
        //redirect_to($redirect_file);
        //die();

    }
}

?>


