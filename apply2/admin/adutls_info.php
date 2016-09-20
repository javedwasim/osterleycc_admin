<?php
include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

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
.tip {
	position: relative;
}
.tip p {
	display: none;
	position: absolute;
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
	padding: 3px;
	box-sizing: border-box;
	-o-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
}
.tip:hover p {
	display: block;
}
#sortingTable thead td {
	background: -webkit-linear-gradient(top, #dcdcdc, #ccc);
	background: -moz-linear-gradient(top, #dcdcdc, #ccc);
	background: -o-linear-gradient(top, #dcdcdc, #ccc);
	background: -ms-linear-gradient(top, #dcdcdc, #ccc);
	font-weight: bold
}
</style>
</head>
<body>
<div id="page-wrapper">
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
    <?php 
$query_source = "SELECT * FROM `occ_registrant` WHERE `source_type` = 2 ORDER BY occ_firstname , occ_lastname , occ_birthday ASC";
$fetch_source = mysql_query($query_source);
?>
    <table width="100%" border="0" id="sortingTable">
      <thead>
      
        <td><span class="head">Applicant full name</span>
          </th>
        <td><span class="head">Date of birth</span></td>
        <td><span class="head">Gender</span></td>
        <td><span class="head">Contact no.</span></td>
        <td><span class="head">Job title</span></td>
        <td><span class="head">Email</span></td>
        <td><span class="head">Total price</span></td>
        <td><span class="head">Registration date</span></td>
        <td><span class="head">Control</span></td>
          </thead>
        <?php while ($src = mysql_fetch_array($fetch_source)) {  ?>
      <tr class="records-row">
        <td><?php echo $src['occ_firstname'].'&nbsp;'.$src['occ_lastname']; ?></td>
        <td><?php echo $src['occ_birthday']; ?></td>
        <td><?php echo $src['occ_gender']; ?></td>
        <td><?php echo $src['occ_sec2_daytimetel']; ?></td>
        <td><?php echo $src['occ_job_title']; ?></td>
        <td><?php echo $src['occ_sec2_emailaddress']; ?></td>
        <td><?php echo $src['occ_total_price']; ?></td>
        <td><?php echo $src['date_registration']; ?></td>
        <?php
if($_SESSION['UserName'] == 'Administrator') {
?>
        <td><a href="add_email_template.php?UserId=<?php echo $src['Id']; ?>" id="anchor" style="cursor:pointer;"> <span class="tip"><img src="images/envelope.png" width="24" height="24">
          <p>Send Email</p>
          </span></a> | <a href="edit_adults_control.php?id=<?php echo $src['Id'];?>&user_id=<?php echo $src['sid'];?>" id="anchor" style="cursor:pointer;"><span class="tip"><img src="images/view.png" width="16" height="16">
          <p>Edit Adult Records</p>
          </span></a> | <span id="<?php echo $src['Id'];?>"> <a class="linkStatus" href="status_control.php?Id=<?php echo $src['Id'];?>" style="cursor:pointer;">
          <?php if($src['status'] != 2) {  ?>
          <span class="tip"><img src="images/del-cross.png" width="16" height="16" id="show_status">
          <p>Change Adult Status</p>
          </span>
          <?php } else { ?>
          <span class="tip"><img src="images/active.png" width="16" height="16" id="show_status">
          <p>Change Adult Status</p>
          </span>
          <?php } ?>
          </a></span> |<a href="delete_payment.php?id=<?php echo $src['Id'];?>"><img src="images/trash_recyclebin_empty_closed.png" width="20" height="20"></a></td>
        <?php } else {  ?>
        <td><span id="<?php echo $src['Id'];?>"> <a class="linkStatus">
          <?php if($src['status'] != 2) {  ?>
          <span><img src="images/del-cross.png" width="16" height="16" id="show_status"></span>
          <?php } else { ?>
          <span><img src="images/active.png" width="16" height="16" id="show_status"></span>
          <?php } ?>
          </a> </span></td>
        <?php }  ?>
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
	
		$(".head").click(function(e) {

		tr = new Array();
		$("#sortingTable").find("tr").each(function(index, element) {
           if(index!=0)
		   {
			   tr[index-1] = $(this);
		   }
        });
		
		$("#sortingTable").find("tr").each(function(index, element) {
           if(index!=0)
		   {
			   $(this).remove();
		   }
        });
		
		for(i=tr.length-1; i>=0; i--)
		{
			$("#sortingTable").append("<tr>"+tr[i].html()+"</tr>");
		}
	});
});

</script>
</body>
</html>