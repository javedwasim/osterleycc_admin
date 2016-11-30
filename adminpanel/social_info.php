<?php
session_start();
$_SESSION['source_type'] = 3;
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");
include("DateMathClassA.php");

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

//Select all season for registerant.
$squery = "SELECT `id`, `seasonyear`, `seasonname`  FROM `season` WHERE 1";
$sreault = mysql_query($squery);
//print_r($srow);

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
    <!-- Font Awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- Datatable -->
    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">


    <link rel="stylesheet" media="screen" href="css/styles.css">
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript">

        $(document).ready(function (e) {

            $("#pay_anchor").click(function (e) {

                $("#progress").show();

            });
        });

    </script>
</head>
<body>

<div id="page-wrapper">

    <div id="content-manage">

        <?php

        if ($_SESSION['Administrator']) {
            include("navigation_bar.php");
        } else {
            include("banner.php");
        }

        ?>

        <?php

        # create the date math object
        $dt = new date_math_class;
        //get month of current year
        $currentMonth = date("m");

        //Get  season id current seassion.
        if ($currentMonth<10) {

            $isAfter30September = true;
            $season_id = $dt->RegistrantSeason($isAfter30September);

        }
        //CASE 2 - For Registrations after 30th septemebr
        elseif($currentMonth>9){

            $isAfter30September = false;
            $season_id = $dt->RegistrantSeason($isAfter30September);

        }


        //filter by season
        if(isset($_REQUEST['sort_season']) && !empty($_REQUEST['sort_season'])){
            $season_id = $_REQUEST['sort_season'];
            $query_source = "SELECT * FROM `occ_registrant` WHERE `source_type` = 3 and `season_id` = $season_id ";

        }else{

            if(isset($_REQUEST['sort_season']) && empty($_REQUEST['sort_season'])){

                $query_source = "SELECT * FROM `occ_registrant` WHERE `source_type` = 3 ORDER BY occ_firstname , occ_lastname , occ_birthday ASC";
                $season_id = "";

            }else{
                $query_source = "SELECT * FROM `occ_registrant` WHERE `source_type` = 3 and `season_id` = $season_id";
            }

        }

        $fetch_source = mysql_query($query_source);
        $total_records = mysql_num_rows($fetch_source);
        ?>
        <div class="panel panel-default table-responsive" style="margin-top: 75px;">
            <div style="padding: 15px 0 10px 0;">

                <div id="container" class="occ-filter">
                    <form name="sortingForm" id="sortingForm" action="social_info.php" method="post">
                        <div id="sortby" style="margin: 20px 0 15px 0;">
                            <strong>Filter By Season:</strong>
                            <select name="sort_season" id="sort_season" onchange="this.form.submit()" class="form-control">
                                <option value=""> -- Select Season --</option>
                                <?php while($srow = mysql_fetch_array($sreault)) { ?>
                                    <option value="<?php echo $srow['id']; ?>" <?php if(isset($srow['id']) && ($srow['id'] == $season_id)){echo "selected";} ?>><?php echo $srow['seasonname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="panel-heading">
                    <a href="#" class="shortcut-link payinfo-link" style="float: left;margin: 15px 0 15px 0;">
					<span class="shortcut-icon">
						<i class="fa fa-group"></i>
					</span>
                        <span class="text payinfo">Social Registrations</span>
                    </a>

                    <a href="#" class="shortcut-link" style="float: right; margin: 15px 10px 15px 0;">
					<span class="label label-info3 pull-right payinfo-record"
                          style="margin-top: 15px; font-weight: 100"><?php echo $total_records . " Records"; ?></span>
                    </a>

                </div>
            </div>
            <div class="padding-md clearfix">
                <h4 style="color: green;"><?php if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    } ?></h4>
                <table class="table table-striped" id="dataTable1">
                    <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>D.O.B</th>
                        <th width="7%">Gender</th>
                        <th>Contact no</th>
                        <th>Job title</th>
                        <th width="15%">Email</th>
                        <th width="6%">Price</th>
                        <th>Reg.Date</th>
                        <th width="12%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php while ($src = mysql_fetch_array($fetch_source)) { ?>
                    <tr class="records-row">
                        <td><?php echo $src['occ_firstname'] . '&nbsp;' . $src['occ_lastname']; ?></td>
                        <td><?php echo $src['occ_birthday']; ?></td>
                        <td><?php echo $src['occ_age']; ?></td>
                        <td><?php echo $src['occ_gender']; ?></td>
                        <td><?php echo $src['occ_sec2_daytimetel']; ?></td>
                        <td><?php echo $src['occ_sec2_emailaddress']; ?></td>
                        <td><?php echo $src['occ_total_price']; ?></td>

                        <td><?php echo $src['date_registration']; ?></td>

                        <td>
                            <a class="occ-action-icon <?php if ($src['status'] == 2) {
                                echo "occ-color-green";
                            } else {
                                echo "occ-color";
                            } ?>" title="<?php if ($src['status'] == 2) {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            } ?>" href="status_control.php?Id=<?php echo $src['Id']; ?>" id="anchor"
                               style="cursor:pointer;"><i class="fa <?php if ($src['status'] == 2) {
                                    echo "fa-check-circle";
                                } else {
                                    echo "fa-minus-circle";
                                } ?> fa-lg"></i></i><?php if ($src['status'] == 2) {
                                    echo "";
                                } else {
                                    echo "";
                                } ?></a> |
                            <a class="occ-action-icon" title="Email"
                               href="sendemail.php?UserId=<?php echo $src['Id']; ?>" id="anchor"
                               style="cursor:pointer;"><i class="fa fa-envelope-o"></i><span></span></a>|
                            <a class="occ-action-icon" title="Edit"
                               href="edit_social_control.php?id=<?php echo $src['Id']; ?>&user_id=<?php echo $src['sid']; ?>"
                               id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a> |
                            <a class="occ-action-icon" title="Delete"
                               onclick="return confirm('Are you sure you want to delete this record?');"
                               href="delete_payment.php?social_id=<?php echo $src['Id']; ?>" id="anchor"
                               style="cursor:pointer;"><i class="fa fa-trash-o"></i></a>


                            <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.padding-md -->
        </div>
    </div>

</div>
<?php include_once("footer.php"); ?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".linkStatus").live('click', function (e) {
            var self = $(this);
            var href = $(this).attr('href');
            $.get(href, {}, function (data) {
                if (data == 1) {
                    self.html('<img src="images/del-cross.png" width="16" height="16" id="show_status">');
                }
                else {
                    self.html('<img src="images/active.png" width="16" height="16" id="show_status">');
                }
            });
            return false;
        });
    });
</script>
