<?php include("../class/db_config.php");
if($_REQUEST['status'])
{
	echo $_SESSION['fname']  = $_REQUEST['fname'];
	$_SESSION['birth']  = $_REQUEST['birthday_day'].$_REQUEST['birthday_month'].$_REQUEST['birthday_year'];
	$_SESSION['cur_age']  = $_REQUEST['cur_age'];
	$_SESSION['sc_cl']  = $_REQUEST['sc_cl'];
	$_SESSION['gender']  = $_REQUEST['gender'];
	$_SESSION['mtel']  = $_REQUEST['mtel'];
	$_SESSION['guardian_name']  = $_REQUEST['guardian_name'];
	$_SESSION['rel_child']  = $_REQUEST['rel_child'];
	$_SESSION['addr']  = $_REQUEST['addr'];
	$_SESSION['dtimetel']  = $_REQUEST['dtimetel'];
	$_SESSION['etimetel']  = $_REQUEST['etimetel'];
	$_SESSION['emerg_name']  = $_REQUEST['emerg_name'];
	$_SESSION['rel_child_emg']  = $_REQUEST['rel_child_emg'];
	$_SESSION['addr_emg']  = $_REQUEST['addr_emg'];
	$_SESSION['dtimetel_emg']  = $_REQUEST['dtimetel_emg'];
	$_SESSION['etimetel_emg']  = $_REQUEST['etimetel_emg'];
	$_SESSION['email_emg']  = $_REQUEST['email_emg'];
	$_SESSION['status']  = $_REQUEST['status'];
}
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#chld_ply").click( function () {
		$("#info").slideDown();
	});
	   $("#chld_ply2").click( function () {
		$("#info").slideUp();
	});
	   $("#care_impariment").click( function () {
		$("#info_sc2").slideDown();
	});
	   $("#care_impariment2").click( function () {
		$("#info_sc2").slideUp();
	});
	$("#medic_info").click( function () {
		$("#medic_condition").slideToggle();
	});

});

	function hideshow(div) {
           document.getElementById('secwise').style.display = "block";
	}
</script>

<form name="sporting_info" id="sporting_info" action="<?php if($pname == 'index.php'){ echo '#step2'; }else{ echo 'index.php#step2'; } ?>" method="post">
<div class="mainContent">
<div id="heading">Sporting Information <span style="font-size:12px; color:#2687d1; font-weight:600;">(Section 4 - Sporting Information)</span></div>
<div class="informationSection">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Has the child played Cricket before?
<span style="position:absolute; right:0; margin-right:50%;">
<span>Yes : </span><span style="margin-left:5px;"><input type="radio" value="yes" name="chld_ply" id="chld_ply"></span>
<span style="margin-left:5px;">No  : </span><span style="margin-left:5px;"><input type="radio" value="no" name="chld_ply" id="chld_ply2"></span>
</span>
</div>
</div>
<div id="info" style="display:none;">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">If yes, where have they played Cricket?: (please indicate below)
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Primary school
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" name="primary_school" id="primary_school"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Secondary school
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" name="secondary_school" id="secondary_school"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Special Educational Needs School
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" name="special_education_school" id="special_education_school"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Local authority coaching session(s)
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" name="local_authority_session" id="local_authority_session"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Club
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" name="club" id="club"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">County
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" name="country" id="country"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="height:80px;">Other (please specify)
<span style="position:absolute; right:0; margin-right:30%;">
<span style="margin-left:5px;"><textarea name="other_spc" id="other_spc" class="colt_textareas"></textarea></span>
</span>
</div>
</div>
</div>
<div id="heading" style="border-bottom:1px solid #dcdcdc;">Impairment Information <span style="font-size:12px; color:#2687d1; font-weight:600;">(Section 5 – Information about any Impairment)</span></div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
Please provide information about any impairment your child may have so that we can determine what reasonable adjustments may be required to support your child’s full participation in club activities.
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Do you consider your child / the child in your care to have impairment? 
<span style="position:absolute; right:0; margin-right:30%;">
<span>Yes : </span><span style="margin-left:5px;"><input type="radio" value="yes" name="care_impairment" id="care_impariment"></span>
<span style="margin-left:5px;">No  : </span><span style="margin-left:5px;"><input type="radio" value="no" name="care_impairment" id="care_impariment2"></span>
</span>
</div>
</div>
<div id="info_sc2" style="display:none;">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">If yes, where have they played Cricket?: (please indicate below)
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Visual impairment
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" onClick="return hideshow('secwise');" name="visual_impairment" id="visual_impairment"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Hearing impairment
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" onClick="return hideshow('secwise');" name="hearing_impairment" id="hearing_impairment"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Physical impairment
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" onClick="return hideshow('secwise');" name="physical_impairment" id="physical_impairment"></span>

</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Learning difficulty
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" value="yes" onClick="return hideshow('secwise');" name="learning_difficulty" id="learning_difficulty"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Multiple impairments 
<span style="position:absolute; right:0; margin-right:70%;">
<span style="margin-left:5px;"><input type="checkbox" class="chck" onClick="return hideshow('secwise');" value="yes" name="multiple_impairments" id="multiple_impairments"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="height:80px;">Other (please specify)
<span style="position:absolute; right:0; margin-right:30%;">
<span style="margin-left:5px;"><textarea name="other_spcf" id="other_spcf" class="colt_textareas"></textarea></span>
</span>
</div>
</div>
</div>
<div id="secwise" style="display:none;">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
If you have ticked yes in any box above please provide us with any additional information that will assist us to ensure your child is fully supported whilst at the club.
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">
<textarea name="other_spc" id="other_spc" class="colt_textareas" style="width:100%;"></textarea>
</div>
</div>
</div>
<div id="heading" style="border-bottom:1px solid #dcdcdc;">Medical Information <span style="font-size:12px; color:#2687d1; font-weight:600;">(Section 5 – Medical Information)</span></div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Name of Doctor / Surgery
<span style="position:absolute; top:8px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" value="" name="name_dr" id="name_dr" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Doctor / Surgery telephone number
<span style="position:absolute; top:8px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" value="" name="tel_dr" id="tel_dr" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="medic_info" id="medic_info" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">Please detail below any important medical information that our coaches/junior coordinator should be aware of (e.g. epilepsy, asthma, diabetes, current medication, injuries etc.) 
</span>
</div>
</div>
<div id="medic_condition" style="display:none;">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="font-weight:bold;">Medical consent
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="medic_consent" id="medic_consent" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I give my consent that in an emergency situation, the club may act in my place, (in loco parentis), if the need arises for the administration of emergency first aid and / or other medical treatment which in the opinion of a qualified medical practitioner may be necessary. I also understand that in such an occurrence all reasonable steps will be taken to contact me as the relevant parent / legal guardian, or the alternative adult I have named in section 3 of this form.
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="medic_consent_child" id="medic_consent_child" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I confirm that to the best of my knowledge, my child / the child in my care does not suffer from any medical condition other than those detailed above.
</span>
</div>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<div align="center"><input type="submit" value="Continue to next step" class="submit"></div>
</div>
</div>
</div>
</div>
</form>









