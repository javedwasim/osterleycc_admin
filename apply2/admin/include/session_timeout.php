<?php
$valid = $_SESSION['IsActive'];
if(!$valid){
	header("Location:index.php?action=login first");
}
?>