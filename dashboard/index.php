<?php   
include('header.php'); 
$DB = Database::Instance();

?>

        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-header">
                            Welcome, <?php echo $_SESSION['user']->getFname() ?>
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default no-boder">
                          <div class="panel-heading">
                            Recent Announcements
                          </div>
                          <div class="panel-body">

                            <?php
                                $q = "SELECT * FROM `announcements` ORDER BY datePosted DESC LIMIT 3";
                                $r = $DB->query($q);

                                while($a =& $r->fetch_assoc()) {
                                    $date = new DateTime($a['datePosted']);
                                    $date = $date->format('d-m-Y');
                                    $text = $a['textContent'];

                                    echo "<p><div>{$date}</div>";
                                    echo "<div>&nbsp&nbsp{$text}</div></p>";
                                }
                            ?>

                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="projects.php">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-bar-chart-o fa-5x" style="padding-top:15px"></i>
                            </div>
                            <div class="panel-footer back-footer-green">
                                View Projects
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="assessments.php">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-file-text-o fa-5x" style="padding-top:15px"></i>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                View Assessments
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="no-style" href="forum.php">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body" style="height:128px">
                                <i class="fa fa-users fa-5x" style="padding-top:15px"></i>    
                            </div>
                            <div class="panel-footer back-footer-red">
                               Chat
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
                                Student Info
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <!-- Row -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER -->


<?php include('footer.php'); ?>
