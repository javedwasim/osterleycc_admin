<?php
if($_REQUEST['name_dr'])
{
	$_SESSION['chld_ply']  = $_REQUEST['chld_ply'];
	$_SESSION['school_edu']  = $_REQUEST['primary_school'].'&nbsp;'.$_REQUEST['secondary_school'].'&nbsp;'.$_REQUEST['special_education_school'].'&nbsp;'.$_REQUEST['local_authority_session'].'&nbsp;'.$_REQUEST['club'].'&nbsp;'.$_REQUEST['country'];
	$_SESSION['care_impairment']  = $_REQUEST['care_impairment'];
	$_SESSION['impairment']  = $_REQUEST['visual_impairment'].'&nbsp;'.$_REQUEST['hearing_impairment'].'&nbsp;'.$_REQUEST['physical_impairment'].'&nbsp;'.$_REQUEST['learning_difficulty'].'&nbsp;'.$_REQUEST['multiple_impairments'];
	$_SESSION['other_spcf']  = $_REQUEST['other_spcf'];
	$_SESSION['other_spc']  = $_REQUEST['other_spc'];
	$_SESSION['name_dr']  = $_REQUEST['name_dr'];
	$_SESSION['tel_dr']  = $_REQUEST['tel_dr'];
	$_SESSION['medic_info']  = $_REQUEST['medic_info'];
	$_SESSION['consent']  = $_REQUEST['medic_consent'].'&nbsp;'.$_REQUEST['medic_consent_child'];

}
?>
    <style>
	.spcing_req
	{
		margin-bottom:5px;
	}
	</style>


<form name="information" id="sporting_info" action="<?php if($pname == 'index.php'){ echo '#step3'; }else{ echo 'index.php#step3'; } ?>" method="post">
<div class="heading" style="box-shadow: #80808C 0 1px 1px; padding:5px 0; background: -webkit-linear-gradient(top, #fff, #f1f1f1);">
Section 7 - Automatic Non- Voting Membership Status
</div>
<div class="paragraph spcing_req" style="margin-top:10px;">
Junior membership of the club also provides that the parent(s) / legal guardian(s) of the child are given non-voting membership of the club as part of that junior membership.  This does not entitle the parent(s) / guardian(s) to any additional privileges that would otherwise be gained by paying the appropriate adult membership fee(s). Any use of facilities by parents or legal guardians (for example social / training / playing) may incur such charges as applicable to relevant adult membership. 
</div>
<div class="heading" style="box-shadow: #80808C 0 1px 1px; padding:5px 0; background: -webkit-linear-gradient(top, #fff, #f1f1f1);">
Section 8 – Communication and Interaction with Osterley CC
</div>
<div class="paragraph spcing_req" style="margin-top:10px;">
In order to gain insights and updates on all of Osterley Cricket Clubs Activities and to keep up-to-date with club Fixtures, Events, Policies, Procedures, Regulations and Endorsements please visit the following:
</div>
<div class="paragraph spcing_req" style="text-align:center; line-height:25px;">
<span><a href="http://www.osterleycricketclub.com/" class="anc">http://www.osterleycricketclub.com/</a> - <a href="http://www.osterleycc.com/Official Website" class="anc">http://www.osterleycc.com/Official Website</a></span><br>
<span><a href="http://www.facebook.com/OsterleyCC" class="anc">http://www.facebook.com/OsterleyCC </a> - Official Facebook Page</span><br>
<span><a href="http://www.twitter.com/OsterleyCC" class="anc">http://www.twitter.com/OsterleyCC </a>- Official Twitter Account</span><br>
</div>
<div class="heading " style="box-shadow: #80808C 0 1px 1px; padding:5px 0; background: -webkit-linear-gradient(top, #fff, #f1f1f1);">
Section 9 – Data Protection
</div>
<div class="paragraph spcing_req" style="margin-top:10px;">
The Club will use the information provided on this Membership Form (together with other information it obtains about the player) to administer his/her cricketing activity at the Club and in any activities in which he/she participates through the Club and to care for and supervise activities in which he/she is involved. 
</div>
<div class="paragraph spcing_req">
In some cases this may require the Club to disclose the information to County Boards, Leagues and to the England and Wales Cricket Board. In the event of a medical issue or child protection issue arising, the Club may disclose certain information to doctors or other medical specialists and/or to police, children’s social care, the Courts and/or probation officers and, potentially to legal and other advisers involved in an investigation.  
</div>
<div class="paragraph spcing_req" style="font-weight:bold;">
As the person completing this form, you must ensure that each person whose information you include in this form knows what will happen to their information and how it may be disclosed.
</div>
<div align="center" style="margin-bottom:10px;"><input type="submit" id="submtt" class="submit" value="Continue to next step"></div>
</form>
