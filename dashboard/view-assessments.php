<?php 
  include('header.php'); 

  $DB = Database::Instance();
  $projectId = $_GET['projectId'];
  $groupId = $_GET['groupId'];

  $q = "SELECT * FROM projects WHERE projectId={$projectId}";
  $result = $DB->query($q);
  $curr = new Project($result->fetch_assoc());

?>

<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header">
          Assessments for <?php echo $curr->getTitle() ?>   
        </h3>
      </div>
    </div> 
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-4 no-padding">
          <div class="panel panel-default no-boder">
            <div class="panel-body ten">
              <p><div class="green"></div>&nbsp Excellent (> 1 standard deviation)</p>
              <p><div class="yellow"></div>&nbsp Good (within 1 standard deviation)</p>
              <p><div class="red"></div>&nbsp Needs Improvement (< 1 standard deviation)</p>
            </div>
          </div>
        </div>
      </div>
    </div>

      <?php
        $assessments = User::getAssessments($DB, $groupId, $projectId);

        foreach($assessments as $a) {
          $s1 = $a['score1'];
          $s2 = $a['score2'];
          $s3 = $a['score3'];
          $s4 = $a['score4'];
          $s5 = $a['score5'];
          $total = $s1+$s2+$s3+$s4+$s5;
          $comments = $a['comments'];

          $c1 = $curr->getCriteria()[0];
          $c2 = $curr->getCriteria()[1];
          $c3 = $curr->getCriteria()[2];
          $c4 = $curr->getCriteria()[3];
          $c5 = $curr->getCriteria()[4];

          $mean = Project::calculateMean($DB, $projectId);
          $stddev = Project::calculateStdDev($DB, $projectId);
          $scoreType = Assessment::scoreType($mean, $stddev, $total);
          $graderScore = Project::getScoreForUser($DB, $projectId, $a['groupId'])['total'];

          if($scoreType == 0) {
            $footer = "<div class='panel-footer back-footer-green left-align' style='height:35px'>";
          } else if ($scoreType == 1) {
            $footer = "<div class='panel-footer back-footer-brown left-align' style='height:35px'>";
          } else {
            $footer = "<div class='panel-footer back-footer-red left-align' style='height:35px'>";
          }

          echo "
            <div class='row'>
              <div class='col-lg-12'>
                <div class='panel panel-primary text-center no-boder'>
                  <div class='panel-body'>
                      {$comments}
                      <br><div class='graderScore'>Grader's score: {$graderScore}/25</div>
                  </div>
                  {$footer}
                    <div class='col-md-3'>
                      <strong>Overall Score: {$total}/25</strong>
                    </div>
                    <div class='col-md-9 right-align'>
                      {$c1}: {$s1}/5 &nbsp
                      {$c2}: {$s2}/5 &nbsp
                      {$c3}: {$s3}/5 &nbsp
                      {$c4}: {$s4}/5 &nbsp
                      {$c5}: {$s5}/5  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ";
        }
      ?>
  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER -->


<?php include('footer.php'); ?>

<script type="text/javascript">
  $(".panel").each(function() {
    $( this ).addClass( "foo" );
  })

</script>