<?php 
include("include/db_config.php");
if($_POST['usn-admin'])
{
	$adm_username = $_POST['usn-admin'];
	$adm_password = $_POST['usn-pwd'];
	$user_name    = preg_replace('/[^A-Za-z0-9]/', '', $_POST['usn-admin']);
	$user_pass    = preg_replace('/[^A-Za-z0-9]/', '', $_POST['usn-pwd']);
	$queryadm     = mysql_query("SELECT * FROM `occ_admin` WHERE `occ_username` = '$user_name' AND `occ_password` = '$user_pass'");

	$row = mysql_fetch_array($queryadm);
	
		if (mysql_num_rows($queryadm) > 0 ) {
				
						$_SESSION['IsActive'] = true;
						$_SESSION['Id']   =  $row['Id'];
						if($row['occ_status'] == 1)
						{
							$_SESSION['Administrator'] = $row['occ_status'];
							$_SESSION['UserName']      = 'Administrator';
						}
						else
						{
							$_SESSION['UserName']      = 'Coach';
						}
						header("Location:colts_info.php?action=WELCOME {$_SESSION['UserName']}");
						exit();	
		
		} else {
						header("Location:index.php?action=failed");
						exit();
			}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login | Admin | Osterley Cricket Club </title>
	<link rel="apple-touch-icon" href="favicon.ico"/> 
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type="text/javascript" src="js/jquery-latest.js"></script>
</head>
<body>
<div id="page-wrap">
<div id="wrapper-section">
<div id="content-admin">
<div class="admin-heading">Login</div>
<div class="admin-content">
<form name="admin-login" id="admin-login" method="post">
<div>
<div class="admin-use-sec floatLeft">Username : </div>
<div class="admin-pwd-sec floatLeft"><input type="text" value="" name="usn-admin" id="usn-admin" class="admin-fields"></div>
<div class="clear"></div>
</div>
<div>
<div class="admin-use-sec floatLeft">Password : </div>
<div class="admin-pwd-sec floatLeft"><input type="password" value="" name="usn-pwd" id="usn-pwd" class="admin-fields"></div>
<div class="clear"></div>
</div>
<div align="center"><input type="submit" value="Login" class="login-admin"></div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>