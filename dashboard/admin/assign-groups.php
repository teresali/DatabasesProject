<?php include('admin-header.php'); 

	session_start();
  	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  	include_once(DOC_ROOT.'/php/functions.php');
 
  	$DB = Database::Instance();

  	if(isset($_POST['submit'])) {
  		$projectTitle = $_POST['project'];
		$result = $DB->query("SELECT projectId FROM projects WHERE projectTitle='{$projectTitle}'");
		$data = $result->fetch_assoc();
		$projectId = $data["projectId"];

  		$array = $_POST['group'];

		$name = explode(" ", $member);

		for ($i = 1; $i <= sizeof($array); $i++) {
			$group = $array[$i];
			$groupId = $i;
			for ($j = 0; $j < sizeof($group); $j++) {
				$member = $group[$j];
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
		          Group Assignments   
		        </h3>
		      </div>
		    </div> 

            <input type="file" id="fileInput">
	        <a href="#" id="addStudents"> Upload Class Roster </p></a>
	        <!--
	        <input id="max_members" placeholder="# members per group" name="max_members">
	        <br>
	        <br>
	        <input id="num_groups" placeholder="# of groups" name="num_groups">
	        <br>
	        <br>
	        -->
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
	        	<br>
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
		        			<tr>
		        				<td>1</td>
		        				<td><select class="form-control member_select" name="group[1][]"></select></td>
		        				<td><select class="form-control member_select" name="group[1][]"></select></td>
		        				<td><select class="form-control member_select" name="group[1][]"></select></td>
		        			</tr>
		        		</tbody>
		        	</table>
		        </div>	
	        	<div class="col-lg-12">
        			<a href="#" id="addGroup"><i class="glyphicon glyphicon-plus-sign"></i> Add Group</p></a>
        		</div>
        		<br>
        		<br>
        		<a href="#"><button type="button" id="randomize" class="btn btn-default btn-primary" name="randomize">Random</button></a>
        		<!--<button id="randomize" class="btn btn-default btn-primary" name="randomize">Random</button>-->
	        	<button type="submit" class="btn btn-default btn-primary" name="submit">Submit</button>
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

		var names;
		var memberOptions = ""; 
		var groupNum = 2;
		var optionArray;

        function addGroup()
        {
        	var name="group[]"
            var row = document.getElementById("GroupsTable").insertRow(-1);
            row.innerHTML = '<td>' + groupNum + '</td><td><select class="form-control member_select" name="group[' + groupNum + '][]"></select></td><td><select class="form-control member_select" name="group[' + groupNum + '][]"></select></td><td><select class="form-control member_select" name="group[' + groupNum + '][]"></select></td>';
            setMemberOptions();
            groupNum++;

        }

        document.getElementById ("addStudents").addEventListener ("click", setMemberOptions, false);
        //document.getElementById ("addStudents").addEventListener ("click", randomize, false);

        document.getElementById ("addGroup").addEventListener ("click", addGroup, false);

        function setMemberOptions()
        {
			$(".member_select:empty").each(function() {  //update with member select?
		        var select = $(this);
		        for (i in names) {
		        	var option = new Option(names[i], names[i]);
		        	$(option).attr('id', names[i]); //works?
			        $(select).append(option);
			    }
		    });

		}
	
        document.getElementById('fileInput').onchange = function(){
		  var file = this.files[0];
		  names = new Array;
		  names.push(""); //empty option
		  var reader = new FileReader();
		  reader.onload = function(progressEvent){
		    var lines = this.result.split('\n');
		    for(i in lines){
		      names.push(lines[i]);
		    }
		  };
		  reader.readAsText(file);
		
		};


		document.getElementById('randomize').onclick = function(){
			var num_names = names.length - 1; 
			var num_groups = Math.ceil(num_names / 3); //hardcoded 3, only group size supported currently
			for (var i = 1; i < num_groups; i++) {
				addGroup();
			};
			var members = names.slice(1);
			members = shuffle(members);
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

/*
		document.getElementsByClassName("member_select").onchange = function() {
			var selection = this.value;
			$(".member_select").each(function() {  //update with member select?
		        var select = $(this);
			    $(select).remove(selection);
			    
		    });
			

		};
 */
 		</script>
	</head>
<?php include('admin-footer.php'); ?>