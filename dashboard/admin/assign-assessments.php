<<<<<<< HEAD
<?php include('admin-header.php'); 
=======
<?php 
  session_start();
  // redirects to 404 page if user is not an admin
  if(!$_SESSION['isAdmin']) {
    echo "<div style='margin-left:560px; margin-top:200px'><img src='sadface.png' height='200px' width='200px'><p><div style='font-size:50pt; margin-left:50px'>404</div></p><p><div style='font-size:20pt;margin-left:-70px'>Not an Admin Unable to View Page</div></p>";
    header("HTTP/1.0 404 Not Found");
    exit();
  } else {

  include('admin-header.php'); 

?>
>>>>>>> 5905efc7bfc815e091e07f0bb6206e1c6c2f8c12

	session_start();
  	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  	include_once(DOC_ROOT.'/php/functions.php');
 

  	$DB = Database::Instance();

  	if(isset($_POST['submit'])) {
  		$projectTitle = $_POST['project'];
  		$result = $DB->query("SELECT projectId FROM projects WHERE projectTitle='{$projectTitle}'");
		$data = $result->fetch_assoc();
		$projectId = $data["projectId"];

		$table_data = $_POST['group'];
		
		foreach ($table_data as $groupToAssess => $assessingGroups) {
    		foreach ($assessingGroups as $groupId) {
    			//echo "groupId: ".$groupId." groupToAssess: ".$groupToAssess." projectId: ".$projectId;
    			if ($groupId != "") {
	    			$q = "INSERT INTO groupstoassess VALUES ('{$groupId}', '{$groupToAssess}', '{$projectId}')";
	    			$DB->query($q);
	    		}
    		}
    	}
 
  	}
/*
  	$q = "SELECT * FROM groupstoassess WHERE projectId='{$projectId}'";
	$result = $DB->query($q);
	if ($result->num_rows) >= 1){

	}
*/
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



		    <div role="tabpanel">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#assign" aria-controls="home" role="tab" data-toggle="tab">Assign Assessments</a></li>
            <li role="presentation"><a href="#view" aria-controls="profile" role="tab" data-toggle="tab">View Assigned Assessments</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="assign">
                <div class="row">
                  <div class="col-lg-12">
                  <div class="panel panel-default no-boder">
                      <div class="panel-body">
                      		<form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
						       
					       
					        	<br>
					        	<br>
						        <div class="col-xs-3">
						        	<select class="form-control" name="project" id="projectOptions">
						        		<?php
						        			$DB = Database::Instance();
						        			$q = "SELECT * from projects";
											$result = $DB->query($q); 
											echo "<option value=''>Select Project</option>";
										  	if ($result->num_rows >= 1) {
											  	while ($row = $result->fetch_assoc()) {
											  		$projectTitle = $row['projectTitle'];
											  		echo "<option value='{$projectTitle}'>{$projectTitle}</option>";
											    }
											}

						        		?>
						        	</select>
						        </div>
						        <br>
						        <br>
						        	<div class="table-responsive"> 
							        	<table id="AssessmentsTable" class="table table-striped table-bordered table-hover" style="width:100%"> 
							        		<tbody id="assessment-groups">
									        	
									        </tbody>
									    </table>
									</div>
					        		<a href="#"><button type="button" id="randomize" class="btn btn-default btn-primary" name="randomize">Random</button></a>
									<button type="submit" class="btn btn-default btn-primary" name="submit">Submit</button> 
	        				</form>
                        </div>
                        <!-- /. panel-body -->
                    </div>
                    <!-- /. panel -->
                </div>
                <!-- /. ROW  -->
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="view">
                <div class="row">
                  <div class="col-lg-12">
                  <div class="panel panel-default no-boder">
                      <div class="panel-body">
                      	<?php 
                      		
                      		$DB = Database::Instance();

                      		


                      		$project_q = "SELECT DISTINCT projectId FROM groupstoassess";
                      		$project_result = $DB->query($project_q);

                      		while ($project_data = $project_result->fetch_assoc()) {
                      			$projectId = $project_data['projectId'];

                      			$q = "SELECT maxAssess FROM projects WHERE projectId='{$projectId}'";
								$result = $DB->query($q)->fetch_assoc();
								$max = $result['maxAssess'];

                      			$projectTitle = $DB->query("SELECT projectTitle FROM projects WHERE projectId='{$projectId}'")->fetch_assoc()['projectTitle'];
                      			echo $projectTitle;
                      			echo "<table class='table table-striped table-bordered table-hover' style='width:100%'>";
                      			echo "<tbody>";


                      			$assessed_q = "SELECT DISTINCT groupToAssess FROM groupstoassess WHERE projectId='{$projectId}'";
                      			$assessed_result = $DB->query($assessed_q);

                      			echo "<tr><th class='col-md-1'>Group</th>";


                      			for ($i=1; $i <= $max; $i++) { 
                      				echo "<th class='col-md-1'> Assessed By ({$i})</th>";
                      			}

                      			echo '</tr>';
                      			/*
                      			 <th class='col-md-1'> Assessed By (1)</th><th class='col-md-1'> Assessed By (2)</th><th class='col-md-1'> Assessed By (3)</th></tr>";
         */
                      			while ($assessed_data = $assessed_result->fetch_assoc()) {
                      				$assessed_id = $assessed_data['groupToAssess'];
                      				//echo $assessed_id." ";
                      				echo "<tr>";

                      				echo "<td>{$assessed_id}</td>";
                      				$assessing_q = "SELECT groupId FROM groupstoassess WHERE groupToAssess='{$assessed_id}' AND projectId='{$projectId}'";
                      				$assessing_result = $DB->query($assessing_q);

                      				$max_cols = $max;
                      				while ($max_cols > 0)  {   
	                      				while ($assessing_data = $assessing_result->fetch_assoc()) {
	                      					
	                      					$assessing_id = $assessing_data['groupId'];
	                      					echo "<td>{$assessing_id}</td>";

	                      					$max_cols--;
	                      				} 
	                      				if ($max_cols > 0) {
		                      				echo "<td></td>";
		                      				$max_cols--;
		                      			}
                      				}	
                      				echo "</tr>";
                      			}
                      			echo "</tbody>";
                      			echo "</table>"; 
                      		}


                      		
                        ?>      
                        </div>
                        <!-- /. panel-body -->
                    </div>
                    <!-- /. panel -->
                </div>
                <!-- /. ROW  -->


            </div>
          </div>
        </div>
       
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->
<<<<<<< HEAD
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

		var groups;
		var data;
		var max_assess;

		$('#projectOptions').change(function() {
			var selectedProj = $(this).val();
			data = jQuery.ajax({
                type: "POST",
                url: "assess-assign-script.php",
                dataType: 'json',
                async: false,
                data: {proj:selectedProj}
            }).responseJSON;

			
			groups = data['groups'];
			max_assess = data['max'];
			var max = max_assess;

            groups.sort(sortNumber);
          

          	$("#AssessmentsTable tr").remove();
        
            var html = "";

            var header_html = '<th class="col-md-1">Group</th>';
            var header_row = document.getElementById("AssessmentsTable").insertRow(-1);
            for (x = 1; x <= max; x++){
            	header_html += '<th class="col-md-1"> Assessed By (' + x + ')</th>';
            }
            header_row.innerHTML = header_html;

					       				
			for (i in groups) {   
            	var row = document.getElementById("AssessmentsTable").insertRow(-1);
            	//html = "";
            	html = '<td>' + groups[i] + '</td>';
            	for (j = 0; j < max; j++){
            		html += '<td><select class="form-control assesser_select" name="group[' + groups[i] + '][]"></select></td>'
            	}
            	row.innerHTML = html;
            }

            setGroupOptions(groups); 

	    });

	    function setGroupOptions(groups) {
	    	$(".assesser_select").each(function() {  
		        var select = $(this);
		        var default_option = new Option("Select", "");
		        $(select).append(default_option);
		        for (i in groups) {
		        	var option = new Option(groups[i], groups[i]);
		        	$(option).attr('id', groups[i]); 
			        $(select).append(option);
			    }
		    });

	    }



	    document.getElementById('randomize').onclick = function(){
	    	
			$('#AssessmentsTable tr').each(function(){

				var group_arr = groups.slice();
				group_arr = shuffle(group_arr);
				var group = $(this).find('td:first').html();
				var index = group_arr.indexOf(group);
				if (index > -1) {
				    group_arr.splice(index, 1);
				}

			    $(this).find('.assesser_select').each(function(index){
			    	$(this).val(group_arr[index]);

			    });
			});

		};

		function shuffle(array) {
		  var currentIndex = array.length, temporaryValue, randomIndex ;

		  while (0 !== currentIndex) {

		    randomIndex = Math.floor(Math.random() * currentIndex);
		    currentIndex -= 1;

		    temporaryValue = array[currentIndex];
		    array[currentIndex] = array[randomIndex];
		    array[randomIndex] = temporaryValue;
		  }

		  return array;
		}

		function sortNumber(a,b) {
		    return a - b;
		}
=======

<?php 

include('admin-footer.php'); 

}?>
>>>>>>> 5905efc7bfc815e091e07f0bb6206e1c6c2f8c12

 		</script>
	</head>
<?php include('admin-footer.php'); ?>
