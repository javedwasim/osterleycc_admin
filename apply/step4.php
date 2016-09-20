<?php
include("class/db_config.php");
include("../adminpanel/DateMathClassA.php");
//mail function

function readTemplateFile($FileName)
{
    $fp = fopen($FileName, "r") or exit("Unable to open File " . $FileName);
    $str = "";
    while (!feof($fp)) {
        $str .= fread($fp, 1024);
    }
    return $str;
}

if ($_SESSION['sid']) {

    $_SESSION['appropriate_ans1'] = $_POST['circling_ans1'];
    $_SESSION['appropriate_ans2'] = $_POST['circling_ans2'];
    $_SESSION['appropriate_ans3'] = $_POST['circling_ans3'];
    $_SESSION['appropriate_ans4'] = $_POST['circling_ans4'];
    $_SESSION['appropriate_ans5'] = $_POST['circling_ans5'];
    $_SESSION['club_constitution'] = $_POST['club_constitution'];
    $_SESSION['code_of_conduct'] = $_POST['code_of_conduct'];
    $_SESSION['cck_bx'] = $_POST['cck_bx'];
    $occ_city = $_SESSION['occ_city'];

    $firstname = $_SESSION['fname'];
    $lastname = $_SESSION['lname'];
    $birthday = $_SESSION['dday'] . '/' . $_SESSION['dmonth'] . '/' . $_SESSION['dyear'];
    $migratedday = $_SESSION['mday'] . '/' . $_SESSION['mmonth'] . '/' . $_SESSION['myear'];
    $currentAge = $_SESSION['cur_age'];
    $schoolClass = str_replace("'", " ", $_SESSION['sc_cl']);
    $gender = $_SESSION['gender'];
    $mobTel = $_SESSION['mtel'];
    $guardianName = $_SESSION['guardian_name'];
    $relationChild = $_SESSION['rel_child'];
    $address = $_SESSION['addr'];
    $address2 = $_SESSION['addr2'];
    $cityofuk = $_SESSION['cityofuk'];
    $counties = $_SESSION['counties'];
    $postcode = $_SESSION['postcode'];
    $countries = $_SESSION['countries'];
    $dayTimeTel = $_SESSION['dtimetel'];
    $evenTimeTel = $_SESSION['etimetel'];
    $emailAddress = $_SESSION['email'];
    $emergencyContactName = $_SESSION['emerg_name'];
    $emergencyContactChild = $_SESSION['rel_child_emg'];
    $emergencyContactAddr = $_SESSION['addr_emg'];
    $emergencyContactDayTel = $_SESSION['dtimetel_emg'];
    $emergencyContactEvenTel = $_SESSION['etimetel_emg'];
    $emergencyemail = $_SESSION['email_emg'];
    $sid = $_SESSION['sid'];
    $childPlay = $_SESSION['chld_ply'];
    $played = $_SESSION['played_cricket1'] . '|' . $_SESSION['played_cricket2'] . '|' . $_SESSION['played_cricket3'] . '|' . $_SESSION['played_cricket4'] . '|' . $_SESSION['played_cricket5'] . '|' . $_SESSION['played_cricket6'];
    $careImpairment = $_SESSION['care_impairment'];
    $impairments = $_SESSION['impairment1'] . '|' . $_SESSION['impairment2'] . '|' . $_SESSION['impairment3'] . '|' . $_SESSION['impairment4'] . '|' . $_SESSION['impairment5'];
    $otherSpcf = $_SESSION['other_spcf'];
    $otherSpc = $_SESSION['other_spc'];
    $additional = $_SESSION['additional_info'];
    $doctorName = $_SESSION['name_dr'];
    $doctorTel = $_SESSION['tel_dr'];
    $consent = $_SESSION['medic_consent'] . '|' . $_SESSION['medic_consent_child'];
    $sid = $_SESSION['sid'];
    $source_type = $_SESSION['source_type'];

    $cirlce = $_SESSION['appropriate_ans1'] . '|' . $_SESSION['appropriate_ans2'] . '|' . $_SESSION['appropriate_ans3'] . '|' . $_SESSION['appropriate_ans4'] . '|' . $_SESSION['appropriate_ans5'];
    $club = $_SESSION['club_constitution'];
    $code = $_SESSION['code_of_conduct'];
    $terms = $_SESSION['cck_bx'];


    $emgcity = $_SESSION['cityofuk_emg'];
    $emgcounty = $_SESSION['counties_emg'];
    $emgpost = $_SESSION['postcode_emg'];
    $dateRegistration = date('m/d/Y h:i:s a', time());

    $cricket_played = str_replace(" ", "_", $played);
    $impairment = str_replace(" ", "_", $impairments);
    $codesofconduct = $club . '|' . $code;
    $date = date("Y-m-d");

    $fulladdress = $address . '|' . $address2;
    $status = '1';


    //Discounted amount starts here
    $discountAmount = mysql_query("select discounted_amount from `discounted_amount` where `fname` = '$firstname' and `lname` = '$lastname' and `date_birth` = '$birthday' and `status` = 1");
    $discamount = mysql_fetch_array($discountAmount);
    $discamount['discounted_amount'];
    if ($discamount['discounted_amount']) {
        $totalprice = $discamount['discounted_amount'];
    } else {
        $totalprice = $_SESSION['total_price'];
    }
    //Discounted amount ends here

    //season of registered person.
    $dt = new date_math_class;
    //get today date
    $currentdate = date('Y-m-d');
    $currentmonth = date('m');
    $currentyear = date('Y');

    //CASE 1 - For Registrations before 1st October
    if ($currentmonth<10) {

        $isAfter30September = true;
        $season_id = $dt->RegistrantSeason($isAfter30September);

    }
    //CASE 2 - For Registrations after 30th septemebr
    elseif($currentmonth>9){

        $isAfter30September = false;
        $season_id = $dt->RegistrantSeason($isAfter30September);

    }

    //Colts information inserts
    $query = "call occ_registrant('NULL','" . $firstname . "','" . $lastname . "','" . $birthday . "','" . $currentAge . "','" . $gender . "','" . $mobTel . "','" . $schoolClass . "','NA','" . $guardianName . "','" . $relationChild . "','" . $fulladdress . "','" . $cityofuk . "','" . $counties . "','" . $postcode . "','" . $dayTimeTel . "','" . $evenTimeTel . "','" . $emailAddress . "','" . $emergencyContactName . "','NA','" . $emergencyContactChild . "','" . $emergencyContactAddr . "','" . $emgcity . "','" . $emgcounty . "','" . $emgpost . "','" . $emergencyContactDayTel . "','" . $emergencyContactEvenTel . "','" . $emergencyemail . "','" . $childPlay . "','" . $cricket_played . "','" . $otherSpc . "','" . $careImpairment . "','" . $impairment . "','" . $otherSpcf . "','" . $additional . "','" . $doctorName . "','" . $doctorTel . "','" . $consent . "','" . $cirlce . "','" . $date . "','" . $codesofconduct . "','" . $terms . "','" . $totalprice . "','" . $sid . "','" . $dateRegistration . "','" . $source_type . "','" . $status . "','" . $countries . "','" . $migratedday . "','" . $occ_city . "','" . $season_id . "')";

    if (mysql_query($query)) {

        //colts payment records inserting
        //Mail procedure of colts registration starts here

        $selectTmpQ = "SELECT `empl_id`, `empl_name`, `empl_src_code`, `empl_created_date`, `empl_status` FROM `email_tmpl` WHERE `empl_id`=4";
        $resultTmp = mysql_query($selectTmpQ);
        $selectedTemp = mysql_fetch_array($resultTmp);
        $selectedTemp = base64_encode($selectedTemp['empl_src_code']);

        $NameofPerson = $firstname . '&nbsp;' . $lastname;
        $body = base64_decode($selectedTemp); //readTemplateFile("reg_colt.html");
        $headers = "From: omer@osterleycc.com";
        $headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
        $body = str_replace("#fullname#", $NameofPerson, $body);
        //$estatus = mail($emailAddress, " Registration Successful ", $body, $headers);

//	include("imail/PHPMailer-master/PHPMailerAutoload.php");
//
//	 $mail = new PHPMailer(true);
//
//	//Send mail using gmail
//	$mail->IsSMTP(); // telling the class to use SMTP
//	$mail->SMTPAuth = true; // enable SMTP authentication
//	//$mail->SMTPSecure = "tls"; // sets the prefix to the servier
//	$mail->Host = "shared7.hostwindsdns.com"; // sets GMAIL as the SMTP server
//	$mail->Port = 465; // set the SMTP port for the GMAIL server
//	$mail->Username = "info@osterleycc.com"; // GMAIL username
//	$mail->Password = "InfO@Osdt23456"; // GMAIL password @@WELCOME@@777@@tds
//	$mail->SMTPSecure = "ssl";
//
//
//	//Typical mail data
//	$mail->AddReplyTo('info@osterleycc.com',"Osterley Cricket Club");
//	$mail->AddAddress($emailAddress);
//	$mail->SetFrom('info@osterleycc.com', 'Osterley Cricket Club');
//	$mail->Subject = "Registration Successful";
//	//echo $_POST['subject'];
//
//	$mail->MsgHTML($body);
//
//	if(!$mail->send()) {
//		//echo 'Message could not be sent.';
//		echo 'Mailer Error: ' . $mail->ErrorInfo;
//	}
        //Mail procedure of colts registration ends here
    } else {
        mysql_error() . '<hr>';
    }
} else {
    header("Location:index.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>

    <script type='text/javascript'>
        (function (d, t) {
        /* var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
         bh.type = 'text/javascript';
         bh.src = '//www.bugherd.com/sidebarv2.js?apikey=bshfgpegfciiwavc7a2xgg';
         s.parentNode.insertBefore(bh, s);
         })(document, 'script'); */


    </script>

    <meta charset="utf-8">
    <title>Osterley Cricket Club | Colt Registration Form</title>
    <link rel="icon" type="image/png" href="favicon.ico">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Pace -->
    <link href="css/pace.css" rel="stylesheet">

    <!-- Datatable -->
    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">

    <link rel="stylesheet" media="screen" href="css/reset.css">
    <link rel="stylesheet" media="screen" href="css/styles.css">

    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/gen_validatorv4.js"></script>


</head>

<body>
<div id="container">
    <div id="wrapper">
        <?php include("header.php"); ?>
        </header>
        <div id="tabs-container">
            <div class="top-menus">
                <div class="floatLeft tab">Colts Information</div>
                <div class="floatLeft tab spacing-tab">Sporting Information</div>
                <div class="floatLeft tab spacing-tab">Information</div>
                <div class="floatLeft tab spacing-tab">Submission &amp; Checklist</div>
                <div class="floatLeft tab spacing-tab tabsactive">Application Complete</div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="content">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="form1">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="omer@osterleycc.com">
                <input type="hidden" name="item_name" value="Osterley Colts Registration - Annual Subs">
                <input type="hidden" name="custom" value="<?php echo $sid; ?>">
                <input type="hidden" name="amount" value="<?php echo $totalprice; ?>">
                <input type="hidden" name="first_name" value="<?php echo $firstname; ?>">
                <input type="hidden" name="last_name" value="<?php echo $lastname; ?>">
                <input type="hidden" name="address1" value="<?php echo $address; ?>">
                <input type="hidden" name="address2" value="<?php echo $address2; ?>">
                <input type="hidden" name="city" value="London">
                <input type="hidden" name="zip" value="<?php echo $postcode; ?>">
                <input type="hidden" name="currency_code" value="GBP">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="return" value="http://www.osterleycc.com/apply/thankyou.html">
                <input type="hidden" name="cancel_return" value="http://www.osterleycc.com/apply/abort.html">
                <input type="hidden" name="notify_url" value="http://www.osterleycc.com/apply/ipn2.php">

                <div class="padding-md">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>Application Summary</strong>

                                </div>
                                <table class="table table-bordered table-condensed table-hover table-striped"
                                       id="responsiveTable" style="border: 1px solid black; width: 100%; word-wrap:break-word;
              table-layout: fixed;">
                                    <thead>
                                    <tr>

                                        <th>Registrant</th>
                                        <th>Value</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Colts Full Name :</td>
                                        <td><?php echo $firstname . '&nbsp;' . $lastname . '&nbsp;' . $guardianName; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Date of Birth:</td>
                                        <td><?php echo $birthday; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Gender :</td>
                                        <td><?php echo $gender; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Current Age :</td>
                                        <td><?php echo $currentAge; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Name of School/College :</td>
                                        <td><?php echo $schoolClass; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Parent/Guardian Name :</td>
                                        <td><?php echo $guardianName; ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Relationship to child :</td>
                                        <td><?php echo $relationChild; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address line 1 :</td>
                                        <td><?php echo $address; ?> </td>
                                    </tr>
                                    <?php if ($address2) { ?>
                                        <tr>
                                            <td>Address line 2 :</td>
                                            <td><?php echo $address2; ?> </td>
                                        </tr>
                                    <?php }
                                    $queries = mysql_query("select * from uk_city as ct, uk_county as cc where ct.Id = '$cityofuk' and cc.Id = '$counties'");
                                    $fetch = mysql_fetch_array($queries);
                                    ?>
                                    <tr>
                                        <td>United Kingdom Cities :</td>
                                        <td><?php echo $fetch['cities_name']; ?> </td>
                                    </tr>

                                    <tr>
                                        <td>United Kingdom Counties :</td>
                                        <td><?php echo $fetch['counties_name']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Postal code :</td>
                                        <td><?php echo $postcode; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Daytime telephone number :</td>
                                        <td><?php echo $dayTimeTel; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Evening telephone number :</td>
                                        <td><?php echo $evenTimeTel; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Email :</td>
                                        <td><?php echo $emailAddress; ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Total Price :</td>
                                        <td><?php echo $totalprice; ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>

                                    </tr>

                                    <tr>
                                        <td style="text-align:right;">
                                            <img src="images/money.png" width="73" height="45"></td>
                                        <td>
                                            <label class="label-radio">
                                                <input type="radio" value="4" id="pay1" name="pay" class="radioBtnClass">
                                                <span class="custom-radio"></span>
                                                Pay in Person (Cash or Cheque)
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align:right;">
                                            <img src="images/paypa.png" width="73" height="44">
                                        </td>
                                        <td>
                                            <label class="label-radio">
                                                <input type="radio" value="5" id="pay2"
                                                       name="pay" class="radioBtnClass" disabled>
                                                <span class="custom-radio"></span>
                                                Pay via Debit or Credit Card (Paypal)
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align:right;">
                                            <img src="images/bank.png" width="73" height="44">
                                        </td>
                                        <td>
                                            <label class="label-radio">
                                                <input type="radio" value="6" id="pay3"
                                                       name="pay" class="radioBtnClass">
                                                <span class="custom-radio"></span>
                                                Pay via Bank Transfer
                                                <a style="color: blue;" target="_blank" href="download.php">Download Bank Detail</a>
                                            </label>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align:right;">
                                            <input type="button" value="Continue" id="submit" class="submit">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="step3.php"
                                               style="width: 101px;color: #fff;background-color: #C00;border: 1px solid #C00;">Back</a>
                                            <input type="submit" id="bac" name="bac" style="display:none;">
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div><!-- /panel -->
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="jstheme/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Datatable -->
<script src='jstheme/jquery.dataTables.min.js'></script>

<!-- Modernizr -->
<script src='jstheme/modernizr.min.js'></script>

<!-- Pace -->
<script src='jstheme/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='jstheme/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='jstheme/jquery.slimscroll.min.js'></script>

<!-- Cookie -->
<script src='jstheme/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="jstheme/endless/endless.js"></script>

<script type="text/javascript">
    $(document).ready(function (e) {

        $("#submit").click(function (e) {
            if ($('input').is(":checked") == false) {
                alert("Please select payment method");
                return false;

            }

            if($("input[type='radio'].radioBtnClass").is(':checked')) {
                var card_type = $("input[type='radio'].radioBtnClass:checked").val();
                  $.ajax({
                    url: "payinperson.php?uid=<?php echo $sid; ?>&totalprice=<?php echo $totalprice; ?>&method="+card_type,
                    type:'GET',
                    cache: false,
                    success: function(data){
                        if(data=='success') {
                            //window.location.assign("http://www.osterleycc.com/apply/thankyou2.html");
                            alert("OK");
                        }
                    }
                });
            }

//            if ($('#pay1').is(":checked") == true) {
//
//                $.ajax({
//                    url: "payinperson.php?uid=<?php //echo $sid; ?>//&totalprice=<?php //echo $totalprice; ?>//",
//                    cache: false,
//                    success: function(data){
//                        if(data=='success') {
//                            window.location.assign("http://www.osterleycc.com/apply/thankyou2.html");
//                        }
//                    }
//                });
//
//
//                //window.location.assign("http://localhost/apply2/thankyou2.html");
//            }

//            if ($("#pay2").attr('checked')) {
//
//                $("#bac").trigger('click');
//            }

        });
    });
</script>

</body>
</html>