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
    $q = "SELECT ROUND(AVG(score1),2) as s1, ROUND(AVG(score2),2) as s2, ROUND(AVG(score3),2) as s3, ROUND(AVG(score4),2) as s4, ROUND(AVG(score5),2) as s5, ROUND(AVG(score1 + score2 + score3 + score4 + score5), 2) as score from assessments WHERE groupAssessed = {$groupId} AND projectId = {$projectId}";
    $r = $db->query($q);
    $data = $r->fetch_assoc();
    $scores = array(
      'total' => $data['score'],
      's1'    => $data['s1'],
      's2'    => $data['s2'],
      's3'    => $data['s3'],
      's4'    => $data['s4'],
      's5'    => $data['s5']
    );
    return $scores;
  }

  public function getRankForUser($db, $projectId, $groupId) {
    $q = "SELECT groupAssessed, avgScore, @curRank := @curRank + 1 as rank 
          FROM (
            SELECT groupAssessed, (score1 + score2 + score3 + score4 + score5) as avgScore from assessments where projectId = {$projectId} group by groupAssessed) x, 
            (SELECT @curRank := 0 ) y 
          ORDER BY avgScore DESC";
    $r = $db->query($q);
    $num_rows = $r->num_rows;

    while($data =& $r->fetch_assoc()) {
      if($data['groupAssessed'] == $groupId) {
        return array($data['rank'], $num_rows);
      }
    }
    return NULL;
  }


}


?>