<?php 
include("include/db_config.php");
include("include/session_timeout.php");


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
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="functions.js"></script>

<style>
.hpactive
{
	background:#333;
	color:#fff;
	border-radius:5px;
	padding:4px;
}
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
<div class="cont-progess">
<div class="banners">
Adults Registration Form
<div class="clear"></div>
</div>
<div id="firstStep" style="margin-top:10px; padding-top:5px;">
<form name="edit-app-details" id="edit-app-details" method="post" action="update_control.php?id=<?php echo $r['Id'];?>&user_id=<?php echo $r['uid'];?>">
<div class="edit-user">
<div class="edit-heads-control floatLeft"> First name : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_firstname']; ?>" name="fname" id="fname" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Last name : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_lastname']; ?>" name="lname" id="lname" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Date of Birth : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_birthday']; ?>" name="birth" id="birth" class="pro-fields"></div>
<div class="clear"></div>
</div>


<div class="edit-user">
<div class="edit-heads-control floatLeft"> Gender : </div>
<div class="edit-details-control floatLeft">
<select class="pro-fields" id="gender" name="gender">
<option value="Male" <?php if($r['occ_gender'] == 'Male')  {  echo 'selected'; } ?>>Male</option>
<option value="Female" <?php if($r['occ_gender'] == 'Female')  { echo 'selected'; } ?>>Female</option>
</select>
</div>
<div class="clear"></div>
</div>

<div class="edit-user">
<div class="edit-heads-control floatLeft"> Job Title : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_job_title']; ?>" name="jobtitle" id="jobtitle" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Address : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec2_address']; ?>" name="address" id="address" class="pro-fields"></div>
<div class="clear"></div>
</div>

<div class="edit-user">
<div class="edit-heads-control floatLeft"> City : </div>
<div class="edit-details-control floatLeft">
<select name="city" id="city" class="pro-fields">
        <option value="0">Select City:</option>
<?php $county = mysql_query("select * from `uk_city`");
while($cc = mysql_fetch_array($county)) { ?>
<option value="<?php echo $cc['Id'];?>" <?php if($cc['Id'] == $r['occ_sec2_city']) { echo 'selected'; } ?>><?php   echo $cc['cities_name'];  ?></option>
<?php } ?>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> County : </div>
<div class="edit-details-control floatLeft">

<select name="county" id="county" class="pro-fields">
        <option value="0">Select County:</option>
<?php $county = mysql_query("select * from `uk_county`");
while($cc = mysql_fetch_array($county)) { ?>
<option value="<?php echo $cc['Id'];?>" <?php if($cc['Id'] == $r['occ_sec2_county']){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>
<?php } ?>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Postal Code : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec2_postcode']; ?>" name="postalcode" id="postalcode" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Day time tel : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec2_daytimetel']; ?>" name="daytimetel" id="daytimetel" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Evening time tel : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec2_eventimetel']; ?>" name="eventimetel" id="eventimetel" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Email address : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec2_emailaddress']; ?>" name="emailaddr" id="emailaddr" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="banners" style="margin:10px 0;">
Emergency Contact Details
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> First name : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_name']; ?>" name="emergname" id="emergname" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Last name : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_lname']; ?>" name="emerglname" id="emerglname" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Relationship to child : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_relationship']; ?>" name="emergrelation" id="emergrelation" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Address : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_address']; ?>" name="emergaddress" id="emergaddress" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> City : </div>
<div class="edit-details-control floatLeft">
<select name="city_emg" id="city_emg" class="pro-fields">
        <option value="0">Select City:</option>
<?php $county = mysql_query("select * from `uk_city`");
while($cc = mysql_fetch_array($county)) { ?>
<option value="<?php echo $cc['Id'];?>" <?php if($cc['Id'] == $r['occ_sec3_emerg_city']) { echo 'selected'; } ?>><?php   echo $cc['cities_name'];  ?></option>
<?php } ?>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> County : </div>
<div class="edit-details-control floatLeft">

