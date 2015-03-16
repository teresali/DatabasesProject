<?php 
session_start();
include('header.php');
?>

        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page-header">
                            Projects
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Name</th>
                                            <th class="col-md-3">Due Date</th>
                                            <th class="col-md-1">Score</th>
                                            <th class="col-md-1">Mean</th>
                                            <th class="col-md-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(isset($_SESSION['user'])) {
                                                $DB = Database::Instance();
                                                $q = "SELECT projectId, projectTitle, dueDate from Projects";
                                                $result = $DB->query($q);

                                                while($p =& $result->fetch_assoc()) {
                                                    $projectId = $p['projectId'];
                                                    $title = $p['projectTitle'];
                                                    $dueDate = $p['dueDate'];
                                                    // have to change once configure admin
                                                    $groupId = 1;                                               
                                                    $mean = Project::calculateMean($DB, $projectId);
                                                    $score = Project::getScoreForUser($DB, $projectId, $groupId)['total'];

                                                    echo "<tr>";
                                                    echo "<td><a href=report.php?projectId={$projectId}&groupId={$groupId}>{$title}<S/a></td>";
                                                    echo "<td>{$dueDate}</td>";
                                                    echo "<td>{$score}</td>";
                                                    echo "<td>{$mean}</td>";
                                                    echo "<td>Graded</td>";
                                                    echo "</tr>";
                                                }
                                           }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->

                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER -->


<?php include('footer.php'); ?>
