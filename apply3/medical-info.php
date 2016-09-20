<?php require_once("class/db_config.php");


$isPosted = count($_POST);


if($isPosted > 0)
{
	$_SESSION['fname']          		 = $_POST['fname'];
	$_SESSION['lname']          		 = $_POST['lname'];
	$_SESSION['dday']  		    		 = $_POST['birthday_day'];
	$_SESSION['dmonth']  				 = $_POST['birthday_month'];
	$_SESSION['dyear']  				 = $_POST['birthday_year'];
	$_SESSION['job_title']  			 = $_POST['job_title'];
	$_SESSION['gender']  				 = $_POST['gender'];
	$_SESSION['addr']  			 		 = $_POST['addr'];
	$_SESSION['addr2']  				 = $_POST['addr2'];
	$_SESSION['cityofuk']  				 = $_POST['cityofuk'];
	$_SESSION['counties']  				 = $_POST['counties'];
	$_SESSION['postcode']  				 = $_POST['postcode'];
	$_SESSION['dtimetel']				 = $_POST['dtimetel'];
	$_SESSION['etimetel'] 				 = $_POST['etimetel'];
	$_SESSION['email'] 					 = $_POST['email'];
	if(isset($_POST['emerg_name'])){ $_SESSION['emerg_name'] = $_POST['emerg_name']; }
	
	$_SESSION['emerg_lname']     		 = $_POST['emerg_lname'];
	$_SESSION['rel_child_emg']  		 = $_POST['rel_child_emg'];
	$_SESSION['addr_emg']        		 = $_POST['addr_emg'];
	$_SESSION['addr2_emg']  			 = $_POST['addr2_emg'];
	$_SESSION['cityofuk_emg']  			 = $_POST['cityofuk_emg'];
	$_SESSION['counties_emg']  			 = $_POST['counties_emg'];
	$_SESSION['postcode_emg']  			 = $_POST['postcode_emg'];
	$_SESSION['dtimetel_emg']    		 = $_POST['dtimetel_emg'];
	$_SESSION['etimetel_emg']   		 = $_POST['etimetel_emg'];
	if(isset($_POST['email_emg'])){ $_SESSION['email_emg'] = $_POST['email_emg']; }
	//$_SESSION['email_emg']       		 = $_POST['email_emg'];
	$_SESSION['sid']            		 = $_POST['sid'];
	$_SESSION['source_type']    		 = $_POST['source_type'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Osterley Cricket Club | Adults Registration Form</title>
    <link rel="icon" type="image/png" href="favicon.ico">
    <link rel="stylesheet" media="screen" href="css/reset.css" >
	<link rel="stylesheet" media="screen" href="css/styles.css" >
    <script type='text/javascript'>
(function (d, t) {
  /* var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=bshfgpegfciiwavc7a2xgg';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script'); */
</script>
    
    
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
<div class="floatLeft tab">Adults Information</div>
<div class="floatLeft tab spacing-tab tabsactive">Sporting Information</div>
<div class="floatLeft tab spacing-tab">INFORMATION</div>
<div class="floatLeft tab spacing-tab">Submission &amp; Checklist</div>
<div class="floatLeft tab spacing-tab">APPLICATION COMPLETE</div>
<div class="clear"></div>
</div>
</div>
<div id="content">
<form name="sporting_info" id="sporting_info" action="info.php" method="post">
<div class="mainContent">

<div class="informationSection">








<div id="secwise">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
If you have ticked yes in any box above please provide us with any additional information that will assist us to ensure you are fully supported whilst at the club.
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
<textarea name="additional_info" id="additional_info" class="colt_textareas" style="width:100%;"><?php if(isset($_SESSION['additional_info'])) { echo $_SESSION['additional_info']; }?></textarea>
</div>
</div>
</div>
<div id="heading" style="border-bottom:1px solid #dcdcdc;" class = "indexheading">Medical Information <span style="font-size:12px; color:#2687d1; font-weight:600;">(Section 6 – Medical Information)</span></div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Name of Doctor / Surgery <span style="color:#f60;">*</span>
<span class = "played-info-text other-specify" >
<span style="margin-left:5px;">
<input type="text" value="<?php if(isset($_SESSION['name_dr'])) { echo $_SESSION['name_dr']; }?>" name="name_dr" required id="name_dr" style="border:1px solid #ccc;     margin-left: 7%; padding:4px; border-radius:5px; width:30%; box-shadow:inset #f1f1f1 0 2px 0;" class = "info-width"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Doctor / Surgery telephone number <span style="color:#f60;">*</span>
<span class = "played-info-text other-specify" >
<span style="margin-left:5px;"><input type="number" value="<?php if(isset($_SESSION['tel_dr'])) { echo $_SESSION['tel_dr']; }?>" name="tel_dr" required id="tel_dr" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:30%; box-shadow:inset #f1f1f1 0 2px 0;" class = "info-width"></span>
</span>
</div>
</div>

<div id="medic_condition">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="font-weight:bold;">Medical consent
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="medic_consent" required id="medic_consent" class="medical_consent" value="yes1" <?php if(isset($_SESSION['medic_consent'])) { echo 'checked'; } ?> style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I give my consent that in an emergency situation, the club may act accordingly, (in loco parentis), if the need arises for the administration of emergency first aid and / or other medical treatment which in the opinion of a qualified medical practitioner may be necessary. I also understand that in such an occurrence all reasonable steps will be taken to contact the next of kin I have named in section 3 of this form.
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="medic_consent_child" required <?php if(isset($_SESSION['medic_consent_child'])) { echo 'checked'; } ?> id="medic_consent_child" class="medical_consent" value="yes2" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I confirm that to the best of my knowledge, that I do not suffer from any medical condition other than those detailed above.
</span>
</div>
</div>


</div>
<div align="center" style="margin-top:10px;">
<div class="infoPara"><input type="submit" onClick="return validate();" value="Continue to next step" class="submit"><a href="index.php" class="backbutton">Back</a>
</div>
</div>
</div>
</div>
</form>
      <script type="text/javascript">
var frmvalidator = new Validator("sporting_info");		
frmvalidator.addValidation("chld_ply","dontselect=0","Has the child played before");
frmvalidator.addValidation("care_impairment","dontselect=0","Please answer impairment question");   
frmvalidator.addValidation("name_dr","req","Please Enter the Doctor/Surgery's Name");
frmvalidator.addValidation("name_dr","minlen=4","Please enter the FULL Doctor/Surgery's Name");
frmvalidator.addValidation("tel_dr","numeric","Please enter Doctor Mobile No.");
frmvalidator.addValidation("tel_dr","minlen=10","Number should not be less than 10 digits");
frmvalidator.addValidation("medic_consent","shouldselchk","Please give your Medical Consent by checking the box");
frmvalidator.addValidation("medic_consent_child","shouldselchk","Please confirm your Medical Information is correct");
 //Please confirm your medical information is correct
 //Please give your Medical Consent by checking the box
   function show(val)
   {
    if(val == 1){
     $('#info').show(200);
    }
    if(val != 1){
     $('#info').hide(200);
    }
   }
      function display(val)
   {
    if(val == 1){
     $('#info_sc2').show(200);
    }
    if(val != 1){
     $('#info_sc2').hide(200);
    }
   }
function validate(){
	
	var chld_plys = $("#chld_ply").val();
	var care = $("#care_impairment").val();

	
	
	var pre_checkbox = 0;
	var availabilty = 0;

	
	
	if(chld_plys == 1)
	{
	$('.school_check').each(function() {
		if($(this).is(":checked") == false){
			pre_checkbox++;	
		}
	});
	}
	
	if(care == 1)
	{
    $('.impairment_check').each(function() {
		if($(this).is(":checked") == false){
			availabilty++;	
		}
	});
	}
	 $('.medical_consent').each(function() {
		if($(this).is(":checked") == false){
			medical_consent++;	
		}
	});
	if(pre_checkbox == 6){
		alert("Please tick or enter where your child has played cricket before");
		$(".school_check").focus();
		return	false;
	}
	if(availabilty == 5){
		alert("Please check or enter the imparment(s) your child has");
		$(".impairment_check").focus();
		return	false;
	}
	
	

}
</script> 
</div>
</div>
</div>

</body>
</html>









