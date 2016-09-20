<?php

include("imail/PHPMailer-master/PHPMailerAutoload.php");


$mail = new PHPMailer(true);

$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "javedafaq@gmail.com";
$mail->Password = "polkmn-manjum";
$mail->SetFrom("javedafaq@gmail.com","Osterley Cricket Club");
$mail->AddReplyTo('javedafaq@gmail.com',"Osterley Cricket Club");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("jwaseem@thinkdonesolutions.com");

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent";
}

die();
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



//Send mail using gmail
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->Host = "shared7.hostwindsdns.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "info@osterleycc.com"; // GMAIL username
$mail->Password = "InfO@Osdt23456"; // GMAIL password
$mail->SMTPSecure = "ssl";


//Typical mail data
$mail->AddReplyTo('info@osterleycc.com',"Osterley Cricket Club");
$mail->AddAddress('javedafaq@gmail.com');
$mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
$mail->Subject = "Registration Successful for ";


$mail->MsgHTML($messageBody);

if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
        message("Updates Successfully!!");
}