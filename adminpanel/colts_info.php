<?php
session_start();

$_SESSION['source_type'] = 1;

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


//filter by age or by season
if(!empty($_REQUEST['sort_age'])&&!empty($_REQUEST['sort_season'])){


    //add months to go back to 1st Sep of previous year
    $sepMonths = $currentMonth + 3;
    //get date of 1st sep of previous year.
    $sepDate = date("Y-m-01", strtotime("-$sepMonths months"));
    //Age criteria
    $ageCriteria = $_REQUEST['sort_age'];

    if ($_REQUEST['sort_age'] == 11) {
      $season_id = $_REQUEST['sort_season'];
      $query1 = "SELECT *, TIMESTAMPDIFF(YEAR, STR_TO_DATE(occ_birthday,'%d/%b/%Y'), '$sepDate') As age from `occ_registrant`  HAVING age <=11 and `source_type` = 1  and `season_id` = $season_id ";

    } else {
        $season_id = $_REQUEST['sort_season'];
        $todayDate = date("Y-m-d");
        $query1 = "SELECT *, TIMESTAMPDIFF(YEAR, STR_TO_DATE(occ_birthday,'%d/%b/%Y'), '$todayDate') As age from `occ_registrant`  HAVING age <=$ageCriteria and `source_type` = 1 and `season_id` = $season_id ";

    }
}
//Only Age Filter
elseif (isset($_REQUEST['sort_age']) && !empty($_REQUEST['sort_age'])) {

    //add months to go back to 1st Sep of previous year
    $sepMonths = $currentMonth + 3;
    //get date of 1st sep of previous year.
    $sepDate = date("Y-m-01", strtotime("-$sepMonths months"));
    //Age criteria
    $ageCriteria = $_REQUEST['sort_age'];

    if ($_REQUEST['sort_age'] == 11) {
        $season_id = "";
        $query1 = "SELECT *, TIMESTAMPDIFF(YEAR, STR_TO_DATE(occ_birthday,'%d/%b/%Y'), '$sepDate') As age from `occ_registrant`  HAVING age <=11 and `source_type` = 1";

    } else {
        $season_id = "";
        $todayDate = date("Y-m-d");
        $query1 = "SELECT *, TIMESTAMPDIFF(YEAR, STR_TO_DATE(occ_birthday,'%d/%b/%Y'), '$todayDate') As age from `occ_registrant`  HAVING age <=$ageCriteria and `source_type` = 1";
    }

}
//Only season filter
elseif(isset($_REQUEST['sort_season']) && !empty($_REQUEST['sort_season'])){

    $season_id = $_REQUEST['sort_season'];
    $query1 = "SELECT * FROM `occ_registrant` WHERE `source_type` = 1 and `season_id` = $season_id";
}
else {
    //Select all for season filters
    if(isset($_REQUEST['sort_season']) && empty($_REQUEST['sort_season'])){

        $query1 = "SELECT * FROM `occ_registrant` WHERE `source_type` = 1";
        $season_id = "";

    }
    else{
        $query1 = "SELECT * FROM `occ_registrant` WHERE `source_type` = 1 and `season_id` = $season_id ";
    }

}


$pagination1 = mysql_query($query1);
$total_records = mysql_num_rows($pagination1);

//Select all season of registerant for filter.
$squery = "SELECT `id`, `seasonyear`, `seasonname`  FROM `season` WHERE 1";
$sreault = mysql_query($squery);
//print_r($srow);


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- Datatable -->
    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-landing.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet">


    <script type="text/javascript" src="js/jquery-latest.js"></script>



</head>
<body class="overflow-hidden">
<!-- Overlay Div -->
<div id="overlay" class="transparent"></div>

