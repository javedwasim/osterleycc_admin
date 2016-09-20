<?php session_start();

if('pages/step'.$_POST['page'] == '') {
	echo '<script>window.location = "index.php";</script>';
	exit;
		}


if(file_exists('pages/step'.$_POST['page'].'.php')){
include'pages/step'.($_POST['page'].".php");
}
else {
	echo '<script>window.location = "index.php";</script>';
		exit;
}
?>