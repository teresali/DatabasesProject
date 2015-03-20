<?php include('header.php'); ?>

<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header">
          My Assessments   
        </h3>
      </div>
    </div> 

    <div class="row">
      <div class="col-lg-12">
        <div class="panel no-boder panel-danger">
          <div class="panel-heading">
            To Be Assessed
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="col-md-2">Title</th>
                    <th class="col-md-2">Project Title</th>
                    <th class="col-md-2">GroupId</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    $DB = Database::Instance();
                    $groupId = $_SESSION['user']->getGroupId();
                    $projectTitles = Project::getTitles($DB);

                    $q = "SELECT * from groupsToAssess where groupId={$groupId}";
                    $r = $DB->query($q);
                    $completed = array();

                    while($a =& $r->fetch_assoc()) {
                      $assessment = Assessment::isCompleted($DB, $groupId, $a['groupToAssess'], $a['projectId']);

                      if($assessment == NULL) {
                        echo 'not complete';
                        echo "<tr>";
                        echo "<td><a href='single-view-assessment.php?toassess={$a['groupToAssess']}&projectId={$a['projectId']}' title='Assess'>{$title}</a></td>";
                        echo "<td>{$projectTitles[$a['projectId']]}</td>";
                        echo "<td>Anonymous</td>";
                        echo "</tr>";
                      } else {
                        array_push($completed, $assessment);
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
      <!-- /.col-md-12 -->
    </div>
    <!-- /. ROW -->

    <div class="row">
      <div class="col-lg-12">
        <div class="panel no-boder panel-success">
          <div class="panel-heading">
            Completed Assessments
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="col-md-3">Title</th>
                    <th class="col-md-2">ProjectTitle</th>
                    <th class="col-md-2">GroupId</th>
                    <th class="col-md-2">Date Assessed</th>
                    <th class="col-md-1">Score Given</th>
                    <th class="col-md-1">Avg</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                    foreach($completed as $a) {
                      $score = $a['score1'] + $a['score2'] + $a['score3'] + $a['score4'] + $a['score5'];
                      $title = Report::getTitleDB($DB, $a['groupAssessed'], $a['projectId']);
                      $avg = Project::getScoreForUser($DB, $a['projectId'], $a['groupAssessed'])['total'];

                      echo "<tr>";
                      echo "<td>{$title}<a class='pull-right' href='single-view-assessment.php?toassess={$a['groupAssessed']}&projectId={$a['projectId']}' title='Edit Assessment'><i class='edit fa fa-pencil pull-right'></i></a></td>";
                      echo "<td>{$projectTitles[$a['projectId']]}</td>";
                      echo "<td>Anonymous</td>";
                      echo "<td>{$a['dateAssessed']}</td>";
                      echo "<td>{$score}</td>";
                      echo "<td>{$avg}</td>";
                      echo "</tr>";
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
      <!-- /.col-md-12 -->
    </div>
    <!-- /. ROW -->



  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER -->


<?php include('footer.php'); ?>