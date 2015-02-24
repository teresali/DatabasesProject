<?php

class Report {
  private $reportId;
  private $groupId;
  private $projectId;
  private $title;
  private $dateSubmitted;
  private $text;
  private $overallScore;

  function __construct($data) {
    $this->reportId = $data['reportId'];
    $this->groupId = $data['groupId'];
    $this->projectId = $data['projectId'];
    $this->title = $data['title'];
    $this->dateSubmitted = $data['dateSubmitted'];
    $this->text = $data['text'];
  }

  /* Getters for fields */
  public function get_groupId() {
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
}

?>