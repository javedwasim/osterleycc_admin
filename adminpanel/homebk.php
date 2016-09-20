<!DOCTYPE html>
<?php session_start(); ?>
<?php if (isset($_SESSION['UserName'])) {
    $username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];
} else {
    header("Location:index.php");
    die();
} ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> OCC - Administrtion Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">


</head>

<body>
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>
<div id="wrapper">

    <div id="top-nav" class="skin-6 fixed">
        <div class="brand3">
            <span>Osterley Crick Club  - Administrtion Portal</span>
        </div><!-- /brand -->
        <div class="brand3" style="float: right;">
            <a  class="main-link logoutConfirm_open" style = "color:#FFFFFF !important;" href="log_out.php">
             Log out</a>
        </div>
    </div><!-- /top-nav-->
    <div class="padding-md" style="margin-top:100px;">
        <!--<h1 style=" text-align: center;">Dashboard</h1>-->
        <div style=" text-align: center;"><img src="images/sitelogo1.png"/></div>

        <div class="row">


            <div class="panel-body" style="text-align: center; padding: 50px;">


                <?php if (isset($_SESSION['UserName']) && $_SESSION['UserName'] == 'Administrator'): ?>

                    <div class="col-md-4 col-sm-4">

                        <a class="btn btn-lg btn-primary3"
                           href="colts_info.php?action=<?php echo $username; ?>&type=Colts">Manage
                            Colts Registrations</a>

                    </div>

                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-lg btn-primary3"
                           href="adutls_info.php?action=<?php echo $username; ?>&type=Adults">Manage Adults
                            Registrations</a>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-lg btn-primary3"
                           href="social_info.php?action=<?php echo $username; ?>&type=Socials">Manage Social
                            Memberships</a>
                    </div>

                <?php else: ?>

                    <div class="col-md-4 col-sm-4">&nbsp;</div>

                    <div class="col-md-4 col-sm-4">

                        <a class="btn btn-lg btn-primary3"
                           href="colts_info.php?action=<?php echo $username; ?>&type=Colts">Manage
                            Colts Registrations</a>

                    </div>

                    <div class="col-md-4 col-sm-4">&nbsp; </div>

                <?php endif; ?>

            </div>

        </div>


    </div><!-- /.padding-md -->
</div><!-- /wrapper -->
<!-- Logout confirmation -->
<div class="custom-popup width-100" id="logoutConfirm">
    <div class="padding-md">
        <h4 class="m-top-none"> Do you want to logout?</h4>
    </div>

    <div class="text-center">
        <a class="btn btn-success m-right-sm" href="<?php echo "log_out.php" ?>">Logout</a>
        <a class="btn btn-danger logoutConfirm_close">Cancel</a>
    </div>
</div>
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

<!-- Cookie -->
<script src='jstheme/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="jstheme/endless/endless.js"></script>

</body>

<script type="text/javascript">
    $(document).ready(function (e) {
        $("#pay_anchor").click(function (e) {
            $("#progress").show();
        });
    });
</script>

</html>
