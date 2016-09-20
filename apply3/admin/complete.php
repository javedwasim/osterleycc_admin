<?php 

	$findpay = mysql_query("SELECT * FROM  payment_recieved where uid = '$user_id' ORDER BY payment_id DESC LIMIT 0 , 1");		
		$finduser = mysql_query("SELECT * FROM  occ_registrant where uid = '$user_id' LIMIT 0 , 1");
		
		
		$clientmail = mysql_fetch_array($findpay);
		
		
		$item_desc = $clientmail['description'];
		$custom = $clientmail['payment_id'];
		



$compemail = "<html>
<head>
</head>
<body>
<div style=\"border:1px solid #ccc; padding:5px 0;\">
<div>
<header style=\"border-bottom:1px solid #ccc;\">
<div id=\"headSection\">
<a href=\"http://www.osterleycc.com/\" ><img src=\"http://www.osterleycc.com/apply/images/PaymentRecievedHeader.png\" width=\"488\" height=\"144\" />
</a>
</div>
</header>
<div style=\"border-top:1px solid #ccc;padding: 15px;font-weight: bold;background: #f7f8fc;box-shadow: inset #ccc 0 1px 1px 0;\">
<p>Dear #Fullname#,</p>

<p>Thank you for your payment of £100. Please retain this email as proof of your payment to Osterley CC for \"#Description#\".</p>

<p>Osterley Cricket Club</p>
</div>

</div>
</div>
</body>

</html>";



$pendemail = "

<html>
<head>
</head>
<body>
<div style=\"border:1px solid #ccc; padding:5px 0;\">
<div>
<header style=\"border-bottom:1px solid #ccc;\">
<div id=\"headSection\">
<a href=\"http://www.osterleycc.com/\" ><img src=\"http://www.osterleycc.com/apply/admin/images/PaymentRequested.png\" width=\"488\" height=\"144\" />
</a>
</div>
</header>
<div style=\"border-top:1px solid #ccc;padding: 15px;font-weight: bold;background: #f7f8fc;box-shadow: inset #ccc 0 1px 1px 0;\">
<p>Dear #Fullname#,</p>

<p>You have a pending payment of #XXX# for \"#description#\" on your account. Please follow click the below button to pay the outstanding amount.</p>

<p>
<a href=\"https://www.paypal.com/cgi-bin/webscr?business=omer@osterleycc.com&cmd=_xclick&currency_code=GBP&amount=100&item_name=".$item_desc."&custom=".$item_custom."\" ><img src=\"http://www.osterleycc.com/apply/images/paynow.gif\"  />
</a>

</p>

<p>If you have any queries or are not sure about why you have recieved this payment request please contact the Administrator Omer Butt on 07774573622.</p>

<p>Osterley Cricket Club</p>
</div>

</div>
</div>
</body>
</html>";


?>