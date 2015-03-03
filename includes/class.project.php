<?php 

class Project {
  private $id;
  private $title;
  private $dueDate;
  private $desc;
  private $criteria(5);

  public function __construct($data) {

  }


  public function getProjects($db, $groupId) {
    $q = "SELECT projectId, projectTitle, dueDate from Projects";

  }

  public function calculateMean($db, $projectId) {
    $q = "SELECT AVG(overallScore) as avgScore from Reports WHERE projectId = ".$projectId;
    $data = $db->query($q);
    return $data['avgScore'];
  }

  public function getScoreForUser($db, $projectId, $groupId) {
    $q = "SELECT overallScore from Reports WHERE groupId = ".$groupId." AND projectId = ".$projectId;
    $data = $db-> query($q);
  }



}

?>