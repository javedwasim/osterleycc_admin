<?php

		include("imail/PHPMailer-master/PHPMailerAutoload.php");
		
		
		 $mail = new PHPMailer(true);

        //Send mail using gmail
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        //$mail->SMTPSecure = "tls"; // sets the prefix to the servier
        
		$mail->Host = "mail.launchmyempire.com"; // sets GMAIL as the SMTP server
        $mail->Port = 25; // set the SMTP port for the GMAIL server
        $mail->Username = "noreply@launchmyempire.com"; // GMAIL username
        $mail->Password = "NOreply@789"; // GMAIL password
		//$mail->SMTPSecure = "ssl";

        //Typical mail data
        $mail->AddReplyTo('info@launchmyempire.com',"Osterley Cricket Club");
        $mail->AddAddress('jwanjum@gmail.com');
        $mail->SetFrom('info@launchmyempire.com', 'Osterley Cricket Club');
        $mail->Subject = "Test Email Sending.";

        $messageBody =  '
						Hello,
						<br/><br/>
						This is test email.:
						<br/><br/>
					    <b>check</b>
						<br/><br/>
						Thank you,
						<br/>
						Digital Wealth Creation Academy Support
						';
        $mail->MsgHTML($messageBody);

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    