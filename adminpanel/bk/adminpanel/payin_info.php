<?php
session_start();

if (isset($_SESSION['source_type'])) {
    $source_type = $_SESSION['source_type'];
}

include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");


if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];

$query1 = "SELECT * FROM occ_registrant as r, payment_recieved as p WHERE r.sid = p.uid and p.status = 1 and p.source_type = $source_type";
$pagination1 = mysql_query($query1);
$total_records = mysql_num_rows($pagination1);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- Datatable -->
    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">


    <link rel="stylesheet" media="screen" href="css/styles.css">
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <style>
        .tip {
            position: relative;
        }

        .tip p {
            display: none;
            position: absolute;
            z-index: 1000;
            top: -8px;
            left: -240px;
            width: 235px;
            background: #333;
            border: 1px solid black;
            color: white;
            -moz-border-radius: 3px;
            -webkit-border-radius: 2px;
            box-shadow: 3px 3px 3px #CCC;
            padding: 3px;
            box-sizing: border-box;
            -o-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        .tip:hover p {
            display: block;
        }
    </style>
</head>
<body style = "overflow-x: hidden;">

<div id="page-wrapper">
    <!--<header>
    <div id="header-content">Manage Applicants Settings</div>
    </header>-->
    <div id="content-manage">
        <?php
        if ($_SESSION['Administrator']) {
            include("navigation_bar.php");
        } else {
            include("banner.php");
        }
        ?>
        <div class="panel panel-default table-responsive" style="margin-top:75px;">
            <div class="padding-md clearfix">
                <div class="grey-container shortcut-wrapper">
                    <a href="#" class="shortcut-link payinfo-link" style = "float: left;">
					<span class="shortcut-icon">
						<i class="fa fa-money fa-lg"></i>
					</span>
                        <span class="text payinfo">Payments</span>
                    </a>

                    <a href="add_payment.php" class="shortcut-link payinfo-link">
					<span class="shortcut-icon">
						<i class="fa fa-plus-circle"></i>
						
					</span>
                        <span class="text">Add Payment</span>
                    </a>

                    <a href="discount_list.php" class="shortcut-link payinfo-link">
					<span class="shortcut-icon">
						<i class="fa fa-bullhorn"></i>
					</span>
                        <span class="text">Discount Code</span>
                    </a>

                    <a href="#" class="shortcut-link" style = "float: right;">
					<span class="label label-info3 pull-right payinfo-record"
                          style="margin-top: 15px;"><?php echo $total_records . " Records"; ?></span>
                    </a>

                </div>

                <table class="table table-striped" id="dataTable">
                    <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>D.O.B</th>
                        <th>Age (Years)</th>
                        <th>Age (Months)</th>
                        <th>Gender</th>
                        <th>Contact no.</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Reg.Date</th>
                        <th>Status</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    while ($r = mysql_fetch_array($pagination1)) { ?>
                    <tr class="records-row">
                        <td><?php echo $r['occ_firstname'] . '&nbsp;' . $r['occ_lastname']; ?></td>
                        <td><?php echo $r['occ_birthday']; ?></td>
                        <td>
                            <?php
                            $birthDate = $r['occ_birthday'];
                            //explode the date to get month, day and year
                            $birthDate = explode("/", $birthDate);

                            $birth_day = $birthDate[2] . "-" . $birthDate[1] . "-" . $birthDate[0];
                            $birth_day = date("Y-m-d", strtotime($birth_day));

                            if (isset($_GET['sort_age'])) {
                                //echo $r['occ_age'];
                                echo calculate_age($birth_day);
                            } else {

                                //get age from date or birthdate
                                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                //echo $age;
                                echo calculate_age($birth_day);
                            }
                            ?>
                        </td>
                        <td><?php echo calculate_agewithmonth($birth_day); ?></td>
                        <td><?php echo $r['occ_gender']; ?></td>
                        <td><?php echo $r['occ_sec2_daytimetel']; ?></td>
                        <td><?php echo $r['occ_sec2_emailaddress']; ?></td>
                        <td><?php echo $r['amount']; ?></td>
                        <td><?php echo $r['date_registration']; ?></td>
                        <td><?php if ($r['status'] == 1) echo 'Payment Incomplete'; ?></td>
                        <td>
                            <a id="anchor"
                               href="edit_payment.php?id=<?php echo $r['payment_id']; ?>&uid=<?php echo $r['uid']; ?>"
                               style="cursor:pointer;" class="occ-action-icon" title="Add Payment"><i
                                    class="fa fa-edit fa-lg"></i></a> |
                            <a class="occ-action-icon" title="Delete"
                               href="delete_payment.php?pid=<?php echo $r['payment_id']; ?>"><i
                                    class="fa fa-trash-o"></i></a></td>
                        <?php } ?>

                    </tbody>
                </table>
            </div><!-- /.padding-md -->
        </div>
    </div>
    <?php include_once("footer.php"); ?>
</div>

</body>
</html>