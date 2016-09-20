<?php
session_start();
include("include/db_config.php");

if (isset($_SESSION['source_type'])) {

    if ($_SESSION['source_type'] == 3) {
        $redirect = "social_info.php";
    } elseif ($_SESSION['source_type'] == 2) {
        $redirect = "adutls_info.php";
    } else {
        $redirect = "colts_info.php";
    }
}
//echo $_SESSION['source_type']; die();
if ($_GET['id']) {
    $id = $_GET['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $mobnum = $_POST['mobnum'];
    $instname = $_POST['instname'];
    $guardianname = $_POST['guardianname'];
    $relationship = $_POST['relationship'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $postalcode = $_POST['postalcode'];
    $daytimetel = $_POST['daytimetel'];
    $eventimetel = $_POST['eventimetel'];
    $emailaddr = $_POST['emailaddr'];
    $emergname = $_POST['emergname'];
    $emergrelation = $_POST['emergrelation'];
    $emergaddress = $_POST['emergaddress'];
    $emergcity = $_POST['city_emg'];
    $emergcounty = $_POST['county_emg'];
    $emergpostalcode = $_POST['postalcode_emg'];
    $emergdaytel = $_POST['emergdaytel'];
    $emergeventel = $_POST['emergeventel'];
    $emergemail = $_POST['emergemail'];
    $played = $_POST['played'];
    $cricketplayed = $_POST['played_cricket1'] . '|' . $_POST['played_cricket2'] . '|' . $_POST['played_cricket3'] . '|' . $_POST['played_cricket4'] . '|' . $_POST['played_cricket5'] . '|' . $_POST['played_cricket6'];
    $otherstate = $_POST['otherstate'];
    $care_imp = $_POST['care_imp'];
    $impairment = $_POST['impairment1'] . '|' . $_POST['impairment2'] . '|' . $_POST['impairment3'] . '|' . $_POST['impairment4'] . '|' . $_POST['impairment5'];
    $otherspcf = $_POST['other_spcf'];
    $additionalinfo = $_POST['additional_info'];
    $nameofdr = $_POST['name_dr'];
    $telofdr = $_POST['tel_dr'];
    $price = $_POST['amount'];
    $status = $_POST['status'];
    $occ_country = $_POST['countries'];
    if($occ_country == 232){
        $occ_city = "";
        $migratedday ="";
    }else {
        $occ_city = $_POST['occ_city'];
        $migratedday = $_POST['moved_day'] . '/' . $_POST['moved_month'] . '/' . $_POST['moved_year'];
    }

    if (mysql_query("UPDATE `occ_registrant` SET
 `occ_firstname` = '$firstname',
 `occ_lastname` = '$lastname',
 `occ_birthday` = '$birth',
 `occ_age` = '$age',
 `occ_gender` = '$gender',
 `occ_mobnumber` = '$mobnum',
 `occ_schoolname` = '$instname',
 `occ_sec2_guardian_name` = '$guardianname',
 `occ_sec2_relationship` = '$relationship',
 `occ_sec2_address` = '$address',
 `occ_sec2_city` = '$city',
 `occ_sec2_county` = '$county',
 `occ_sec2_postcode` = '$postalcode',
 `occ_sec2_daytimetel` = '$daytimetel',
 `occ_sec2_eventimetel` = '$eventimetel',
 `occ_sec2_emailaddress` = '$emailaddr',
 `occ_sec3_emerg_name` = '$emergname',
 `occ_sec3_emerg_relationship` = '$emergrelation',
 `occ_sec3_emerg_address` = '$emergaddress',
 `occ_sec3_emerg_city` = '$emergcity',
 `occ_sec3_emerg_county` = '$emergcounty',
 `occ_sec3_emerg_postcode` = '$emergpostalcode',
 `occ_sec3_emerg_daytel` = '$emergdaytel',
 `occ_sec3_emerg_eventel` = '$emergeventel',
 `occ_sec3_emerg_email` = '$emergemail',
 `occ_child_played` = '$played',
 `occ_played_cricket` = '$cricketplayed',
 `occ_other_state` = '$otherstate',
 `occ_care_impairment` = '$care_imp',
 `occ_impairment` = '$impairment',
 `occ_imp_state` = '$otherspcf',
 `occ_imp_additional` = '$additionalinfo',
 `occ_doctorname` = '$nameofdr',
 `occ_migrated_date` = '$migratedday',
 `occ_country` = '$occ_country',
 `occ_city` = '$occ_city',
 `occ_doctortel` = '$telofdr' WHERE `id` = '$id'")) {
        header("Location: $redirect?action=Updated Successfully");
    }

} else {
    header("Location: $redirect?action=Updates failed");
}
?>
