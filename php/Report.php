<?php

class Report {
  private groupId;
  private projectId;
  private title;
  private dateSubmitted;
  private text;
  private overallScore;

  function __construct($groupId, $projectId, $title, $dateSubmitted, $text) {
    $this->groupId = $groupId;
    $this->projectId = $projectId;
    $this->title = $title;
    $this->dateSubmitted = $dateSubmitted;
    $this->text = $text;
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