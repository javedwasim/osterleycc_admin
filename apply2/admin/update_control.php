<?php 
include("include/db_config.php");

if($_GET['id'])
{
$id = $_GET['id'];
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$birth = $_POST['birth'];
$gender = $_POST['gender'];
$jobtitle = $_POST['jobtitle'];
$address = $_POST['address'];
$city = $_POST['city'];
$county = $_POST['county'];
$postalcode = $_POST['postalcode'];
$daytimetel = $_POST['daytimetel'];
$eventimetel = $_POST['eventimetel'];
$emailaddr = $_POST['emailaddr'];
$emergname = $_POST['emergname'];
$emerglname = $_POST['emerglname'];
$emergrelation = $_POST['emergrelation'];
$emergaddress = $_POST['emergaddress'];
$emergcity = $_POST['city_emg'];
$emergcounty = $_POST['county_emg'];
$emergpostalcode = $_POST['postalcode_emg'];
$emergdaytel = $_POST['emergdaytel'];
$emergeventel = $_POST['emergeventel'];
$played = $_POST['played'];
$cricketplayed = $_POST['played_cricket1'].'|'.$_POST['played_cricket2'].'|'.$_POST['played_cricket3'].'|'.$_POST['played_cricket4'].'|'.$_POST['played_cricket5'].'|'.$_POST['played_cricket6'];
$otherstate = $_POST['otherstate'];
$care_imp = $_POST['care_imp'];
$impairment = $_POST['impairment1'].'|'.$_POST['impairment2'].'|'.$_POST['impairment3'].'|'.$_POST['impairment4'].'|'.$_POST['impairment5'];
$otherspcf = $_POST['other_spcf'];
$additionalinfo = $_POST['additional_info'];
$nameofdr = $_POST['name_dr'];
$telofdr = $_POST['tel_dr'];
$price = $_POST['amount'];
$status = $_POST['status'];

	if(mysql_query("UPDATE `occ_registrant` SET 
 `occ_firstname` = '$firstname',
 `occ_lastname` = '$lastname',
 `occ_birthday` = '$birth',
 `occ_gender` = '$gender',
 `occ_job_title` = '$jobtitle',
 `occ_sec2_address` = '$address',
 `occ_sec2_city` = '$city',
 `occ_sec2_county` = '$county',
 `occ_sec2_postcode` = '$postalcode',
 `occ_sec2_daytimetel` = '$daytimetel',
 `occ_sec2_eventimetel` = '$eventimetel',
 `occ_sec2_emailaddress` = '$emailaddr',
 `occ_sec3_emerg_name` = '$emergname',
  `occ_sec3_emerg_lname` = '$emerglname',
 `occ_sec3_emerg_relationship` = '$emergrelation',
 `occ_sec3_emerg_address` = '$emergaddress',
 `occ_sec3_emerg_city` = '$emergcity',
 `occ_sec3_emerg_county` = '$emergcounty',
 `occ_sec3_emerg_postcode` = '$emergpostalcode',
 `occ_sec3_emerg_daytel` = '$emergdaytel',
 `occ_sec3_emerg_eventel` = '$emergeventel',
 `occ_child_played` = '$played',
 `occ_played_cricket` = '$cricketplayed',
 `occ_other_state` = '$otherstate',
 `occ_care_impairment` = '$care_imp',
 `occ_impairment` = '$impairment',
 `occ_imp_state` = '$otherspcf',
 `occ_imp_additional` = '$additionalinfo',
 `occ_doctorname` = '$nameofdr',
 `occ_doctortel` = '$telofdr' WHERE `id` = '$id'"))
	{
		header("Location: adutls_info.php?action=Updated Successfully"); 
	}

}

else
{
	header("Location: adutls_info.php?action=Updates failed");	
}
?>
