<?php 
  session_start();
  // redirects to 404 page if user is not an admin
  if(!$_SESSION['isAdmin']) {
    echo "<div style='margin-left:560px; margin-top:200px'><img src='sadface.png' height='200px' width='200px'><p><div style='font-size:50pt; margin-left:50px'>404</div></p><p><div style='font-size:20pt;margin-left:-70px'>Not an Admin Unable to View Page</div></p>";
    header("HTTP/1.0 404 Not Found");
    exit();
  } else {

    include('admin-header.php');
    include('../../config.php');

    $DB = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if(isset($_POST['submit'])) {
        $date = date('Y-m-d H:i:s');
        $textContent = $_POST['announcement'];

        if($date && $textContent) {
            $q = "INSERT INTO announcements (datePosted, textContent) VALUES ('{$date}', '{$textContent}')";
            $DB->query($q);
        }
    }

?>


        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Admin
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="view-scores.php">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-bar-chart-o fa-5x" style="padding-top:15px"></i>
                            </div>
                            <div class="panel-footer back-footer-green">
                                View Scores
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="add-project.php">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-file-text-o fa-5x" style="padding-top:15px"></i>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Add Project

                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="assign-groups.php">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-users fa-5x" style="padding-top:15px"></i>    
                            </div>
                            <div class="panel-footer back-footer-red">
                                Assign Groups

                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="assign-assessments.php">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-list-alt fa-5x" style="padding-top:15px"></i>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Assign Assessments

                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default no-boder">
                          <div class="panel-heading">
                            Post Announcement
                          </div>
                          <div class="panel-body">
                            <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                  <textarea class="form-control" rows="5" name="announcement" placeholder="Tell your students something.." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-default btn-primary" name="submit">Post</button>
                              </form>

                          </div>
                          <!-- panel-body -->
                        </div>
                        <!-- panel -->

                    </div>
                    <!-- col-lg-12 -->
                </div>
                <!-- row -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
            
            
<?php 
include('admin-footer.php'); 
}?>