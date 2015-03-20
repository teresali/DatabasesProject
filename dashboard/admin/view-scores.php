<?php 
  session_start();
  // redirects to 404 page if user is not an admin
  if(!$_SESSION['isAdmin']) {
    echo "<div style='margin-left:560px; margin-top:200px'><img src='sadface.png' height='200px' width='200px'><p><div style='font-size:50pt; margin-left:50px'>404</div></p><p><div style='font-size:20pt;margin-left:-70px'>Not an Admin Unable to View Page</div></p>";
    header("HTTP/1.0 404 Not Found");
    exit();
  } else {

    include('admin-header.php'); 
    include('../../config.php');
?>

    <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
              <div class="col-lg-12">
                  <h3 class="page-header">
                      View Scores
                  </h3>
              </div>
          </div>

          <div role="tabpanel">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#by-project" aria-controls="home" role="tab" data-toggle="tab">By Project</a></li>
            <li role="presentation"><a href="#by-user" aria-controls="profile" role="tab" data-toggle="tab">By User</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="by-project">
                <div class="row">
                  <div class="col-lg-12">
                  <div class="panel panel-default no-boder">
                      <div class="panel-body">
                            <div class="table-responsive">    
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th class="col-md-3">Name</th>
                                          <th class="col-md-3">Due Date</th>
                                          <th class="col-md-2">Mean</th>
                                          <th class="col-md-2">Standard Deviation</th>
                                          <th class="col-md-2">No. of Submissions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                        if(isset($_SESSION['user'])) {

                                          $DB = Database::Instance();
                                          $q = "SELECT projectId, projectTitle, dueDate from Projects";
                                          $result = $DB->query($q);
                                               
                                          while($p =& $result->fetch_assoc()) {
                                            $projectId = $p['projectId'];
                                            $title = $p['projectTitle'];
                                            $dueDate = $p['dueDate'];
                                                                                      
                                            $mean = Project::calculateMean($DB, $projectId);
                                            $stddev = Project::calculateStdDev($DB, $projectId);
                                            $numSubmissions = Project::countSubmissions($DB, $projectId);

                                            echo "<tr>";
                                            echo "<td><a href=view-scores-project.php?projectId={$projectId}>{$title}<S/a></td>";
                                            echo "<td>{$dueDate}</td>";
                                            echo "<td>{$mean}</td>";
                                            echo "<td>{$stddev}</td>";
                                            echo "<td>{$numSubmissions}</td>";
                                            echo "</tr>";
                                          }
                                       }
                                    ?>
                                  </tbody>
                                </table>
                            </div> 
                            <!-- /. table-responsive -->   
                        </div>
                        <!-- /. panel-body -->
                    </div>
                    <!-- /. panel -->
                </div>
                <!-- /. ROW  -->
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="by-user">
                <div class="row">
                  <div class="col-lg-12">
                  <div class="panel panel-default no-boder">
                      <div class="panel-body">
                            <div class="table-responsive">    
                              <table id="view-scores" class="table table-striped table-bordered table-hover" data-sort-name="grade" data-sort-order="desc">
                                  <thead>
                                      <tr>
                                          <th class="col-md-2" data-field="fName"data-sortable="true">First Name </th>
                                          <th class="col-md-2" data-field="lName" data-sortable="true">Last Name </th>
                                          <th class="col-md-2" data-field="grade" data-sortable="true">Current Overall Grade</th>
                                          <th class="col-md-2" data-field="stddev"data-sortable="true">No. Reports Submitted </th>
                                          <th class="col-md-2" data-field="no" data-sortable="true">Notes </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                        if(isset($_SESSION['user'])) {
                                          // $DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                          $DB = Database::Instance();
                                          $q = "SELECT userId, fName, lName from users where isAdmin=0";
                                          $result = $DB->query($q);
                                               
                                          while($u =& $result->fetch_assoc()) {
                                              $userId = $u['userId'];
                                              $fName = $u['fName'];
                                              $lName = $u['lName'];
                                              $avg = User::getAvgScore($DB, $userId);
                                              $numReports = User::getNumReports($DB, $userId);

                                              if($avg <= 12 && ($numReports[0] != 0)) {
                                                $comments = 'Student is below average';
                                              } else {
                                                $comments = '';
                                              }

                                              echo "<tr>";
                                              echo "<td><a href=view-scores-user.php?userId={$userId}>{$fName}</a></td>";
                                              echo "<td>{$lName}</td>";
                                              echo "<td>{$avg}</td>";
                                              echo "<td>{$numReports[0]}/{$numReports[1]}</td>";
                                              echo "<td><button class='report-button' data-toggle='modal' data-target='#modal{$userId}'><i class='fa fa-file-text'></i></button>{$comments}</td>";
                                              echo "</tr>";

                                              echo "<div class='modal fade' id='modal{$userId}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                  <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                      <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                        <h4 class='modal-title' id='myModalLabel'>Reports Status for {$fName}</h4>
                                                      </div>
                                                      <div class='modal-body'>
                                                        <p>
                                                        <strong>Submitted Reports: </strong>{$numReports[2]}
                                                        </p>
                                                        <p>
                                                        <strong>Not Submitted Reports: </strong>{$numReports[3]}
                                                        </p>
                                                      </div>
                                                      
                                                    </div>
                                                  </div>
                                                </div>";
                                          }
                                       }
                                    ?>
                                  </tbody>
                                </table>
                            </div> 
                            <!-- /. table-responsive -->   
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
<?php 
include('admin-footer.php'); 
}?>