<select name="county_emg" id="county_emg" class="pro-fields">
        <option value="0">Select County:</option>
<?php $county = mysql_query("select * from `uk_county`");
while($cc = mysql_fetch_array($county)) { ?>
<option value="<?php echo $cc['counties_name'];?>" <?php if($cc['Id'] == $r['occ_sec3_emerg_county']){ echo 'selected'; } ?>><?php   echo $cc['counties_name'];  ?></option>
<?php } ?>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft">Postal Code : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_postcode']; ?>" name="postalcode_emg" id="postalcode_emg" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Day time tel : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_daytel']; ?>" name="emergdaytel" id="emergdaytel" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Evening time tel : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_sec3_emerg_eventel']; ?>" name="emergeventel" id="emergeventel" class="pro-fields"></div>
<div class="clear"></div>
</div>

<div class="banners" style="margin:10px 0;">
Sporting Information <span>(Section 4 - Sporting Information)</span>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Has the child played Cricket before? : </div>
<div class="edit-details-control floatLeft">
<select name="played" id="played" class="pro-fields">
<option value="1" <?php if($r['occ_child_played'] == '1')  {  echo 'selected'; } ?>>Yes</option>
<option value="2" <?php if($r['occ_child_played'] == '2')  { echo 'selected'; } ?>>No</option>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Primary school : </div>
<?php 
$occ   = explode("|",$r['occ_played_cricket']);
$imp   = explode("|",$r['occ_impairment']);
$medc  = explode("|",$r['occ_medical_consent']);
$appr  = explode("|",$r['occ_appropriate_ans']);
$const = explode("|",$r['occ_club_constitution']);
 ?>
<div class="edit-details-control floatLeft"><input type="checkbox" value="primary_school" <?php
for($acc = 0; $acc < count($occ); $acc++)
 {
   if($occ[$acc] == 'primary_school') { echo 'checked';} 
  }  ?> name="played_cricket1" id="played_cricket1"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Secondary school : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="secondary_school" <?php for($acc = 0; $acc < count($occ); $acc++)
{
	
if($occ[$acc] == 'secondary_school') { echo 'checked';} } ?> name="played_cricket2" id="played_cricket2"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Special Educational Needs school : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="special_educational_needs_school" <?php for($acc = 0; $acc < count($occ); $acc++)
{
if($occ[$acc] == 'special_educational_needs_school') { echo 'checked';} } ?> name="played_cricket3" id="played_cricket3"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Local authority coaching session(s) : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="local_authority_coaching_session" <?php for($acc = 0; $acc < count($occ); $acc++)
{
if($occ[$acc] == 'local_authority_coaching_session') { echo 'checked';} } ?> name="played_cricket4" id="played_cricket4"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Club : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="club" <?php
for($acc = 0; $acc < count($occ); $acc++)
{

if($occ[$acc] == 'club') { echo 'checked';} } 
?> name="played_cricket5" id="played_cricket5"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> County : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="county" <?php if($r['occ_played_cricket'] == 'county') { echo 'checked';} ?> name="played_cricket6" id="played_cricket6"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Other state (please specify): </div>
<div class="edit-details-control floatLeft">
<textarea name="otherstate" id="otherstate" class="pro-fields" style="height:60px;"><?php echo $r['occ_other_state']; ?></textarea>
</div>
<div class="clear"></div>
</div>
<div class="banners" style="margin:10px 0;">
Impairment Information <span>(Section 5 – Information about any Impairment)</span>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Do you consider your child / the child in your care to have impairment?  </div>
<div class="edit-details-control floatLeft">
<select name="care_imp" id="care_imp" class="pro-fields">
<option value="1" <?php if($r['occ_care_impairment'] == '1')  {  echo 'selected'; } ?>>Yes</option>
<option value="2" <?php if($r['occ_care_impairment'] == '2')  { echo 'selected'; } ?>>No</option>
</select>
</div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Visual impairment : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="visual_impairment" <?php 
for($mp = 0; $mp < count($imp); $mp++)
 {
   if($imp[$mp] == 'visual_impairment') { echo 'checked';} 
  } 
 ?> name="impairment1" id="impairment1"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Hearing impairment : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="hearing_impairment" <?php 
