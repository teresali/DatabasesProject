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
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
<!--
                        <div class="panel-heading">
                             Projects
                        </div>
-->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                                    $projectTitle = $p['projectTitle'];
                                                    $dueDate = $p['dueDate'];
                                                    // have to change once configure admin
                                                    $groupId = 1;
                                                  
                                                    $q = "SELECT ROUND(AVG(avgScore), 2) as mean from reports WHERE projectId = {$projectId}";
                                                    $r = $DB->query($q);
                                                    $data = $r->fetch_assoc();
                                                    $mean = $data['mean'];
                                                    // $mean = Project::calculateMean($DB, $projectId);

                                                    $q = "SELECT avgScore from reports WHERE groupId = {$groupId} AND projectId = {$projectId}";
                                                    $r = $DB->query($q);
                                                    $data = $r->fetch_assoc();
                                                    $score = $data['avgScore'];
                                                    // $score = Project::getScoreForUser($DB, $projectId, $groupId);

                                                    echo "<tr>";
                                                    echo "<td><a href=report.php?projectId={$projectId}&groupId={$groupId}>{$projectTitle}</a></td>";
                                                    echo "<td>{$dueDate}</td>";
                                                    echo "<td>12</td>";
                                                    echo "<td>12</td>";
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
