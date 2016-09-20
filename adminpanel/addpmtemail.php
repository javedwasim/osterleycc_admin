<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if(isset($_POST['status1'])) {
    $description = $_POST['description1'];
    $note = $_POST['note1'];
    $amount = $_POST['amount1'];
    $method = $_POST['method1'];
    $status = $_POST['status1'];
    $user_id = $_POST['userid'];

    $findpay = mysql_query("SELECT * FROM  payment_recieved WHERE uid =  '$user_id' and source_type = $source_type ORDER BY  payment_id DESC LIMIT 0 , 1");
    $finduser = mysql_query("SELECT * FROM  occ_registrant where sid = '$user_id' and source_type = $source_type LIMIT 0 , 1");

    while ($stuser = mysql_fetch_array($finduser)) {

        $user_fullname = $stuser['occ_firstname'] . " " . $stuser['occ_lastname'];
        $user_guardname = $stuser['occ_sec2_guardian_name'];
        $user_email = $stuser['occ_sec2_emailaddress'];

        while ($stemail = mysql_fetch_array($findpay)) {


            $item_desc = $stemail['description'];
            $item_amount = $stemail['amount'];
            $item_custom = $stemail['payment_id'];

            $pendemail = "";


            $body = $pendemail;
            $headers = "From: omer@osterleycc.com";
            $headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";

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

            //echo $emailTo  = $row['occ_sec2_emailaddress']; die();
            $emailTo = $row['occ_sec2_emailaddress'];
            //Typical mail data
            $mail->AddReplyTo('info@osterleycc.com', "Osterley Cricket Club");
            $mail->AddAddress($user_email);
            $mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
            $mail->Subject = "Welcome to OsterleyCC";


            $mail->MsgHTML($body);

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                message("Email Process Successfully!!");
            }
        }
    }

}