<?php
session_start();
if (isset($_SESSION['source_type'])) {
    $source_type = $_SESSION['source_type'];
}

include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];

//mail function starts

function readTemplateFile($FileName)
{
    $fp = fopen($FileName, "r") or exit("Unable to open File " . $FileName);
    $str = "";
    while (!feof($fp)) {
        $str .= fread($fp, 1024);
    }
    return $str;
}

//mail function ends

$selectmethod = mysql_query("select * from `payment_method`");
$uid = $_GET['uid'];
$cc = mysql_query("select * from `occ_registrant` WHERE `source_type` = $source_type");


$isPosted = count($_POST);


if ($isPosted > 0) {
    $description = $_POST['description1'];
    $note = $_POST['note1'];
    $amount = $_POST['amount1'];
    $method = $_POST['method1'];
    $status = $_POST['status1'];
    $user_id = $_POST['userid'];


    $date = date('m/d/Y h:i:s a', time());
    $NameofPerson = $_SESSION['firstname'] . '&nbsp;' . $_SESSION['lastname'];
    $datetwin = "$date','";
    $insertQuery = mysql_query("insert into payment_recieved values ('','$user_id','$amount','$description','$note','$status','$method','$datetwin','','$source_type')");


    if ($status == 1) {


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

                //				echo $item_desc;
                //				exit();

                $pendemail = "

<html>
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
<p>Dear " . $user_guardname . ",</p>

<p>You have a pending payment of &pound;" . $item_amount . " for your child " . $user_fullname . " (<strong>\"" . $item_desc . "\"</strong>) on your account. Please click the PAY NOW button below to pay the outstanding amount.</p>

<p>



      

<a href=\"https://www.paypal.com/cgi-bin/webscr?business=omer@osterleycc.com&cmd=_xclick&currency_code=GBP&amount=" . $item_amount . "&item_name=" . $item_desc . "&custom=$item_custom&cancel_return=http://www.osterleycc.com/apply/abort.html&notify_url=http://www.osterleycc.com/apply/ipn4.php&return=http://www.osterleycc.com/apply/thankyou.html\" ><img src=\"http://www.osterleycc.com/apply/images/paynow.gif\"  />
</a>

</p>

<p>If you have any queries or are not sure about why you have recieved this payment request please contact the Administrator Omer Butt on 07774573622.</p>

<p>Osterley Cricket Club</p>
</div>

</div>
</div>
</body>
</html>";


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
				$emailTo  = $row['occ_sec2_emailaddress'];
				//Typical mail data
				$mail->AddReplyTo('info@osterleycc.com',"Osterley Cricket Club");
				$mail->AddAddress($user_email);
				$mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
				$mail->Subject = "Welcome to OsterleyCC";

			   
				$mail->MsgHTML($body);

				if(!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					message("Email Process Successfully!!");
				}
            }
        }
    } else {
        $datetwin = "$date','$date";
		
        $body = $pendemail;
        $headers = "From: omer@osterleycc.com";
        $headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
        $body = str_replace("#Fullname#", $NameofPerson, $body);
        $body = str_replace("#XXX#", $amount, $body);
        $body = str_replace("#Description#", $description, $body);
        
		include("imail/PHPMailer-master/PHPMailerAutoload.php");
		
		$mail = new PHPMailer(true);

        //Send mail using gmail
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        //$mail->SMTPSecure = "tls"; // sets the prefix to the servier
        $mail->Host = "shared7.hostwindsdns.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "info@osterleycc.com"; // GMAIL username
        $mail->Password = "InfO@Osdt23456"; // GMAIL password
		$mail->SMTPSecure = "ssl";

        //Typical mail data
        //Typical mail data
        $mail->AddReplyTo('info@osterleycc.com',"Osterley Cricket Club");
        $mail->AddAddress("qasimnepster@gmail.com");
        $mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
        $mail->Subject = "Welcome to OsterleyCC";

       
        $mail->MsgHTML($body);

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            message("Email Process Successfully!!");
        }
		
		/**
		$mail_function = mail("qasimnepster@gmail.com", " Payment Completed ", $body, $headers);
        $mail_function = mail("omer@osterleycc.com", " Payment Required ", $body, $headers);
		**/
		
    }


    if ($insertQuery) {
        if ($source_type == 1) {
            $redirect_file = "colts_info.php";
        } elseif ($source_type == 2) {
            $redirect_file = "adutls_info.php";
        } elseif ($source_type == 3) {
            $redirect_file = "social_info.php";
        } else {
            $redirect_file = "home.php";
        }

        mysql_query("update `occ_registrant` set `status` = 1 where `sid` = '$uid' WHERE `source_type` = $source_type");
        header("Location: $redirect_file?action= Payment Added Successfully");
    } else {
        echo mysql_error();
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Pace -->
    <link href="css/pace.css" rel="stylesheet">

    <!-- Chosen -->
    <link href="css/chosen/chosen.min.css" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="css/datepicker.css" rel="stylesheet"/>

    <!-- Timepicker -->
    <link href="css/bootstrap-timepicker.css" rel="stylesheet"/>

    <!-- Slider -->
    <link href="css/slider.css" rel="stylesheet"/>

    <!-- Tag input -->
    <link href="css/jquery.tagsinput.css" rel="stylesheet"/>

    <!-- WYSIHTML5 -->
    <link href="css/bootstrap-wysihtml5.css" rel="stylesheet"/>

    <!-- Dropzone -->
    <link href='css/dropzone/dropzone.css' rel="stylesheet"/>

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script>
        function showUser(val) {
            var method = $("#method1").val();
            window.location.assign("add_payment.php?uid=" + method);
        }

    </script>
</head>
<body>

<div id="overlay" class="transparent"></div>
<div id="wrapper" class="preload">
    <?php
    if ($_SESSION['Administrator']) {
        include("navigation_bar.php");
    } else {
        include("banner.php");
    }
    ?>

    <div id="main-container" style="margin-left:0px; margin-top:40px;">

        <div class="padding-md edit-reg-form">

            <div class="panel panel-default">
                <div class="panel-heading">

                    <h2>Add Payment</h2>

                </div>

                <div class="panel-body">

                    <form id="formToggleLine" class="form-horizontal no-margin form-border" name="paym1" method="post"
                          action="">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Select user :</label>
                            <div class="col-lg-10">
                                <select name="method1" id="method1" class="form-control"
                                        onchange="showUser(this.value)">
                                    <option value="">Please Select User</option>
                                    <?php
                                    while ($occ = mysql_fetch_array($cc)) { ?>
                                        <option value="<?php echo $occ['sid']; ?>" <?php if ($occ['sid'] == $uid) {
                                            echo 'selected';
                                        } ?>><?php echo $occ['Id'] . '&nbsp;' . $occ['occ_firstname'] . '&nbsp;' . $occ['occ_lastname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->


                        <?php if ($_GET['uid']) {
                            $crd = mysql_query("select * from `occ_registrant` where `sid` = '$uid'");
                            $crow = mysql_fetch_array($crd);
                            $_SESSION['firstname'] = $crow['occ_firstname'];
                            $_SESSION['lastname'] = $crow['occ_lastname'];
                            ?>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Firstname:</label>
                                <div class="col-lg-10">
                                    <input type="text" value="<?php echo $crow['occ_firstname']; ?>" name="fname"
                                           id="fname" class="form-control" disabled>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Lastname:</label>
                                <div class="col-lg-10">
                                    <input type="text" value="<?php echo $crow['occ_lastname']; ?>" name="lname"
                                           id="lname" class="form-control" disabled>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Amount :</label>
                                <div class="col-lg-10">
                                    <input type="text" value="" name="amount1" id="amount1" class="form-control">
                                </div><!-- /.col -->
                            </div><!-- /form-group -->

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Description :</label>
                                <div class="col-lg-10">
                                    <input type="text" name="description1" id="description1" class="form-control"
                                           value="">
                                </div><!-- /.col -->
                            </div><!-- /form-group -->

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Notes :</label>
                                <div class="col-lg-10">
                                    <textarea name="note1" id="note1" class="form-control"
                                              style="height:100px;"></textarea>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Method :</label>
                                <div class="col-lg-10">
                                    <select name="method1" id="method1" class="form-control">
                                        <?php
                                        while ($mthd = mysql_fetch_array($selectmethod)) { ?>
                                            <option
                                                value="<?php echo $mthd['Id']; ?>"><?php echo $mthd['method']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->


                            <div class="form-group">
                                <label class="col-lg-2 control-label">Status :</label>
                                <div class="col-lg-10">
                                    <select name="status1" id="status1" class="form-control">

                                        <option value="1">Pending</option>
                                        <option value="2">complete</option>

                                    </select>
                                </div><!-- /.col -->
                            </div><!-- /form-group -->

                            <div class="form-group">
                                <input type="hidden" value="<?php echo $_GET['uid']; ?>" name="userid" id="userid">
                                <label class="col-lg-12 control-label" style="text-align:center;">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </label>

                            </div><!-- /form-group -->

                        <?php } ?>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
<?php include_once("footer.php"); ?>

