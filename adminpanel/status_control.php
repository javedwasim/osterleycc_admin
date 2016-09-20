<?php
session_start();
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if (isset($_SESSION['source_type'])) {

    if ($_SESSION['source_type'] == 3) {
        $redirect = "social_info.php";
    } elseif ($_SESSION['source_type'] == 2) {
        $redirect = "adutls_info.php";
    } else {
        $redirect = "colts_info.php";
    }
}

$ID = $_GET['Id'];
if ($ID) {
    $q = mysql_query("SELECT * FROM `occ_registrant` WHERE `Id` = '$ID'");
    $row = mysql_fetch_array($q);
    $status = $row['status'];
	//echo "<pre>"; print_r($row); die();
    if ($status == 1) {
        $status = 2;
    } else {
        $status = 1;
    }
    $update_query = mysql_query("update `occ_registrant` set `status` ='$status' where `Id` = '$ID'");
    if ($update_query) {
        //echo $status;
        $pendemail = " <html>
                        <head>
                        <!-- Bootstrap core CSS -->

                        <style type=\"text/css\">
                        body,td,th {
                            font-family: Arial, Helvetica, sans-serif;
                        }
                        </style>


                        </head>
                        <body>
                        <div style=\"border:1px solid #ccc; padding:5px 0;\">
                        <div>
                        <header style=\"border-bottom:1px solid #ccc;\">
                        <div id=\"headSection\">
                        
                        </div>
                        </header>
                        <div style=\"border-top:1px solid #ccc;padding: 15px;font-weight: bold;background: #f7f8fc;box-shadow: inset #ccc 0 1px 1px 0;\">
                        <p>Osterley Cricket Club</p>
                        </div>

                        </div>
                        </div>
                        </body>
                        </html>";

       
        //$headers = "From: omer@osterleycc.com";
        //$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
		//$mail_function = mail($user_email, "Payment Request from OsterleyCC ", $pendemail, $headers);
		
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
		$emailTo  = $row['occ_sec2_emailaddress'];
		//Typical mail data
        $mail->AddReplyTo('info@osterleycc.com',"Osterley Cricket Club");
        $mail->AddAddress($emailTo);
        $mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
        $mail->Subject = "Welcome to OsterleyCC";

	   
		$mail->MsgHTML($pendemail);

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			message("Status change successfully!");
		}
        header("Location: $redirect");

        die();
    }

}

?>