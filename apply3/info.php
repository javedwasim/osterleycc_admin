<?php include("class/db_config.php");

if(!$_SESSION['sid'])

{

	header("Location: index.php");

}



$isPosted = count($_POST);

if($isPosted > 0)

{
	
	if(isset($_POST['chld_ply'])){$_SESSION['chld_ply'] = $_POST['chld_ply'];}
	
	if(isset($_POST['played_cricket1'])){$_SESSION['played_cricket1'] = $_POST['played_cricket1'];}
	
	if(isset($_POST['played_cricket2'])){$_SESSION['played_cricket2'] = $_POST['played_cricket2'];}
	
	if(isset($_POST['played_cricket3'])){$_SESSION['played_cricket3'] = $_POST['played_cricket3'];}
	
	if(isset($_POST['played_cricket4'])){$_SESSION['played_cricket4'] = $_POST['played_cricket4'];}
	
	if(isset($_POST['played_cricket5'])){$_SESSION['played_cricket5'] = $_POST['played_cricket5'];}
	
	if(isset($_POST['played_cricket6'])){$_SESSION['played_cricket6'] = $_POST['played_cricket6'];}
	
	if(isset($_POST['care_impairment'])){$_SESSION['care_impairment'] = $_POST['care_impairment'];}
	
	if(isset($_POST['impairment1'])){$_SESSION['impairment1'] = $_POST['impairment1'];}
	
	if(isset($_POST['impairment2'])){$_SESSION['impairment2'] = $_POST['impairment2'];}
	
	if(isset($_POST['impairment3'])){$_SESSION['impairment3'] = $_POST['impairment3'];}
	
	if(isset($_POST['impairment4'])){$_SESSION['impairment4'] = $_POST['impairment4'];}
	
	if(isset($_POST['impairment5'])){$_SESSION['impairment5'] = $_POST['impairment5'];}
	
	if(isset($_POST['other_spcf'])){$_SESSION['other_spcf'] = $_POST['other_spcf'];}
	
	if(isset($_POST['other_spc'])){$_SESSION['other_spc'] = $_POST['other_spc'];}
	
	if(isset($_POST['additional_info'])){$_SESSION['additional_info'] = $_POST['additional_info'];}
	
	if(isset($_POST['name_dr'])){$_SESSION['name_dr'] = $_POST['name_dr'];}
	
	if(isset($_POST['tel_dr'])){$_SESSION['tel_dr'] = $_POST['tel_dr'];}
	
	if(isset($_POST['medic_info'])){$_SESSION['medic_info'] = $_POST['medic_info'];}
	
	if(isset($_POST['medic_consent'])){$_SESSION['medic_consent'] = $_POST['medic_consent'];}
	
	if(isset($_POST['medic_consent_child'])){$_SESSION['medic_consent_child'] = $_POST['medic_consent_child'];}
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

	<title>Osterley Cricket Club | Adults Registration Form</title>
	
    <link rel="icon" type="image/png" href="favicon.ico">
    
    <link rel="stylesheet" media="screen" href="css/reset.css" >

	<link rel="stylesheet" media="screen" href="css/styles.css" >

    <script type="text/javascript" src="js/jquery-latest.js"></script>

    <style>

	.spcing_req

	{

		margin-bottom:5px;

	}

	</style>

</head>

<body>

<div id="container">

<div id="wrapper">

<?php include("header.php"); ?>

</header>

<div id="tabs-container">

<div class="top-menus">

<div class="floatLeft tab">Adults Information</div>

<div class="floatLeft tab spacing-tab">Sporting Information</div>

<div class="floatLeft tab spacing-tab tabsactive">INFORMATION</div>

<div class="floatLeft tab spacing-tab">Submission &amp; Checklist</div>

<div class="floatLeft tab spacing-tab">APPLICATION COMPLETE</div>

<div class="clear"></div>

</div>

</div>

<div id="content">

<form name="step3" id="step3" action="submission-checklist.php" method="post">

<div class="heading headlines informationSection">

Section 7 - Automatic Voting Membership Status

</div>

<div class="paragraph spcing_req" style="margin-top:10px;">

Membership of the club also provides that you are given voting membership of the club as part of your adult membership.  This entitles you to all additional privileges that would be gained by paying the appropriate adult membership fee(s). Use of facilities by yourself (for example social / training / playing) will not incur such charges as applicable to relevant non-paying membership

</div>


<div class="heading headlines informationSection">

Section 8 – Communication and Interaction with Osterley CC

</div>

<div class="paragraph spcing_req" style="margin-top:10px;">

In order to gain insights and updates on all of Osterley Cricket Clubs Activities and to keep up-to-date with club Fixtures, Events, Policies, Procedures, Regulations and Endorsements please visit the following:

</div>

<div class="paragraph spcing_req" style="text-align:center; line-height:25px;">

<span><a href="http://www.osterleycricketclub.com/" class="anc" target="_blank">http://www.osterleycricketclub.com/</a> - <a href="http://www.osterleycc.com/" class="anc" target="_blank">http://www.osterleycc.com/</a></span><br>

<span><a href="http://www.facebook.com/OsterleyCC" class="anc" target="_blank"><img src="clean-icon-set/facebook.png" width="80" height="80">

</a></span>

<span><a href="http://www.twitter.com/OsterleyCC" class="anc" target="_blank"><img src="clean-icon-set/twitter.png" width="80" height="80">

</a></span><br>

</div>

<div class="heading headlines informationSection">

Section 9 – Data Protection

</div>

<div class="paragraph spcing_req" style="margin-top:10px;">

The Club will use the information provided on this Membership Form (together with other information it obtains about the player) to administer your cricketing activity at the Club and in any activities in which you participate through the Club and to care for and supervise activities in which you are involved. 

</div>

<div class="paragraph spcing_req">

In some cases this may require the Club to disclose the information to County Boards, Leagues and to the England and Wales Cricket Board. In the event of a medical issue arising, the Club may disclose certain information to doctors or other medical specialists and/or to police, the Courts and/or probation officers and, potentially to legal and other advisers involved in an investigation.  

</div>

<div class="paragraph spcing_req" style="font-weight:bold;">

As the person completing this form, you must ensure that each person whose information you include in this form knows what will happen to their information and how it may be disclosed.

</div>

<input type="hidden" value="100.00" name="total_price" id="total_price">

<div align="center" style="margin-bottom:10px;"><input type="submit" id="submtt" class="submit" value="Continue to next step">

<a href="medical-info.php" class="backbutton">Back</a>

</div>

</form>

</div>



</div>

</div>

</body>

</html>