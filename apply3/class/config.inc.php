<?php 
//$server = "localhost";
//$username = "dblfhagz_colt";
//$password = "test123";
//$db_name = "dblfhagz_colts";

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

//$username = "rrsecuri_colt";
//$password = "By1t8kHchxb1";

?>