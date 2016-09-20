<?php
include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

$isPosted = count($_POST);
if($isPosted > 0)
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
		echo mysql_error();
	}
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
 <form name="AddUserDetails" id="AddUserDetails" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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

<td colspan="2" style="background:#fff; border-left:none;">
<input type="submit" value="Add Template" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:65%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</tbody></table>
</form>
</div>
<?php include_once("footer.php"); ?>
</div>

</body>
</html>