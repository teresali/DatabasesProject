<?php 

class Assessment{
  private groupId;
  private reportId;
  private score(6);

  function __construct($groupId, $reportId) {
    $this->groupId = $groupId;
    $this->reportId = $reportId;
  }

  /* Getters for fields */
  public function getGroupId() {
    return $this->data;
  }


  public function submit($s1, $s2, $s3, $s4, $s5) {
    var total = $s1 + $s2 + $s3 + $s4 + $s5;
    # set the score array

    # update the database
  }
}

?>