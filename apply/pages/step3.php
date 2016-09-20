<?php
$date = date("d-m-y"); 
echo $_SESSION['name_dr'];
if($_SESSION['name_dr'])
{
$fullName = 	$_SESSION['fname'];
$birthDay = 	$_SESSION['birth'];
$currentAge = 	$_SESSION['cur_age'];
$schoolClass = 	$_SESSION['sc_cl'];
$genDer = 	$_SESSION['gender'];
$mobTel = 	$_SESSION['mtel'];
$guardianName = 	$_SESSION['guardian_name'];
$relationChild = 	$_SESSION['rel_child'];
$address = 	$_SESSION['addr'];
$dayTimeTel = 	$_SESSION['dtimetel'];
$evenTimeTel = 	$_SESSION['etimetel'];
$emergencyContactName = 	$_SESSION['emerg_name'];
$emergencyContactChild = 	$_SESSION['rel_child_emg'];
$emergencyContactAddr = 	$_SESSION['addr_emg'];
$emergencyContactDayTel = 	$_SESSION['dtimetel_emg'];
$emergencyContactEvenTel = 	$_SESSION['etimetel_emg'];
$status = 	$_SESSION['status'];
$childPlay = 	$_SESSION['chld_ply'];
$schoolEducation = 	$_SESSION['school_edu'];
$careImpairment = 	$_SESSION['care_impairment'];
$impairment = 	$_SESSION['impairment'];
$otherSpcf = $_SESSION['other_spcf'];
$otherSpc = $_SESSION['other_spc'];
$doctorName = $_SESSION['name_dr'];
$doctorTel = $_SESSION['tel_dr'];
$medicalInfo = $_SESSION['medic_info'];
$consent = $_SESSION['consent'];
echo "INSERT INTO `occ_coltregistrant` VALUES ('', '$fullName', '$birthDay', '$currentAge', '$schoolClass', '$genDer', '$mobTel', '$guardianName', '$relationChild', '$address', '$dayTimeTel', '$evenTimeTel', '$emergencyContactName', '$emergencyContactChild', '$emergencyContactAddr', '$emergencyContactDayTel', '$emergencyContactEvenTel', '$status', '$childPlay', '$schoolEducation', '$careImpairment', '$impairment', '$otherSpcf', '$otherSpc', '$doctorName', '$doctorTel', '$medicalInfo', '$consent')";
exit();
	if(mysql_query("INSERT INTO `occ_coltregistrant` VALUES ('', '$fullName', '$birthDay', '$currentAge', '$schoolClass', '$genDer', '$mobTel', '$guardianName', '$relationChild', '$address', '$dayTimeTel', '$evenTimeTel', '$emergencyContactName', '$emergencyContactChild', '$emergencyContactAddr', '$emergencyContactDayTel', '$emergencyContactEvenTel', '$status', '$childPlay', '$schoolEducation', '$careImpairment', '$impairment', '$otherSpcf', '$otherSpc', '$doctorName', '$doctorTel', '$medicalInfo', '$consent')"))
	{
	}

}
?>
    <script type="text/javascript">
function blinks(){
if(document.getElementById('cck_bx').checked == false) {
	alert("Please accept our terms and conditions");		
div = document.getElementById("blink_now");
intrvl=0;
for(nTimes=0;nTimes<3;nTimes++){
intrvl += 400;
setTimeout("div.style.backgroundColor='#d1d1d1';",intrvl);
intrvl += 400;
setTimeout("div.style.backgroundColor='#ffffff';",intrvl);
}
		}
}
 /*    $(document).ready(function() {
		 $(".submit").click( function () {
        $("#blink_now").animate({opacity:0},100,"linear",function(){
  $(this).animate({opacity:1},100);
});

		 });
    });*/
	</script>

<form name="sporting_info" id="sporting_info" action="" method="post">
<div class="mainContent">


<div id="heading">Submission & Checklist <span style="font-size:12px; color:#2687d1; font-weight:600;">(Section 9 – Check-List)</span></div>
<div class="informationSection">
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="font-weight:600;">
Please answer the following questions by circling the appropriate answer:
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="activities_cricket" id="activities_cricket" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">By submitting this completed Junior Membership Form, I agree to my child / the child in my care taking part in the activities of Osterley Cricket Club.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="entitled_consent" id="entitled_consent" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I confirm that I have legal responsibility for the child named on Page 1/Section 1, and that I am entitled to give this consent.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="legal_responsibility" id="legal_responsibility" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I understand that I will be kept informed of activities at Osterley Cricket Club – for example details of times and transport etc.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="injury_appr" id="injury_appr" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I understand that in the event of injury or illness all reasonable steps will be taken to contact me / the alternative contact, and to deal with that injury/illness appropriately.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara" style="position:relative;">
<input type="checkbox" name="knowledge_info" id="knowledge_info" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px;">I confirm that to the best of my knowledge all information provided in this form is accurate and I will inform the club of any changes to this information in a timely manner.</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Colt Name
<span style="position:absolute; top:7px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" value="" name="colt_name" id="colt_name" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #eee;">
<div class="infoPara">Name of parent / legal guardian
<span style="position:absolute; top:7px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" value="" name="name_dr" id="name_dr" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;"></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #ccc;">
<div class="infoPara">Date
<span style="position:absolute; top:7px; right:0; margin-right:50%;">
<span style="margin-left:5px;"><input type="text" name="date_now" id="date_now" style="border:1px solid #ccc; padding:4px; border-radius:5px; width:120%; box-shadow:inset #f1f1f1 0 2px 0;" value="<?php echo $date; ?>" ></span>
</span>
</div>
</div>
<div style="border-bottom:1px solid #ccc; background:-webkit-linear-gradient(top, #fff, #f7f7f7);">
<div class="infoPara" style="position:relative;" id="blink_now">
<input type="checkbox" name="cck_bx" id="cck_bx" value="yes" style="position:absolute; top:0; left:0; margin:13px 0 0 10px;">
<span style="margin-left:20px; font-weight:bold;">I have read and agree to the Declaration and the Data Protection Notice.  I consent to the processing of my/my 
child’s personal data (including medical information and the use of images) as described under the Data 
Protection Notice.</span>
</div>
</div>
<div align="center" style="margin-top:10px;">
<div class="infoPara"><input type="submit" value="Continue to payment" onClick="return blinks();" class="submit">
</div>
</div>
</div>
</div>

</form>
