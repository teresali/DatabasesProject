<?php

class Report {
  private $groupId;
  private $projectId;
  private $title;
  private $dateSubmitted;
  private $text;

  function __construct($data) {
    $this->groupId = $data['groupId'];
    $this->projectId = $data['projectId'];
    $this->title = $data['title'];
    $this->dateSubmitted = $data['dateSubmitted'];
    $this->text = $data['textContent'];
  }

  /* Getters for fields */
  public function getGroupId() {
    return $this->groupId;
  }
  public function getProjectId() {
    return $this->projectId;
  }
  public function getTitle() {
    return $this->title;
  }

  public function test() {
    echo "YOOOOOoooooooojsodjfjsadfjsldkjflsdjflsdjfalksdjfaljsdlfjsd";
  }


  public function exists($groupId, $projectId, $db) {
    $q = "SELECT * FROM reports 
            WHERE groupId = {$groupId} and projectId = {$projectId}";
    $check_exists = $db->query($q);
    if($check_exists->num_rows == 1) {
      return $check_exists->fetch_assoc();
    }
    return NULL;
  }

  public function addReport($data, $db) {
    $date = date('Y-m-d H:i:s');
    $q = "INSERT INTO reports (groupId, projectId, title, dateSubmitted, textContent, md5) 
            VALUES ({$data['groupId']}, {$data['projectId']}, '{$data['title']}', '{$date}', '{$data['textContent']}', '{$data['md5']}')";
    $db->query($q);
  }

  public function replaceExisting($data, $db) {
    $date = date('Y-m-d H:i:s');
    $q = "UPDATE reports
            SET title='{$data['title']}', dateSubmitted='{$date}', textContent='{$data['textContent']}', md5='{$data['md5']}'
            WHERE projectId={$data['projectId']} and groupId={$data['groupId']}";
    $db->query($q);
  }

  public function calculateRank($groupdId, $projectId, $db) {
    // $q = "SELECT AVG(score1), AVG(score2), AVG(score3), AVG(score4), AVG(score5), @curRank := @curRank + 1 as score1, score2, score3, score4, score5, rank from assessments, (SELECT @curRank := 0) r where groupId={$groupId and projectId={$projectId} order by (score1+score2+score3+score4+score5)";
    // echo $q;

  }

}

?>