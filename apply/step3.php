<?php include("class/db_config.php");



if(!$_SESSION['sid'])
{
	header("Location:index.php");
}


$isPosted = count($_POST);

if($isPosted > 0)
{
$_SESSION['total_price'] = $_POST['total_price'];
	
$date = date("Y-m-d");




}

?>
<!DOCTYPE HTML>
<html>
<head>

<script type='text/javascript'>
(function (d, t) {
  /* var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=bshfgpegfciiwavc7a2xgg';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script'); */
</script>


<meta charset="utf-8">
	<title>Osterley Cricket Club | Colt Registration Form</title>
    <link rel="icon" type="image/png" href="favicon.ico">
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript" src="js/gen_validatorv4.js"></script>
</head>

<body>
<div id="container">
<div id="wrapper">
<?php include("header.php"); ?>
</header>
<div id="tabs-container">
<div class="top-menus">
<div class="floatLeft tab">Colts Information</div>
<div class="floatLeft tab spacing-tab">Sporting Information</div>
<div class="floatLeft tab spacing-tab">INFORMATION</div>
<div class="floatLeft tab spacing-tab tabsactive">Submission &amp; Checklist</div>
<div class="floatLeft tab spacing-tab">APPLICATION COMPLETE</div>
<div class="clear"></div>
</div>
</div>
<div id="content">
<form action="step4.php" name="submission_checklist" id="submission_checklist" method="post">
<div class="mainContent">
<div id="heading" class="indexheadings2">Submission & Checklist <span style="font-size:12px; color:#2687d1; font-weight:600;">(Section 9 – Check-List)</span></div>
<div class="informationSection">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="font-weight:600;">
Please check each box as a virtual signature confirming you have read and abide by its content: 
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="circling_ans1" required id="circling_ans1" <?php if($_SESSION['appropriate_ans1']) echo 'checked';?> value="yes1"  class="appropriate_ans">
<span style="margin-left:20px;">By submitting this completed Junior Membership Form, I agree to my child / the child in my care taking part in the activities of Osterley Cricket Club.</span>
</div>
</div>

<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="circling_ans2" required id="circling_ans2" <?php if($_SESSION['appropriate_ans2']) echo 'checked';?> value="yes2" class="appropriate_ans">
<span style="margin-left:20px;">I confirm that I have legal responsibility for the child named on Page 1/Section 1, and that I am entitled to give this consent.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;"></div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="circling_ans4" id="circling_ans4" required value="yes4" <?php if($_SESSION['appropriate_ans4']) echo 'checked';?>  class="appropriate_ans">
<span style="margin-left:20px;">I understand that I will be kept informed of activities at Osterley Cricket Club – for example details of times and transport etc. - through the means of communication I have provided in this registration form.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="circling_ans5" required id="circling_ans5" value="yes5" <?php if($_SESSION['appropriate_ans5']) echo 'checked';?> class="appropriate_ans">
<span style="margin-left:20px;">I confirm that to the best of my knowledge all information provided in this form is accurate and I will inform the club of any changes to this information in a timely manner.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Colt Name
<span style="position:absolute; top:7px; right:0; margin-right:50%;" class = "step3info">
<span style="margin-left:5px;"><?php echo $_SESSION['fname'].'&nbsp;'.$_SESSION['lname']; ?></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Name of parent / legal guardian
<span style="position:absolute; top:7px; right:0; margin-right:50%;" class = "step3info">
<span style="margin-left:5px;"><?php echo $_SESSION['guardian_name']; ?></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Date
<span style="position:absolute; top:7px; right:0; margin-right:50%;" class = "step3info">
<span style="margin-left:5px;"><?php echo date("d-m-y");?></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="club_constitution" required <?php if($_SESSION['club_constitution']) echo 'checked';?> id="club_constitution" value="yes1" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">Have you read and understood our  <a href="http://www.osterleycc.com/wp-content/uploads/2013/10/Osterley-Cricket-Club-Constitution.pdf" class="anc" target="new">Club Constitution</a></span> and <a href="http://www.osterleycc.com/wp-content/uploads/2015/06/Osterley-Cricket-Club-Inclusion-Diversity-Policy.pdf" target="new" class="anc">Inclusion and Diversity Policy</a>? </div>
</div>

<div style="border-bottom:1px solid #ccc;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="code_of_conduct" required <?php if($_SESSION['code_of_conduct']) echo 'checked';?> id="code_of_conduct" value="yes2" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;"> Have you read and agree to the Code of Conduct and your role/responsiilities at Osterley Cricket Club <a href="http://www.osterleycc.com/information/code-of-conduct/" class="anc" target="_blank"> Read Code of Conduct</a></span> ?
</div>
</div>

<div style="border-bottom:1px solid #ccc; " class="gradient">
<div class="infoPara" style="position:relative;" id="blink_now">
<input type="checkbox" required = "" <?php if($_SESSION['cck_bx']) echo 'checked';?> name="cck_bx" id="cck_bx"  value="1" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px; font-weight:bold;">I have read and agree to the Declaration and the Data Protection Notice.  I consent to the processing of my/my 
child’s personal data (including medical information and the use of images) as described under the Data 
Protection Notice.</span>
</div>
</div>

<div align="center" style="margin-top:10px;">

<div class="infoPara"><input type="submit" value="Continue to next step"   class="submit">
<a href="step2.php" class="backbutton">Back</a>
</div>
</div>
</div>
</div>
</form>
      <script type="text/javascript">
var frmvalidator = new Validator("submission_checklist");		

function validate()
{
if(document.getElementById('cck_bx').checked == false) {
	//alert("Please accept our terms and conditions");	
	
div = document.getElementById("blink_now");
intrvl=0;
for(nTimes=0;nTimes<3;nTimes++){
intrvl += 400;
setTimeout("div.style.backgroundColor='#ddd';",intrvl);
intrvl += 400;
setTimeout("div.style.backgroundColor='#ffffff';",intrvl);
}
return false
		}
}
</script>
</div>
</div>
</div>
</body>
</html>













