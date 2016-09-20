<?php session_start();
$session_id = session_id();



$server = "localhost";
$username = "root";
$password = "";
$db_name = "dblfhagz_colts";


if(!isset($link)){
	$link = mysql_connect($server, $username, $password) or die ("Could not connect");
	if (mysql_select_db($db_name, $link)) {
	} else {
    	echo "<h3>Error message:</h3>";
    	echo "<p>".mysql_error()."</p>";
	 }
}

//$username = "rrsecuri_colt";
//$password = "By1t8kHchxb1";

date_default_timezone_set('Europe/London');

?>