<div id="wrapper" class="preload">

    <div id="content-manage">
        <?php
        if ($_SESSION['Administrator']) {
            include("navigation_bar.php");
        } else {

            include("banner.php");
        }
        ?>
        <div class="seperator"></div>


        <div class="panel panel-default table-responsive" style = "margin-top: 60px;">

            <div style="padding: 15px 0 10px 0;">
                <form name="sortingForm" id="sortingForm" action="colts_info.php" method="post">
                <div id="container" class="occ-filter">

                        <div id="sortby" style="margin: 20px 0 15px 0;">
                            <strong>Filter By Age:</strong>
                            <select name="sort_age" id="sort_age" onchange="this.form.submit()" class="form-control">
                                <option value=""> -- Select Age --</option>
                                <option value="11" <?php if(isset($ageCriteria) && ($ageCriteria == 11)){echo "selected";} ?>>Under 11</option>
                                <option value="13" <?php if(isset($ageCriteria) && ($ageCriteria == 13)){echo "selected";} ?>>Under 13</option>
                                <option value="15" <?php if(isset($ageCriteria) && ($ageCriteria == 15)){echo "selected";} ?>>Under 15</option>
                                <option value="17" <?php if(isset($ageCriteria) && ($ageCriteria == 17)){echo "selected";} ?>>Under 17</option>
                                <option value="19" <?php if(isset($ageCriteria) && ($ageCriteria == 19)){echo "selected";} ?>>Under 19</option>
                                <option value="21" <?php if(isset($ageCriteria) && ($ageCriteria == 21)){echo "selected";} ?>>Under 21</option>
                            </select>
                        </div>

                </div>
                <div id="container" class="occ-filter">

                        <div id="sortby" style = "margin: 20px 0 15px 0;">
                            <strong>Filter By Season:</strong>
                            <select name="sort_season" id="sort_season" onchange="this.form.submit()" class="form-control">
                                <option value=""> -- Select Season --</option>
                                <?php while($srow = mysql_fetch_array($sreault)) { ?>
                                    <option value="<?php echo $srow['id']; ?>" <?php if(isset($srow['id']) && ($srow['id'] == $season_id)){echo "selected";} ?>><?php echo $srow['seasonname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                </div>
                </form>
                <div class="panel-heading">
                    <a href="#" class="shortcut-link payinfo-link" style="float: left;margin: 15px 0 15px 0;">
					<span class="shortcut-icon">
						<i class="fa fa-group"></i>
					</span>
                        <span class="text payinfo">Colts Registrations</span>
                    </a>

                    <a href="#" class="shortcut-link" style="float: right; margin: 15px 10px 15px 0;;">
					<span class="label label-info3 pull-right payinfo-record"
                          style="margin-top: 15px; font-weight: 100"><?php echo $total_records . " Records"; ?></span>
                    </a>

                </div>
            </div>

            <div class="padding-md clearfix">
                <h4 style="color: green;"><?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?></h4>
                <table class="table table-striped" id="dataTable">
                    <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>D.O.B</th>
                        <th>Age (Yrs)</th>
                        <th>Age (Mon)</th>
                        <th>Gender</th>
                        <th>Contact no.</th>
                        <th>Email</th>
                        <th>Price</th>
                        <th>Reg.Date</th>
						<th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php while ($r = mysql_fetch_array($pagination1)) { ?>
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

                                if (isset($_REQUEST['sort_age'])) {
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
                            <td>
                                <?php echo calculate_agewithmonth($birth_day); ?>
                            </td>
                            <td><?php echo $r['occ_gender']; ?></td>
                            <td><?php echo $r['occ_sec2_daytimetel']; ?></td>
                            <td><?php echo $r['occ_sec2_emailaddress']; ?></td>
                            <td><?php echo $r['occ_total_price']; ?></td>
                            <td><?php echo date("d/M/Y",strtotime($r['date_registration'])); ?></td>

                            <?php
                            if (isset($_SESSION['UserName']) && $_SESSION['UserName'] == 'Administrator') {
                                ?>
                                <td>
                                    <a class="occ-action-icon <?php if ($r['status'] == 2) {
                                        echo "occ-color-green";
                                    } else {
                                        echo "occ-color";
                                    } ?>" title="<?php if ($r['status'] == 2) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    } ?>" href="status_control.php?Id=<?php echo $r['Id']; ?>" id="anchor"
                                       style="cursor:pointer;"><i class="fa <?php if ($r['status'] == 2) {
                                            echo "fa-check-circle";
                                        } else {
                                            echo "fa-minus-circle";
                                        } ?> fa-lg"></i></i><?php if ($r['status'] == 2) {
                                            echo "";
                                        } else {
                                            echo "";
                                        } ?></a> |
                                    <a class="occ-action-icon" title="Email"
                                       href="sendemail.php?UserId=<?php echo $r['Id']; ?>" id="anchor"
                                       style="cursor:pointer;"><i class="fa fa-envelope-o"></i><span></span></a> |
                                    <a class="occ-action-icon" title="Edit"
                                       href="edit_colts_control.php?id=<?php echo $r['Id']; ?>&user_id=<?php echo $r['sid']; ?>"
                                       id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a> |
                                    <a class="occ-action-icon" title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this record?');"
                                       href="delete_payment.php?cid=<?php echo $r['Id']; ?>" id="anchor"
                                       style="cursor:pointer;"><i class="fa fa-trash-o"></i></a>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <a class="occ-action-icon <?php if ($r['status'] == 2) {
                                        echo "occ-color-green";
                                    } else {
                                        echo "occ-color";
                                    } ?>" title="<?php if ($r['status'] == 2) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    } ?>" href="#" id="anchor" style="cursor:pointer;"><i
                                            class="fa <?php if ($r['status'] == 2) {
                                                echo "fa-check-circle";
                                            } else {
                                                echo "fa-minus-circle";
                                            } ?> fa-lg"></i></i><?php if ($r['status'] == 2) {
                                            echo "";
                                        } else {
                                            echo "";
                                        } ?></a> |
                                    <a class="occ-action-icon" title="Edit"
                                       href="edit_colts_control.php?id=<?php echo $r['Id']; ?>&user_id=<?php echo $r['sid']; ?>"
                                       id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.padding-md -->
        </div><!-- /panel -->
    </div>
</div>
<?php include_once("footer.php"); ?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#pay_anchor").click(function (e) {
            $("#progress").show();
        });
    });
</script>
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
