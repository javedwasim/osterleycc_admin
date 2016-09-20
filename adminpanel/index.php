<?php
include("include/db_config.php");
include("DateMathClassA.php");

if ($_POST['usn-admin']) {

    # create the date math object
    $dt = new date_math_class;

    //get today date
    $currentdate = date('Y-m-d');
    $currentmonth = date('m');
    $currentyear = date('Y');

    //$currentdate = '2016-10-1';
    //$currentmonth = 10;

    //CASE 1 - For Registrations before 1st October
    if ($currentmonth<10) {

        $isAfter30September = true;
        $dt->RegistrantSeason($isAfter30September);

    }
    //CASE 2 - For Registrations after 30th septemebr
    elseif($currentmonth>9){

        $isAfter30September = false;
        $dt->RegistrantSeason($isAfter30September);

    }

    $queryadm = mysql_query("SELECT * FROM `season` WHERE `occ_username` = '$user_name' AND `occ_password` = '$user_pass'");

    $adm_username = $_POST['usn-admin'];
    $adm_password = $_POST['usn-pwd'];
    $user_name = preg_replace('/[^A-Za-z0-9]/', '', $_POST['usn-admin']);
    $user_pass = preg_replace('/[^A-Za-z0-9]/', '', $_POST['usn-pwd']);
    $queryadm = mysql_query("SELECT * FROM `occ_admin` WHERE `occ_username` = '$user_name' AND `occ_password` = '$user_pass'");

    $row = mysql_fetch_array($queryadm);

    if (mysql_num_rows($queryadm) > 0) {

        $_SESSION['IsActive'] = true;
        $_SESSION['Id'] = $row['Id'];
        if ($row['occ_status'] == 1) {
            $_SESSION['Administrator'] = $row['occ_status'];
            $_SESSION['UserName'] = 'Administrator';
        } else {
            $_SESSION['UserName'] = 'Coach';
        }
        //header("Location:colts_info.php?action=WELCOME {$_SESSION['UserName']}");
        header("Location:home.php?action=WELCOME {$_SESSION['UserName']}");

        exit();

    } else {
        header("Location:index.php?action=failed");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">

</head>

<body>
<div class="login-wrapper" style="margin-top:100px;">
    <div class="text-center">
        <img src="images/sitelogo1.png"/>
        <!--
        <h2 class="fadeInUp animation-delay8" style="font-weight:bold">
            <span class="text-success">Osterleycc</span> <span style="color:#ccc; text-shadow:0 1px #fff">Admin</span>

        </h2>
        -->
    </div>
    <div class="login-widget animation-delay1">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <i class="fa fa-lock fa-lg"></i> Login
                </div>


            </div>
            <div class="panel-body">
                <form class="form-login" method="post" action="">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" placeholder="Username" name="usn-admin" id="usn-admin"
                               class="form-control input-sm bounceIn animation-delay2">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Password" name="usn-pwd" id="usn-pwd"
                               class="form-control input-sm bounceIn animation-delay4">
                    </div>


                    <div class="seperator"></div>


                    <hr/>
                    <button type="submit"
                            class="btn btn-primary btn-sm bounceIn animation-delay5 login-link pull-right"><i
                            class="fa fa-sign-in"></i>Sign in
                    </button>

                </form>
            </div>
        </div><!-- /panel -->
    </div><!-- /login-widget -->
</div><!-- /login-wrapper -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="jstheme/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Modernizr -->
<script src='jstheme/modernizr.min.js'></script>

<!-- Pace -->
<script src='jstheme/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='jstheme/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='jstheme/jquery.slimscroll.min.js'></script>


<!-- Endless -->
<script src="jstheme/endless/endless.js"></script>
</body>
</html>

