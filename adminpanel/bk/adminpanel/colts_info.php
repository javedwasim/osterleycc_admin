<?php
session_start();

$_SESSION['source_type'] = 1;

include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];
$query = "SELECT DISTINCT `occ_age` FROM `occ_registrant` WHERE `source_type` = 1 GROUP BY `occ_age` ASC";
$pagination = mysql_query($query);
$query_data = mysql_num_rows($pagination);
$total_rows = $query_data;
$each_page = 5;
if ($total_rows > $each_page) {
    $total_pages = ceil($total_rows / $each_page);
    if (isset($_GET['page'])) {
        if ($_GET['page'] > 0) {
            $p = $_GET['page'];
        } else {
            $p = 1;
        }
        $p = $p - 1;
        $limit = $p * $each_page;
    } else {
        $limit = 0;
    }
    if ($_GET['page'] > $total_pages) {
        echo '<script>window.location = "' . __self . '?page=' . $total_pages . '"</script>';
    }
}
if (isset($_GET['sort_age'])) {
    //get month of current year
    $currentMonth = date("m");
    //add months to go back to 1st Sep of previous year
    $sepMonths = $currentMonth + 3;
    //get date of 1st sep of previous year.
    $sepDate = date("Y-m-01", strtotime("-$sepMonths months"));
    //Age criteria
    $ageCriteria = $_GET['sort_age'];

    if ($_GET['sort_age'] == 11) {

        $query1 = "SELECT *, TIMESTAMPDIFF(YEAR, STR_TO_DATE(occ_birthday,'%d/%b/%Y'), '$sepDate') As age from `occ_registrant`  HAVING age <=11";
    } else {

        $todayDate = date("Y-m-d");

        $query1 = "SELECT *, TIMESTAMPDIFF(YEAR, STR_TO_DATE(occ_birthday,'%d/%b/%Y'), '$todayDate') As age from `occ_registrant`  HAVING age <=$ageCriteria";
    }

} else {
    $query1 = "SELECT * FROM `occ_registrant` WHERE `source_type` = 1";
}
$pagination1 = mysql_query($query1);
$total_records = mysql_num_rows($pagination1);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

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
            <div class="panel-heading">

                <span class="text occ-color occ-heading">Colts Registrations</span>


                <span class="label label-info3 pull-right"><?php echo $total_records . " Records"; ?></span>
            </div>
            <div id="container" class="occ-filter">
                <form name="sortingForm" id="sortingForm" action="colts_info.php" method="get">
                    <div id="sortby">
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
                </form>
            </div>
            <div class="padding-md clearfix">
                <?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?>
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
                                       href="delete_payment.php?id=<?php echo $r['Id']; ?>" id="anchor"
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
