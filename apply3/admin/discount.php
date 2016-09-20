<?php
include("include/db_config.php");
include("include/session_timeout.php");
$username = 'Welcome'. '&nbsp;' .$_SESSION['UserName'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
if($_POST['fnamount'] != NULL)
{
$discountCode = $_POST['dscount'];
$first = $_POST['fname'];
$firstname = strtolower($first);
$last = $_POST['lname'];
$lastname = strtolower($last);
$birth = $_POST['birthday_day'].'/'.$_POST['birthday_month'].'/'.$_POST['birthday_year'];
$amount = $_POST['fnamount'];
$atStatus = $_POST['status'];
//$queryString = mysql_query("select * from `app_form` where cs_fname = '$firstname' and cs_sname = '$lastname' and cs_birth = '$birth'");
//if(mysql_num_rows($queryString) > 0)
//{
if(mysql_query("INSERT INTO `discounted_amount` VALUES ('', '$firstname', '$lastname', '$birth', '$amount', '$atStatus', '1')"))
$action = 'Discount Code Has Been Generated!';
//}
}
$qs	=	mysql_query("select status from `occ_registrant` where `status` = '1' and `occ_firstname` = '$firstname' and `occ_lastname` = '$lastname' and `occ_birthday` = '$birth'");


$disCountQuery = mysql_query("SELECT * FROM `discounted_amount`");

/*function random_letters ($numofletters) { 
    if (!isset($numofletters)) $numofletters = 10; // if $numofletters is not specified sets to 10 letters 
	$numFloat = array('0','1','2','3','4','5','6','7','8','9');
    $literki = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'W'); 
	
    $ilosc_literek = count($literki); 
    for ($licz = 0; $licz < $numofletters; $licz++) { 
    $rand = rand(0, $ilosc_literek-1); 
    $vercode = $vercode.$literki[$rand]; 
    } 
		return substr($vercode , 0,5).$rand;
}*/

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $username; ?></title>
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <link rel="stylesheet" media="screen" href="css/datePicker.css">
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript">
	$(document).ready(function(e) {
		
		$("#popUpWindow, #closeIcon").click(function(e) {
            $("#progress").toggle("fast");
        });
		
		 
		$('th, td').css('border-bottom', 'none');
		$('th, td').css('border-right', 'none');
		
		$("#gnr_code tr:last-child td").css("border-bottom", "1px solid #999");
		$("#gnr_code tr th:last-child , td:last-child").css("border-right", "1px solid #999");
    });

		
	
</script>
<style>
.row0{
 background:#ffd;
}
.row1{
 background:#f9f9f9;
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
left:50%;
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
th
{
	background:#fff;
}
</style>
</head>
<body>
<?php if($status == true) { ?>

<?php } ?>
<div id="page-wrapper">
<!--<header>
<div id="header-content">Manage Applicants Settings</div>
</header>-->
<div id="content-manage">
<?php include("navigation_bar.php");?>
<div class="content">
<a id="popUpWindow">
<div class="generate">Generate Discount Code <span class="addic">+</span></div>
</a>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="gnr_code">
    <tr>
      <th width="5%">S.NO </th>
      <th width="60%" >User Details </th>
      <th width="24%" >Final Amount</th>
      <th width="11%" >Status</th>
      <th>Delete</th>
    </tr>
<?php
$i = 0;
while($afrows = mysql_fetch_array($disCountQuery)) {

$i++
?>
      <tr class="<?php echo $class; ?>" id="row">
      <td width="5%"><?php echo $afrows['Id']; ?></td>
      <td width="60%"><?php echo $afrows['fname'].' &nbsp; '.$afrows['lname'].' &nbsp; | '.$afrows['date_birth'];?></td>
      <td width="24%"><?php echo $afrows['discounted_amount']; ?></td>
      <td width="11%"><?php echo $afrows['status']; ?></td>
     <td><a onClick="delete_discode('<?php echo $afrows['Id']; ?>');"><img src="images/trash_recyclebin_empty_closed.png" width="24" height="24" id="show_status" style="cursor:pointer;"></a></td>
    </tr>
    
   <?php
   
    } ?>
    </table>
    
</div>
<div id="progress" style="display:none; background:rgba(0,0,0,0.5);">
<form name="discount_code" id="discount_code" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" style=" position:relative;">
<span style="position:absolute; right:0; margin-right:125px;"><img src="http://osterleycc.com/apply/admin/images/del-cross.png" width="24" height="24" style="cursor:pointer;" id="closeIcon"></span>
  <table width="100%" border="0"  class="progresstable">
  
    <tr>
      <td>First name :</td>
      <td><input type="text" value="" name="fname" id="fname" class="fields"></td>
    </tr>
    <tr>
      <td>Last name :</td>
      <td><input type="text" value="" name="lname" id="lname" class="fields"></td>
    </tr>
    <tr>
      <td>Date of birth :</td>
      <td align="center">
 <select name="birthday_day" id="birthday_day_fac" class="fieldsfor" style="border:1px solid #ddd; border-radius:5px; padding:5px;" aria-label="Day">
 <option value="0">Day :</option>
 <?php for($i=1; $i<=31; $i++){ ?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
 </select>
             
            <select name="birthday_month" id="birthday_month_fac" style="border:1px solid #ddd; border-radius:5px; padding:5px;" aria-label="Month" class=""><option value="">Month :</option><option value="none">Month:</option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="Jul">Jul</option><option value="Aug">Aug</option><option value="Sep">Sep</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option></select></select>

  <select name="birthday_year" id="birthday_year_fac" aria-label="Year" style="border:1px solid #ddd; border-radius:5px; padding:5px;">
   <option value="0">Year :</option>
    <?php for($ye = 1994; $ye <= 2013; $ye++){ ?>
                <option value="<?php echo $ye ;?>"><?php echo $ye; ?></option>
                <?php } ?></select></td>
    </tr>
    <tr>
      <td>Final amount :</td>
      <td class="tip"><input type="text" value="" name="fnamount" id="fnamount" class="fields">
      <span><p>Give Finat Amount Format e.g 40.00</p></span>
      </td>
    </tr>
    
    <input type="hidden" value="1" name="status" id="status">
    <input type="hidden" value="1" name="user_id" id="user_id">
        <tr>
    	<td colspan="2"><input type="submit" value="Submit" name="submit" id="submit" style="border:1px solid #ccc; border-radius:3px; font-weight:bold; padding:5px; width:25%; box-shadow:#dcdcdc 0 1px 2px 0 inset; color:#333;">
        </td>
    </tr>
  </table>
</form>
</div>
</div>
<?php include_once("footer.php"); ?>
</div>
</div>
</body>
</html>