<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

//update user
if(!empty($_REQUEST['userid'])){

    $user_id = $_REQUEST['userid'];
    $adUserName = $_POST['userName'];
    $adpasWrd = $_POST['pasWrd'];
    $adMethod = $_POST['method1'];
    $adAccType = $_POST['accFor'];

    $update_query = "UPDATE `occ_admin` SET `occ_username`='$adUserName',`occ_password`='$adpasWrd',`occ_access_type`='$adAccType',`occ_status`='$adMethod' WHERE `Id`=$user_id";
    mysql_query($update_query);
    $message = "User Updated Successfully!";
    message($message);
    redirect_to("user_list.php");
    die();

}
$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];

$isPosted = count($_POST);
if (($isPosted > 0) && empty($_REQUEST['user_id'])) {
    $adUserName = $_POST['userName'];
    $adpasWrd = $_POST['pasWrd'];
    $adMethod = $_POST['method1'];
    $adAccType = $_POST['accFor'];

    $query = mysql_query("INSERT INTO `occ_admin` (`occ_username`,`occ_password`,`occ_access_type`,`occ_status`) VALUES ('$adUserName','$adpasWrd','$adAccType','$adMethod')");
    if (mysql_affected_rows() > 0) {
        $message = "User Added Successfully";
        message($message);
        header("Location: user_list.php");
    } else {
        echo mysql_error();
    }
}
//load user
if (isset($_REQUEST['user_id'])) {

    $user_id = $_REQUEST['user_id'];
    $select_query = "SELECT `Id`, `occ_username`, `occ_password`, `occ_access_type`, `occ_status` FROM `occ_admin` WHERE `Id` =$user_id";
    $result = mysql_query($select_query);
    $row = mysql_fetch_array($result);

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

    <div id="main-container" style="margin-left:0px; margin-top:40px;">

        <div class="padding-md edit-reg-form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><?php if(!empty($user_id)){echo "Edit"; }else{echo "Add";} ?> User</h2>

                </div>
                <div class="panel-body">
                    <form id="formToggleLine" class="form-horizontal no-margin form-border" name="paym1" method="post"
                          action="<?php echo $_SERVER['PHP_SELF']; ?>?userid=<?php echo $user_id; ?>">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Username :</label>
                            <div class="col-lg-10">
                                <input type="text" value="<?php if(isset($row['occ_username'])){echo $row['occ_username']; } ?>" required name="userName" id="userName" class="form-control">
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Password :</label>
                            <div class="col-lg-10">
                                <input type="password" value="<?php if(isset($row['occ_password'])){echo $row['occ_password']; } ?>" required name="pasWrd" id="pasWrd" class="form-control">
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Access / Authority :</label>
                            <div class="col-lg-10">
                                <select name="method1" id="method1" class="form-control">
                                    <option value="1" <?php if(($row['occ_status'])==1 ){echo "selected";} ?>>Admin</option>
                                    <option value="2" <?php if(($row['occ_status'])!=1 ){echo "selected";} ?>>Coach</option>
                                </select>
                            </div><!-- /.col -->
                        </div><!-- /form-group -->

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Access/Authority For :</label>
                            <div class="col-lg-10">
                                <select name="accFor" id="accFor" class="form-control">
                                    <option value="1" <?php if(($row['occ_access_type'])==1 ){echo "selected";} ?>>Colts</option>
                                    <option value="2" <?php if(($row['occ_access_type'])==2 ){echo "selected";} ?>>Adults</option>
                                    <option value="3" <?php if(($row['occ_access_type'])==3 ){echo "selected";} ?>>Both</option>
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
	