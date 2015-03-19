<?php

  	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  	include_once(DOC_ROOT.'/php/functions.php');

 
  	$DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$result = $DB->query("SELECT * from projects"); 
	
  	$projects = array();



  	if ($result->num_rows >= 1) {
	  	while ($row = $result->fetch_assoc()) {
	  		array_push($projects, $row['projectTitle']);
	    }
	} else {
		array_push($projects, "no data");
	}
	
    $json = json_encode($projects, JSON_FORCE_OBJECT);

    
    echo $json;


?>