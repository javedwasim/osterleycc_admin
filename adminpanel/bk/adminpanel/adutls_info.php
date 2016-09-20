<?php
session_start();
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

$_SESSION['source_type'] = 2;

if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator'){redirect_to("home.php"); die(); }

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

<link href="css/styles.css" rel="stylesheet">
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

 if($_SESSION['Administrator']){
		 	include("navigation_bar.php");
 } else{
	 include("banner.php");
 }
		 
?>
<?php
$query_source = "SELECT * FROM `occ_registrant` WHERE `source_type` = 2 ORDER BY occ_firstname , occ_lastname , occ_birthday ASC";
$fetch_source = mysql_query($query_source);
$total_records = mysql_num_rows($fetch_source);
?>
<div class="panel panel-default table-responsive" style = "margin-top: 75px;">

<div class="panel-heading">
	<span class="text occ-color occ-heading">Adults Registrations</span>
	<span class="label label-info3 pull-right"><?php echo $total_records." Records"; ?></span>
</div>

<div class="padding-md clearfix">
	<?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?>
	<table class="table table-striped" id="dataTable">
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
				<?php while ($src = mysql_fetch_array($fetch_source)) {  ?>
					  <tr class="records-row">
						<td><?php echo $src['occ_firstname'].'&nbsp;'.$src['occ_lastname']; ?></td>
						<td><?php echo $src['occ_birthday']; ?></td>
						<td><?php echo $src['occ_gender']; ?></td>
						<td><?php echo $src['occ_sec2_daytimetel']; ?></td>
						<td><?php echo $src['occ_job_title']; ?></td>
						<td><?php echo $src['occ_sec2_emailaddress']; ?></td>
						<td><?php echo $src['occ_total_price']; ?></td>
						<td><?php echo date("d/M/Y",strtotime($src['date_registration'])); ?></td>
						<?php
						if($_SESSION['UserName'] == 'Administrator') {
						?>
						<td>
						  
						  <a class="occ-action-icon <?php if($src['status'] == 2) { echo "occ-color-green" ;  }else{echo "occ-color";}?>" title = "<?php if($src['status'] == 2) { echo "Active";  }else{echo "Inactive";}?>" href="status_control.php?Id=<?php echo $src['Id'];?>" id="anchor" style="cursor:pointer;"><i class="fa <?php if($src['status'] == 2) { echo "fa-check-circle" ;  }else{echo "fa-minus-circle";}?> fa-lg"></i></i><?php if($src['status'] == 2) { echo "" ;  }else{echo "";}?></a>| 
						  <a class="occ-action-icon" title = "Email" href="sendemail.php?UserId=<?php echo $src['Id']; ?>" id="anchor" style="cursor:pointer;"><i class="fa fa-envelope-o"></i><span></span></a>|
						  <a class="occ-action-icon" title="Edit" href="edit_adults_control.php?id=<?php echo $src['Id'];?>&user_id=<?php echo $src['sid'];?>" id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a>|
						  
						  <a class="occ-action-icon" title = "Delete" onclick="return confirm('Are you sure you want to delete this record?');" href="delete_payment.php?id=<?php echo $src['Id'];?>" id="anchor" style="cursor:pointer;" ><i class="fa fa-trash-o"></i></a>
						  
						  
						</td>
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
				
			</tbody>
		</table>
	</div><!-- /.padding-md -->
</div>	
</div>
  
</div>
<?php include_once("footer.php"); ?>
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
