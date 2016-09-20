<?php
session_start();
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

if (isset($_SESSION['source_type'])) {
    $source_type = $_SESSION['source_type'];

    if ($source_type == 1) {
        $redirect = "colts_info.php";
    } elseif ($source_type == 2) {
        $redirect = "adutls_info.php";
    } elseif (source_type == 3) {
        $redirect = "social_info.php";
    }

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

$userId = $_GET['uid'];
$payId = $_GET['id'];
if ($userId) {
    $selectmethod = mysql_query("select * from `payment_method`");

    $selectusers = mysql_query("select * from occ_registrant as r, payment_recieved as p where r.sid = p.uid and p.uid = '$userId' and p.payment_id = '$payId' and p.source_type = $source_type");
    $rows = mysql_fetch_array($selectusers);

    $isPosted = count($_POST);
    if ($isPosted > 0) {

        $pid = $_POST['pid'];
        $amount = $_POST['amount1'];
        $description = $_POST['description1'];
        $note = $_POST['note1'];
        $method = $_POST['method1'];
        $user_conf_email = $rows['occ_sec2_emailaddress'];
        $date = date('m/d/Y h:i:s a', time());
        $updateQuery = mysql_query("update `payment_recieved` set `amount` = '$amount' , `description` = '$description' , `note` = '$note' , `status` = '2' , `method` = '$method' , `date_recieved` = '$date' where `payment_id` = '$pid'");
        if ($updateQuery) {
            mysql_query("update `occ_registrant` set `status` = '2' where `sid` = '$userId'");
        }
        if ($_POST['email_format'] != NULL) {
            $formats = $_POST['email_format'];

            $status = explode("-", $formats);

            if (isset($status[1])) {
                $NameofPerson = $rows['occ_firstname'] . " " . $rows['occ_lastname'];
                $nameguard = $rows['occ_sec2_guardian_name'];


                $selectTmpQ = "SELECT `empl_id`, `empl_name`, `empl_src_code`, `empl_created_date`, `empl_status` FROM `email_tmpl` WHERE `empl_id`=$status[0]";
                $resultTmp = mysql_query($selectTmpQ);
                $selectedTemp = mysql_fetch_array($resultTmp);
                $selectedTemp = base64_encode($selectedTemp['empl_src_code']);
                $price = $rows['amount'];

                $body = base64_decode($selectedTemp);
                $body = str_replace("#Fullname#", $nameguard, $body);
                $body = str_replace("#XXX#", $price, $body);
                $body = str_replace("#Description#", $description, $body);


                include("imail/PHPMailer-master/PHPMailerAutoload.php");
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
                $mail->AddAddress($rows['occ_sec2_emailaddress']);
                $mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
                $mail->Subject = "Registration Successful for $nameguard";


                $mail->MsgHTML($body);

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    message("Updates Successfully!!");
                }
            }

        }

        header("Location: payin_info.php");

    }


} else {
    header("Location:$redirect");
}


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
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


</head>
<body>

<!-- Overlay Div -->
<div id="overlay" class="transparent"></div>
<div id="wrapper" class="preload">
    <?php
    if ($_SESSION['Administrator']) {
        include("navigation_bar.php");
    } else {
        include("banner.php");
    }
    ?>

    <div id="main-container" style="margin-left:0px; margin-top: 40px;">

        <div class="padding-md edit-reg-form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Edit Payment</h2>

                </div>
                <div class="panel-body">
                    <form id="formToggleLine" class="form-horizontal no-margin form-border" name="paym1" method="post"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $payId; ?>&uid=<?php echo $userId; ?>">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">First name :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php echo $rows['occ_firstname']; ?>" name="fname" id="fname"
                                       class="form-control" disabled>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Last name :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php echo $rows['occ_lastname']; ?>" name="lname" id="lname"
                                       class="form-control" disabled>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Amount :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php echo $rows['amount']; ?>" name="amount1" id="amount1"
                                       class="form-control" required>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Description :</label>
                            <div class="col-lg-10">
                                <input type="text" name="description1" id="description1" class="form-control"
                                       value="<?php echo $rows['description']; ?>">
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Notes :</label>
                            <div class="col-lg-10">
                                <textarea name="note1" id="note1"
                                          class="form-control"><?php echo $rows['note']; ?></textarea>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Method :</label>
                            <div class="col-lg-10">
                                <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>">
                                <?php /*
                                <select name="method1" id="method1" class="form-control">
                                    <?php
                                    while ($mthd = mysql_fetch_array($selectmethod)) { ?>
                                        <option
                                            value="<?php echo $mthd['Id']; ?>"><?php echo $mthd['method']; ?></option>
                                    <?php } ?>
                                </select>
                                */ ?>
                                <select name="method1" id="method1" class="form-control" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="4"<?php if($rows['method']==4){echo "selected";} ?>>Cheque</option>
                                    <option value="5"<?php if($rows['method']==5){echo "selected";} ?>>Cash</option>
                                    <option value="6"<?php if($rows['method']==6){echo "selected";} ?>>Bank Transfer</option>
                                </select>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email :</label>
                            <div class="col-lg-10">
                                <select name="email_format" id="email_format" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="2-1">Send Complete Payment Email</option>
                                    <option value="3-1">Send Successfull Payment Email</option>
                                    <option value="1-1">Send Pending Payment Email</option>
                                </select>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-12 control-label" style="text-align:center;">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </label>

                        </div><!-- /form-group -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>
	