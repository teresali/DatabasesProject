<?php

class Report {
  private $groupId;
  private $projectId;
  private $title;
  private $dateSubmitted;
  private $text;
  private $overallScore;

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
  public function getScore() {
    return $this->overallScore;
  }

  public function exists($groupId, $projectId, $db) {
    $q = "SELECT * FROM reports 
            WHERE groupId = {$groupId} and projectId = {$projectId}";
    $check_exists = $db->query($q);
    if($check_exists->num_rows == 1) {
      return True;
    }
    return False;
  }

  public function addReport($data, $db) {
    $date = date('Y-m-d H:i:s');
    $q = "INSERT INTO reports (groupId, projectId, title, dateSubmitted, textContent) 
            VALUES ({$data['groupId']}, {$data['projectId']}, '{$data['title']}', '{$date}', '{$data['textContent']}')";
    $db->query($q);
  }

  public function replaceExisting($data, $db) {
    $date = date('Y-m-d H:i:s');
    $q = "UPDATE reports
            SET title='{$data['title']}', dateSubmitted='{$date}', textContent='{$data['textContent']}'
            WHERE projectId={$data['projectId']} and groupId={$data['groupId']}";
    $db->query($q);
  }

  public function getAvgScore() {

  }


}

?>