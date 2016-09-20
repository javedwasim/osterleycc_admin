<?php session_start(); ?>
<?php
if (isset($_SESSION['source_type'])) {

 $source_type = $_SESSION['source_type'];

 if ($source_type == 1) {
  $redirect_file = "colts_info.php";
 } elseif ($source_type == 2) {
  $redirect_file = "adutls_info.php";
 } elseif ($source_type == 3) {
  $redirect_file = "social_info.php";
 } else {
  $redirect_file = "home.php";
 }
}


?>

<header class="navbar navbar-fixed-top header-navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><span class="text-danger"><img height="45px"
                                                                            src="images/sitelogo1.png"/></span></a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="home.php" class="shortcut-link">
			            <span class="shortcut-icon occ-color">
				        <i class="fa fa-home"></i>
			            </span>
                        <span class="text occ-color">Home</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo $redirect_file; ?>" class="shortcut-link">
                    <span class="shortcut-icon occ-color">

                    <i class="fa fa-group"></i>

                    </span>
                        <span class="text occ-color">Registrations</span>
                    </a>
                </li>


                <li>
                    <a href="log_out.php" class="shortcut-link">
                        <span class="shortcut-icon occ-color">
                        <i class="fa fa-power-off"></i>
                        </span>
                        <span class="text occ-color">Logout</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</header>