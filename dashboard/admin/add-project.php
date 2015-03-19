<?php include('admin-header.php'); 

  session_start();
  include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  include_once(DOC_ROOT.'/php/functions.php');
 
  $DB = Database::Instance();
  
  if(isset($_POST['submit'])) {
    $data = array(
        'projectTitle'  => $_POST['title'],
        'dueDate'       => $_POST['date'], 
        'projectDescription' => $_POST['description'],
        'criteria1'     => $_POST['criteria1'],
        'criteria2'     => $_POST['criteria2'],
        'criteria3'     => $_POST['criteria3'],
        'criteria4'     => $_POST['criteria4'],
        'criteria5'     => $_POST['criteria5']
    );
        
    $errors ='';
        
    if(Project::isDuplicate($_POST['title'], $DB)) {
      $errors = 'Project Name already exists.';
    }
    
    if($errors == '') {
      Project::addProject($data, $DB);
    }
  }
?>
    <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-header">
                Add Project  
              </h3>
            </div>
          </div>             
            <div class="col-lg-12"> 
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="errors"> <?php if($errors) { echo $errors; } ?> </div>
                            <div class="form-group">
                              <label>Project Title</label>
                              <input class="form-control" name="title" required>
                            </div>
                            <div class="form-group">
                              <label>Project description</label>
                              <textarea class="form-control" rows="10" name="description"></textarea>
                            </div>

                            <div class="container">
                              <div class="row">
                                <div class='col-lg-4'>
                                  <div class="form-group">
                                    Due Date
                                    <div class='input-group date' id='datetimepicker1'>
                                      <input type='text' class="form-control" name="date" placeholder="YYYY-MM-DD HH:MM:SS"/>
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Assessment Criteria</label>
                                <br>
                                <input class="form-control" name="criteria1" placeholder="Criteria 1" required></input>
                                <br>
                                <input class="form-control" name="criteria2" placeholder="Criteria 2" required></input>
                                <br>
                                <input class="form-control" name="criteria3" placeholder="Criteria 3" required></input>
                                <br>
                                <input class="form-control" name="criteria4" placeholder="Criteria 4" required></input>
                                <br>
                                <input class="form-control" name="criteria5" placeholder="Criteria 5" required></input>
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-default btn-primary" name = "submit">Submit</button>
                            </div>
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
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER -->

<?php include('admin-footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datetimepicker1').datetimepicker();
  });

</script>