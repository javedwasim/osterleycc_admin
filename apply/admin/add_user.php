<?php
include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

$isPosted = count($_POST);
if($isPosted > 0)
{
	$adUserName = $_POST['userName'];
	$adpasWrd = $_POST['pasWrd'];
	$adMethod = $_POST['method1'];
	$adAccType = $_POST['accFor'];
	
	$query = mysql_query("INSERT INTO `occ_admin` (`occ_username`,`occ_password`,`occ_access_type`,`occ_status`) VALUES ('$adUserName','$adpasWrd','$adAccType','$adMethod')");
	if(mysql_affected_rows() > 0 )
	{
		echo "<script> alert('User Added Successfully!'); </script>";
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
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Username :</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><input type="text" value="" name="userName" id="userName" class="fields"></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Password :</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><input type="password" value="" name="pasWrd" id="pasWrd" class="fields"></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Access / Authority</td>
<td style="background:#fff;  border-bottom:none;">
<select name="method1" id="method1" class="fields" style="width:52%;">
<option value="1">Admin</option>
<option value="2">Coach</option>
</select>
</td>
</tr>

<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Access / Authority For</td>
<td style="background:#fff;  border-bottom:none;">
<select name="accFor" id="accFor" class="fields" style="width:52%;">
<option value="1">Colts</option>
<option value="2">Adults</option>
<option value="3">Both</option>
</select>
</td>
</tr>

<tr>
<td colspan="2" style="background:#fff; border-left:none;" align="center">

<input type="submit" value="Add User" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:65%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</tbody></table>
</form>
</div>
<?php include_once("footer.php"); ?>
</div>

</body>
</html>