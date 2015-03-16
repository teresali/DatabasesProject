<?php 

class Assessment{
  private $groupId;
  private $reportId;
  private $score = array(6);

  function __construct($data) {
    $this->groupId = $this['groupId'];
    $this->reportId = $this['reportId'];
  }


  public function scoreType($mean, $std, $val) {
    // good score
    if($val > $mean + $std) {
      return 0;
    // below average score
    } else if ($val < $mean - $std) {
      return 2;
    // average score
    } else {
      return 1;
    }
  }
}

?>