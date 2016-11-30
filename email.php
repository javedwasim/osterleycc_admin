<?php
include("adminpanel/imail/PHPMailer-master/PHPMailerAutoload.php");

try{

    $mail = new PHPMailer(true);

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
    $mail->AddAddress('jwaseem@thinkdonesolutions.com');
    $mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
    $mail->Subject = "Registration Successful for ";


    $mail->MsgHTML('test email');

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "mail sent successfully!";
    }

}catch (phpmailerException $e) {
     echo $e->errorMessage(); //Pretty error messages from PHPMailer


}catch (Exception $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer

}
