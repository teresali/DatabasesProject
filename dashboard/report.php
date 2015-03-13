<?php
  include('header.php');

  $DB = Database::Instance();
  $projectId = $_GET['projectId'];
  $groupId = $_GET['groupId'];

  $result = $DB->query("SELECT * from projects WHERE projectId = {$projectId}");
  $data = $result->fetch_assoc();
  $curr = new Project($data);


  if(isset($_POST['submit'])) {
    if($_FILES['newfile']) {
      echo "hi";
    }
    echo file_get_contents($_FILES['newfile']['tmp_name']);
    // if ($_FILES['newfile']['error'] == UPLOAD_ERR_OK               //checks for errors
    //   && is_uploaded_file($_FILES['newfile']['tmp_name'])) { 
    //                                                                 //checks that file is uploaded
    //   echo file_get_contents($_FILES['newfile']['tmp_name']); 
    // }
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
          <div class="panel-body" style="
    height: 218px;">
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
        </div>
      </div>

      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            Scores from Peer Assessments
            <div class="pull-right">
              <a href="#">View Assessments</a>
            </div>
          </div>
          <div class="panel-body" style="
    height: 218px;">
            <table class="table borderless" id="borderless">
              <tbody>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[0]; ?></td>
                  <td class="col-md-7">4</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[1]; ?></td>
                  <td class="col-md-7">5</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[2]; ?></td>
                  <td class="col-md-7">3</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[3]; ?></td>
                  <td class="col-md-7">5</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[4]; ?></td>
                  <td class="col-md-7">4</td>
                </tr>
                <tr>
                  <td class="col-md-5"><strong>Overall</strong></td>
                  <td class="col-md-7">21</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

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
                <td>3 out of 10 groups</td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
  </div>

    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            File Submission
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']."?projectId={$projectId}&groupId={$groupId}"; ?>">
                <div class="form-group">
                  <label>Report Title</label>
                  <input class="form-control" name="title" required>
                </div>
                <div class="form-group">
                  <label>Upload File</label>
                  <input type="file" name="newfile">
                </div>
                <div class="form-group">
                  <label>Or Paste File Contents Here</label>
                  <textarea class="form-control" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-default btn-primary" name = "submit">Submit</button>
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
</div>

          
<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php include('footer.php'); ?>