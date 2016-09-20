<?php include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];

//mail function starts

function readTemplateFile($FileName)
 {
  $fp = fopen($FileName,"r") or exit("Unable to open File ".$FileName);
  $str = "";
  while(!feof($fp)) {
   $str .= fread($fp,1024);
  } 
  return $str;
}

//mail function ends

$userId = $_GET['uid'];
$payId = $_GET['id'];
if($userId)
{
	$selectmethod = mysql_query("select * from `payment_method`");
	
	$selectusers = mysql_query("select * from occ_registrant as r, payment_recieved as p where r.sid = p.uid and p.uid = '$userId' and p.payment_id = '$payId' and p.source_type = 1");
	$rows = mysql_fetch_array($selectusers);
	
	$isPosted = count($_POST);
	if($isPosted > 0)
		{
			
			$pid = $_POST['pid'];
			$amount 		= $_POST['amount1'];
			$description 	= $_POST['description1'];
			$note 			= $_POST['note1'];
			$method 		= $_POST['method1'];
			$user_conf_email = $rows['occ_sec2_emailaddress'];
			$date = date('m/d/Y h:i:s a', time());
			$updateQuery = mysql_query("update `payment_recieved` set `amount` = '$amount' , `description` = '$description' , `note` = '$note' , `status` = '2' , `method` = '$method' , `date_recieved` = '$date' where `payment_id` = '$pid'");
			if($updateQuery)
				{
					mysql_query("update `occ_registrant` set `status` = '2' where `sid` = '$userId'");
				}
			if($_POST['email_format']!= NULL)
			{
				$formats = $_POST['email_format'];
				if($formats == '1')
					{
						$NameofPerson = $rows['occ_firstname']." ".$rows['occ_lastname'];					
						$nameguard = $rows['occ_sec2_guardian_name'];
						$body = readTemplateFile("successfull.html");
						$headers = "From: omer@osterleycc.com";
						$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
						$body = str_replace("#Fullname#",$nameguard,$body); 
					//	$mail_function = mail("qasimnepster@gmail.com", " Registration Successful ", $body, $headers); 
					//	$mail_function = mail("omer@osterleycc.com", " Registration Successful ", $body, $headers);
						$mail_function = mail($user_conf_email, " Registration Successful for $NameofPerson", $body, $headers); 
					}
				if($formats == '2')
					{
						$NameofPerson = $rows['occ_firstname']." ".$rows['occ_lastname'];
						$price = $rows['amount'];
						$body = readTemplateFile("complete.html");
						$headers = "From: omer@osterleycc.com";
						$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
						$body = str_replace("#Fullname#",$NameofPerson,$body); 
						$body = str_replace("#XXX#",$price,$body);
						$body = str_replace("#Description#",$description,$body);
				//		$mail_function = mail("qasimnepster@gmail.com", " Payment Completed ", $body, $headers); 
				//		$mail_function = mail("omer@osterleycc.com", " Payment Completed ", $body, $headers);
						$mail_function = mail($user_conf_email, " Registration Successful for $NameofPerson", $body, $headers); 

					
					}
			}
			
			header("Location: colts_info.php?action= Updates Successfully");
				
		}
	
		
		
}

	else
	{
		header("Location:colts_info.php?");
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

<form name="paym1" id="paym1" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $payId;?>&uid=<?php echo $userId;?>" method="post">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="progresstable" style="margin-top:10px;">
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Firstname</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><?php echo $rows['occ_firstname']; ?></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Lastname</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><?php echo $rows['occ_lastname']; ?></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Amount :</td>
<td style="background:#fff; border-bottom:none;"><input type="text" value="<?php echo $rows['amount']; ?>" name="amount1" id="amount1" class="fields"></td>
</tr>
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Description :</td>
<td style="background:#fff; border-bottom:none;"><input type="text" name="description1" id="description1" class="fields" value="<?php echo $rows['description']; ?>"></td>

</tr>
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Notes :</td>
<td style="background:#fff; border-bottom:none;"><textarea name="note1" id="note1" class="fields" style="height:100px;"><?php echo $rows['note']; ?></textarea></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Method :</td>
<td style="background:#fff;  border-bottom:none;">
<input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id'];?>">
<select name="method1" id="method1" class="fields" style="width:52%;">
<?php
while($mthd = mysql_fetch_array($selectmethod)) {  ?>
<option value="<?php echo $mthd['Id']; ?>"><?php echo $mthd['method']; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Email :</td>
<td style="background:#fff;  border-bottom:none;">
<select name="email_format" id="email_format" class="fields" style="width:52%;">
<?php
$selectemails = mysql_query("select * from `email_formats` where `email_status` = '1'");
while($eml = mysql_fetch_array($selectemails)) {  ?>
<option value="<?php echo $eml['Id']; ?>"><?php echo $eml['email_names']; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td style="background:#fff;" colspan="2"><input type="submit" value="Complete payment" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:25%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</table>
</form>

</div>
<?php include_once("footer.php"); ?>
</div>

</body>
</html>
