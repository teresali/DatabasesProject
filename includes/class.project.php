<?php 
session_start();

class Project {
  private $projectId;
  private $projectTitle;
  private $dueDate;
  private $description;
  private $criteria(5);

  public function __construct($data) {
    echo 'in construct';
    $this->projectId = $data['projectId'];
    $this->projectTitle = $data['projectTitle'];
    $this->dueDate = $data['dueDate'];
    $this->description = $data['projectDescription'];
    $this->criteria = array($data['criteria1'], $data['criteria2'], $data['criteria3'], $data['criteria4'], $data['criteria5']);
  }

  public function test() {
    echo 'hi';
  }

  public function calculateMean($db, $projectId) {
    $q = "SELECT ROUND(AVG(avgScore), 2) as mean from reports WHERE projectId = {$projectId}";
    $r = $DB->query($q);
    $data = $r->fetch_assoc();
    return $data['mean'];
  }

  public function getScoreForUser($db, $projectId, $groupId) {
    $q = "SELECT avgScore from reports WHERE groupId = {$groupId} AND projectId = {$projectId}";
    $r = $DB->query($q);
    $data = $r->fetch_assoc();
    return $data['avgScore'];
  }



}

?>