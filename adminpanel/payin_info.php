<?php
session_start();

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

if (isset($_SESSION['source_type'])) {
    $source_type = $_SESSION['source_type'];
}

include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");
include("DateMathClassA.php");

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];

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

//Select all season of registerant for filter.
$squery = "SELECT `id`, `seasonyear`, `seasonname`  FROM `season` WHERE 1";
$sreault = mysql_query($squery);
//print_r($srow);
//filter by season
if(isset($_REQUEST['sort_season']) && !empty($_REQUEST['sort_season'])){
    $season_id = $_REQUEST['sort_season'];
    $query1 = "SELECT * FROM payment_recieved p INNER JOIN occ_registrant r ON p.uid = r.sid WHERE p.source_type=$source_type and p.status=1 and r.season_id = $season_id";

}else{

    if(isset($_REQUEST['sort_season']) && empty($_REQUEST['sort_season'])){

        $query1 = "SELECT * FROM occ_registrant as r, payment_recieved as p WHERE r.sid = p.uid and p.status = 1 and p.source_type = $source_type";
        $season_id = "";

    }else{
        $query1 = "SELECT * FROM occ_registrant as r, payment_recieved as p WHERE r.sid = p.uid and p.status = 1 and p.source_type = $source_type and r.season_id = $season_id";
    }



}

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

    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
</head>
<body style="overflow-x: hidden;">

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

            <h4 style="color: green;"><?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                } ?></h4>
            <div class="padding-md clearfix">
                <div id="container" class="occ-filter">
                    <form name="sortingForm" id="sortingForm" action="payin_info.php" method="post">
                        <div id="sortby">
                            <strong>Filter By Season:</strong>
                            <select name="sort_season" id="sort_season" onchange="this.form.submit()"
                                    class="form-control">
                                <option value=""> -- Select Season --</option>
                                <?php while ($srow = mysql_fetch_array($sreault)) { ?>
                                    <option
                                        value="<?php echo $srow['id']; ?>" <?php if (isset($srow['id']) && ($srow['id'] == $season_id)) {
                                        echo "selected";
                                    } ?>><?php echo $srow['seasonname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="grey-container shortcut-wrapper">
                    <a href="#" class="shortcut-link payinfo-link" style="float: left;">
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

                    <a href="#" class="shortcut-link" style="float: right;">
					<span class="label label-info3 pull-right payinfo-record"
                          style="margin-top: 15px; font-weight: 100"><?php echo $total_records . " Records"; ?></span>
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
                               onclick="return confirm('Are you sure you want to delete this record?');"
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