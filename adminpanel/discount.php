<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
//add discount.
if (isset($_POST['submit']) && ($_REQUEST['discountid'] == '')) {

    $discountCode = $_POST['dscount'];
    $first = $_POST['fname'];
    $firstname = strtolower($first);
    $last = $_POST['lname'];
    $lastname = strtolower($last);
    $birth = $_POST['birthday_day'] . '/' . $_POST['birthday_month'] . '/' . $_POST['birthday_year'];
    $amount = $_POST['fnamount'];
    $atStatus = $_POST['status'];
//$queryString = mysql_query("select * from `app_form` where cs_fname = '$firstname' and cs_sname = '$lastname' and cs_birth = '$birth'");
//if(mysql_num_rows($queryString) > 0)
//{
    if (mysql_query("INSERT INTO `discounted_amount` VALUES ('', '$firstname', '$lastname', '$birth', '$amount', '$atStatus', '1')"))
        $message = "Dicount Added Successfully!.";
    message($message);
    redirect_to("discount_list.php");
    die();
//}
}
//update discount
if (isset($_POST['submit']) && (!empty($_REQUEST['discountid'])) ) {

    $discountid = $_REQUEST['discountid'];

    $discountCode = $_POST['dscount'];
    $first = $_POST['fname'];
    $firstname = strtolower($first);
    $last = $_POST['lname'];
    $lastname = strtolower($last);
    $birth = $_POST['birthday_day'] . '/' . $_POST['birthday_month'] . '/' . $_POST['birthday_year'];
    $amount = $_POST['fnamount'];
    $atStatus = $_POST['status'];

    $updateQ = "UPDATE `discounted_amount` SET `fname`='$firstname',`lname`='$lastname',`date_birth`='$birth',`discounted_amount`='$amount',`status`='$atStatus',`user_id`= '1' WHERE Id = $discountid";
    $result  = mysql_query($updateQ);
    $message = "Dicount Updated Successfully!.";
    message($message);
    redirect_to("discount_list.php");
    die();
//}
}
//load discount form values
if (!empty($_REQUEST['discount_id'])) {

    $discount_id = $_REQUEST['discount_id'];
    $query = "SELECT `Id`, `fname`, `lname`, `date_birth`, `discounted_amount`, `status`, `user_id` FROM `discounted_amount` WHERE  Id =  $discount_id";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
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

    <div id="main-container" style="margin-left:0px; margin-top: 40px;;">

        <div class="padding-md edit-reg-form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><?php if (!empty($discount_id)) {
                            echo "Edit";
                        } else {
                            echo "Add";
                        } ?> Discount</h2>

                </div>
                <div class="panel-body">
                    <form id="formToggleLine" class="form-horizontal no-margin form-border" name="paym1" method="post"
                          action="<?php  $_SERVER['PHP_SELF']; ?>?discountid=<?php echo $discount_id; ?>">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">First name :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php if (isset($row['fname'])) {
                                    echo $row['fname'];
                                } ?>" name="fname" required id="fname" class="form-control">
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Last name :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php if (isset($row['lname'])) {
                                    echo $row['lname'];
                                } ?>" name="lname" required id="lname" class="form-control">
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <?php if (isset($row['date_birth'])) {
                            $dob = explode("/", $row['date_birth']); //print_r($dob);
                        } ?>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Date of birth :</label>
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <select name="birthday_day" required id="birthday_day_fac" class="form-control"
                                                style="border:1px solid #ddd; border-radius:5px; padding:5px;"
                                                aria-label="Day">
                                            <option value="">Day :</option>
                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php if(isset($row['date_birth']) && ($dob[0] == $i) ){echo "selected"; } ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div><!-- /.col -->
                                    <div class="col-lg-3">
                                        <select name="birthday_month" required id="birthday_month_fac"
                                                aria-label="Month" class="form-control">
                                            <option value="">Month</option>
                                            <option value="Jan" <?php if(isset($row['date_birth']) && ($dob[1] == 'Jan') ) {echo "selected"; } ?>>Jan</option>
                                            <option value="Feb" <?php if(isset($row['date_birth']) && ($dob[1] == 'Feb') ) {echo "selected"; } ?>>Feb</option>
                                            <option value="Mar" <?php if(isset($row['date_birth']) && ($dob[1] == 'Mar') ) {echo "selected"; } ?>>Mar</option>
                                            <option value="Apr" <?php if(isset($row['date_birth']) && ($dob[1] == 'Apr') ) {echo "selected"; } ?>>Apr</option>
                                            <option value="May" <?php if(isset($row['date_birth']) && ($dob[1] == 'May') ) {echo "selected"; } ?>>May</option>
                                            <option value="Jun" <?php if(isset($row['date_birth']) && ($dob[1] == 'Jun') ) {echo "selected"; } ?>>Jun</option>
                                            <option value="Jul" <?php if(isset($row['date_birth']) && ($dob[1] == 'Jul') ) {echo "selected"; } ?>>Jul</option>
                                            <option value="Aug" <?php if(isset($row['date_birth']) && ($dob[1] == 'Aug') ) {echo "selected"; } ?>>Aug</option>
                                            <option value="Sep" <?php if(isset($row['date_birth']) && ($dob[1] == 'Sep') ) {echo "selected"; } ?>>Sep</option>
                                            <option value="Oct" <?php if(isset($row['date_birth']) && ($dob[1] == 'Oct') ) {echo "selected"; } ?>>Oct</option>
                                            <option value="Nov" <?php if(isset($row['date_birth']) && ($dob[1] == 'Nov') ) {echo "selected"; } ?>>Nov</option>
                                            <option value="Dec" <?php if(isset($row['date_birth']) && ($dob[1] == 'Dec') ) {echo "selected"; } ?>>Dec</option>
                                        </select>
                                    </div><!-- /.col -->
                                    <div class="col-lg-3">
                                        <select name="birthday_year" required id="birthday_year_fac" aria-label="Year"
                                                class="form-control">
                                            <option value="">Year :</option>
                                            <?php for ($ye = 1994; $ye <= 2013; $ye++) { ?>
                                                <option value="<?php echo $ye; ?>" <?php if(isset($row['date_birth']) && ($dob[2] == $ye) ) {echo "selected"; } ?>><?php echo $ye; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.col -->
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Final amount :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php if (isset($row['discounted_amount'])) {
                                    echo $row['discounted_amount'];
                                } ?>" name="fnamount" required id="fnamount" class="form-control">
                            </div><!-- /.col -->
                        </div><!-- /form-group -->


                        <div class="form-group">
                            <label class="col-lg-12 control-label" style="text-align:center;">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                            </label>

                        </div><!-- /form-group -->
                        <input type="hidden" value="1" name="status" id="status">
                        <input type="hidden" value="1" name="user_id" id="user_id">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>
	
