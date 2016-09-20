<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator'){redirect_to("home.php"); die(); }

$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];
?>
<?php
if(isset($_REQUEST['discount_id']) && !empty($_REQUEST['discount_id'])){

    $discount_id= $_REQUEST['discount_id'];
    $delete_query = "delete from discounted_amount where Id = $discount_id ";
    $emailTemplates = mysql_query($delete_query);
    message("Discount deleted succesfully!");
    redirect_to("discount_list.php");
    die();
}

$discounts = mysql_query("select * from discounted_amount");
$rowCount = mysql_num_rows($discounts);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
						&nbsp;
					</span>
                        <span class="text payinfo">Discounts</span>
                    </a>

                    <a href="discount.php" class="shortcut-link payinfo-link">
					<span class="shortcut-icon">
						<i class="fa fa-plus-circle"></i>

					</span>
                        <span class="text">Add Discount</span>
                    </a>



                    <a href="#" class="shortcut-link" style = "float: right;">
					<span class="label label-info3 pull-right payinfo-record"
                          style="margin-top: 15px;"><?php echo $rowCount . " Records"; ?></span>
                    </a>

                </div>
                <?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?>
                <table class="table table-striped" id="dataTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>D.O.B</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php while ($r = mysql_fetch_array($discounts)) {  ?>
                        <tr class="records-row">
                            <td><?php echo $r['fname']." ".$r['lname']; ?></td>
                            <td><?php  echo $r['date_birth']; ?></td>
                            <td><?php  echo $r['discounted_amount']; ?></td>
                            <td>
                                <a class="occ-action-icon" title = "Edit" href="discount.php?discount_id=<?php echo $r['Id'];?>" id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a> |
                                <a class="occ-action-icon" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');" href="?discount_id=<?php echo $r['Id'];?>" id="anchor" style="cursor:pointer;" ><i class="fa fa-trash-o"></i></a>
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

