<?php 

class Assessment{
  private $groupId;
  private $reportId;
  private $totalScore;
  private $score(6);

  function __construct($data) {
    $this->groupId = $this['groupId'];
    $this->reportId = $this['reportId'];
  }

  /* Getters for fields */
  public function getGroupId() {
    return $this->groupId;
  }

  /* Update total score 
      @params: int
  */
  public function setTotalScore($newScore) {
    $this->totalScore = $newScore;
  }

  /* Submit an assessment
      @params: int, int, int, int, int
  */
  public function submit($s1, $s2, $s3, $s4, $s5) {
    var total = $s1 + $s2 + $s3 + $s4 + $s5;
    # set the score array

    # update the database
  }
}

?>