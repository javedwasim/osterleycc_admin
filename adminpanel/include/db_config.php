<?php
error_reporting(0);
ob_start();
if(!$session_id){
session_start();
$session_id = session_id();
}
ini_set('session.gc_maxlifetime', 60 * 60 * 6); 
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

/*
$server = "localhost";
$username = "dblfhagz_colt";
$password = "test123";
$db_name = "dblfhagz_colts";
*/

$server = "localhost";
$username = "root";
$password = "";
$db_name = "dblfhagz_colts";


if(!$link){
	$link = mysql_connect($server, $username, $password) or die ("Could not connect");
	if (mysql_select_db($db_name, $link)) {
	} else {
    	echo "<h3>Error message:</h3>";
    	echo "<p>".mysql_error()."</p>";
	 }
}


?>