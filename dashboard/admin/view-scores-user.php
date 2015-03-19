<?php 
  include('admin-header.php'); 
  include('../../config.php');

  $DB = Database::Instance();
  $userId = $_GET['userId'];
  $user = User::exists($DB, $userId);
?>


    <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
              <div class="col-lg-12">
                  <h3 class="page-header">
                      <?php echo $user['fName'].' '.$user['lName'] ?>
                  </h3>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
              <div class="panel panel-default no-boder">
                <div class="panel-heading">
                  Student Info
                </div>
                  <div class="panel-body">
                    <div class="col-lg-3">
                      First Name: <?php echo $user['fName']?>
                    </div>
                    <div class="col-lg-3">
                      Last Name: <?php echo $user['lName']?>
                    </div>
                    <div class="col-lg-3">
                      Email: <?php echo $user['email']?>
                    </div>
                  </div>
                    <!-- /. panel-body -->
                </div>
                <!-- /. panel -->
            </div> 
            <!-- /. col-lg-12  -->
          </div>
          <!-- /. row -->

          <?php 
            $q = "SELECT * from projects";
            $result = $DB->query($q);

            while($p =& $result->fetch_assoc()) {
              $q = "SELECT groupId from groups where userId={$userId} and projectId={$p['projectId']}";
              $r = $DB->query($q);

              $groupId = $r->fetch_assoc()['groupId'];

              if($groupId) {
                $rank = Project::getRankForUser($DB, $p['projectId'], $groupId);
                $report = Report::exists($DB, $groupId, $p['projectId']);
                $score = Project::getScoreForUser($DB, $p['projectId'], $groupId)['total'];
              } else {
                $rank = NULL;
                $report = NULL;
                $score = NULL;
              }
              
          ?>

          <div class="row">
              <div class="col-lg-12">
              <div class="panel panel-default no-boder">
                <div class="panel-heading">
                  <?php echo $p['projectTitle'] ?>
                </div>
                  <div class="panel-body">
                    <div class="row" style="padding-bottom:10px">
                      <div class="col-lg-3">
                        Group Id: <?php echo $groupId?>
                      </div>
                      <div class="col-lg-3">
                        Group Rank: 
                        <?php 
                          if($rank) {
                            echo ($rank[0]."/".$rank[1]);
                          } else {
                            echo "<span style='color:red'>N/A</span>";
                          }
                        ?>
                      </div>
                      <div class="col-lg-3">
                        Average Score: 
                        <?php 
                          if($rank) {
                            echo $score;
                          } else {
                            echo "<span style='color:red'>N/A</span>";
                          }
                        ?>
                      </div>
                      <div class="col-lg-3">
                        Report: 
                        <?php 

                          if($report) {
                            echo "<div class='modal fade' id='modalg{$groupId}p{$p['projectId']}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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

                            echo "<button class='report-button' data-toggle='modal' data-target='#modalg{$groupId}p{$p['projectId']}'><div style='color:green'><strong>Submitted</strong></div></button>";
                          } else {
                            echo "<span style='color:red'>N/A</span>";
                          }
                        ?>
                      </div>
                  </div>
                  <!-- row -->
                        <h5><strong>Assessments of Student's Report</strong></h5>
                        <div class="table-responsive"> 
              
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th class="col-md-1">Group Id </i></th>
                                      <th class="col-md-1"><?php echo $p['criteria1'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria2'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria3'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria4'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria5'] ?></th>
                                      <th class="col-md-1">Overall </th>
                                      <th class="col-md-1">Comments </th>
                                      <th class="col-md-2">Date Assessed </th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                    if(isset($_SESSION['user'])) {  
                                      $q = "SELECT * from assessments where groupAssessed={$groupId} and projectId={$p['projectId']}";
                                      $assessments = $DB->query($q);

                                      foreach($assessments as $a) {
                                        $id = $a['groupId'];
                                        $score1 = $a['score1'];
                                        $score2 = $a['score2'];
                                        $score3 = $a['score3'];
                                        $score4 = $a['score4'];
                                        $score5 = $a['score5'];
                                        $total = $score1 + $score2 + $score3 + $score4 + $score5;
                                        $comments = $a['comments'];
                                        $dateAssessed = $a['dateAssessed'];

                                        echo "<tr>";
                                        echo "<td>{$id}</td>";
                                        echo "<td>{$score1}</td>";
                                        echo "<td>{$score2}</td>";
                                        echo "<td>{$score3}</td>";
                                        echo "<td>{$score4}</td>";
                                        echo "<td>{$score5}</td>";
                                        echo "<td>{$total}</td>";
                                        echo "<td><button class='report-button' data-toggle='modal' data-target='#modal{$id}'><i class='fa fa-comments'></i></button></td>";
                                        echo "<td>{$dateAssessed}</td>";
                                        echo "</tr>";

                                        echo "<div class='modal fade' id='modal{$id}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                  <div class='modal-content'>
                                                    <div class='modal-header'>
                                                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                      <h4 class='modal-title' id='myModalLabel'>Group {$id}'s Comments</h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                      {$comments}
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


                        <h5><strong>Assessments Completed by Student</strong></h5>
                        <div class="table-responsive"> 
              
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th class="col-md-1">Group Assessed </i></th>
                                      <th class="col-md-1"><?php echo $p['criteria1'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria2'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria3'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria4'] ?></th>
                                      <th class="col-md-1"><?php echo $p['criteria5'] ?></th>
                                      <th class="col-md-1">Overall </th>
                                      <th class="col-md-1">Comments </th>
                                      <th class="col-md-2">Date Assessed </th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                  if(isset($_SESSION['user'])) {  
                                      $q = "SELECT * from assessments where groupId={$groupId} and projectId={$p['projectId']}";
                                      $assessments = $DB->query($q);

                                      foreach($assessments as $a) {
                                        $groupAssessed = $a['groupAssessed'];
                                        $score1 = $a['score1'];
                                        $score2 = $a['score2'];
                                        $score3 = $a['score3'];
                                        $score4 = $a['score4'];
                                        $score5 = $a['score5'];
                                        $total = $score1 + $score2 + $score3 + $score4 + $score5;
                                        $comments = $a['comments'];
                                        $dateAssessed = $a['dateAssessed'];

                                        echo "<tr>";
                                        echo "<td>{$groupAssessed}</td>";
                                        echo "<td>{$score1}</td>";
                                        echo "<td>{$score2}</td>";
                                        echo "<td>{$score3}</td>";
                                        echo "<td>{$score4}</td>";
                                        echo "<td>{$score5}</td>";
                                        echo "<td>{$total}</td>";
                                        echo "<td><button class='report-button' data-toggle='modal' data-target='#modal{$groupId}'><i class='fa fa-comments'></i></button></td>";
                                        echo "<td>{$dateAssessed}</td>";
                                        echo "</tr>";

                                        echo "<div class='modal fade' id='modal{$groupId}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                  <div class='modal-content'>
                                                    <div class='modal-header'>
                                                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                      <h4 class='modal-title' id='myModalLabel'>Comments for Group {$groupAssessed}</h4>
                                                    </div>
                                                    <div class='modal-body'>
                                                      {$comments}
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
                        <!-- completed assessments -->
                    </div>
                    <!-- /. panel-body -->
                </div>
                <!-- /. panel -->
            </div> 
            <!-- /. col-lg-12  -->
          </div>
          <!-- /. row -->

          <?php } ?>
        
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->
<?php include('admin-footer.php'); ?>



