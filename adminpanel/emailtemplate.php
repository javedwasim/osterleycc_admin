<?php
include("include/db_config.php");

if ($_POST['tmplName'] != NULL && $_POST['edit_id']=='') {

   $adtmplName = $_POST['tmplName'];
    $adsmleCode = base64_decode($_POST['smleCode']);
   $empl_status = $_POST['empl_status'];

    $sql = "INSERT INTO `email_tmpl` (`empl_name`,`empl_src_code`,`empl_created_date`,`empl_status`) VALUES ('$adtmplName','$adsmleCode',NOW(),$empl_status)";
    $query = mysql_query($sql);
    if (mysql_affected_rows() > 0) {
       echo "Email Template Added Successfully!";
    } else {
        $message = mysql_error();

    }
}elseif ($_POST['tmplName'] != NULL && $_POST['edit_id']!='') {

    $id = $_POST['edit_id'];
    $adtmplName = $_POST['tmplName'];
    $adsmleCode = base64_decode($_POST['smleCode']);
    $empl_status = $_POST['empl_status'];

    $update_query = "UPDATE `email_tmpl` SET `empl_name`= '$adtmplName' ,`empl_src_code`= '$adsmleCode' ,`empl_status`= '$empl_status' WHERE empl_id = $id";
    mysql_query($update_query);
    echo "Email Template Updated Successfully!";
}