<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator'){redirect_to("home.php"); die(); }

$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];
?>
<?php
if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])){

    $user_id = $_REQUEST['user_id'];
    $delete_query = "delete from occ_admin where Id = $user_id ";
    $emailTemplates = mysql_query($delete_query);
    message("User deleted succesfully!");
    redirect_to("user_list.php");
    die();
}

$emailTemplates = mysql_query("select * from occ_admin");
$templateCount = mysql_num_rows($emailTemplates);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
    <!-- Font Awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- Datatable -->
    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet">

    <script>
        function showUser(val)
        {
            var method = $("#method1").val();
            window.location.assign("add_payment.php?uid="+method);
        }

    </script>
</head>
<body>

<div id="overlay" class="transparent"></div>
<div id="wrapper" class="preload">
    <?php
    if($_SESSION['Administrator']){
        include("navigation_bar.php");
    }else{
        include("banner.php");
    }
    ?>
    <div id="main-container" style = "margin-left:0px; margin-top: 40px;">
        <div class="panel panel-default table-responsive">
            <div class="padding-md clearfix">

                <div class="grey-container shortcut-wrapper">
                    <a href="#" class="shortcut-link payinfo-link" style = "float: left;">
					<span class="shortcut-icon">
						<i class="fa fa-user fa-lg"></i>
					</span>
                        <span class="text payinfo">Users</span>
                    </a>

                    <a href="add_user.php" class="shortcut-link payinfo-link">
					<span class="shortcut-icon">
						<i class="fa fa-plus-circle"></i>

					</span>
                        <span class="text">Add User</span>
                    </a>



                    <a href="#" class="shortcut-link" style = "float: right;">
					<span class="label label-info3 pull-right payinfo-record"
                          style="margin-top: 15px;"><?php echo $templateCount . " Records"; ?></span>
                    </a>

                </div>
                <?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?>
                <table class="table table-striped" id="dataTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Access Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php while ($r = mysql_fetch_array($emailTemplates)) {  ?>
                        <tr class="records-row">
                            <td><?php echo $r['occ_username']; ?></td>
                            <td><?php  if($r['occ_access_type'] == 1) {echo "Colts";} elseif($r['occ_access_type'] == 2){ echo "Adults";}elseif($r['occ_access_type'] == 3){echo "Both";} ?></td>
                            <td><?php  if($r['occ_status']==1) {echo "Admin";} else{ echo "Coach";} ?></td>
                            <td>
                                <a class="occ-action-icon" title = "Edit" href="add_user.php?user_id=<?php echo $r['Id'];?>" id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a> |
                                <a class="occ-action-icon" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');" href="?user_id=<?php echo $r['Id'];?>" id="anchor" style="cursor:pointer;" ><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php }  ?>
                    </tbody>
                </table>
            </div><!-- /.padding-md -->
        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>

