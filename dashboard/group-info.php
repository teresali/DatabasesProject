<?php include('header.php');
  $DB = Database::Instance();

  $groupId = $_SESSION['user']->getGroupId();
  if(!isset($groupId)) {
    // to be changed later
    $_SESSION['user']->setGroupId(1);
  }
 ?>

<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header">
          Group Info     
        </h3>
      </div>
    </div> 
  
  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER -->


<?php include('footer.php'); ?>