for($mp = 0; $mp < count($imp); $mp++)
 {
   if($imp[$mp] == 'hearing_impairment') { echo 'checked';} 
  } 
?> name="impairment2" id="impairment2"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Physical impairment : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="physical_impairment" <?php 
for($mp = 0; $mp < count($imp); $mp++)
 {
   if($imp[$mp] == 'physical_impairment') { echo 'checked';} 
  } 
?> name="impairment3" id="impairment3"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Learning difficulty : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="learning_difficulty" <?php 
for($mp = 0; $mp < count($imp); $mp++)
 {
   if($imp[$mp] == 'learning_difficulty') { echo 'checked';} 
  } 
 ?> name="impairment4" id="impairment4"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Multiple impairment : </div>
<div class="edit-details-control floatLeft"><input type="checkbox" value="multiple_impairment" <?php 
for($mp = 0; $mp < count($imp); $mp++)
 {
   if($imp[$mp] == 'multiple_impairment') { echo 'checked';} 
  } 
 ?> name="impairment5" id="impairment5"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Other state (please specify): </div>
<div class="edit-details-control floatLeft">
<textarea name="other_spcf" id="other_spcf" class="pro-fields" style="height:60px;"><?php echo $r['occ_imp_state']; ?></textarea>
</div>
<div class="clear"></div>
</div>
<div class="banners" style="margin:10px 0;">
Medical Information <span>(Section 6 – Medical Information)</span>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> If you have ticked yes in any box above please provide us with any additional information that will assist us to ensure your child is fully supported whilst at the club and the coach and Welfare Officer are aware of any special requirements and know-how on how to accomodate your child, fully, in all cricketing activities at the club. </div>
<div class="edit-details-control floatLeft">
<textarea name="additional_info" id="additional_info" class="pro-fields" style="height:60px;"><?php echo $r['occ_imp_additional']; ?></textarea></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Name of Doctor / Surgery : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_doctorname']; ?>" name="name_dr" id="name_dr" class="pro-fields"></div>
<div class="clear"></div>
</div>
<div class="edit-user">
<div class="edit-heads-control floatLeft"> Doctor / Surgery telephone number : </div>
<div class="edit-details-control floatLeft"><input type="text" value="<?php echo $r['occ_doctortel']; ?>" name="tel_dr" id="tel_dr" class="pro-fields"></div>
<div class="clear"></div>
</div>
<?php if($query1 = mysql_query("SELECT * FROM `payment_recieved` WHERE `uid` = '$userId'")) { ?>
<div class="banners" style="margin:10px 0;">
Payment History 
<div class="clear"></div>
</div>
<div id="histHolder">


<table width="700" border="1" align="center" cellpadding="5" cellspacing="0">
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
	
	echo "<a href=\"edit_payment.php?id=".$fetch['payment_id']."&uid=".$userId."\">Edit</a>";
	
	
		}
	
	
	?>
	</td>
  </tr>

<?php 

	$rcounter++;

		} 

?> </table>




</div>


 <?php } ?>
 <?php if($_SESSION['Administrator']) { ?>
<div class="edit-user">
<div align="center" style="margin:10px 0;">
<input type="submit" value="Update" name="update" id="update" class="edit-control-btn"></div>
</div>
<?php } ?>
</form>
</div>
</div>

<?php } ?>

</div>
<?php include_once("footer.php"); ?>
</div>
</body>
</html>
<!--<a onClick="update_app('<?php// echo $r['id']; ?>');" class="edit-control-btn"> Update </a>-->
