<?php 
  include('header.php');
  $DB = Database::Instance();
  $groupId = $_SESSION['user']->getGroupId();
  $groupToAssess = $_GET['toassess'];
  $projectId = $_GET['projectId'];

  $report = Report::exists($DB, $groupToAssess, $projectId);
  $project = Project::exists($DB, $projectId);
  $assessment = Assessment::exists($DB, $groupId, $groupToAssess, $projectId);


  if(isset($_POST['submit'])) {
    if(isset($_POST['score1']) && isset($_POST['score2']) && isset($_POST['score3']) && isset($_POST['score4']) && isset($_POST['score5'])) {
      $s1 = $_POST['score1'];
      $s2 = $_POST['score2'];
      $s3 = $_POST['score3'];
      $s4 = $_POST['score4'];
      $s5 = $_POST['score5'];
      $comments = $DB->escape_string($_POST['comments']);

      $data = array(
        'groupId'       => $groupId,
        'groupAssessed' => $groupToAssess,
        'projectId'     => $projectId,
        'score1'        => $s1,
        'score2'        => $s2,
        'score3'        => $s3,
        'score4'        => $s4,
        'score5'        => $s5,
        'comments'      => $comments
      );

      if($assessment == NULL) {
        Assessment::addAssessment($DB, $data);
      } else {
        Assessment::replaceExisting($DB, $data);
      }

      header('Location: assessments.php');
      exit();
     }
  }
 ?>

<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header">
          Create/Edit Assessment  
        </h3>
      </div>
    </div> 
   <!-- /. ROW  -->

   <div class="row">                     
      <div class="col-lg-12">
        <div class="panel panel-default no-boder">
          <div class="panel-heading">
            <?php echo $report['title']; ?>
          </div>
          <div class="panel-body">
            <?php echo $report['textContent']; ?>
          </div>
          <!-- /. panel-body -->
        </div>
        <!-- /. panel -->
      </div>
      <!-- /. col-lg-12 -> -->
    </div>
    <!-- /. ROW -->



    <div class="row">                     
      <div class="col-lg-12">
        <div class="panel panel-default no-boder">
          <div class="panel-heading">
            Assessment for <?php echo $report['title']; ?>
          </div>
          <div class="panel-body">
            <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']."?toassess={$groupToAssess}&projectId={$projectId}" ?>" enctype="multipart/form-data">
              <div class="offset row">
                <div class="col-lg-5">
                  <label class="pull-left" style="color:grey">Needs Improvement</label>
                  <label class="pull-right" style="color:grey">Outstanding</label>
                </div>
              </div>
              <div class="row float">
                  <div class="col-lg-2">
                    <label><?php echo $project['criteria1']?> &nbsp</label>
                  </div>
                  <div class="col-lg-10">
                    <div class="score btn-group" data-toggle="buttons">
                      <label class="width-80 btn btn-default active">
                        <input type="radio" name="score1" value=1 autocomplete="off" checked>1
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score1" value=2 autocomplete="off">2
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score1" value=3 autocomplete="off">3
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score1" value=4 autocomplete="off">4
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score1" value=5 autocomplete="off">5
                      </label>
                    </div>
                  </div>
                </div>

                <div class="row float">
                  <div class="col-lg-2">
                    <label><?php echo $project['criteria2']?> &nbsp</label>
                  </div>
                  <div class="col-lg-10">
                    <div class="score btn-group" data-toggle="buttons">
                      <label class="width-80 btn btn-default active">
                        <input type="radio" name="score2" value=1 autocomplete="off" checked>1
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score2" value=2 autocomplete="off">2
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score2" value=3 autocomplete="off">3
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score2" value=4 autocomplete="off">4
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score2" value=5 autocomplete="off">5
                      </label>
                    </div>
                  </div>
                </div>

                <div class="row float">
                  <div class="col-lg-2">
                    <label><?php echo $project['criteria3']?> &nbsp</label>
                  </div>
                  <div class="col-lg-10">
                    <div class="score btn-group" data-toggle="buttons">
                      <label class="width-80 btn btn-default active">
                        <input type="radio" name="score3" value=1 autocomplete="off" checked>1
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score3" value=2 autocomplete="off">2
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score3" value=3 autocomplete="off">3
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score3" value=4 autocomplete="off">4
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score3" value=5 autocomplete="off">5
                      </label>
                    </div>
                  </div>
                </div>


                <div class="row float">
                  <div class="col-lg-2">
                    <label><?php echo $project['criteria4']?> &nbsp</label>
                  </div>
                  <div class="col-lg-10">
                    <div class="score btn-group" data-toggle="buttons">
                      <label class="width-80 btn btn-default active">
                        <input type="radio" name="score4" value=1 autocomplete="off" checked>1
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score4" value=2 autocomplete="off">2
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score4" value=3 autocomplete="off">3
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score4" value=4 autocomplete="off">4
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score4" value=5 autocomplete="off">5
                      </label>
                    </div>
                  </div>
                </div>

                <div class="row float">
                  <div class="col-lg-2">
                    <label><?php echo $project['criteria5']?> &nbsp</label>
                  </div>
                  <div class="col-lg-10">
                    <div class="score btn-group" data-toggle="buttons">
                      <label class="width-80 btn btn-default active">
                        <input type="radio" name="score5" value=1 autocomplete="off" checked>1
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score5" value=2 autocomplete="off">2
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score5" value=3 autocomplete="off">3
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score5" value=4 autocomplete="off">4
                      </label>
                      <label class="width-80 btn btn-default">
                        <input type="radio" name="score5" value=5 autocomplete="off">5
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Comments</label>
                  <textarea id="comments" class="form-control" rows="3" name="comments" required></textarea>
                </div>
                <button type="submit" class="btn btn-default btn-primary" name="submit">Submit</button>
            </form>
        </div>
        <!-- /. panel-body -->
      </div>
      <!-- /. panel -->
    </div>
    <!-- /. ROW -->
  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER -->


<?php include('footer.php'); ?>


<script type="text/javascript">
  // pre-populates the assessment form with the existing assessment
  (function() {
    var assessment = <?php echo json_encode($assessment) ?>;

    if(assessment != null) {
      $('label.active').removeClass('active');

      for (i = 1; i <= 5; i++) {
        var name = 'score' + String(i);
        var index = assessment[name]-1;
        $('input:radio[name=' + name + ']:nth(' + index + ')').attr('checked',true);
        $('input:radio[name=' + name + ']:nth(' + index + ')').parent().addClass('active');
        $('#comments').val(assessment['comments']);
      }
    }
  })();
</script>
