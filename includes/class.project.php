<?php 
session_start();


class Project {
  private $projectId;
  private $projectTitle;
  private $dueDate;
  private $description;
  private $criteria = array(5);

  /* Constructor for Project class */
  public function __construct($data) {
    $this->projectId = $data['projectId'];
    $this->projectTitle = $data['projectTitle'];
    $this->dueDate = $data['dueDate'];
    $this->description = $data['projectDescription'];
    $this->criteria = array($data['criteria1'], $data['criteria2'], $data['criteria3'], $data['criteria4'], $data['criteria5']);
  }

  /* Getters for private fields */
  public function getId() {
    return $this->projectId;
  }
  public function getTitle() {
    return $this->projectTitle;
  }
  public function getDueDate() {
    return $this->dueDate;
  }
  public function getDescription() {
    return $this->description;
  }
  public function getCriteria() {
    return $this->criteria;
  }
  
  public function calculateMean($db, $projectId) {
    $q = "SELECT ROUND(AVG(score1 + score2 + score3 + score4 + score5), 2) as mean from assessments WHERE projectId = {$projectId}";
    $r = $db->query($q);
    $data = $r->fetch_assoc();
    return $data['mean'];
  }

  public function getScoreForUser($db, $projectId, $groupId) {
    $q = "SELECT ROUND(AVG(score1 + score2 + score3 + score4 + score5), 2) from assessments WHERE groupAssessed = {$groupId} AND projectId = {$projectId}";
    $r = $db->query($q);
    $data = $r->fetch_assoc();
    return $data['avgScore'];
  }




}


?>