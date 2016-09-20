<?php 
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator'){redirect_to("home.php"); die(); }


if($_GET['id']) { 
$id = $_GET['id'];
$userId = $_GET['user_id'];
$selectmethod = mysql_query("select * from `payment_method`");
$query = mysql_query("SELECT * FROM occ_registrant WHERE `Id` = '$id'");
$r = mysql_fetch_array($query);

$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];
?>
<script type="text/javascript" src="js/jquery-latest.js"></script>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $username; ?></title>
  
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">
	
	<!-- Chosen -->
	<link href="css/chosen/chosen.min.css" rel="stylesheet"/>

	<!-- Datepicker -->
	<link href="css/datepicker.css" rel="stylesheet"/>
	
	<!-- Timepicker -->
	<link href="css/bootstrap-timepicker.css" rel="stylesheet"/>
	
	<!-- Slider -->
	<link href="css/slider.css" rel="stylesheet"/>
	
	<!-- Tag input -->
	<link href="css/jquery.tagsinput.css" rel="stylesheet"/>

	<!-- WYSIHTML5 -->
	<link href="css/bootstrap-wysihtml5.css" rel="stylesheet"/>
	
	<!-- Dropzone -->
	<link href='css/dropzone/dropzone.css' rel="stylesheet"/>
	
	<!-- Endless -->
	<link href="css/endless.min.css" rel="stylesheet">
	<link href="css/endless-skin.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">


