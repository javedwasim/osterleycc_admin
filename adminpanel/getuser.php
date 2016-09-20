<?php include("include/db_config.php");
include("include/session_timeout.php");
$uid=$_GET["uid"];
$selectmethod = mysql_query("select * from `payment_method`");

$fetchdata = mysql_query("select * from `payment_recieved` where `uid` = '$uid'");

$fetch = mysql_fetch_array($fetchdata);
if($fetch)
{
  echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="progresstable" style="margin-top:10px;">
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Description</td>
<td style="background:#fff; border-bottom:none;"><input type="text" name="description1" id="description1" class="fields" value="'.$fetch['description'].'"></td>
</tr>
<tr>
<td valign="top" style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Notes</td>
<td style="background:#fff; border-bottom:none;"><textarea name="note1" id="note1" class="fields" style="height:100px;">'.$fetch['note'].'</textarea></td>
</tr>
<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Amount</td>
<td style="background:#fff; border-bottom:none;"><input type="text" value="'.$fetch['amount'].'" name="amount1" id="amount1" class="fields"></td>
</tr>

<tr>
<td style="background:#fff; font-weight:bold; border-right:none; border-bottom:none;">Method</td>
<td style="background:#fff;  border-bottom:none;">
<select name="method1" id="method1" class="fields" style="width:52%;">
<option value="1">Euro/Mastercard</option>
<option value="2">Visa</option>
<option value="3">Credit card / Debit card</option>
<option value="4">Cheque / Cash</option>
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
<input type="hidden" value="'.$uid.'" name="userid" id="userid">
<input type="submit" value="Submit" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:25%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;"></td>
</tr>
</table>';


}
else
{
	echo '';
}

?>
