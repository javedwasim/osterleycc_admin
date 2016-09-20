<?php include("class/db_config.php");


$isPosted = count($_POST);


if($isPosted > 0)
{
	$_SESSION['fname']          		 = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($_POST['fname']))));
	$_SESSION['lname']          		 = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($_POST['lname']))));
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
	$_SESSION['emerg_name']     		 = $_POST['emerg_name'];
	$_SESSION['emerg_lname']     		 = $_POST['emerg_lname'];
	$_SESSION['rel_child_emg']  		 = $_POST['rel_child_emg'];
	$_SESSION['addr_emg']        		 = $_POST['addr_emg'];
	$_SESSION['addr2_emg']  			 = $_POST['addr2_emg'];
	$_SESSION['cityofuk_emg']  			 = $_POST['cityofuk_emg'];
	$_SESSION['counties_emg']  			 = $_POST['counties_emg'];
	$_SESSION['postcode_emg']  			 = $_POST['postcode_emg'];
	$_SESSION['dtimetel_emg']    		 = $_POST['dtimetel_emg'];
	$_SESSION['etimetel_emg']   		 = $_POST['etimetel_emg'];
	$_SESSION['email_emg']       		 = $_POST['email_emg'];
	echo $_SESSION['sid']            		 = $_POST['sid'];
	$_SESSION['source_type']    		 = $_POST['source_type'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Osterley Cricket Club | Adult Registration Form</title>
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
<div class="floatLeft tab">Adults Information</div>
<div class="floatLeft tab spacing-tab tabsactive">Sporting Information</div>
<div class="floatLeft tab spacing-tab">INFORMATION</div>
<div class="floatLeft tab spacing-tab">Submission &amp; Checklist</div>
<div class="floatLeft tab spacing-tab">APPLICATION COMPLETE</div>
<div class="clear"></div>
</div>
</div>
<div id="content">
<form name="sporting_info" id="sporting_info" action="information.php" method="post">
<div class="mainContent">
<div id="heading">Sporting Information <span style="font-size:12px; color:#333; font-weight:600;">(Section 4 - Sporting Information)</span></div>
<div class="informationSection">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="width:72%;">Have you  played Cricket before? <span style="color:#F60;">*</span>
  <div style="float:right; width:28%;">

  <select name="chld_ply" id="chld_ply"  class="fieldsfor" onChange="show(this.value);" style="border:1px solid #dcdcdc; padding:4px;">
            <option value="0"> -- Select -- </option>
           <option value="1" <?php if($_SESSION['chld_ply'] == '1') echo 'selected'; ?>>Yes</option>
           <option value="2" <?php if($_SESSION['chld_ply'] == '2') echo 'selected'; ?>>No</option>
           </select>

</div>
<div class="clear"></div>
</div>
</div>
<div id="info" style="display:none; <?php if($_SESSION['chld_ply'] == '1') echo 'display:block;'; ?>">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">If yes, where have they played Cricket?: (please indicate below)
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Primary school
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="primary school" <?php if($_SESSION['played_cricket1'] == 'primary school') { echo 'checked';} ?> class="school_check" name="played_cricket1" id="played_cricket1"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Secondary school
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="secondary school" class="school_check" name="played_cricket2" <?php if($_SESSION['played_cricket2']) { echo 'checked';} ?> id="played_cricket2"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Special Educational Needs School
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="special educational needs school" class="school_check" name="played_cricket3" <?php if($_SESSION['played_cricket3']) { echo 'checked';} ?> id="played_cricket3"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Local authority coaching session(s)
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="local authority coaching session" class="school_check" name="played_cricket4" <?php if($_SESSION['played_cricket4']) { echo 'checked';} ?> id="played_cricket4"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Club
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="club" class="school_check" name="played_cricket5" <?php if($_SESSION['played_cricket5']) { echo 'checked';} ?> id="played_cricket5"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">County
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="county" class="school_check" name="played_cricket6" <?php if($_SESSION['played_cricket6']) { echo 'checked';} ?> id="played_cricket6"></span>
</span>
</div>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="height:80px;">Other (please specify)
<span style="position:absolute; right:0; margin-right:30%;">
<span style="margin-left:5px;"><textarea name="other_spc" id="other_spc" style="height:60px;" class="colt_textareas"><?php if($_SESSION['other_spc']) { echo $_SESSION['other_spc']; } ?></textarea></span>
</span>
</div>
</div>

<div id="heading" style="border-bottom:1px solid #dcdcdc;">Impairment Information <span style="font-size:12px; color:#333; font-weight:600;">(Section 5 – Information about any Impairment)</span></div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
Please provide information about any impairment you may have so that we can determine what reasonable adjustments may be required to support your full participation in club activities.
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="width:72%;">Do you consider having an impairment? <span style="color:#F60;">*</span> 

<div style="float:right; width:28%;">

  <select name="care_impairment" id="care_impairment" onChange="display(this.value);"  class="fieldsfor" style="border:1px solid #dcdcdc; padding:4px;">
            <option value="0"> -- Select -- </option>
           <option value="1" <?php if($_SESSION['care_impairment'] == '1') echo 'selected'; ?>>Yes</option>
           <option value="2" <?php if($_SESSION['care_impairment'] == '2') echo 'selected'; ?>>No</option>
           </select>

</div>
<div class="clear"></div>

</div>
</div>
<div id="info_sc2" style="display:none; <?php if($_SESSION['care_impairment'] == '1') echo 'display:block;'; ?> ">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">If yes, what is the nature of the impairment?
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Visual impairment
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="visual impairment" class="impairment_check" <?php if($_SESSION['impairment1']) { echo 'checked';} ?> name="impairment1" id="impairment1"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Hearing impairment
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" <?php if($_SESSION['impairment2']) { echo 'checked'; } ?> value="Hearing impairment" class="impairment_check" name="impairment2" id="impairment2"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Physical impairment
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" <?php if($_SESSION['impairment3']) { echo 'checked'; } ?> value="physical impairment" class="impairment_check" name="impairment3" id="impairment3"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Learning difficulty
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" <?php if($_SESSION['impairment4']) { echo 'checked'; } ?> value="learning difficulty" class="impairment_check" name="impairment4" id="impairment4"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Multiple impairments 
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" class="impairment_check" value="multiple impairments" name="impairment5" id="impairment5" <?php if($_SESSION['impairment5']) { echo 'checked'; } ?>></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="height:80px;">Other (please specify)
<span style="position:absolute; right:0; margin-right:30%;">
<span style="margin-left:5px;"><textarea name="other_spcf" id="other_spcf" style="height:60px;" class="colt_textareas"><?php if($_SESSION['other_spcf']) { echo $_SESSION['other_spcf']; }?></textarea></span>
</span>
</div>
</div>
</div>
<div id="secwise">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
If you have ticked yes in any box above please provide us with any additional information that will assist us to ensure you are fully supported whilst at the club.
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
<textarea name="additional_info" id="additional_info" class="colt_textareas" style="width:100%;"><?php if($_SESSION['additional_info']) { echo $_SESSION['additional_info']; }?></textarea>
</div>
</div>
</div>
<div id="heading" style="border-bottom:1px solid #dcdcdc;">Medical Information <span style="font-size:12px; color:#333; font-weight:600;">(Section 6 – Medical Information)</span></div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Name of Doctor / Surgery <span style="color:#f60;">*</span>
<span style="position:absolute; top:8px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" value="<?php if($_SESSION['name_dr']) { echo $_SESSION['name_dr']; }?>" name="name_dr" id="name_dr" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Doctor / Surgery telephone number <span style="color:#f60;">*</span>
<span style="position:absolute; top:8px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" value="<?php if($_SESSION['tel_dr']) { echo $_SESSION['tel_dr']; }?>" name="tel_dr" id="tel_dr" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;"></span>
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
<input type="checkbox" name="medic_consent" id="medic_consent" class="medical_consent" value="yes1" <?php if($_SESSION['medic_consent']) { echo 'checked'; } ?> style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I give my consent that in an emergency situation, the club may act accordingly, (in loco parentis), if the need arises for the administration of emergency first aid and / or other medical treatment which in the opinion of a qualified medical practitioner may be necessary. I also understand that in such an occurrence all reasonable steps will be taken to contact the next of kin I have named in section 3 of this form.
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="medic_consent_child" <?php if($_SESSION['medic_consent_child']) { echo 'checked'; } ?> id="medic_consent_child" class="medical_consent" value="yes2" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
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









