<?php
include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

$isPosted = count($_POST);
if($isPosted > 0 && $_POST['tmplName'] != NULL)
{
	$adtmplName = $_POST['tmplName'];
	$adsmleCode = $_POST['smleCode'];
	
	$query = mysql_query("INSERT INTO `email_tmpl` (`empl_name`,`empl_src_code`,`empl_created_date`,`empl_status`) VALUES ('$adtmplName','$adsmleCode',NOW(),1)");
	if(mysql_affected_rows() > 0 )
	{
		echo "<script> alert('Template Added Successfully!'); </script>";
	}
	else
	{
		echo "<script> alert('Something Went Wrong'); </script>";
	}
}



if(isset($_GET['UserId']))
{
	$SrcId = isset($_GET['UserId']);
	
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $username; ?></title>
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type="text/javascript" src="js/jquery-latest.js"></script>
   

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
 <form name="AddETmplDetails" id="AddETmplDetails" action="<?php echo $_SERVER['PHP_SELF'].'?UserId='.$_GET['UserId'];?>" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="progresstable" style="margin-top:10px;width:40%;">
<tbody><tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Template Name :</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><input type="text" value="" name="tmplName" id="tmplName" class="fields" style="width: 80%;"></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Html Code :</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><textarea name="smleCode" id="smleCode" class="fields" style="height: 150px;width: 80%;"></textarea></td>
</tr>
<tr>
<td style="background:#fff; border-left:none;" colspan="2">
<input type="submit" value="Add Template" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:65%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</tbody></table>
</form>

<?php if(isset($_GET['UserId'])){
$etmplquery = mysql_query('select * from email_tmpl limit 1');
$etotalrows = mysql_num_rows($etmplquery);	
?>

<form name="SendETmplDetails" id="SendETmplDetails" action="<?php echo $_SERVER['PHP_SELF'].'?UserId='.$_GET['UserId'];?>" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="progresstable" style="margin-top:10px;width:40%;">
<tbody><tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Templates :</td>
<td style="background:#fff; border-bottom:none; text-align:center;">
<select name="etmpl" id="etmpl" style="width:80%;" class="fields">
<?php 
if($etotalrows > 0) { 
while($etrows = mysql_fetch_array($etmplquery)) {
$etdata[]	= $etrows;
?>
<option value="<?php echo $etrows['empl_id'];?>"><?php echo $etrows['empl_name'];?></option>
<?php } } ?>
</select></td>
</tr>
<tr>
<td style="background:#fff; border-left:none;" colspan="2">
<input type="submit" value="Process Email" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:65%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</tbody></table>
</form>
<?php } ?>
</div>
<?php include_once("footer.php"); ?>
</div>

</body>
</html>



<?php
if($isPosted > 0 && $_POST['etmpl'] != NULL)
{
	$query_source = "SELECT * FROM `occ_registrant` WHERE `Id` = {$_GET['UserId']} ";
	$fetch_source = mysql_query($query_source);
	if(mysql_num_rows($query_source) > 0 ) { 
	$src = mysql_fetch_array($fetch_source);
	$etmplname = $_POST['etmpl'];
	if($etotalrows > 0) { 
		foreach($etdata as $etrow){
			$body = '';
			$body .= $etrow['empl_src_code'];	
			$body = str_replace("#Applicantfullname#", $src['occ_firstname'].'&nbsp;'.$src['occ_lastname'], $body);
			$body = str_replace("#Dateofbirth#", $src['occ_birthday'], $body);
			$body = str_replace("#Gender#", $src['occ_gender'], $body);
			$body = str_replace("#Contactno#", $src['occ_sec2_daytimetel'], $body);
			$body = str_replace("#Jobtitle#", $src['occ_job_title'], $body);
			$body = str_replace("#Email#", $src['occ_sec2_emailaddress'], $body);
			$body = str_replace("#Totalprice#", $src['occ_total_price'], $body);
			$body = str_replace("#Registrationdate#", $src['date_registration'], $body);

			
			$headers = "From: omer@osterleycc.com";
			$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
			$estatus = @mail("qasimnepster@gmail.com", "Welcome to OsterleyCC", $body, $headers);
			
		}
	}
	}
}
?>