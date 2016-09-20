<?php 
include("include/db_config.php");
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

$selectmethod = mysql_query("select * from `payment_method`");
$uid = $_GET['uid'];
$cc = mysql_query("select * from `occ_registrant` WHERE `source_type` = 1");


$isPosted = count($_POST);



if($isPosted > 0)
	{
		$description = $_POST['description1'];
		$note = $_POST['note1'];
		$amount = $_POST['amount1'];
		$method = $_POST['method1'];
		$status = $_POST['status1'];
		$user_id = $_POST['userid'];
		
		
		$date = date('m/d/Y h:i:s a', time());
		$NameofPerson = $_SESSION['firstname'].'&nbsp;'.$_SESSION['lastname'];
		$datetwin = "$date','";
		$insertQuery = mysql_query("insert into payment_recieved values ('','$user_id','$amount','$description','$note','$status','$method','$datetwin','','1')");
		
		
	
		if($status == 1){
		
		
		$findpay = mysql_query("SELECT * FROM  payment_recieved WHERE uid =  '$user_id' and source_type = 1 ORDER BY  payment_id DESC LIMIT 0 , 1");		
		$finduser = mysql_query("SELECT * FROM  occ_registrant where sid = '$user_id' and source_type = 1 LIMIT 0 , 1");

		while($stuser = mysql_fetch_array($finduser)){
			
			$user_fullname = $stuser['occ_firstname']." ".$stuser['occ_lastname'];
			$user_guardname = $stuser['occ_sec2_guardian_name'];			
			$user_email = $stuser['occ_sec2_emailaddress'];
					
		while($stemail = mysql_fetch_array($findpay)){
		
		
		
			
				
		$item_desc = $stemail['description'];	
		$item_amount = $stemail['amount'];	
		$item_custom = $stemail['payment_id'];						
						
		//				echo $item_desc;
		//				exit();
												
						$pendemail = "

<html>
<head>

<style type=\"text/css\">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
</style>


</head>
<body>
<div style=\"border:1px solid #ccc; padding:5px 0;\">
<div>
<header style=\"border-bottom:1px solid #ccc;\">
<div id=\"headSection\">
<a href=\"http://www.osterleycc.com/\" ><img src=\"http://www.osterleycc.com/apply/images/PaymentRequested.png\" width=\"488\" height=\"144\" />
</a>
</div>
</header>
<div style=\"border-top:1px solid #ccc;padding: 15px;font-weight: bold;background: #f7f8fc;box-shadow: inset #ccc 0 1px 1px 0;\">
<p>Dear ".$user_guardname.",</p>

<p>You have a pending payment of &pound;".$item_amount." for your child ".$user_fullname." (<strong>\"".$item_desc."\"</strong>) on your account. Please click the PAY NOW button below to pay the outstanding amount.</p>

<p>



      

<a href=\"https://www.paypal.com/cgi-bin/webscr?business=omer@osterleycc.com&cmd=_xclick&currency_code=GBP&amount=".$item_amount."&item_name=".$item_desc."&custom=$item_custom&cancel_return=http://www.osterleycc.com/apply/abort.html&notify_url=http://www.osterleycc.com/apply/ipn4.php&return=http://www.osterleycc.com/apply/thankyou.html\" ><img src=\"http://www.osterleycc.com/apply/images/paynow.gif\"  />
</a>

</p>

<p>If you have any queries or are not sure about why you have recieved this payment request please contact the Administrator Omer Butt on 07774573622.</p>

<p>Osterley Cricket Club</p>
</div>

</div>
</div>
</body>
</html>";



						
						
						
	//					$body = $pendemail;
						$headers = "From: omer@osterleycc.com";
						$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
	//					$body = str_replace("#Fullname#",$NameofPerson,$body); 
	//					$body = str_replace("#XXX#",$amount,$body); 
	//					$body = str_replace("#description#",$description,$body); 
//						$mail_function = mail("qasimnepster@gmail.com", " Registration Successful ", $body, $headers); 
						$mail_function = mail($user_email, "Payment Request from OsterleyCC ", $pendemail, $headers);
		
			}
		}
		} 
		
		else {
		$datetwin = "$date','$date";


						$body = $compemail;
						$headers = "From: omer@osterleycc.com";
						$headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";
						$body = str_replace("#Fullname#",$NameofPerson,$body); 
						$body = str_replace("#XXX#",$amount,$body);
						$body = str_replace("#Description#",$description,$body);
						$mail_function = mail("qasimnepster@gmail.com", " Payment Completed ", $body, $headers); 
						$mail_function = mail("omer@osterleycc.com", " Payment Required ", $body, $headers);
		}

	
		if($insertQuery)
		{
			mysql_query("update `occ_registrant` set `status` = 1 where `sid` = '$uid' WHERE `source_type` = 1");
			header("Location: colts_info.php?action= Payment Added Successfully");
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
	<script src="js/jquery-latest.js" type="text/javascript"></script>
    <script type="text/javascript">

function showUser(val)
{
	var method = $("#method1").val();
    window.location.assign("add_payment.php?uid="+method);
}

	</script>
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

<form name="paym1" id="paym1" action="" method="post">

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="progresstable" style="margin-top:10px;">
<tr>
<td width="27.5%" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Select user :</td>
<td style="background:#fff;  border-bottom:none;">
<select name="method1" id="method1" class="fields" style="width:52%;" onchange="showUser(this.value)">
<?php
while($occ = mysql_fetch_array($cc)) {  ?>
<option value="<?php echo $occ['sid']; ?>" <?php if($occ['sid'] == $uid) { echo 'selected'; } ?>><?php echo $occ['Id'].'&nbsp;'.$occ['occ_firstname'].'&nbsp;'.$occ['occ_lastname']; ?></option>
<?php } ?>
</select>
</td>
</tr>

</table>

<?php if($_GET['uid']) {
	$crd = mysql_query("select * from `occ_registrant` where `sid` = '$uid'");
	$crow = mysql_fetch_array($crd);
	$_SESSION['firstname'] = $crow['occ_firstname'];
	$_SESSION['lastname'] = $crow['occ_lastname'];
	 ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="progresstable" style="margin-top:10px;">
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Firstname</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><?php echo $crow['occ_firstname']; ?></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Lastname</td>
<td style="background:#fff; border-bottom:none; text-align:center;"><?php echo $crow['occ_lastname']; ?></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Amount</td>
<td style="background:#fff; border-bottom:none;"><input type="text" value="" name="amount1" id="amount1" class="fields"></td>
</tr>
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Description</td>
<td style="background:#fff; border-bottom:none;"><input type="text" name="description1" id="description1" class="fields" value=""></td>
</tr>
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Notes</td>
<td style="background:#fff; border-bottom:none;"><textarea name="note1" id="note1" class="fields" style="height:100px;"></textarea></td>
</tr>


<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Method</td>
<td style="background:#fff;  border-bottom:none;">
<select name="method1" id="method1" class="fields" style="width:52%;">
<?php
while($mthd = mysql_fetch_array($selectmethod)) {  ?>
<option value="<?php echo $mthd['Id']; ?>"><?php echo $mthd['method']; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Status</td>
<td style="background:#fff;  border-bottom:none;">
<select name="status1" id="status1" class="fields" style="width:52%;">

<option value="1">Pending</option>
<option value="2">complete </option>

</select>
</td>
</tr>
<tr>
<td style="background:#fff; border-right:none;">&nbsp;</td>
<td style="background:#fff; border-left:none;">
<input type="hidden" value="<?php echo $_GET['uid']; ?>" name="userid" id="userid">
<input type="submit" value="Add payment" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:25%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</table>
<?php } ?>



</form>

</div>
<?php include_once("footer.php"); ?>
</div>

</body>
</html>
