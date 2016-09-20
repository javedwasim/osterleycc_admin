<?php

require "classes/DatabaseConnect.class.php";

if (isset($_GET['term'])){
	$return_arr = array();

	try {
	   
	    
	    $stmt = $db->prepare('SELECT cities_name FROM uk_city WHERE cities_name LIKE :term');
	    $stmt->execute(array('term' => $_GET['term'].'%'));
	    
	    while($row = $stmt->fetch()) {
	        $return_arr[] =  $row['value'];
	    }

	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}


