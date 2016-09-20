<?php session_start(); ?>
<?php if (isset($_SESSION['UserName'])) {
    $username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];
} else {
    header("Location:index.php");
    die();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Osterley Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>	

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Pace -->
    <link href="css/pace.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-landing.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="css/styles.css" rel="stylesheet">

</head>

<body class="overflow-hidden">
<!-- Overlay Div -->
<div id="overlay" class="transparent"></div>

<div id="wrapper" class="preload">

    <header class="navbar navbar-fixed-top bg-white">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand"><span class="text-danger">OsterleyCC</span> - Admin</a>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <ul class="nav navbar-nav logout-right">
                    <li>
                        <a class="main-link logoutConfirm_open top-link" href="log_out.php">Log out</a>
                    </li>

                </ul>
            </nav>
        </div>
    </header>

    <div id="landing-content">
        <div class="padding-md">
            <div class="container">
                <div class="maincontent"><img src="images/sitelogo1.png"/></div>
                <div class="row" style="margin-top: 30px;">
                    <?php if (isset($_SESSION['UserName']) && $_SESSION['UserName'] == 'Administrator'): ?>
                        <div class="col-sm-4 content-padding">
                            <a class="btn btn-lg btn-primary3"
                               href="colts_info.php?action=<?php echo $username; ?>&type=Colts">Manage
                                Colts Registrations</a>
                        </div><!-- /.col -->
                        <div class="col-sm-4 content-padding">
                            <a class="btn btn-lg btn-primary3"
                               href="adutls_info.php?action=<?php echo $username; ?>&type=Adults">Manage Adults
                                Registrations</a>
                        </div><!-- /.col -->
                        <div class="col-sm-4 content-padding">
                            <a class="btn btn-lg btn-primary3"
                               href="social_info.php?action=<?php echo $username; ?>&type=Socials">Manage Social
                                Memberships</a>
                        </div><!-- /.col -->
                    <?php else: ?>
                        <div class="col-sm-4 content-padding">&nbsp;</div>
                        <div class="col-sm-4 content-padding">
                            <a class="btn btn-lg btn-primary3"
                               href="colts_info.php?action=<?php echo $username; ?>&type=Colts">Manage
                                Colts Registrations</a>
                        </div><!-- /.col -->
                        <div class="col-sm-4 content-padding">&nbsp;</div>
                    <?php endif; ?>
                </div><!-- /.row -->
            </div>

        </div>

    </div><!-- /landing-content -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 padding-md">

                </div><!-- /.col -->

                <div class="col-sm-3 padding-md">

                </div><!-- /.col -->
                <div class="col-sm-3 padding-md">

                </div><!-- /.col -->
                <div class="col-sm-3 padding-md">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </footer>
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
<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="jstheme/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Waypoint -->
<script src='jstheme/waypoints.min.js'></script>

<!-- LocalScroll -->
<script src='jstheme/jquery.localscroll.min.js'></script>

<!-- ScrollTo -->
<script src='jstheme/jquery.scrollTo.min.js'></script>

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

<script>
    $(function () {
        $('.animated-element').waypoint(function () {

            $(this).removeClass('no-animation');

        }, {offset: '70%'});

        $('.nav').localScroll({duration: 800});
    });
</script>

</body>
</html>
