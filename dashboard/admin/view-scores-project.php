<?php 
  include('admin-header.php'); 
  include('../../config.php');

  $DB = Database::Instance();
  $projectId = $_GET['projectId'];

  $project = Project::exists($DB, $projectId);
?>


    <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
              <div class="col-lg-12">
                  <h3 class="page-header">
                      Scores for <?php echo $project['projectTitle'] ?>
                  </h3>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
              <div class="panel panel-default no-boder">
                  <div class="panel-body">
                        <div class="table-responsive">    
                          <table id="view-scores" class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th class="col-md-1 sorting">Rank <i class="sort-icon fa fa-arrows-v"></i></th>
                                      <th class="col-md-1 sorting_asc">Group Id <i class="sort-icon fa fa-arrows-v"></i></th>
                                      <th class="col-md-2 ">Group Members <i class="sort-icon fa fa-arrows-v"></i></th>
                                      <th class="col-md-1 sorting">Report <i class="sort-icon fa fa-arrows-v"></i></th>
                                      <th class="col-md-1 sorting">Assessments <i class="sort-icon fa fa-arrows-v"></i></th>
                                      <th class="col-md-1 sorting">Score <i class="sort-icon fa fa-arrows-v"></i></th>
                                      <th class="col-md-2 sorting">Date Submitted <i class="sort-icon fa fa-arrows-v"></i></th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                    if(isset($_SESSION['user'])) {
                                      // $DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                      $DB = Database::Instance();
                                      $q = "SELECT DISTINCT groupId from groups where projectId={$projectId}";
                                      $result = $DB->query($q);
                                      
                                      // echo("<script>console.log('Request: ".$q."');</script>");
                                      // echo("<script>console.log('Request: ".json_encode($result->fetch_assoc())."');</script>");
                                           
                                      while($g =& $result->fetch_assoc()) {
                                          $groupId = $g['groupId'];
                                          $members = User::getGroupMembers($DB, $groupId, $projectId);
                                          $report = Report::exists($DB, $groupId, $projectId);
                                          $score = Project::getScoreForUser($DB, $projectId, $groupId)['total'];
                                          $rank = Project::getRankForUser($DB, $projectId, $groupId);
                                          $dateSubmitted = $report ? $report['dateSubmitted'] : 'Not Submitted Yet';

                                          echo "<tr>";
                                          echo "<td>{$rank[0]}</td>";
                                          echo "<td>{$groupId}</td>";
                                          echo "<td>{$members}</td>";
                                          echo "<td><button class='report-button' data-toggle='modal' data-target='#modal{$groupId}'><i class='fa fa-file-text'></i></button></td>";
                                          echo "<td><a class='report-button' href='../view-assessments.php?projectId={$projectId}&groupId={$groupId}'><i class='fa fa-users'></i></a></td>";
                                          echo "<td>{$score}</td>";
                                          echo "<td>{$dateSubmitted}</td>";
                                          echo "</tr>";

                                          echo "<div class='modal fade' id='modal{$groupId}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                  <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                      <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                        <h4 class='modal-title' id='myModalLabel'>{$report['title']}</h4>
                                                      </div>
                                                      <div class='modal-body'>
                                                        {$report['textContent']}
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
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->
<?php include('admin-footer.php'); ?>