</head>
<body>
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>
	<div id="wrapper" class="preload">
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
		<div id="main-container" style = "margin-left:0px; margin-top: 40px;">
			
			<div class="padding-md edit-reg-form">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2>Registration Form</h2>
						
					</div>
					<div class="panel-body">
						<form id="formToggleLine" class="form-horizontal no-margin form-border" name="edit-app-details" method="post" action="update_control.php?id=<?php echo $r['Id'];?>&user_id=<?php echo $r['uid'];?>">
							<div class="form-group">
								<label class="col-lg-2 control-label">First name :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_firstname']; ?>" name="fname" id="fname" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Last name :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_lastname']; ?>" name="lname" id="lname" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Date of Birth :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_birthday']; ?>" name="birth" id="birth" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Gender : </label>
								<div class="col-lg-10">
									<select  id="gender" name="gender" class="form-control">
										<option value="Male" <?php if($r['occ_gender'] == 'Male')  {  echo 'selected'; } ?>>Male</option>
										<option value="Female" <?php if($r['occ_gender'] == 'Female')  { echo 'selected'; } ?>>Female</option>
									</select>
									
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Job Title : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_job_title']; ?>" name="jobtitle" id="jobtitle" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Address :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec2_address']; ?>" name="address" id="address" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">City :</label>
								<div class="col-lg-10">
									<select name="city" id="city" class="form-control" required>
										<option value="0">Select City:</option>
										<?php $county = mysql_query("select * from `uk_city`");
										while($cc = mysql_fetch_array($county)) { ?>
										<option value="<?php echo $cc['Id'];?>" <?php if($cc['Id'] == $r['occ_sec2_city']) { echo 'selected'; } ?>><?php   echo $cc['cities_name'];  ?></option>
										<?php } ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">County :</label>
								<div class="col-lg-10">
									<select name="county" id="county" class="form-control" required>
										<option value="">Select County:</option>
										<?php $county = mysql_query("select * from `uk_county`");
										while($cc = mysql_fetch_array($county)) { ?>
										<option value="<?php echo $cc['Id'];?>" <?php if($cc['Id'] == $r['occ_sec2_county']){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>
										<?php } ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Postal Code :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec2_postcode']; ?>" name="postalcode" id="postalcode" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Day time tel : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec2_daytimetel']; ?>" name="daytimetel" id="daytimetel" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Evening time tel :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec2_eventimetel']; ?>" name="eventimetel" id="eventimetel" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Email address :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec2_emailaddress']; ?>" name="emailaddr" id="emailaddr" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->

							<div class="form-group">
								<label class="col-lg-2 control-label">Country of Birth :</label>
								<div class="col-lg-10">
									<select name="countries" id="countries" class="form-control" onChange="ShowMigrate();" required>
										<option value="">Select Country:</option>
										<?php $county = mysql_query("select * from `countries`");
										while($cc = mysql_fetch_array($county)) { ?>
											<option value="<?php echo $cc['C_ID'];?>" <?php if($cc['C_ID'] == $r['occ_country']) { echo 'selected'; } ?>><?php   echo $cc['C_NAME'];  ?></option>
										<?php } ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->

							<div class="form-group migration" style = "<?php if(!empty($r['occ_city'])) {echo "display: block;";}else{echo "display: none;";} ?>">
								<label class="col-lg-2 control-label">City of Birth :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_city']; ?>" name="occ_city"  id="occ_city" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							<?php

							$occ_migrated_date =	explode("/",$r['occ_migrated_date']);

							//print_r($occ_migrated_date);

							?>
							<div class="form-group migration" id="migration" style = "<?php if(!empty($r['occ_migrated_date'])) {echo "display: block;";}else{echo "display: none;";} ?>">
								<label class="col-lg-2 control-label">Date moved to the UK :</label>
								<div class="col-lg-10">
									<div class="row">
										<div class="col-lg-3">
											<select name="moved_day"  id="moved_day" class="form-control" required>

												<option value="">Day</option>

												<?php for($i=1; $i<=31; $i++){ ?>

													<option value="<?php echo $i; ?>" <?php if($occ_migrated_date[0] == $i){ echo 'selected'; } ?>><?php echo $i; ?></option>

												<?php } ?>

											</select>
										</div><!-- /.col -->
										<div class="col-lg-3">
											<select name="moved_month" required id="moved_month" class="form-control">

												<option value="">Month</option>

												<option value="Jan" <?php if($occ_migrated_date[1] == 'Jan'){ echo 'selected'; } ?>>Jan</option>

												<option value="Feb" <?php if($occ_migrated_date[1] == 'Feb'){ echo 'selected'; } ?>>Feb</option>

												<option value="Mar" <?php if($occ_migrated_date[1] == 'Mar'){ echo 'selected'; } ?>>Mar</option>

												<option value="Apr" <?php if($occ_migrated_date[1] == 'Apr'){ echo 'selected'; } ?>>Apr</option>

												<option value="May" <?php if($occ_migrated_date[1] == 'May'){ echo 'selected'; } ?>>May</option>

												<option value="Jun" <?php if($occ_migrated_date[1] == 'Jun'){ echo 'selected'; } ?>>Jun</option>

												<option value="Jul" <?php if($occ_migrated_date[1]== 'Jul'){ echo 'selected'; } ?>>Jul</option>

												<option value="Aug" <?php if($occ_migrated_date[1]== 'Aug'){ echo 'selected'; } ?>>Aug</option>

												<option value="Sep" <?php if($occ_migrated_date[1] == 'Sep'){ echo 'selected'; } ?>>Sep</option>

												<option value="Oct" <?php if($occ_migrated_date[1] == 'Oct'){ echo 'selected'; } ?>>Oct</option>

												<option value="Nov" <?php if($occ_migrated_date[1] == 'Nov'){ echo 'selected'; } ?>>Nov</option>

												<option value="Dec" <?php if($occ_migrated_date[1] == 'Dec'){ echo 'selected'; } ?>>Dec</option>

											</select>
										</div><!-- /.col -->
										<div class="col-lg-3">
											<select name="moved_year" required id="moved_year" class="form-control">

												<option value="">Year</option>

												<?php for($ye = 1930; $ye <= 2013; $ye++){ ?>

													<option value="<?php echo $ye ;?>" <?php if($occ_migrated_date[2]==$ye){ echo 'selected'; } ?>><?php echo $ye; ?></option>

												<?php } ?>

											</select>
										</div><!-- /.col -->
									</div><!-- /.row -->
								</div><!-- /.col -->

							</div><!-- /form-group -->

							<div class="form-group edit-control-heading">
								<label class="col-lg-12 control-label" style = "text-align: left;"><h4>Emergency Contact Details</h4></label>

							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">First name :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_name']; ?>" name="emergname" id="emergname" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Last name :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_lname']; ?>" name="emerglname" id="emerglname" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Relationship to child :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_relationship']; ?>" name="emergrelation" id="emergrelation" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Address : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_address']; ?>" name="emergaddress" id="emergaddress" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">City :</label>
								<div class="col-lg-10">
									<select name="city_emg" id="city_emg" class="form-control" required>
										<option value="0">Select City:</option>
										<?php $county = mysql_query("select * from `uk_city`");
										while($cc = mysql_fetch_array($county)) { ?>
										<option value="<?php echo $cc['Id'];?>" <?php if($cc['Id'] == $r['occ_sec3_emerg_city']) { echo 'selected'; } ?>><?php   echo $cc['cities_name'];  ?></option>
										<?php } ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">County :</label>
								<div class="col-lg-10">
									<select name="county_emg" id="county_emg" class="form-control" required>
										<option value="0">Select County:</option>
										<?php $county = mysql_query("select * from `uk_county`");
										while($cc = mysql_fetch_array($county)) { ?>
										<option value="<?php echo $cc['counties_name'];?>" <?php if($cc['Id'] == $r['occ_sec3_emerg_county']){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>
										<?php } ?>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Postal Code  :</label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_postcode']; ?>" name="postalcode_emg" id="postalcode_emg" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Day time tel : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_daytel']; ?>" name="emergdaytel" id="emergdaytel" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Evening time tel  : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_sec3_emerg_eventel']; ?>" name="emergeventel" id="emergeventel" class="form-control" required>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group edit-control-heading">
								<label class="col-lg-12 control-label" style = "text-align:left;"><h4>Sporting Information <span style = "font-size:12px;">(Section 4 - Sporting Information)</span></h4></label>
								
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Has the child played Cricket before? :</label>
								<div class="col-lg-10">
									<select name="played" id="played" class="form-control">
										<option value="1" <?php if($r['occ_child_played'] == '1')  {  echo 'selected'; } ?>>Yes</option>
										<option value="2" <?php if($r['occ_child_played'] == '2')  { echo 'selected'; } ?>>No</option>
									</select>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Primary school :</label>
								<?php 
									$occ   = explode("|",$r['occ_played_cricket']);
									$imp   = explode("|",$r['occ_impairment']);
									$medc  = explode("|",$r['occ_medical_consent']);
									$appr  = explode("|",$r['occ_appropriate_ans']);
									$const = explode("|",$r['occ_club_constitution']);
								?>
								
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="primary_school" name="played_cricket1" id="played_cricket1" <?php for($acc = 0; $acc < count($occ); $acc++){if($occ[$acc] == 'primary_school') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Secondary school :</label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="secondary_school" name="played_cricket2" id="played_cricket2" <?php for($acc = 0; $acc < count($occ); $acc++){if($occ[$acc] == 'secondary_school') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Special Educational Needs school :</label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="special_educational_needs_school" name="played_cricket3" id="played_cricket3" <?php for($acc = 0; $acc < count($occ); $acc++){if($occ[$acc] == 'special_educational_needs_school') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Local authority coaching session(s) :</label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="local_authority_coaching_session" name="played_cricket4" id="played_cricket4" <?php for($acc = 0; $acc < count($occ); $acc++){if($occ[$acc] == 'local_authority_coaching_session') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Club : </label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="club" name="played_cricket5" id="played_cricket5" <?php for($acc = 0; $acc < count($occ); $acc++){if($occ[$acc] == 'club') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">County : </label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="county" name="played_cricket6" id="played_cricket6" <?php for($acc = 0; $acc < count($occ); $acc++){if($occ[$acc] == 'county') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Other state (please specify):</label>
								<div class="col-lg-10">
									<textarea name="otherstate" id="otherstate" class="form-control" style="height:60px;"><?php echo $r['occ_other_state']; ?></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							
							<div class="form-group edit-control-heading">
								<label class="col-lg-12 control-label" style = "text-align:left;"><h4>Impairment Information <span style = "font-size:12px;">&nbsp;(Section 4 - Sporting Information)</span></h4></label>
								
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Do you consider your child / the child in your care to have impairment? :</label>
								<div class="col-lg-10">
									<select name="played" id="played" class="form-control">
										<option value="1" <?php if($r['occ_care_impairment'] == '1')  {  echo 'selected'; } ?>>Yes</option>
										<option value="2" <?php if($r['occ_care_impairment'] == '2')  { echo 'selected'; } ?>>No</option>
									</select>
									
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Visual impairment : </label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="visual_impairment" name="impairment1" id="impairment1" <?php for($mp = 0; $mp < count($imp); $mp++){if($imp[$mp] == 'visual_impairment') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Hearing impairment  : </label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="hearing_impairment" name="impairment2" id="impairment2" <?php for($mp = 0; $mp < count($imp); $mp++){if($imp[$mp] == 'hearing_impairment') { echo 'checked';} } ?>  >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Physical impairment : </label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="physical_impairment" name="impairment3" id="impairment3" <?php for($mp = 0; $mp < count($imp); $mp++){if($imp[$mp] == 'physical_impairment') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Learning difficulty : </label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="learning_difficulty" name="impairment4" id="impairment4" <?php for($mp = 0; $mp < count($imp); $mp++){if($imp[$mp] == 'learning_difficulty') { echo 'checked';} } ?> >
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Multiple impairment :</label>
								<div class="col-lg-10">
									<label class="label-checkbox">
										<input type="checkbox" value="multiple_impairment" name="impairment5" id="impairment5" <?php for($mp = 0; $mp < count($imp); $mp++){if($imp[$mp] == 'multiple_impairment') { echo 'checked';} } ?>>
										<span class="custom-checkbox"></span>
									</label>
									
								</div>
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Other state (please specify):</label>
								<div class="col-lg-10">
									<textarea name="other_spcf" id="other_spcf" class="form-control" style="height:60px;"><?php echo $r['occ_imp_state']; ?></textarea>
								</div><!-- /.col -->
									
								
							</div><!-- /form-group -->
							
							<div class="form-group edit-control-heading">
								<label class="col-lg-12 control-label" style = "text-align:left;"><h4>Medical Information <span style = "font-size:12px;">(Section 6 – Medical Information)</span></h4></label>
								
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">If you have ticked yes in any box above </label>
								<div class="col-lg-10">
									<textarea name="additional_info" id="additional_info" class="form-control" style="height:60px;"><?php echo $r['occ_imp_additional']; ?></textarea>
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Name of Doctor / Surgery : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_doctorname']; ?>" name="name_dr" id="name_dr" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Doctor / Surgery telephone number : </label>
								<div class="col-lg-10">
									<input type="text" value="<?php echo $r['occ_doctortel']; ?>" name="tel_dr" id="tel_dr" class="form-control">
								</div><!-- /.col -->
							</div><!-- /form-group -->
							
							<?php if($query1 = mysql_query("SELECT * FROM `payment_recieved` WHERE `uid` = '$userId'")) { ?>
								
								<div class="form-group edit-control-heading">
									<label class="col-lg-12 control-label" style = "text-align:left;"><h4>Payment History</h4></label>
								
								</div><!-- /form-group -->
								<div class="seperator"></div>
								<div class="seperator"></div>
								<div id="histHolder">
								<table  border="1" align="center" cellpadding="5" cellspacing="0" class="table table-hover table-striped">
								  <tr>
									<td width="23">&nbsp;</td>
									<td width="176">Description</td>
									<td width="56">Amount</td>
									<td width="162">Date Created</td>
									<td width="150">Date Completed</td>
									<td>Transaction id</td>
									<td width="59">&nbsp;</td>
								  </tr>
								  <?php 

									$rcounter = 1;
									while($fetch = mysql_fetch_array($query1)) { 
									?>
									
									<tr>
									<td><?php echo $rcounter ; ?></td>
									<td><?php echo $fetch['description'] ; ?></td>
									<td>&pound;<?php echo $fetch['amount'] ; ?></td>
									<td><?php echo $fetch['date_created'] ; ?></td>
									<td><?php echo $fetch['date_recieved'] ; ?></td>
									 <td><?php echo $fetch['payment_txn'] ; ?></td>
									<td><?php 
									
									if($fetch['status'] == '1'){
									
									echo "<a href=\"edit_payment.php?id=".$fetch['payment_id']."&uid=".$userId."\"><i class=\"fa fa-edit fa-lg\"></i></a>";
									
									
										}
									
									
									?>
									</td>
								  </tr>
							
							<?php $rcounter++; } ?>
							</table>
						 <?php } ?>
						  <?php if($_SESSION['Administrator']) { ?>
							<div class="form-group">
								<label class="col-lg-12 control-label" style = "text-align:center;"><button type="submit" class="btn btn-primary btn-sm">Submit</button></label>
								
							</div><!-- /form-group -->
							
							<?php } ?>
						</form>
					</div>
				</div><!-- /panel -->
			</div>
		</div>
	</div>

<?php } ?>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>
<!--<a onClick="update_app('<?php// echo $r['id']; ?>');" class="edit-control-btn"> Update </a>-->
<script>
	function ShowMigrate() {

		var country = $("#countries").val();
		//alert(country);
		if(country != 232)
		{
			$(".migration").fadeIn(300);

			document.getElementById("occ_city").required = true;

			frmvalidator.addValidation("moved_day","dontselect=0","Please enter the date you moved to UK");
			frmvalidator.addValidation("moved_month","dontselect=0","Please enter the date you moved to UK");
			frmvalidator.addValidation("moved_year","dontselect=0","Please enter the date you moved to UK");


		}

		else
		{
			document.getElementById("occ_city").required = false;
			document.getElementById("moved_day").required = false;
			document.getElementById("moved_month").required = false;
			document.getElementById("moved_year").required = false;


			$(".migration").fadeOut(300);

		}


	}
</script>