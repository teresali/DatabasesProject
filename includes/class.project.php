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
    $result = $db->query($q);
    $projects = array();

    while($p =& $result->fetch_assoc()) {
      $projectId = $p['projectId'];
      $projectTitle = $p['projectTitle'];
      $dueDate = $p['dueDate'];
      $mean = self::calculateMean($db, $projectId);
      $score = self::getScoreForUser($db, $projectId, $groupId);
      
    }
  }

  public function calculateMean($db, $projectId) {
    $q = "SELECT AVG(overallScore) as avgScore from reports WHERE projectId = ".$projectId;
    $result = $db->query($q);
    $data = $result->fetch_assoc();
    return $data['avgScore'];
  }

  public function getScoreForUser($db, $projectId, $groupId) {
    $q = "SELECT overallScore from reports WHERE groupId = {$groupId} AND projectId = {$projectId}";
    $data = $db->query($q);
  }



}

?>