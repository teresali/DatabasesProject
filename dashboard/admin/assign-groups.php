<?php 

  session_start();
  // redirects to 404 page if user is not an admin
  if(!$_SESSION['isAdmin']) {
    echo "<div style='margin-left:560px; margin-top:200px'><img src='sadface.png' height='200px' width='200px'><p><div style='font-size:50pt; margin-left:50px'>404</div></p><p><div style='font-size:20pt;margin-left:-70px'>Not an Admin Unable to View Page</div></p>";
    header("HTTP/1.0 404 Not Found");
    exit();
  } else {
		include('admin-header.php'); 
	  	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
	  	include_once(DOC_ROOT.'/php/functions.php');
	 
	  	$DB = Database::Instance();

	  	if(isset($_POST['submit'])) {


	  		$projectTitle = $_POST['project'];
			$result = $DB->query("SELECT projectId FROM projects WHERE projectTitle='{$projectTitle}'");
			$data = $result->fetch_assoc();
			$projectId = $data["projectId"];

	  		$table_data = $_POST['group'];


		foreach($table_data as $groupId => $groupMembers) {
			foreach ($groupMembers as $member) {
				if ($member != ""){
					$name = explode(" ", $member);
					$fName = $name[0];
					$lName = $name[1];
					$result = $DB->query("SELECT userId FROM users WHERE fName='{$fName}' AND lName='{$lName}'");
					$data = $result->fetch_assoc();
					$userId = $data["userId"];
					$DB->query("INSERT INTO groups VALUES ('{$userId}', '{$groupId}', '{$projectId}')");
				}
			}
		}

		
  	}



?>
<body>
    <div id="page-wrapper">
        <div id="page-inner">
        	<div class="row">
		      <div class="col-md-12">
		        <h3 class="page-header">
		          Groups   
		        </h3>
		      </div>
		    </div> 



		    <div role="tabpanel">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#assign" aria-controls="home" role="tab" data-toggle="tab">Assign</a></li>
            <li role="presentation"><a href="#view" aria-controls="profile" role="tab" data-toggle="tab">View</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="assign">
                <div class="row">
                  <div class="col-lg-12">
                  <div class="panel panel-default no-boder">
                      <div class="panel-body">
                      		<form class="form-horizontal form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
					        	<div class="col-xs-3">
					        	<select required class="form-control" name="project" id="projectOptions">
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
					        	<label>Upload Class Roster:</label>
				            	<input type="file" id="fileInput">
					        	<br>
					        	<div class="table-responsive"> 
						        	<table id="GroupsTable" class="table table-striped table-bordered table-hover" style="width:100%"> 
						        		<tbody>
						        			<tr>
						        				<th class="col-md-1"> Group </th>
						        				<th class="col-md-1"> Member 1</th>
						        				<th class="col-md-1"> Member 2</th>
						        				<th class="col-md-1"> Member 3</th>
						        			</tr>
						        		</tbody>
						        	</table>
						        </div>	
					        	<div class="col-lg-12">
				        			<a href="#" id="addGroup"><i class="glyphicon glyphicon-plus-sign"></i> Add Group</p></a>
				        		</div>
				        		<div class="col-lg-12">
				        			<a href="#" id="removeGroup"><i class="glyphicon glyphicon-minus-sign"></i> Remove Group</p></a>
				        		</div>
				        		<br>
				        		<br>
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


                      		$project_q = "SELECT DISTINCT projectId FROM groups";
                      		$project_result = $DB->query($project_q);

                      		while ($project_data = $project_result->fetch_assoc()) {
                      			$projectId = $project_data['projectId'];
                      			$projectTitle = $DB->query("SELECT projectTitle FROM projects WHERE projectId='{$projectId}'")->fetch_assoc()['projectTitle'];
                      			echo $projectTitle;
                      			echo "<table class='table table-striped table-bordered table-hover' style='width:100%'>";
                      			echo "<tbody>";


                      			$group_q = "SELECT DISTINCT groupId FROM groups WHERE projectId='{$projectId}'";
                      			$group_result = $DB->query($group_q);

                      			echo "<tr><th class='col-md-1'> Group</th><th class='col-md-1'> Member 1</th><th class='col-md-1'> Member 2</th><th class='col-md-1'> Member 3</th></tr>";
         
                      			while ($group_data = $group_result->fetch_assoc()) {
                      				$groupId = $group_data['groupId'];
                      				echo "<tr>";

                      				echo "<td>{$groupId}</td>";
                      				$user_q = "SELECT userId FROM groups WHERE groupId='{$groupId}' AND projectId='{$projectId}'";
                      				$user_result = $DB->query($user_q);

                      				$max_cols = 3;
                      				while ($max_cols > 0){
		                      			while ($user_data = $user_result->fetch_assoc()) {
		                      					
	                      					$userId = $user_data['userId'];
	                      					$userName = $DB->query("SELECT fName, lName FROM users WHERE userId='{$userId}'")->fetch_assoc();
                  							echo "<td>{$userName['fName']} {$userName['lName']}</td>";
	                      					$max_cols--;
		                      			}

	                      				if ($max_cols > 0) {
		                      				echo "<td></td>";
		                      				$max_cols--; 
		                      			}		     
                      					
                      				} 
                      				echo "</tr>";
                      			}
                      			echo "<tbody>";
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

		var names;
		var memberOptions = ""; 
		var optionArray;

	

		document.getElementById("addGroup").addEventListener("click", addGroup);

        function addGroup(){
        	var rowCount = $('#GroupsTable tr').length;
        	var groupNum;
        	if (rowCount == 1){
        		groupNum = 1;
        	} else {
        		groupNum = parseInt($('#GroupsTable tr:last').find('td:first').text()) + 1;
        	}
        	
        	var name="group[]"
            var row = document.getElementById("GroupsTable").insertRow(-1);
            row.innerHTML = '<td>' + groupNum + '</td><td><select class="form-control member_select" name="group[' + groupNum + '][]"></select></td><td><select class="form-control member_select" name="group[' + groupNum + '][]"></select></td><td><select class="form-control member_select" name="group[' + groupNum + '][]"></select></td>';
            setMemberOptions();
            groupNum++;
        }

        document.getElementById("removeGroup").onclick = function(){
        	$('#GroupsTable tr:last').remove();
        };

        function setMemberOptions()
        {
			$(".member_select").each(function() {  
		        var select = $(this);
		        select.empty();
		        var default_option = new Option("Select", "");
		        $(select).append(default_option);
		        for (i in names) {
		        	var option = new Option(names[i], names[i]);
		        	$(option).attr('id', names[i]); 
			        $(select).append(option);
			    }
		    });

		}


        document.getElementById('fileInput').onchange = function(){
          file = this.files[0]; 
          names = new Array;
		  var reader = new FileReader();
		  reader.readAsText(file);
		  reader.onload = function(){
		    var lines = this.result.split('\n');
		    for(i in lines){
		      names.push(lines[i]);
		      setMemberOptions();
		    }
		  };
        };


		document.getElementById('randomize').onclick = function(){
			$("GroupsTable").find("tr:gt(0)").remove();
			var num_names = names.length; 
			var num_groups = Math.ceil(num_names / 3); //hardcoded 3, only group size supported currently
			for (var i = 0; i < num_groups; i++) {
				addGroup();
			};
			var members = shuffle(names);
			$(".member_select").each(function(index) {  //update with member select?
				if (index < members.length){
			        var select = $(this);
				    $(select).val(members[index]);
				}
			    
		    });

		};

		function shuffle(array) {
		  var currentIndex = array.length, temporaryValue, randomIndex ;

		  // While there remain elements to shuffle...
		  while (0 !== currentIndex) {

		    // Pick a remaining element...
		    randomIndex = Math.floor(Math.random() * currentIndex);
		    currentIndex -= 1;

		    // And swap it with the current element.
		    temporaryValue = array[currentIndex];
		    array[currentIndex] = array[randomIndex];
		    array[randomIndex] = temporaryValue;
		  }

		  return array;
		}


 		</script>
	</head>

<?php 
include('admin-footer.php'); 
}?>
