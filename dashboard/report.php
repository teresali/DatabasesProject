<?php
  include('header.php');

  $DB = Database::Instance();
  $projectId = $_GET['projectId'];
  $groupId = $_GET['groupId'];

  $q = "SELECT * FROM projects WHERE projectId={$projectId}";
  $result = $DB->query($q);
  $curr = new Project($result->fetch_assoc());


  if(isset($_POST['submit'])) {
    $errors = '';
    $title = $_POST['title'];

    // both file and pasted text
    if(file_exists($_FILES['uploadedReport']['tmp_name']) && $_POST['pastedText']) {
      $errors = 'Unable to both upload file and paste contents. Please fix!';
    // file upload
    } elseif($_FILES['uploadedReport']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['uploadedReport']['tmp_name'])) {
      $textContent = file_get_contents($_FILES['uploadedReport']['tmp_name']); 
      $md5 = md5_file($_FILES['uploadedReport']['tmp_name']);
    // // pasted text
    } elseif($_POST['pastedText']) {
      $textContent = $_POST['pastedText'];
      $md5 = 'None';
    // no input
    } else {
      $errors = 'No file or pasted text was entered. Please fix!';
    }
    // // process submission if there are no errors
    if($errors == '') {
      $data = array(
        'groupId'       => $groupId,
        'projectId'     => $projectId,
        'title'         => $title,
        'textContent'   => $textContent,
        'md5'           => $md5
      );
    //   // check if group has already submitted a report for a project
      if(Report::exists($groupId, $projectId, $DB) != NULL) {
        Report::replaceExisting($data, $DB);
      } else {
        Report::addReport($data, $DB);
      }
    }
  }

?>

  <div id="page-wrapper" >
    <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header">
          <?php echo $curr->getTitle(); ?>     
        </h3>
      </div>
    </div> 
   <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Summary
          </div>
          <div class="panel-body" style="height: 218px;">
            <table class="table borderless" id="borderless">
              <tbody>
                <tr>
                  <td class="col-md-3">Description:</td>
                  <td class="col-md-9"><?php echo $curr->getDescription(); ?></td>
                </tr>
                <tr>
                  <td class="col-md-3">Due Date:</td>
                  <td class="col-md-9"><?php echo $curr->getDueDate(); ?></td>
                </tr>
                <tr>
                  <td class="col-md-4">Late Submissions:</td>
                  <td class="col-md-8">Not Accepted</td>
                </tr>
                <tr>
                  <td class="col-md-4">Regrades:</td>
                  <td class="col-md-8">No online regrades</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /. panel-body -->
        </div>
        <!-- /. panel -->
      </div>
      <!-- /. col-lg-6 -->

      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Scores from Peer Assessments
            <div class="pull-right">
              <a href="#">View Assessments</a>
            </div>
          </div>
          <div class="panel-body" style="height: 218px;">
            <table class="table borderless" id="borderless">
              <tbody>
                <tr>
                  <td class="col-md-5"><?php 
                    $scores = Project::getScoreForUser($DB, $projectId, $groupId);
                    echo $curr->getCriteria()[0]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s1']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[1]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s2']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[2]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s3']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[3]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s4']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[4]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s5']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><strong>Overall</strong></td>
                  <td class="col-md-7"><?php echo $scores['total']?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /. panel-body -->
        </div>
        <!-- /. panel -->
      </div>
      <!-- /. col-lg-6 -->
    </div>
    <!-- /. col-lg-12 -->
  </div>
  <!-- /. ROW -->

  <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            Statistics
        </div>
        <div class="panel-body">
          <div class="col-lg-6">
          <table class="table borderless" id="borderless">
            <thead>
              <tr>
                <th class="col-md-2">Mean</th>
                <th class="col-md-3">Aggregated Rank</th>
              </tr>
          </thead>
            <tbody>
              <tr>
                <td><?php echo Project::calculateMean($DB, $projectId); ?></td>
                <td>
                  <?php 
                    $rank = Project::getRankForUser($DB, $projectId, $groupId);
                    if($rank != NULL) {
                      echo "{$rank[0]} out of {$rank[1]}";
                    } else {
                      echo "Not Available";
                    }
                  ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
  </div>

  <?php 
    $report = Report::exists($groupId, $projectId, $DB);
    // if submission has already been made then show details
    if($report != NULL) {
  ?>
    <div id="submissions" class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Submission
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered">
            <thead>
                <tr>
                  <th class="col-md-2">Submitted</th>
                  <th class="col-md-2">Date</th>
                  <th class="col-md-3">MD5</th>
                </tr>
            </thead>
            <tbody>
              <?php
                echo "<tr>";
                echo "<td>{$report['title']}</td>";
                echo "<td>{$report['dateSubmitted']}</td>";
                echo "<td>{$report['md5']}</td>";
                echo "</tr>";
              ?>
            </tbody>
          </table>
        </div>
          <!-- /. panel-body -->
      </div>
      <!-- /. panel -->
    </div>
    <!-- /. col-lg-12 -->

  <?php } 

    $now = new DateTime();
    $dueDate = new DateTime($curr->getDueDate());
    $interval = $now->diff($dueDate);
    $diff = (int)$interval->format('%r%a');
    if($diff < 0) {
      echo "
        <div id='file-submit' class='col-lg-12'>
          <div class='panel panel-default'>
            <div class='panel-heading errors'>
                Submission Closed
            </div>
          </div>
        </div>
      ";
    }
    // if not overdue then show file submission form
    else {
  ?>

      <div id="file-submit" class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            File Submission
            <span class="errors"> <?php if($errors) { echo "- ".$errors; } ?></span>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']."?projectId={$projectId}&groupId={$groupId}#submission" ?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Report Title</label>
                  <input class="form-control" name="title" required>
                </div>
                <div class="form-group">
                  <label>Upload File</label>
                  <input type="file" name="uploadedReport">
                </div>
                <div class="form-group">
                  <label>Or Paste File Contents Here</label>
                  <textarea class="form-control" rows="10" name="pastedText"></textarea>
                </div>
                <button type="submit" class="btn btn-default btn-primary" name="submit">Submit</button>
              </form>
          </div>            
        </div>
        <!-- /.row (nested) -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->


  <?php

    }

  ?>


    
</div>

          
<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php include('footer.php'); ?>