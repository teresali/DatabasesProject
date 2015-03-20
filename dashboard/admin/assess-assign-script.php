<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  	include_once(DOC_ROOT.'/php/functions.php');



  	$projectTitle = $_POST['proj'];

    $group_arr = [];

    
	$DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);






	$q = "SELECT projectId FROM projects WHERE projectTitle='{$projectTitle}'";
	$result = $DB->query($q);
	$data = $result->fetch_assoc();
	
	$projectId = $data['projectId'];
	
	

  	$q = "SELECT DISTINCT groupId FROM groups WHERE projectId='{$projectId}'";
  	$result = $DB->query($q); 

  	if ($result->num_rows >= 1) {
	  	while ($row = $result->fetch_assoc()) {
	  		$group_arr[] = $row['groupId'];
	  	}
	}  


	$q = "SELECT maxAssess FROM projects WHERE projectId='{$projectId}'";
	$result = $DB->query($q)->fetch_assoc();
	$max = $result['maxAssess'];

	

	$data_arr = [];
	$data_arr['groups'] = $group_arr;
	$data_arr['max'] = $max;

	 
	echo json_encode($data_arr);
?>