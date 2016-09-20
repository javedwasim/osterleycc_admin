<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator'){redirect_to("home.php"); die(); }

$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];
?>
<?php
if(isset($_REQUEST['templateId']) && !empty($_REQUEST['templateId'])){

	$templateId = $_REQUEST['templateId'];
	$delete_query = "delete from email_tmpl where empl_id = $templateId ";
	$emailTemplates = mysql_query($delete_query);
	message("Template deleted succesfully!");
	redirect_to("template_list.php");
	die();
}

$emailTemplates = mysql_query("select * from email_tmpl");
$templateCount = mysql_num_rows($emailTemplates);
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
							<i class="fa fa-envelope"></i>
							</span>
							<span class="text payinfo">Email Templates</span>
						</a>

						<a href="add_email_template.php" class="shortcut-link payinfo-link">
							<span class="shortcut-icon">
								<i class="fa fa-plus-circle"></i>

							</span>
							<span class="text">Add Email Template</span>
						</a>



						<a href="#" class="shortcut-link" style = "float: right;">
							<span class="label label-info3 pull-right payinfo-record"
						  	style="margin-top: 15px;"><?php echo $templateCount . " Records"; ?>
							</span>
						</a>

					</div>
					<?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);} ?>
					<table class="table table-striped" id="dataTable">
						<thead>
						<tr>
							<th>Name</th>
							<th>Date Created</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>

						<?php while ($r = mysql_fetch_array($emailTemplates)) {  ?>
							<tr class="records-row">
								<td><?php echo $r['empl_name']; ?></td>
								<td><?php echo $r['empl_created_date']; ?></td>
								<td><?php  if($r['empl_status']==1) {echo "Active";} else{ echo "Inactive";} ?></td>
								<td>
									<a class="occ-action-icon" title = "Edit" href="add_email_template.php?empl_id=<?php echo $r['empl_id'];?>" id="anchor" style="cursor:pointer;"><i class="fa fa-edit fa-lg"></i></a> |
									<a class="occ-action-icon" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');" href="?templateId=<?php echo $r['empl_id'];?>" id="anchor" style="cursor:pointer;" ><i class="fa fa-trash-o"></i></a>
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

