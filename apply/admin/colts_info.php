<?php

include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];
$query = "SELECT DISTINCT `occ_age` FROM `occ_registrant` WHERE `source_type` = 1 GROUP BY `occ_age` ASC";
$pagination = mysql_query($query);
$query_data = mysql_num_rows($pagination);
$total_rows  = $query_data;
					$each_page = 5;
					if($total_rows > $each_page){
					$total_pages = ceil($total_rows/$each_page);
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
					if($_GET['page'] > $total_pages)
					{
						echo '<script>window.location = "'.__self.'?page='.$total_pages.'"</script>';
					}
					}
if(isset($_GET['sort_age']))
{
	$query1 = "SELECT * FROM `occ_registrant` WHERE `source_type` = 1 AND `occ_age` = {$_GET['sort_age']}";
}
else
{
	$query1 = "SELECT * FROM `occ_registrant` WHERE `source_type` = 1";
}
$pagination1 = mysql_query($query1);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $username; ?></title>
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $("#pay_anchor").click(function(e) {
			    $("#progress").show();
            });
        });
  	</script>
<style>
.tip
{
	position:relative;
}
.tip p
{
display: none;
position:absolute;
z-index: 1000;
top: -8px;
left: -190px;
width: 185px;
background: #333;
border: 1px solid black;
color: white;
-moz-border-radius: 3px;
-webkit-border-radius: 2px;
box-shadow: 3px 3px 3px #CCC;
padding:3px;
box-sizing:border-box;
-o-box-sizing:border-box;
-moz-box-sizing:border-box;
-webkit-box-sizing:border-box;
}
.tip:hover p {display: block;}
</style>
</head>
<body>
<div id="page-wrapper">
<!--<header>
<div id="header-content">Manage Applicants Settings</div>
</header>-->
<div id="content-manage">
<?php
 if($_SESSION['Administrator'])
		 {
		 	include("navigation_bar.php");
		 }
		 else
		 {
			 include("banner.php");
		 }
?>
<form name="sortingForm" id="sortingForm" action="colts_info.php" method="get">
<div id="sortby">
<strong>Sort By Age:</strong>
<select name="sort_age" id="sort_age" onchange="this.form.submit()">
<option value=""> -- Select Age -- </option>
<?php while($curAge = mysql_fetch_array($pagination)) { ?>
<option value="<?php echo $curAge['occ_age'];?>"><?php echo $curAge['occ_age'];?></option>
<?php } ?>
</select>
</div>
</form>
<table width="100%" border="0">
<tr>
<th>Colts full name</th>
<th>Date of birth</th>
<th>Current age</th>
<th>Gender</th>
<th>Contact no.</th>
<th>Email</th>
<th>Total price</th>
<th>Registration date</th>
<th>Control</th>
</tr>
<?php while ($r = mysql_fetch_array($pagination1)) {  ?>
<tr class="records-row">
<td><?php echo $r['occ_firstname'].'&nbsp;'.$r['occ_lastname']; ?></td>
<td><?php echo $r['occ_birthday']; ?></td>
<td>
<?php
if(isset($_GET['sort_age']))
{
	echo $r['occ_age'];
}
else
{
	$birthDate = $r['occ_birthday'];
	//explode the date to get month, day and year
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
    echo $age;
}
?>
</td>
<td><?php echo $r['occ_gender']; ?></td>
<td><?php echo $r['occ_sec2_daytimetel']; ?></td>
<td><?php echo $r['occ_sec2_emailaddress']; ?></td>
<td><?php echo $r['occ_total_price']; ?></td>
<td><?php echo $r['date_registration']; ?></td>
<?php
 if($_SESSION['Administrator'])
{
?>
<td>
<a href="edit_colts_control.php?id=<?php echo $r['Id'];?>&user_id=<?php echo $r['sid'];?>" id="anchor" style="cursor:pointer;"><span class="tip"><img src="images/view.png" width="16" height="16"><p>Edit Colt Records</p></span></a> | <span id="<?php echo $r['Id'];?>">
<a class="linkStatus" href="status_control.php?Id=<?php echo $r['Id'];?>" style="cursor:pointer;"><?php if($r['status'] != 2) {  ?><span class="tip"><img src="images/del-cross.png" width="16" height="16" id="show_status"><p>Change Colt Status</p></span><?php } else { ?><span class="tip"><img src="images/active.png" width="16" height="16" id="show_status"><p>Change Colt Status</p></span><?php } ?></a></span> | <a href="delete_payment.php?id=<?php echo $r['Id'];?>"><img src="images/trash_recyclebin_empty_closed.png" width="20" height="20"></a>
</td>
<?php } else { ?>
<td>
<a  id="anchor" style="cursor:pointer;"><span><img src="images/view.png" width="16" height="16"></span></a>
</td>
<?php } ?>
</tr>
<?php }  ?>
</table>
</div>

<?php include_once("footer.php"); ?>

</div>

<script type="text/javascript">

$(document).ready(function(e) {

    $(".linkStatus").live('click',function(e)

	{

		var self = $(this);

		var href = $(this).attr('href');

		$.get(href, {}, function(data) {

			if(data == 1)

			{

	  			self.html('<img src="images/del-cross.png" width="16" height="16" id="show_status">');

			}

			else

			{

				self.html('<img src="images/active.png" width="16" height="16" id="show_status">');

			}

     	 });

		return false;

	});

});

</script>

</body>

</html>