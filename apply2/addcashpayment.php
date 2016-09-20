<?php
require_once("class/db_config.php");

$date = date('m/d/Y h:i:s a', time());
$sid = $_REQUEST['uid'];
if(!empty($sid)) {
    $totalprice = $_REQUEST['totalprice'];
    $insertQuery = mysql_query("INSERT INTO `payment_recieved` (`payment_id`, `uid`, `amount`, `description`, `note`, `status`, `method`, `date_created`, `date_recieved`, `source_type`) VALUES ('','$sid','$totalprice','Annual subs','Customer request to pay in person','1','','$date','','2')");
    $track = mysql_insert_id();
}