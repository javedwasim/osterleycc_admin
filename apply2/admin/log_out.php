<?php 
include("include/db_config.php");

session_start();
session_destroy();
header('Location: index.php?action=Logout');
?>
