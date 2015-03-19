<?php include('admin-header.php'); 

	session_start();
  	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  	include_once(DOC_ROOT.'/php/functions.php');
 
  	//$DB = Database::Instance();

  	$DB = Database::Instance();
  	$q = "SELECT DISTINCT groupId FROM groups WHERE projectId={$projectId}";
  	$result = $DB->query($q); 

  	if ($result->num_rows >= 1) {
	  	while ($row = $result->fetch_assoc()) {
	  		echo $row['groupId'];
	    }
	}

  	if(isset($_POST['submit'])) {
 
  	}

  	



?>
<body>
    <div id="page-wrapper">
        <div id="page-inner">
        	<div class="row">
		      <div class="col-md-12">
		        <h3 class="page-header">
		          Assessment Assignments  
		        </h3>
		      </div>
		    </div> 
		    <form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	        <label>Project:</label>
	        	<select required class="form-control" name="project" id="projectOptions">
	        		<?php
	        			$DB = Database::Instance();
	        			$q = "SELECT * from projects";
						$result = $DB->query($q); 

					  	if ($result->num_rows >= 1) {
						  	while ($row = $result->fetch_assoc()) {
						  		echo "<option value={$row['projectTitle']}>{$row['projectTitle']}</option>";
						    }
						}

	        		?>
	        	</select>
	        </form>
       
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->
</body>
<!DOCTYPE HTML>
	<html lang="en">
    <head>
		
		<!-- Basic Metas -->
  		<meta http-equiv="content-type" content="text/html; charset=utf-8">

  		<title>Absinth | Peer Assessment</title>

  		<!-- Mobile Metas -->
 		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

 		<!-- CSS Files -->
		<link href="../css/style.css" rel="stylesheet" type="text/css">

	    <!-- JS -->
	    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- jQuery --> 
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> <!-- Bootstrap -->
	    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> <!-- Font awesome -->
	    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script> <!-- angularJS -->

		
		<script>


 		</script>
	</head>
<?php include('admin-footer.php'); ?>