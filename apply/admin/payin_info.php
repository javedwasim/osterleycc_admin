<?php
include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

$query1 = "SELECT * FROM occ_registrant as r, payment_recieved as p WHERE r.sid = p.uid and p.status = 1 and p.source_type = 1";
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
left: -240px;
width: 235px;
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
<th>Status</th>
<th>Edit payment</th>
</tr>
<?php while ($r = mysql_fetch_array($pagination1)) {  ?>
<tr class="records-row">
<td><?php echo $r['occ_firstname'].'&nbsp;'.$r['occ_lastname']; ?></td>
<td><?php echo $r['occ_birthday']; ?></td>
<td><?php echo $r['occ_age']; ?></td>
<td><?php echo $r['occ_gender']; ?></td>
<td><?php echo $r['occ_sec2_daytimetel']; ?></td>
<td><?php echo $r['occ_sec2_emailaddress']; ?></td>
<td><?php echo $r['amount']; ?></td>
<td><?php echo $r['date_registration']; ?></td>
<td><?php if($r['status'] == 1) echo 'Payment Incomplete'; ?></td>
<td>
<a id="anchor" href="edit_payment.php?id=<?php echo $r['payment_id'];?>&uid=<?php echo $r['uid'];?>" style="cursor:pointer;"><span class="tip"><img src="images/view.png" width="16" height="16"><p>Add payment achievment of pay in person</p></span></a> |
<a href="delete_payment.php?pid=<?php echo $r['payment_id'];?>"><img src="images/trash_recyclebin_empty_closed.png" width="20" height="20"></a></td>
<?php } ?>
</tr>
</table>



</div>
<?php include_once("footer.php"); ?>
</div>

</body>
</html>