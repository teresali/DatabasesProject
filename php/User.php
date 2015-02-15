<?php 

class User {
  private $fName;
  private $lName;
  private $email;
  private $groupId;
  private $isAdmin;

  /* Constructor for User class */
  function __construct($fName, $lName, $email, $groupId, $isAdmin) {
    $this->fName = $fName;
    $this->lName = $lName;
    $this->email = $email;
    $this->groupId = $groupId;
    $this->isAdmin = $isAdmin;
  }

  /* Getters for fields */
  public function getName() {
    return $this->fName . " " . $this->lName;
  }

  public function getGroupId() {
    return $this->groupId;
  }

  public function isAdmin() {
    return $this->isAdmin;
  }
}


?>