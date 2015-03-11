<?php
  include('header.php');

  $DB = Database::Instance();
  $projectId = $_GET['projectId'];
  $result = $DB->query("SELECT * from projects WHERE projectId = {$projectId}");
  $data = $result->fetch_assoc();
  // $project = new Project($data);
?>

  <div id="page-wrapper" >
    <div id="page-inner">
  <div class="row">
    <div class="col-md-12">
      <h3 class="page-header">
        <?php echo $data['projectTitle']; ?>
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
                  <td class="col-md-9"><?php echo $data['projectDescription']; ?></td>
                </tr>
                <tr>
                  <td class="col-md-3">Due Date:</td>
                  <td class="col-md-9"><?php echo $data['dueDate']; ?></td>
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
                  <td class="col-md-5"><?php echo $data['criteria1']; ?></td>
                  <td class="col-md-7">4</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $data['criteria2']; ?></td>
                  <td class="col-md-7">5</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $data['criteria3']; ?></td>
                  <td class="col-md-7">3</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $data['criteria4']; ?></td>
                  <td class="col-md-7">5</td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $data['criteria5']; ?></td>
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
                <td>23</td>
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
              <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                  <label>Report Title</label>
                  <input class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Upload File</label>
                  <input type="file">
                </div>
                <div class="form-group">
                  <label>Or Paste File Contents Here</label>
                  <textarea class="form-control" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-default btn-primary">Submit</button>
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